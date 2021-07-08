<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Photo;

class PhotosController extends Controller
{
  public function create($album_id) {
    return view('photos.create')->with('album_id', $album_id);
  }

  public function store(Request $request) {
    $album_id = $request->input('album_id');

    $validator = Validator::make($request->all(), [
      'title' => 'required',
      'description' => 'required',
      'photo' => 'required|image|max:500'
    ]);

    if ($validator->fails()) {
      $keys = array_keys($validator->messages()->getMessages());
      return redirect("/photos/create/$album_id")->with('firstError', $keys[0])->withErrors($validator)->withInput();
    }

    // file upload    
    $filenameWithExt = $request->file('photo')->getClientOriginalName();
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    $extension = $request->file('photo')->getClientOriginalExtension();
    $filesize = $request->file('photo')->getClientSize();
    $currentTime = time();
    $filenameToStore = "{$filename}_{$currentTime}.{$extension}";
    $path = $request->file('photo')->storeAs("public/photos/$album_id", $filenameToStore);

    // upload photo    
    $photo = new Photo;
    $photo->album_id = $album_id;
    $photo->title = $request->input('title');
    $photo->description = $request->input('description');
    $photo->size = $filesize;
    $photo->photo = $filenameToStore;    
    $photo->save();

    return redirect("/albums/$album_id")->with('success', 'Photo uploaded.');
  }

  public function show($id) {
    $photo = Photo::find($id);
    return view('photos.show')->with('photo', $photo);
  }

  public function destroy($id) {
    $photo = Photo::find($id);
    $filepath = "photos/{$photo->album_id}/{$photo->photo}";

    if (Storage::disk('public')->exists($filepath)) {
      Storage::disk('public')->delete($filepath);
      $photo->delete();
      return redirect("/albums/$photo->album_id")->with('success', 'Photo removed.');
    }
    else {
      return redirect("/photos/$photo->id")->with('danger', 'Photo not removed.');
    }
  }
}

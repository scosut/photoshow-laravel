<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Album;

class AlbumsController extends Controller
{
    private function getRows($data, $numPerRow) {
      $rows = [];

      while (count($data) > 0) {
        array_push($rows, array_splice($data, 0, $numPerRow));
      }

      return $rows;
    }

    public function index() {
      $albums = Album::all()->toArray();
      return view('albums.index')->with('rows', $this->getRows($albums, 3));
    }

    public function create() {
      return view('albums.create');
    }

    public function store(Request $request) {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'description' => 'required',
        'cover_image'  => 'required|image|max:500'
      ]);

      if ($validator->fails()) {
        $keys = array_keys($validator->messages()->getMessages());
        return redirect('/albums/create')->with('firstError', $keys[0])->withErrors($validator)->withInput();
      }

      // file upload
      $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('cover_image')->getClientOriginalExtension();      
      $currentTime = time();
      $filenameToStore = "{$filename}_{$currentTime}.{$extension}";
      $path = $request->file('cover_image')->storeAs('public/album_covers', $filenameToStore);

      // new album
      $album = new Album;
      $album->name = $request->input('name');
      $album->description = $request->input('description');
      $album->cover_image = $filenameToStore;
      $album->save();

      return redirect('/albums')->with('success', 'Album created.');
    }

    public function show($id) {
      $album = Album::find($id);
      $data = [
        'album_id' => $album->id,
        'album_name' => $album->name,
        'rows' => $this->getRows($album->photos->toArray(), 3)
      ];
      
      return view('albums.show')->with('data', $data);
    }
}

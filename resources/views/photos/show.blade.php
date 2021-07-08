@extends('layouts.app')

@section('title')
View Photo Details
@endsection

@section('content')
<h3>{{$photo->title}}</h3>
<p>{{$photo->description}}</p>
<a href="/albums/{{$photo->album_id}}" class="btn btn-primary">Back to Album</a>
<hr />
<div class="row">
  <div class="col-sm-6">
    <img src='{{ asset("public/storage/photos/{$photo->album_id}/{$photo->photo}") }}' class="thumbnail img-responsive" alt="{{$photo->title}}" />
  </div>
  <div class="col-sm-6">
    {!! Form::open(['action' => ['PhotosController@destroy', $photo->id], 'method' => 'post', 'onsubmit' => "return confirm('You have chosen to delete photo $photo->title. Click OK to confirm or CANCEL to abort.')"]) !!}
      {{ Form::bsHidden('_method', 'delete')}}
      {{ Form::bsSubmit('Delete Photo', ['class' => 'btn btn-danger']) }}
    {!! Form::close() !!}

    <small>Size: {{$photo->size}}</small>
  </div>
</div>
@endsection
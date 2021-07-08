@extends('layouts.app')

@section('title')
Upload Photo
@endsection

@section('content')
<h3>Upload Photo</h3>

{!! Form::open(['action' => 'PhotosController@store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
  {{ Form::bsText('title', null, ['placeholder' => 'Photo title']) }}
  {{ Form::bsTextarea('description', null, ['placeholder' => 'Photo description']) }}
  {{ Form::bsHidden('album_id', $album_id )}}
  {{ Form::bsFile('photo') }}
  {{ Form::bsSubmit(null, ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}
@endsection
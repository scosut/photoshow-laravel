@extends('layouts.app')

@section('title')
Create Album
@endsection

@section('content')
<h3>Create Album</h3>

{!! Form::open(['action' => 'AlbumsController@store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
  {{ Form::bsText('name', null, ['placeholder' => 'Album name']) }}
  {{ Form::bsTextarea('description', null, ['placeholder' => 'Album Description']) }}
  {{ Form::bsFile('cover_image') }}
  {{ Form::bsSubmit(null, ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}
@endsection
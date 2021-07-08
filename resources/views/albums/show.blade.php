@extends('layouts.app')

@section('title')
View Album Details
@endsection

@section('content')
  <h1>{{$data['album_name']}}</h1>
  <a href="/albums" class="btn btn-default">Go Back</a>&nbsp;
  <a href="/photos/create/{{$data['album_id']}}" class="btn btn-primary">Upload Photo to Album</a>
  <hr />
  <h3 class="album-title">Photos</h3>
  @if(count($data['rows']) > 0)
    @foreach($data['rows'] as $row)
      <div class="row">
        @foreach($row as $r)
        <div class="col-xs-12 col-sm-4">
          <a href="/photos/{{$r['id']}}">
            <img src='{{ asset("public/storage/photos/{$r["album_id"]}/{$r["photo"]}") }}' class="thumbnail img-responsive album-img" alt="{{$r['title']}}" />
          </a>
          <h4 class="album-name">{{$r['title']}}</h4>
        </div>
        @endforeach
      </div>
    @endforeach
  @else
    <p>No photos to display.</p>
  @endif
@endsection
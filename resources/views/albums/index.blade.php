@extends('layouts.app')

@section('title')
Albums
@endsection

@section('content')
<h3 class="album-title">Albums</h3>
@if(count($rows) > 0)
  @foreach($rows as $row)
    <div class="row">
      @foreach($row as $r)
      <div class="col-xs-12 col-sm-4">
        <a href="/albums/{{$r['id']}}">
          <img src='{{ asset("public/storage/album_covers/{$r["cover_image"]}") }}' class="thumbnail img-responsive album-img" alt="{{$r['name']}}" />
        </a>
        <h4 class="album-name">{{$r["name"]}}</h4>
      </div>
      @endforeach
    </div>
  @endforeach
@else
  <p>No albums to display.</p>
@endif
@endsection
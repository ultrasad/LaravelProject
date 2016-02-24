@extends('layouts.main')
@section('page_title', 'Hello Page')
@section('content')
  @foreach($articles as $article)
    <div class="panel panel-default">
      <div class="panel-heading">
        <a href="{{ url('articles', $article->id) }}">{{ $article->title }}</a>
      </div>
      <div class="panel-body">
          {{ $article->body }}
      </div>
      <div class="panel-footer">
        By: <strong>xx {{-- $article->user->name --}}</strong>,
        {{ $article->published_at->diffForHumans() }}
      </div>
    </div>
  @endforeach
@stop

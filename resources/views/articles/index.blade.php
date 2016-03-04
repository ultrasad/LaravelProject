@extends('layouts.main')
@section('page_title', 'Hello Page')
@section('content')
  @forelse($articles as $article)
    <div class="panel panel-default">
      <div class="panel-heading">
        <a href="{{ url('articles', $article->id) }}">{{ $article->title }}</a>
      </div>
      <div class="panel-body">
          {{ $article->body }}
      </div>
      <div class="panel-footer">
        By: <strong> {{ $article->user->name }}</strong>,
        {{ $article->published_at->diffForHumans() }}
      </div>
    </div>
  @empty
  <p>No Article</p>
  @endforelse
  {!! $articles->links() !!}
@stop

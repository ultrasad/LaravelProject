@extends('layouts.document')
@section('page_title', 'Events List')
@section('content')
  @forelse($events as $event)
    <div class="panel panel-default">
      <div class="panel-heading">
        <a href="{{ url('articles', $article->id) }}">{{ $event->title }}</a>
      </div>
      <div class="panel-body">
          {{ $event->body }}
      </div>
      <div class="panel-footer">
        By: <strong> {{ $event->user->name }}</strong>,
        {{ $article->published_at->diffForHumans() }}
      </div>
    </div>
  @empty
  <p>No Article</p>
  @endforelse
  {!! $events->links() !!}
@stop

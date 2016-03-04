@extends('layouts.main')
@section('page_title', 'Hello Page')
@section('content')
<div>
  {{ $article->title }}
  <a class="btn btn-primary" href="{{ url("articles/{$article->id}/edit")}}">Edit</a>
</div>

<div class"panel panel-default">
  <div class="panel-body">

    @if($article->image)
      <img src="{{ url($article->image) }}" class="img-responsive" style="max-width: 200px" />
    @else
      <img src="{{ url('images/laravel-logo.png') }}" class="img-responsive" style="max-width: 200px" />
    @endif
    {{ $article->body }}
  </div>
  <div class="panel-footer">
    {{ $article->published_at->diffForHumans() }}

    @unless($article->tags->isEmpty())
      <div>Tags
        <ul>
          @foreach($article->tags as $tag)
            <li class="label label-primary">{{ $tag->name }}</li>
          @endforeach
        </ul>
      </div>
    @endunless
  </div>
</div>
<div>
  {!! Form::open(array('method' => 'DELETE', 'url' => 'articles/' . $article->id)) !!}
  {!! Form::submit('DELETE', ['class' => 'btn btn-danger']) !!}
  {!! Form::close() !!}
</div>
@stop

@extends('layouts.main')
@section('page_title', 'Hello Page')
@section('content')
<div>
  {{ $article->title }}
  <a class="btn btn-primary" href="{{ url("articles/{$article->id}")}}">Edit</a>
</div>

<div class"panel panel-default">
  <div class="panel-body">
    {{ $article->body }}
  </div>
  <div class="panel-footer">
    {{ $article->published_at }}
  </div>
</div>
<div>
  {!! Form::open(array('method' => 'DELETE', 'url' => 'articles/' . $article->id)) !!}
  {!! Form::submit('DELETE', ['class' => 'btn btn-danger']) !!}
  {!! Form::close() !!}
</div>
@stop

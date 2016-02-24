@extends('layouts.main')
@section('content)
  <h1 class="page-title">Edit: {{$article->title}}</h1>
  @include('errors.list')
  {!! Form::model($article, ['method' => 'PATCH', 'action' => [ArticlesController@update, $article->id]]) !!}
    @include('articles._form', ['submitButtonText' => '<i class="glyphicon-pancil"></i>Edit Article'])
  {!! Form::close() !!}
@stop

@extends('layouts.main')
@section('content')
  <h1 class="page-title">Edit: {{$article->title}}</h1>
  @include('errors.list')
  {!! Form::model($article, array('method' => 'PATCH', 'action' => array('ArticlesController@update', $article->id), 'files' => true)) !!}
    @include('articles._form', ['submitButtonText' => '<i class="glyphicon glyphicon-pencil"></i>Edit Article', 'articleTagList' => $article->tag_list])
  {!! Form::close() !!}
@stop

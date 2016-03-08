@extends('layouts.main')
@section('content')
  <h1 class='page-title'>Write a New article</h1>
  @include('errors.list')
  {!! Form::open(array('method' => 'POST', 'id' => 'article', 'url' => 'articles', 'files' => true)) !!}
    @include('articles._form', ['submitButtonText' => '<i class="glyphicon glyphicon-plus"></i>Add Article', 'articleTagList' => null])
  {!! Form::close() !!}
@stop

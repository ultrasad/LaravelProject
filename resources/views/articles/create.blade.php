@extends('layouts.main')
@section('content)
  <h1 class='page-title'>Write a New article</h1>
  @include('errors.list')
  {!! Form::open('url' => 'articles')!!}
    @include('articles._form', ['submitButtonText' => '<i class="glyphicon-plus"></i>Add Article'])
  {!! Form::close() !!}
@stop

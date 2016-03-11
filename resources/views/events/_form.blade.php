<!-- View partial -->
<div class="form-group">
  {!! Form::label('title', 'Event Title') !!}
  {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('title', 'Event Image') !!}
  {!! Form::file('image', ['class' => 'images']) !!}
</div>

<div class="form-group">
  {!! Form::label('body', 'Event Body: ') !!}
  {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('tag_list', 'Tags: ') !!}
  {!! Form::select('tag_list[]', $tag_list, $articleTagList, ['multiple', 'class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('published_at', 'Publish On: ') !!}
  {!! Form::input('date', 'published_at', \Carbon\Carbon::now()->format('Y-m-d'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::button($submitButtonText, ['class' => 'btn btn-primary form-control', 'type' => 'submit']) !!}
</div>

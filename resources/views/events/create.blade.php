@extends('layouts.document')
@section('page_title', 'Events Create')
@section('content')
  <!-- START CONTAINER FLUID -->
  <div class="container-fluid container-fixed-lg">
    <div class="row">
      <div class="col-md-12">
        <h1 class='page-title'>Write a New event / Multiple Language</h1>
        @include('errors.list')
      </div>
      <div class="col-md-8">
        <!-- START PANEL -->
        <div class="panel panel-default">
          <!--<div class="panel-heading">
            <div class="panel-title">
              Option #one
            </div>
          </div>-->
          <div class="panel-body">
            <h5>Pages default style</h5>
            <form class="" role="form">
              <div class="form-group form-group-default required">
                <label>หัวข้อข่าว</label>
                <input type="text" name="title" class="form-control" placeholder="โปรโมชั่น" required />
              </div>
              <div class="form-group form-group-default required">
                <label>URL SLUG (ภาษาอังกฤษเท่านั้น / สูงสุด 60 ตัวอักษร)</label>
                <input type="text" name="url_slug" class="form-control" placeholder="ex: promotion-my-brand-my-name-date-year" required />
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group form-group-default input-group col-sm-12">
                    <label>วันที่เริ่ม</label>
                    <input type="text" name="start_date" class="form-control" placeholder="Pick a date" id="datepicker-component2">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group form-group-default input-group col-sm-12">
                    <label>วันสิ้นสุด</label>
                    <input type="text" name="end_date" class="form-control" placeholder="Pick a date" id="datepicker-component2">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
                </div>
              </div>
              <div class="form-group form-group-default input-group">
                <label>รูปภาพหลัก</label>
                <input type="file" name="image" class="form-control" placeholder="รูปภาพ" />
                <span class="input-group-addon"><i class="fa fa-picture-o icon-picture"></i></span>
              </div>
              <!-- START PANEL -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="panel-title">
                    Drag n' drop uploader
                  </div>
                  <div class="tools">
                    <a class="collapse" href="javascript:;"></a>
                    <a class="config" data-toggle="modal" href="#grid-config"></a>
                    <a class="reload" href="javascript:;"></a>
                    <a class="remove" href="javascript:;"></a>
                  </div>
                </div>
                <div class="panel-body no-scroll no-padding">
                  <!-- <form action="/file-upload" class="dropzone no-margin"> -->
                    <div class="dropzone" id="dropzone-image">
                      <div class="fallback">
                        <input name="file" type="file" multiple />
                      </div>
                    </div>
                  <!-- </form> -->
                </div>
              </div>
              <!-- END PANEL -->
              <div class="form-group form-group-default required">
                <label>Tags</label>
                <input class="tagsinput custom-tag-input" type="text" value="hello World, quotes, inspiration" />
              </div>
              <div class="form-group required">
                <label>รายละเอียดแบบย่อ</label>
                <textarea class="form-control" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label>รายละเอียด</label>
                <div class="tools">
                  <a class="collapse" href="javascript:;"></a>
                  <a class="config" data-toggle="modal" href="#grid-config"></a>
                  <a class="reload" href="javascript:;"></a>
                  <a class="remove" href="javascript:;"></a>
                </div>
                <div class="no-scroll">
                  <div class="summernote-wrapper">
                    <div id="summernote">Hello Summernote</div>
                  </div>
                </div>
              </div>

              <!--<div class="form-group form-group-default required ">
                <label>Project</label>
                <input type="email" class="form-control" required>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group form-group-default required">
                    <label>First name</label>
                    <input type="text" class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>Last name</label>
                    <input type="text" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group form-group-default required">
                <label>Password</label>
                <input type="password" class="form-control" required>
              </div>
              <div class="form-group  form-group-default required">
                <label>Placeholder</label>
                <input type="email" class="form-control" placeholder="ex: some@example.com" required>
              </div>
              <div class="form-group form-group-default disabled">
                <label>Disabled</label>
                <input type="email" class="form-control" value="You can put anything here" disabled>
              </div>-->

            </form>
          </div>
        </div>
        <!-- END PANEL -->
      </div>
      <div class="col-md-4">
        <!-- START PANEL -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">
              Option #two
            </div>
          </div>
          <div class="panel-body">
            <h5>Traditional Standard Style</h5>
            <form role="form">
              <div class="form-group">
                <label>Your name</label>
                <span class="help">e.g. "Mona Lisa Portrait"</span>
                <input type="email" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Password</label>
                <span class="help">e.g. "Mona Lisa Portrait"</span>
                <input type="password" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <span class="help">e.g. "some@example.com"</span>
                <input type="email" class="form-control" placeholder="ex: some@example.com" required>
              </div>
              <div class="form-group">
                <label>Placeholder</label>
                <span class="help">e.g. "some@example.com"</span>
                <input type="email" class="form-control" placeholder="ex: some@example.com" required>
              </div>
              <div class="form-group">
                <label>Disabled</label>
                <span class="help">e.g. "some@example.com"</span>
                <input type="email" class="form-control" value="You can put anything here" disabled>
              </div>
            </form>
          </div>
        </div>
        <!-- END PANEL -->
      </div>
    </div>
  </div>
  <!-- END CONTAINER FLUID -->

  {{--
  <h1 class='page-title'>Write a New event</h1>
  @include('errors.list')
  {!! Form::open(array('method' => 'POST', 'id' => 'article', 'url' => 'articles', 'files' => true)) !!}
    @include('events._form', ['submitButtonText' => '<i class="glyphicon glyphicon-plus"></i>Add Article', 'articleTagList' => null])
  {!! Form::close() !!}
  --}}
@stop

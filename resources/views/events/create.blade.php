@extends('layouts.document')
@section('page_title', 'Events Create')
@section('content')
  <!-- START CONTAINER FLUID -->
  <form class="events-form dropzone" id="my-awesome-dropzone-form" role="form" action="/events" enctype="multipart/form-data" method="POST">
  {{ Form::token() }}
  <div class="container-fluid container-fixed-lg">
    <div class="row">
      <div class="col-md-12">
        <h3 class='page-title'>เพิ่มข่าวโปรโมชั่น / Multiple Language</h3>
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
            <!-- <h5>Pages default style</h5>-->
              <div class="form-group form-group-default required">
                <label>หัวข้อข่าว</label>
                <input type="text" name="title" class="form-control" placeholder="โปรโมชั่น" oninvalid="this.setCustomValidity('Please Enter valid title')" required />
              </div>
              <div class="form-group form-group-default required">
                <label>URL SLUG (ภาษาอังกฤษเท่านั้น / สูงสุด 60 ตัวอักษร)</label>
                <input type="text" name="url_slug" class="form-control" placeholder="ex: promotion-my-brand-my-name-date-year" required />
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group form-group-default input-group col-sm-12">
                    <label>วันที่เริ่ม</label>
                    <input type="text" name="start_date" class="form-control" placeholder="Pick a date" id="datepicker-component">
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
                <input type="file" name="image" class="form-control image" id="image" placeholder="รูปภาพ" />
                <span class="input-group-addon"><i class="fa fa-picture-o icon-picture"></i></span>
              </div>
              <!-- START PANEL -->
              <div class="form-group form-group-default panel-gallery"><label>รูปภาพ Gallery (ต้องเชื่อมต่อกับ Facebook Fanpage)</label></div>
              <div class="panel-body no-scroll no-padding dropzone-file-previews">
                <input type='hidden' name='base64data' id="base64data" />
                <div class="table table-striped files dropzone-previews dropzoner" id="previews">
                     <div id="template" class="file-row">
                       <div class="dz-default dz-message" data-dz-message><span>Drop files here to upload</span></div>
                     </div>
                 </div>
              </div>

              <!-- <div id="dropzone1" class="dropzone_mix">dd1</div> -->

              <!--<div class="dropzone" id="dropzone-image">
                <div id="my-dropzone" class="my-dropzone"></div>
              </div>-->

              <!-- <div id="dropzone3" class="dropzone_mix">dropzone mix</div> -->

              <!-- END PANEL -->
              <div class="form-group form-group-default required">
                <label>Keyword (สูงสุด 20 คำ)</label>
                <input class="tagsinput custom-tag-input" name="tags" type="text" value="hello World, quotes, inspiration" />
              </div>
              <div class="form-group form-group-default form-group-area required">
                <label>รายละเอียดแบบย่อ</label>
                <textarea class="form-control" name="brief" rows="3" required></textarea>
              </div>
              <!--<div class="form-group form-group-area required">
                <label>รายละเอียดแบบย่อ</label>
                <textarea class="form-control" name="brief" rows="3" required></textarea>
              </div>-->
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
                    <!-- <div id="summernote" name="detail">Hello Summernote</div> -->
                    <textarea class="input-block-level" id="summernote" name="description" class="summernote" rows="10"></textarea>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>แผนที่</label>
                <input name="namePlace" type="text" id="namePlace" size="40" /><input type="button" name="SearchPlace" id="SearchPlace" value="Search" /> 
                <div id="map_canvas" style="height: 400px; width: 100%;"></div>
                <div class="row">
                Latitude: <input name="lat_value" type="text" id="lat_value" value="0" size="17" />
                Longitude: <input name="lon_value" type="text" id="lon_value" value="0" size="17" />
                Zoom: <input name="zoom_value" type="text" id="zoom_value" value="0" size="5" />
              </div>
              </div>

              <div class="form-group social-post-title">
                <h5><i class="fa fa-share-square-o fa-lg"></i> Post ไปยัง Social Network <input type="checkbox" data-init-plugin="switchery" data-size="small" data-color="primary" checked="checked" /></h5>
              </div>

              <div class="form-group">
                <label class="social-facebook-title">Facebook</label>
                <span class="checkbox-inline">
                  <div class="checkbox check-success">
                    <input type="checkbox" checked="checked" value="1" name="fb1" id="checkbox2" />
                    <label for="checkbox2">Channel 2</label>
                  </div>
                </span>
                <span class="checkbox-inline">
                  <div class="checkbox check-primary">
                    <input type="checkbox" value="1" name="fb2" id="checkbox3">
                    <label for="checkbox3">One</label>
                  </div>
                </span>
                <textarea class="form-control" name="fb_post" rows="3"></textarea>
              </div>

              <div class="form-group">
                <label class="social-twitter-title">Twitter</label>
                <span class="checkbox-inline">
                  <div class="checkbox check-warning">
                    <input type="checkbox" checked="checked" value="1" name="tw1" id="checkbox5">
                    <label for="checkbox5">Ch8</label>
                  </div>
                </span>
                <span class="checkbox-inline">
                  <div class="checkbox check-danger">
                    <input type="checkbox" checked="checked" value="1" name="tw2" id="checkbox6">
                    <label for="checkbox6">Sabaidee</label>
                  </div>
                </span>
                <textarea class="form-control" name="tw_post" rows="3"></textarea>
              </div>
          </div>
        </div>
        <!-- END PANEL -->
      </div>
      <div class="col-md-4">
        <!-- START PANEL -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">
              สาขาที่ร่วมรายการ
            </div>
          </div>
          <div class="panel-body">
            <div class="wizard-footer padding-5 bg-master-lightest master-checkbox-all">
              <div class="checkbox check-success">
                <input type="checkbox" checked="checked" value="1" namne="branch_all" id="checkbox7">
                <label class="label-master" for="checkbox7">ทุกสาขา</label>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="wizard-footer padding-5">
              <div class="checkbox check-warning">
                <input type="checkbox" checked="checked" name="branch[]" value="ladprao,12" id="checkbox8">
                <label for="checkbox8">เซ็นทรัลลาดพร้าว</label>
              </div>
              <div class="checkbox check-warning">
                <input type="checkbox" checked="checked" name="branch[]" value="bangkapi,13" id="checkbox9">
                <label for="checkbox9">เดอะมอลล์บางกะปิ</label>
              </div>
              <div class="checkbox check-warning">
                <input type="checkbox" checked="checked" name="branch[]" value="centralworld,21" id="checkbox10">
                <label for="checkbox10">เซ็นทรัลเวิลด์</label>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
        <!-- END PANEL -->
        <!-- START PANEL -->
        <div class="panel panel-default master-checkbox-all">
          <div class="panel-heading">
            <div class="panel-title">
              <div class="checkbox check-danger">
                <input type="checkbox" checked="checked" name="show_now" value="1" id="checkbox11">
                <label class="label-master" for="checkbox11">ขึ้นแสดงผลทันที</label>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="form-group form-group-default input-group col-sm-12">
              <label>ตั้งเวลาขึ้นแสดง</label>
              <input type="text" name="show_date" class="form-control" placeholder="Pick a date" id="datepicker-component3">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
          </div>
        </div>
        <!-- END PANEL -->

        <div class="row">
          <button class="btn btn-success" type="submit" id="submit_event">Submit</button>
          <button class="btn btn-default"><i class="pg-close"></i> Clear</button>
        </div>
      </div>
    </div>
  </div>
  </form>
  <!-- END CONTAINER FLUID -->

  {{--
  <h1 class='page-title'>Write a New event</h1>
  @include('errors.list')
  {!! Form::open(array('method' => 'POST', 'id' => 'article', 'url' => 'articles', 'files' => true)) !!}
    @include('events._form', ['submitButtonText' => '<i class="glyphicon glyphicon-plus"></i>Add Article', 'articleTagList' => null])
  {!! Form::close() !!}
  --}}
@stop

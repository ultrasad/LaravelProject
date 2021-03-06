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
                <input type="file" name="image" class="form-control" placeholder="รูปภาพ" />
                <span class="input-group-addon"><i class="fa fa-picture-o icon-picture"></i></span>
              </div>
              <!-- START PANEL -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="panel-title">
                    Drag n' drop uploader
                  </div>
                </div>
                <!-- <div class="panel-body no-scroll no-padding"> -->
                <div class="panel-body no-scroll">

                  <div class="table table-striped files dropzone-previews dropzoner" id="previews">
                       <div id="template" class="file-row">
                         <div class="dz-default dz-message"><span>Drop files here to upload</span><button class="fileinput-button">Click Here</button></div>
                         <!-- <div class="form-group"><div class="dz-message" data-dz-message><span>Your Custom Message</span></div></div> -->

                           <!-- This is used as the file preview template -->
                           <!--
                           <div class=" dropzone-previews" id="dropzoner2">
                               <div class="dz-preview dz-file-preview" id="template">
                                   <div class="dz-details dztemplate">
                                       <div class="dz-filename" style="display:none;"><span data-dz-name id="filenamer"></span></div>
                                       <input type="hidden" name="filename" id="hiddeninput"/>

                                       <div class="dz-size"  style="display:none;" data-dz-size></div>
                                       <img data-dz-thumbnail /><br/><input type="text" class="dzinput" placeholder="Type Caption" name="caption" style="font-style:italic;" />
                                       <div class="closebutton" data-dz-remove><i class="fa fa-times-circle"></i></div>
                                   </div>
                                   <div class="dz-progress" style="display:none;"><span class="dz-upload" data-dz-uploadprogress></span></div>
                                   <div class="dz-success-mark" style="display:none;"><span>fff</span></div>
                                   <div class="dz-error-mark" style="display:none;"><span>ggg</span></div>
                                   <div class="dz-error-message" style="display:none;"><span data-dz-errormessage></span></div>
                               </div>
                           </div>
                           -->
                           <!-- Drop Zone Area -->

                       </div>
                   </div>

                  <!--<div class="dropzone" id="dropzone-image">
                    <div id="my-dropzone" class="my-dropzone"></div>
                  </div>-->
                  <!--<div class="dropzone-previews" id="dropzone-previews">dropzone previews</div> --> <!-- this is were the previews should be shown. -->
                </div>
            </div>
              <!--
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
                    <div class="dropzone" id="dropzone-image">
                      <div class="fallback">
                        <input name="file" type="file" name="image_files" multiple />
                      </div>
                    </div>
                </div>
              </div>
              -->
              <!-- END PANEL -->
              <div class="form-group form-group-default required">
                <label>Tags</label>
                <input class="tagsinput custom-tag-input" name="tags" type="text" value="hello World, quotes, inspiration" />
              </div>
              <div class="form-group required">
                <label>รายละเอียดแบบย่อ</label>
                <textarea class="form-control" name="brief" rows="3"></textarea>
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
                    <!-- <div id="summernote" name="detail">Hello Summernote</div> -->
                    <textarea class="input-block-level" id="summernote" name="detail" rows="10"></textarea>
                  </div>
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

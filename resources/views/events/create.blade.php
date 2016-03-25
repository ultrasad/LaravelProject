@extends('layouts.document')
@section('page_title', 'Events Create')
@section('content')
  <!-- START CONTAINER FLUID -->
  <form class="events-form dropzone" id="my-awesome-dropzone-form" role="form" action="/events" enctype="multipart/form-data" method="POST">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  {{-- Form::token() --}}
  <div class="container-fluid container-fixed-lg">
    <div class="row">
      <div class="col-md-12">
        <h3 class='page-title'>เพิ่มข่าวโปรโมชั่น / Multiple Language</h3>
        <span class="error-reponse">
          @include('errors.list')
        </span>
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
                <input type="text" class="form-control" />
                <span class="input-group-addon btn-file">
                    <input type="file" name="image" class="form-control form-control-image" id="image" placeholder="รูปภาพ" readonly />
                    <i class="fa fa-picture-o icon-picture"></i>
                </span>
              </div>

              <!--
              <div class="input-group">
                  <span class="input-group-btn">
                      <span class="btn btn-primary btn-file">
                          Browse&hellip; <input type="file" multiple>
                      </span>
                  </span>
                  <input type="text" class="form-control" readonly>
              </div>
              -->

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

              <div class="form-group form-group-default form-group-map">
                <label>สถาณที่จัดโปรโมชั่น</label>
                <input type="text" size="50" name="location_name" class="form-control" id="location_name" placeholder="กรอกข้อมูลสถาณที่เพื่อกำหนดตำแหน่ง" />
                <!-- <input name="namePlace" type="text" id="namePlace" size="40" /><input type="button" name="SearchPlace" id="SearchPlace" value="Search" /> -->
              </div>

              <div class="form-group">
                <div id="map_canvas" style="height: 400px; width: 100%;"></div>
                <div class="row">
                  <input name="location_lat" type="hidden" id="location_lat" value="0" />
                  <input name="location_lon" type="hidden" id="location_lon" value="0" />
                  <input name="location_zoom" type="hidden" id="location_zoom" value="0" />
                </div>
              </div>

              <!-- END PANEL -->
              <div class="form-group form-group-default required">
                <label>Keyword (สูงสุด 20 คำ)</label>
                <input class="tagsinput custom-tag-input" name="tag_list" type="text" value="" />
              </div>
              <div class="form-group form-group-default form-group-area required">
                <label>รายละเอียดแบบย่อ</label>
                <textarea class="form-control" name="brief" rows="3" required></textarea>
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
                    <textarea class="input-block-level note-placeholder" id="summernote" name="description" class="summernote" rows="10"><div><br></div></textarea>
                  </div>
                </div>
              </div>

              <div class="form-group social-post-title">
                <h5><i class="fa fa-share-square-o fa-lg"></i> Post ไปยัง Social Network <input type="checkbox" name="social_post_switchery" class="js-check-change" data-init-plugin="switchery" data-size="small" data-color="primary" checked="checked" /></h5>
                <input name="social_post_status" class="js-check-change-field" type="hidden" value="true" />
              </div>

              <div class="social_group">
                <div class="form-group">
                  <label class="social-facebook-title">Facebook</label>
                  <span class="checkbox-inline">
                    <div class="checkbox check-warning">
                      <input type="checkbox" checked="checked" value="1" name="fb1" id="checkbox2" />
                      <label class="label-master" for="checkbox2">Channel 2</label>
                    </div>
                  </span>
                  <span class="checkbox-inline">
                    <div class="checkbox check-warning">
                      <input type="checkbox" checked="checked" value="1" name="fb2" id="checkbox3">
                      <label class="label-master" for="checkbox3">One</label>
                    </div>
                  </span>
                  <textarea class="form-control" name="fb_message" rows="3"></textarea>
                </div>

                <div class="form-group">
                  <label class="social-twitter-title">Twitter</label>
                  <span class="checkbox-inline">
                    <div class="checkbox check-warning">
                      <input type="checkbox" checked="checked" value="1" name="tw1" id="checkbox4">
                      <label class="label-master" for="checkbox4">Ch8</label>
                    </div>
                  </span>
                  <span class="checkbox-inline">
                    <div class="checkbox check-warning">
                      <input type="checkbox" checked="checked" value="1" name="tw2" id="checkbox5">
                      <label class="label-master" for="checkbox5">Sabaidee</label>
                    </div>
                  </span>
                  <textarea class="form-control" name="tw_message" rows="3"></textarea>
                </div>
              </div>
          </div>
        </div>
        <!-- END PANEL -->
      </div>
      <div class="col-md-4">
        <!-- START PANEL -->
        <div class="panel panel-default">

          <!--
          <div class="panel-heading">
            <div class="panel-title">
              แบรนด์สินค้า
            </div>
          </div>
          -->

          <div class="row">
              <div class="col-sm-12 cs-brand">
                  <select name="brand" class="cs-select cs-skin-slide cs-select-brand" data-init-plugin="cs-select">
                    <option value="">กรุณาเลือกแบรนด์สินค้า</option>
                    @if($brand)
                      @foreach($brand as $id => $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                      @endforeach
                    @endif
                  </select>
              </div>
          </div>

          <div class="panel-heading">
            <div class="panel-title">
              สาขาที่ร่วมรายการ
            </div>
          </div>
          <div class="panel-body">
            <div class="wizard-footer padding-5 bg-master-lightest master-checkbox-all">
              <div class="checkbox check-success">
                <input type="checkbox" checked="checked" name="branch_all" value="1" class="branch_all" id="branch_all">
                <label class="label-master" for="branch_all">ทุกสาขา</label>
              </div>
              <div class="clearfix"></div>
            </div>

            <div class="wizard-footer padding-5 branch_child">
              <div class="list">
                @if($branch)
                  @foreach($branch as $id => $name)
                  <div class="checkbox check-warning">
                    <input type="checkbox" checked="checked" name="branch[]" class="branch" value="{{ $id }}" id="branch_{{ $id }}">
                    <label for="branch_{{ $id }}">{{ $name }}</label>
                  </div>
                  @endforeach
                  <div class="clearfix"></div>
                @endif
              </div>

              <div class="form-group">
                  <span class="new-branch"><i class="fs-14 pg-plus"></i>เพิ่มสาขาใหม่</span>
              </div>

              <!--
              <div class="checkbox check-warning">
                <input type="checkbox" checked="checked" name="branch[]" class="branch" value="ladprao,12" id="checkbox7">
                <label for="checkbox7">เซ็นทรัลลาดพร้าว</label>
              </div>
              <div class="checkbox check-warning">
                <input type="checkbox" checked="checked" name="branch[]" class="branch" value="bangkapi,13" id="checkbox8">
                <label for="checkbox8">เดอะมอลล์บางกะปิ</label>
              </div>
              <div class="checkbox check-warning">
                <input type="checkbox" checked="checked" name="branch[]" class="branch" value="centralworld,21" id="checkbox9">
                <label for="checkbox9">เซ็นทรัลเวิลด์</label>
              </div>
              <div class="checkbox check-warning">
                <input type="checkbox" checked="checked" name="branch[]" class="branch" value="bangkapi,21" id="checkbox10">
                <label for="checkbox10">เซ็นทรัลปิ่นเกล้า</label>
              </div>
              <div class="form-group">
                  <span class="new-branch"><i class="fs-14 pg-plus"></i>เพิ่มสาขาใหม่</span>
              </div>
              <div class="clearfix"></div>
              -->

            </div>
          </div>
        </div>
        <!-- END PANEL -->
        <!-- START PANEL -->
        <div class="panel panel-default master-checkbox-all">
          <div class="panel-heading">
            <div class="panel-title">
              <div class="checkbox check-danger">
                <input type="checkbox" checked="checked" class="published_check" name="published_now" value="{{ date('Y-m-d') }}" id="published_check">
                <label class="label-master" for="published_check">ขึ้นแสดงผลทันที</label>
              </div>
            </div>
          </div>
          <div class="panel-body published_set_time" style="display: none">
            <div class="form-group form-group-default input-group col-sm-12">
              <label>ตั้งเวลาขึ้นแสดง</label>
              <input type="text" name="published_at" class="form-control" placeholder="Pick a date" id="datepicker-component3">
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

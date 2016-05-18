@extends('layouts.admin')
@section('page_title', 'Brand Register')
@section('content')
  <!-- START CONTAINER FLUID -->
  <form class="brand-form" id="brand-register-form" role="form" action="/brand" enctype="multipart/form-data" method="POST">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  {{-- Form::token() --}}
  <div class="container-fluid container-fixed-lg">
    <div class="row">
      <div class="col-md-12">
        <h3 class='page-title'>เพิ่มแบรนด์</h3>
        <span class="error-reponse">
          @include('errors.list')
        </span>
      </div>
      <div class="col-md-8">
        <!-- START PANEL -->
        <div class="panel panel-default">
          <div class="panel-body sm-p-t-20">
              <div class="form-group form-group-default required">
                <label>ชื่อแบรนด์</label>
                <input type="text" name="name" class="form-control" placeholder="ชื่อแบรนด์" />
              </div>
              <div class="form-group form-group-default required">
                <label>URL SLUG (ภาษาอังกฤษเท่านั้น / สูงสุด 60 ตัวอักษร)</label>
                <input type="text" name="url_slug" class="form-control" placeholder="ex: my-brand-name" />
              </div>
              <div class="form-group form-group-default input-group">
                <label>Logo Image</label>
                <input type="text" class="form-control" />
                <span class="input-group-addon btn-file">
                    <input type="file" name="logo_image" class="form-control form-control-image" id="logo_image" placeholder="รูปภาพ (Logo)" readonly />
                    <i class="fa fa-picture-o icon-picture"></i>
                </span>
              </div>
              <div class="form-group form-group-default input-group">
                <label>Cover Image</label>
                <input type="text" class="form-control" />
                <span class="input-group-addon btn-file">
                    <input type="file" name="cover_image" class="form-control form-control-image" id="cover_image" placeholder="รูปภาพ (Cover)" readonly />
                    <i class="fa fa-picture-o icon-picture"></i>
                </span>
              </div>
              <div class="form-group form-group-default required">
                <label>หมวดหมู่</label>
                <select id="category" name="category[]" class="full-width category-select2" multiple>
                  @if($category)
                    @foreach($category as $id => $cate)
                      <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group form-group-default required">
                <label>สโลแกน</label>
                <input type="text" name="slogan" class="form-control" placeholder="สโลแกน" />
              </div>
              <div class="form-group form-group-default form-group-area required">
                <label>รายละเอียดแบบย่อ</label>
                <textarea class="form-control" name="detail" rows="3"></textarea>
              </div>
              <!--<div class="form-group">
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
              </div>-->
              <div class="form-group social-post-title">
                <h5><i class="fa fa-share-square-o fa-lg"></i> Social Linked สำหรับ Post ข่าวไปให้อัตโนมัติ</h5>
              </div>

              <div class="social_group_link">
                <div class="form-group">
                  <button class="btn btn-complete btn-xs fb_login" type="button" id="FBLogin"><i class="fa fa-facebook"></i><strong>&nbsp;FB Login</strong></button>
                  <!--<label class="social-facebook-title">Facebook</label>-->
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
                </div>

                <div class="form-group">
                  <button class="btn btn-success btn-xs tw_login" type="button" id="TWLogin"><i class="fa fa-twitter"></i><strong>&nbsp;TW Login</strong></button>
                  <!--<label class="social-twitter-title">Twitter</label>-->
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
                </div>
              </div>

              <div class="form-group social-post-title">
                <h5><i class="fa fa-share-alt-square fa-lg"></i> Social Network</h5>
              </div>

              <div class="social_network_link">
                <div class="form-group form-group-default">
                  <label>Facebook</label>
                  <input type="text" name="facebook" class="form-control" placeholder="Facebook" />
                </div>
                <div class="form-group form-group-default">
                  <label>Twitter</label>
                  <input type="text" name="twitter" class="form-control" placeholder="Twitter" />
                </div>
                <div class="form-group form-group-default">
                  <label>Line Officail</label>
                  <input type="text" name="line_officail" class="form-control" placeholder="Line Officail" />
                </div>
                <div class="form-group form-group-default">
                  <label>Youtube</label>
                  <input type="text" name="youtube" class="form-control" placeholder="Youtube" />
                </div>
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
            สาขา
          </div>
        </div>

        <div class="panel-body p-b-0">
          <div class="form-group new_branch_btn" style="display: ;">
              <a href="javascript: void(0);" title="เพิ่มสาขาใหม่" class="add_new_branch"><span class="new-branch"><i class="fs-14 pg-minus pg-plus"></i>เพิ่มสาขาใหม่</span></a>
          </div>
        </div>

        <div class="panel-body new_branch_panel" style="display: none;">
          <div class="form-group form-group-default form-group-map">
            <label>ชื่อสาขา</label>
            <input type="text" size="50" name="branch_name" class="form-control" id="branch_name" placeholder="ชื่อสาขา" />
          </div>

          <div class="form-group form-group-default form-group-area">
            <label>ข้อมูลสาขาแบบย่อ</label>
            <textarea class="form-control" name="branch_detail" id="branch_detail" rows="3"></textarea>
          </div>

          <div class="form-group form-group-default form-group-map">
            <label>ที่ตั้งสาขา</label>
            <input type="text" size="50" name="branch_location" class="form-control" id="branch_location" placeholder="กรอกข้อมูลสถาณที่เพื่อกำหนดตำแหน่ง" />
          </div>

          <div class="form-group">
            <div id="map_canvas_branch" class="map-canvas"></div>
            <div class="row">
              <input name="branch_location_lat" type="hidden" id="branch_location_lat" value="0" />
              <input name="branch_location_lon" type="hidden" id="branch_location_lon" value="0" />
              <input name="branch_location_zoom" type="hidden" id="branch_location_zoom" value="0" />
            </div>
          </div>

          <div class="wizard-footer padding-5 branch_child">
            <div class="form-group">
                <button class="btn btn-primary btn-xs" type="button" id="add_branch">เพิ่มสาขา</button>
            </div>
          </div>
        </div>

        <div class="panel-body p-t-0">
          <div class="branch_list" id="branch_list"></div>
        </div>

      </div>
      <!-- END PANEL -->
      <!-- START PANEL -->
      <div class="panel panel-default master-checkbox-all">
        <div class="panel-body">
          <div class="form-group form-group-default">
            <label>Username</label>
            <input type="text" name="username" class="form-control" id="branch_username" placeholder="Username" />
          </div>
          <div class="form-group form-group-default">
            <label>E-mail</label>
            <input type="text" name="email" class="form-control" id="branch_email" placeholder="E-mail" />
          </div>
          <div class="form-group form-group-default">
            <label>Password</label>
            <input type="text" name="password" class="form-control" id="branch_password" placeholder="Password" />
          </div>
        </div>
        <div class="panel-heading">
          <div class="panel-title">
            <div class="checkbox check-danger">
              <input type="checkbox" checked="checked" class="approve_status" name="approve_status" value="Y" id="approve_status">
              <label class="label-master" for="approve_status">Approved (Admin)</label>
            </div>
          </div>
        </div>
      </div>
      <!-- END PANEL -->

        <div class="row">
          <button class="btn btn-success" type="submit" id="submit_event">Submit</button>
          <button class="btn btn-default" type="reset"><i class="pg-close"></i> Clear</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="fbPostModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
  	<div class="modal-content">
  	  <div class="modal-header">
  		<div class="close" data-dismiss="modal" aria-label="Close"></div>
  		<span class="modal-title" id="myModalLabel">
  			<img class="img-responsive" width="316" src="/assets/img/text_header_popup.png" />
  		</span>
  	  </div>

  		<div class="modal-body">
  			<textarea name="message" class="box-mind form-control" rows="2" placeholder="What's on your mind?"></textarea>
  			<img src="/assets/img/sabaideetv_pr6years_407-132.png" width="405" class="img-responsive" />
  			<input type="hidden" name="access_token" id="tokenId" value=""/>
  			<input type="hidden" name="fb_id" id="fbId" value=""/>
  			<input type="hidden" name="first_name" id="firstName" value=""/>
  			<input type="hidden" name="last_name" id="lastName" value=""/>
  			<input type="hidden" name="gender" id="gender" value=""/>
  			<input type="hidden" name="email" id="email" value=""/>
  		</div>
  		<div class="modal-footer">
  			<div class="loading"><img src="/assets/img/barloader.gif" width="220" class="img-responsive" /></div>
  			<div class="notification">&nbsp;</div>
  			<button id="subscribe-email-submit" type="submit" class="btn_share" />
  		</div>

  	</div>
    </div>
  </div>

  </form>

  <div class="brand_branch_row" style="display: none;">
    <div class="col-md-12 branch_row">
      <div class="row">
        <div class="branch_name_list col-xs-10">ชื่อสาขา</div>
        <input type="hidden" name="branch[]" class="branch_id" value="" />
        <div class="btn-group btn_branch_action btn-xs">
          <!--<button class="btn btn-success btn-xs" type="button"><i class="fa fa-pencil" aria-hidden="true"></i>
          </button>-->
          <button class="btn btn-danger btn-xs btn_branch_delete" title="delete" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- END CONTAINER FLUID -->
@stop

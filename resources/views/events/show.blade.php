@extends('layouts.document')
@section('page_title', 'Events List')
@section('content')

<!-- START JUMBOTRON -->
<div class="jumbotron m-b-15" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <p>Event</p>
        </li>
        <li><a href="#" class="active">{{ $event->title }}</a>
        </li>
      </ul>
      <!-- END BREADCRUMB -->
    </div>
  </div>
</div>
<!-- END JUMBOTRON -->
<!-- START CONTAINER FLUID -->
<!--<form role="form">-->
<div class="container-fluid container-fixed-lg">
  <!-- BEGIN PlACE PAGE CONTENT HERE -->
  <div class="row">
    <div class="col-md-7 event-gallery item-details">
      <div class="panel-body">
        <div class="dialog__content">
          <div class="dialog__overview">
            <div class="no-padding item-slideshow-wrapper full-height">
              <!-- START PANEL -->
              <div class="item-slideshow full-height">
                @forelse($event->gallery_list as $id => $image)
                <div class="slide"  data-hash="{{ $id }}" data-image="{{ URL::asset($image) }}"></div>
                @empty
                @endforelse
              </div>
              <!-- END PANEL -->
            </div>
          </div>
        </div>
        <div class="row thumb">
          <div class="panel-body">
            <div class="col-md-12 p-t-15 p-r-0 p-l-0"></div>
          </div>
        </div>
     </div>
    </div>
    <div class="col-md-5">
      <div class="panel-body">
        <div class="no-margin fs-15 hint-text">CATEGORY :: {{ isset($event->category_first->name) ? $event->category_first->name : 'ไม่ระบุ' }}</div>
        <!-- START PANEL -->
        <h2 class="text-master">{{ $event->title }}</h2>
        <p>{{ $event->brief }}</p>
        <p>&nbsp;</p>
        <div class="item-header clearfix">
          <div class="thumbnail-wrapper d32 circular">
            <img width="40" height="40" src="{{ URL::asset('assets/img/profiles/3x.jpg') }}" data-src="{{ URL::asset('assets/img/profiles/3.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/3x.jpg') }}" alt="{{ $event->brand_name }}" />
          </div>
          <div class="inline m-l-10">
            <p class="no-margin">
              <strong>{{ $event->brand->first()->name }}</strong>
            </p>
            <p class="no-margin hint-text">หมวดหมู่แบรนด์</p>
          </div>
        </div>
        <p>&nbsp;</p>
        <p class="col-middle m-b-5">
          <span class="text-complete"><i class="fa fa-circle m-r-10"></i>{{ $event->start_date_thai }} - {{ $event->end_date_thai }}</span>
        </p>
        <p class="col-middle m-b-5">
          <span class="text-danger"><i class="fa fa-circle m-r-10"></i>{{ $event->check_expire }}</span>
        </p>
        <!--<small class="fs-12 hint-text">15 January 2015, 06:50 PM</small>-->
        <!-- END PANEL -->
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel-body p-t-0">
        <u><b>{{ $event->brand_name }} สาขาที่ร่วมรายการ</b></u>
        @if(!empty($branchs))
          {!! implode(', ', $branchs) !!}
        @else
          <span class="text-danger">ไม่ระบุสาขา</span>
        @endif
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel-body">
        <div id="map_canvas" class="map-canvas"></div>
        <div class="row">
          <input name="location_lat" type="hidden" id="location_lat" value="0" />
          <input name="location_lon" type="hidden" id="location_lon" value="0" />
          <input name="location_zoom" type="hidden" id="location_zoom" value="0" />
        </div>
      </div>
    </div>
  </div>
  <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!--</form>-->
<!-- END CONTAINER FLUID -->
@stop

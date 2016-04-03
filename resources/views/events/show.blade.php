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
      <div class="panel-body p-b-0">
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
          <div class="panel-body p-b-0">
            <div class="col-md-12 p-t-15 p-r-0 p-l-0"></div>
          </div>
        </div>
     </div>
    </div>
    <div class="col-md-5">
      <div class="panel-body">
        <div class="no-margin fs-15 hint-text-9">Category :: {{ isset($event->category_first->name) ? $event->category_first->name : 'ไม่ระบุ' }}</div>
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
        <p>&nbsp;</p>
        <p class="col-middle m-b-5">
          <span class="hint-text">FB Share | Like</span>
        </p>
        <!--<small class="fs-12 hint-text">15 January 2015, 06:50 PM</small>-->
        <!-- END PANEL -->
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <div class="panel-body p-t-0 p-b-5 hint-text-9">
            <hr class="p-b-t-1 m-t-10 m-b-10" />
            <u><b>{{ $event->brand_name }} สาขาที่ร่วมรายการ</b></u>
            <span class="event">
              @if(!empty($branchs))
                {!! implode(', ', $branchs) !!}
              @else
                <span class="text-danger">ไม่ระบุสาขา</span>
              @endif
            </span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel-body">
            <div id="map_canvas" class="map-canvas map-show"></div>
            <div class="row">
              <input name="location_lat" type="hidden" id="location_lat" value="0" />
              <input name="location_lon" type="hidden" id="location_lon" value="0" />
              <input name="location_zoom" type="hidden" id="location_zoom" value="0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-12">
            <div class="panel-body p-t-0 hint-text-9">
              <!--<hr class="p-b-t-1 m-t-10 m-b-10" />-->
              <u><h4>รายละเอียดโปรโมชั่น</h4></u>
              <p>{!! $event->description !!}</p>
            </div>
              @if(!empty($tags))
              <div class="col-md-12">
                Tags :: {!! implode(', ', $tags) !!}
              </div>
              @endif
            <div class="col-sm-12 visible-xs">
                <div class="ads bg-warning">
                  <h1>ADS</h1>
                </div>
            </div>
            <div class="col-md-12">
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <u><h4>โปรโมชั่นที่คุณอาจสนใจ</h4></u>
              <div class="row relate">
                <div class="col-lg-3 col-sm-6 col-xs-12 padding-right-active">
                  <div class="card card-relate">
                    <div class="panel no-border  no-margin">
                      <hr class="no-margin">
                      <div class="relative">
                        <div class="no-overflow">
                          <img alt="โปรฯ 7-11 เมษายน 2559 “แลกซื้อสุดคุ้ม” (26 มี.ค. &ndash; 25 เม.ย. 59)" class="block center-margin relative" src="http://localhost:8000/images/events/2016-04-01/20160401-110850-7-11-APRIL-1.jpg">
                        </div>
                      </div>
                      <div class="padding-15">
                        <strong><a title="โปรฯ 7-11 เมษายน 2559 “แลกซื้อสุดคุ้ม” (26 มี.ค. &ndash; 25 เม.ย. 59)" href="http://localhost:8000/events/7-11-april-2016">โปรฯ 7-11 เมษายน 2559 “แลกซื้อสุดคุ้ม” (26 มี.ค. &ndash; 25 เม.ย. 59)</a></strong>
                        <p>โปรโมชั่น 7-eleven (7-11 เซเว่น อีเลฟเว่น) ประจำเดือน เมษายน 2559 (เม.ย.59 April 2016)
                          ระยะเวลาโปรโมชั่น 26 มีนาคม &ndash; 25 เมษายน  2559 นี้เท่านั้น</p>
                      </div>
                      <div class="padding-15 card-relate-footer">
                        <div class="hint-text pull-left">ถึงวันที่ : 25 เม.ย. 59</div>
                        <ul class="list-inline pull-right no-margin">
                          <li><a href="#" class="text-master hint-text">5,345 <i class="fa fa-comment-o"></i></a>
                          </li>
                          <li><a href="#" class="text-master hint-text">23K <i class="fa fa-heart-o"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12 padding-right-active">
                  <div class="card card-relate">
                    <div class="panel no-border  no-margin">
                      <hr class="no-margin">
                      <div class="relative">
                        <div class="no-overflow">
                          <img alt="โปรฯ 7-11 เมษายน 2559 “แลกซื้อสุดคุ้ม” (26 มี.ค. &ndash; 25 เม.ย. 59)" class="block center-margin relative" src="http://localhost:8000/images/events/2016-04-01/20160401-110850-7-11-APRIL-1.jpg">
                        </div>
                      </div>
                      <div class="padding-15">
                        <strong><a title="โปรฯ 7-11 เมษายน 2559 “แลกซื้อสุดคุ้ม” (26 มี.ค. &ndash; 25 เม.ย. 59)" href="http://localhost:8000/events/7-11-april-2016">โปรฯ 7-11 เมษายน 2559 “แลกซื้อสุดคุ้ม” (26 มี.ค. &ndash; 25 เม.ย. 59)</a></strong>
                        <p>โปรโมชั่น 7-eleven (7-11 เซเว่น อีเลฟเว่น) ประจำเดือน เมษายน 2559 (เม.ย.59 April 2016)
                          ระยะเวลาโปรโมชั่น 26 มีนาคม &ndash; 25 เมษายน  2559 นี้เท่านั้น</p>
                      </div>
                      <div class="padding-15 card-relate-footer">
                        <div class="hint-text pull-left">ถึงวันที่ : 25 เม.ย. 59</div>
                        <ul class="list-inline pull-right no-margin">
                          <li><a href="#" class="text-master hint-text">5,345 <i class="fa fa-comment-o"></i></a>
                          </li>
                          <li><a href="#" class="text-master hint-text">23K <i class="fa fa-heart-o"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12 padding-right-active">
                  <div class="card card-relate">
                    <div class="panel no-border  no-margin">
                      <hr class="no-margin">
                      <div class="relative">
                        <div class="no-overflow">
                          <img alt="โปรฯ 7-11 เมษายน 2559 “แลกซื้อสุดคุ้ม” (26 มี.ค. &ndash; 25 เม.ย. 59)" class="block center-margin relative" src="http://localhost:8000/images/events/2016-04-01/20160401-110850-7-11-APRIL-1.jpg">
                        </div>
                      </div>
                      <div class="padding-15">
                        <strong><a title="โปรฯ 7-11 เมษายน 2559 “แลกซื้อสุดคุ้ม” (26 มี.ค. &ndash; 25 เม.ย. 59)" href="http://localhost:8000/events/7-11-april-2016">โปรฯ 7-11 เมษายน 2559 “แลกซื้อสุดคุ้ม” (26 มี.ค. &ndash; 25 เม.ย. 59)</a></strong>
                        <p>โปรโมชั่น 7-eleven (7-11 เซเว่น อีเลฟเว่น) ประจำเดือน เมษายน 2559 (เม.ย.59 April 2016)
                          ระยะเวลาโปรโมชั่น 26 มีนาคม &ndash; 25 เมษายน  2559 นี้เท่านั้น</p>
                      </div>
                      <div class="padding-15 card-relate-footer">
                        <div class="hint-text pull-left">ถึงวันที่ : 25 เม.ย. 59</div>
                        <ul class="list-inline pull-right no-margin">
                          <li><a href="#" class="text-master hint-text">5,345 <i class="fa fa-comment-o"></i></a>
                          </li>
                          <li><a href="#" class="text-master hint-text">23K <i class="fa fa-heart-o"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12 padding-right-active">
                  <div class="card card-relate">
                    <div class="panel no-border  no-margin">
                      <hr class="no-margin">
                      <div class="relative">
                        <div class="no-overflow">
                          <img alt="โปรฯ 7-11 เมษายน 2559 “แลกซื้อสุดคุ้ม” (26 มี.ค. &ndash; 25 เม.ย. 59)" class="block center-margin relative" src="http://localhost:8000/images/events/2016-04-01/20160401-110850-7-11-APRIL-1.jpg">
                        </div>
                      </div>
                      <div class="padding-15">
                        <strong><a title="โปรฯ 7-11 เมษายน 2559 “แลกซื้อสุดคุ้ม” (26 มี.ค. &ndash; 25 เม.ย. 59)" href="http://localhost:8000/events/7-11-april-2016">โปรฯ 7-11 เมษายน 2559 “แลกซื้อสุดคุ้ม” (26 มี.ค. &ndash; 25 เม.ย. 59)</a></strong>
                        <p>โปรโมชั่น 7-eleven (7-11 เซเว่น อีเลฟเว่น) ประจำเดือน เมษายน 2559 (เม.ย.59 April 2016)
                          ระยะเวลาโปรโมชั่น 26 มีนาคม &ndash; 25 เมษายน  2559 นี้เท่านั้น</p>
                      </div>
                      <div class="padding-15 card-relate-footer">
                        <div class="hint-text pull-left">ถึงวันที่ : 25 เม.ย. 59</div>
                        <ul class="list-inline pull-right no-margin">
                          <li><a href="#" class="text-master hint-text">5,345 <i class="fa fa-comment-o"></i></a>
                          </li>
                          <li><a href="#" class="text-master hint-text">23K <i class="fa fa-heart-o"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-12 hidden-xs">
        <div class="panel-body">
          <div class="ads bg-warning">
            <h1>ADS</h1>
          </div>
          <div class="ads bg-success">
            <h1>ADS</h1>
          </div>
        </div>
    </div>
  </div>
  <!-- END PLACE PAGE CONTENT HERE -->
</div>
<input type="hidden" name="event_id" class="event_id" value="{{ $event->id }}" />
<!--</form>-->
<!-- END CONTAINER FLUID -->
@stop

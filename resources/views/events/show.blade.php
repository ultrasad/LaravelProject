@extends('layouts.document')
@section('page_title', $event_title)
@section('content')

<!-- START JUMBOTRON -->
<div class="jumbotron m-b-15" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <a href="/" title="หน้าแรก">หน้าแรก</a>
        </li>
        <li>
          @if($event->category->count() > 0)
            <a href="{{ URL::to('category', $event->category->first()->category) }}" title="{{ $event->category->first()->name }}">{{ $event->category->first()->name }}</a>
          @else
            <a href="{{ URL::to('category', 'unknow') }}" title="ไม่ระบุ หมวดหมู่">ไม่ระบุ หมวดหมู่</a>
          @endif
        </li>
        <li><span class="p-l-5 m-l-5 fs-12">{{ $event->title }}</span>
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
    <div class="col-md-8 event-gallery">
      <div class="panel-body p-b-0">
        <div class="dialog__content">
            <!-- START PANEL -->
            <div class="fotorama" data-width="100%" data-ratio="5/3" data-maxheight="80%" data-arrows="false" data-nav="thumbs" data-loop="true">
              @forelse($event->gallery_list as $id => $image)
                <img src="{{ URL::asset($image) }}" class="img-responsive" data-fit="contain" />
              @empty
              @endforelse
            </div>
            <!-- END PANEL -->
        </div>
     </div>
    </div>
    <div class="col-md-4 body-brief">
      <div class="panel-body body-brief">
        <div class="no-margin fs-15 hint-text-9 text-master">
          <h4>
            @if($event->category->count() > 0)
                <a class="category-event-url" href="{{ URL::to('category', $event->category->first()->category) }}" title="{{ $event->category->first()->name }}">{{ $event->category->first()->name }}</a>
            @else
                <a class="category-event-url" href="{{ URL::to('category', 'unknow') }}" title="ไม่ระบุ หมวดหมู่">ไม่ระบุ หมวดหมู่</a>
            @endif
          </h4>
        </div>
        <!-- START PANEL -->
        <h2 class="text-master m-t-20">{{ $event->title }}</h2>
        <p>{{ $event->brief }}</p>
        <p>&nbsp;</p>
        <div class="item-header clearfix">
          <div class="thumbnail-wrapper d32 circular">
            <img width="40" height="40" src="{{ file_exists($event->brand->logo_image) ? URL::asset($event->brand->logo_image) : URL::asset('assets/img/profiles/e.jpg') }}" data-src="" data-src-retina="" alt="{{ $event->brand->name }}" />
          </div>
          <div class="inline m-l-10">
            <p class="no-margin">
              <strong class="text-master">{{ $event->brand->name }}</strong>
            </p>
            @if(!empty($event->category->count() > 0))
                <p class="no-margin hint-text text-master"><a class="category-brand-url" href="{{ URL::to('/category', $event->category->first()->category) }}" title="{{ $event->category->first()->name }}">{{ $event->category->first()->name }}</a></p>
            @else
                <p class="no-margin hint-text text-master"><a class="category-brand-url" href="{{ URL::to('/category', 'ไม่ระบุ หมวดหมู่') }}" title="Unknow">ไม่ระบุ หมวดหมู่</a></p>
            @endif
          </div>
        </div>
        <p>&nbsp;</p>
        @if(date('Y-m-d', strtotime($event->end_date)) > (\Carbon\Carbon::now()))
        <p class="col-middle m-b-5">
          <span class="text-complete text-master"><i class="fa fa-circle m-r-10"></i>{{ $event->start_date_thai }} - {{ $event->end_date_thai }}</span>
        </p>
        <p class="col-middle m-b-5">
          <span class="text-danger text-master"><i class="fa fa-circle m-r-10"></i>{{ $event->check_expire }}</span>
        </p>
        @else
        <p class="col-middle m-b-5">
          <span class="text-danger text-master"><i class="fa fa-circle m-r-10"></i>{{ $event->start_date_thai }} - {{ $event->end_date_thai }} (หมดโปรโมชั่นแล้ว)</span>
        </p>
        @endif
        <p>&nbsp;</p>
        <p class="col-middle m-b-5">
          <span class="hint-text">FB Share | Like</span>
        </p>
        <!--<small class="fs-12 hint-text">15 January 2015, 06:50 PM</small>-->
        <!-- END PANEL -->
      </div>
    </div>
  </div>

  <div class="col-md-12"><hr /></div>

  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <div class="panel-body p-t-0 p-b-15 event-branch-list text-master">
            <!-- <hr class="p-b-t-1 m-t-10 m-b-10" /> -->
            <u><b>{{ $event->brand->first()->name }} สาขาที่ร่วมรายการ</b></u>
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
    </div>
  </div>
</div>

<div class="map_wide">
  <div id="map_canvas" class="map-canvas map-show"></div>
  <input name="location_lat" type="hidden" id="location_lat" value="0" />
  <input name="location_lon" type="hidden" id="location_lon" value="0" />
  <input name="location_zoom" type="hidden" id="location_zoom" value="0" />
</div>

<div class="bg-write m-t-20">
  <div class="container-fluid container-fixed-lg">
    <div class="row">
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-12">
              <div class="panel-body p-t-10 hint-text-9">
                <h4 class="text-master m-b-30">รายละเอียดโปรโมชั่น</h4>
                <p>{!! $event->description !!}</p>
              </div>
                @if(!empty($tags))
                <div class="col-md-12 text-master">
                  {!! implode(', ', $tags) !!}
                </div>
                @endif
              <div class="col-sm-12 visible-xs">
                  <div class="ads bg-warning">
                    <h1>ADS</h1>
                  </div>
              </div>
              <div class="col-md-12">
                @if($relates->count() > 0)
                  <p>&nbsp;</p>
                  <h4 class="text-master m-b-20"><i class="fa fa-heartbeat" aria-hidden="true"></i>&nbsp;โปรโมชั่นที่คุณอาจสนใจ</h4>
                @endif
                <div class="row relate event-relate">
                  @forelse($relates as $relate)

                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 p-l-10 p-r-10 padding-right-active col-relate">
                    <div class="relative col-md-12 thumb padding-0 p-b-0">
                      <a title="{{ $relate->title }}" href="{{ $relate->url_slug }}"><div class="relate-img-thumb" style="background-image: url({{ URL::asset($relate->image) }});"></div></a>
                      <!--<a title="{{ $relate->title }}" href="{{ $relate->url_slug }}"><img alt="{{ $relate->title }}" class="block center-margin relative full-width img-responsive relate-img-thumb" src="{{ URL::asset($relate->image) }}" /></a>-->
                    </div>
                    <div class="col-md-12 brief p-l-10 p-r-10 card-relate-body">
                        <div class="padding-5 p-t-10 text-master">
                          <a title="{{ $relate->title }}" href="{{ $relate->url_slug }}" class="card_title">{{ $relate->title }}</a>
                        </div>
                    </div>
                    <div class="row col-md-12 padding-0 m-l-0 m-r-0 footer-relate">
                      <div class="p-t-10 p-l-15 p-r-15 p-b-5 card_footer">
                        <div class="pull-left text-master hint-text fs-12 color-body">ถึงวันที่ : {{ $relate->end_date_thai }}</div>
                        <ul class="list-inline pull-right no-margin hint-text">
                          <li><a class="text-info-link" href="#fb comment"><span>5,345</span> <i class="fs-12 pg-comment"></i></a>
                          </li>
                          <li><a class="text-info-link heart" href="#"><span>23K</span> <i class="fa fa-heart-o"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  </div>

                  {{--
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-right-active col-relate">
                    <div class="card card-relate relative">
                      <div class="row card-relate-row">
                        <div class="relative col-md-3 col-xs-4 thumb padding-5">
                            <a title="{{ $relate->title }}" href="{{ $relate->url_slug }}"><img alt="{{ $relate->title }}" class="block center-margin relative full-height" src="{{ URL::asset($relate->image) }}" /></a>
                            <!--<div class="col-sm-12 img-thumb-relate" style="background-image: url('{{ URL::asset($relate->image) }}')"></div>-->
                        </div>
                        <div class="col-md-9 col-xs-8 brief">
                            <div class="padding-5 card-relate-body text-master">
                              <a title="{{ $relate->title }}" href="{{ $relate->url_slug }}" class="card_title">{{ $relate->title }}</a>
                            </div>
                        </div>

                        <div class="row col-md-9 col-xs-8 padding-0 m-l-0 m-r-0 pull-right footer-relate">
                          <div class="col-md-12 card-relate-footer p-l-0 p-r-0">
                            <div class="col-md-12 p-r-0 p-l-5">
                              <div class="pull-left text-master hint-text fs-12 color-body">ถึงวันที่ : {{ $relate->end_date_thai }}</div>
                              <ul class="list-inline pull-right no-margin">
                                <li><a href="#" class="hint-text text-master text-info-link"><span>5,345</span> <i class="fs-12 pg-comment"></i></a>
                                </li>
                                <li><a href="#" class="hint-text text-master text-info-link heart"><span>23K</span> <i class="fa fa-heart-o"></i></a>
                                </li>
                              </ul>
                              <div class="clearfix">&nbsp;</div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                  --}}
                  @empty
                  @endforelse
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
</div>
<input type="hidden" name="event_id" class="event_id" value="{{ $event->id }}" />
<!--</form>-->
<!-- END CONTAINER FLUID -->
@stop

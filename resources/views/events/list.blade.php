@extends('layouts.document')
@section('page_title', 'Events List')
@section('content')

<div class="social-wrapper">
  <div class="social " data-pages="social">
    <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
      <div class="feed">
        <!-- START DAY -->
        <div class="day" data-social="day">
          <!-- START ITEM -->
          <div class="card no-border bg-transparent full-width" data-social="item">

          </div>
          <!-- END ITEM -->
          <!-- START ITEM -->
          <div class="card col2" data-social="item">
              <div class="ar-3-2 widget-1-wrapper">
                <div class="widget-1 panel no-border bg-complete no-margin widget-loader-circle-lg">
                  <div class="panel-heading top-right">
                    <div class="panel-controls">
                      <ul>
                        <li><a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i class="portlet-icon portlet-icon-refresh-lg-master"></i></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="pull-bottom bottom-left bottom-right ">
                      <span class="label font-montserrat fs-11">NEWS</span>
                      <br />
                      <h2 class="text-white">Click anywhere to get Quick Search</h2>
                      <p class="text-white hint-text">Learn More at Project Pages</p>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <!-- END ITEM -->
          <!-- START ITEM -->
          {{--
          <div class="card share col1" data-social="item">
            <div class="circle" data-toggle="tooltip" title="Label" data-container="body">
            </div>
            <div class="card-header clearfix">
              <div class="user-pic">
                <img width="40" height="40" src="{{ URL::asset('assets/img/profiles/3x.jpg') }}" data-src="{{ URL::asset('assets/img/profiles/3.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/3x.jpg') }}" alt="">
              </div>
              <h5>Shannon Williams</h5>
              <h6>Shared a photo</h6>
            </div>
            <div class="card-content">
              <ul class="buttons ">
                <li>
                  <a href="#"><i class="fa fa-expand"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-heart-o"></i></a>
                </li>
              </ul>
              <img src="{{ URL::asset('assets/img/social-post-image.png') }}" class="block center-margin relative" alt="Social Post" />
            </div>
            <div class="card-description">
              <p>Inspired by : good design is obvious, great design is transparent</p>
              <div class="via">via themeforest</div>
            </div>
            <div class="card-footer clearfix">
              <div class="time">few seconds ago</div>
              <ul class="reactions">
                <li><a href="#">5,345 <i class="fa fa-comment-o"></i></a>
                </li>
                <li><a href="#">23K <i class="fa fa-heart-o"></i></a>
                </li>
              </ul>
            </div>
          </div>
          --}}
          <!-- END ITEM -->
          @forelse($events as $event)
          <!-- START ITEM -->
          <div class="card col1" data-social="item">
            <div class="panel no-border  no-margin">
              <div class="padding-15">
                <div class="item-header clearfix">
                  <div class="thumbnail-wrapper d32 circular">
                    <img width="40" height="40" src="{{ URL::asset('assets/img/profiles/3x.jpg') }}" data-src="{{ URL::asset('assets/img/profiles/3.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/3x.jpg') }}" alt="{{ $event->brand_name }}" />
                  </div>
                  <div class="inline m-l-10">
                    <p class="no-margin">
                      <strong>{{ $event->brand_name }}</strong>
                    </p>
                    <p class="no-margin hint-text">หมวดหมู่แบรนด์</p>
                  </div>
                  <div class="pull-top pull-right list-inline">
                    <i class="pg-map"></i>
                  </div>
                </div>
              </div>
              <hr class="no-margin">
              <div class="relative">
                <div class="no-overflow">
                  <img src="{{ URL::asset($event->image) }}" class="block center-margin relative" alt="{{ $event->title }}" />
                </div>
              </div>
              <div class="padding-15">
                <strong><a href="{{ URL::to('events', $event->url_slug) }}" title="{{ $event->title }}">{{ $event->title }}</a></strong>
                <p>{{ $event->brief }}</p>
                <div class="hint-text">via themeforest</div>
              </div>
              <div class="padding-15">
                <div class="hint-text pull-left">ถึงวันที่ : {{ $event->end_date }}</div>
                <ul class="list-inline pull-right no-margin">
                  <li><a class="text-master hint-text" href="#">5,345 <i class="fa fa-comment-o"></i></a>
                  </li>
                  <li><a class="text-master hint-text" href="#">23K <i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- END ITEM -->
          @empty
          @endforelse
        </div>
        <!-- END DAY -->
      </div>
      <!-- END FEED -->
    </div>
    <!-- END CONTAINER FLUID -->
  </div>
  <!-- /container -->
</div>
@stop

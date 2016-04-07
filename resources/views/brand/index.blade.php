@extends('layouts.document')
@section('page_title', 'Events List')
@section('content')

<div class="social-wrapper">
  <div class="social" data-pages="social">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax" data-social="cover">
      <div class="cover-photo">
        <img alt="Cover photo" src="{{ URL::asset('assets/img/social/cover.png') }}" />
      </div>
      <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
        <div class="inner">
          <div class="pull-bottom bottom-left m-b-40">
            <h5 class="text-white no-margin">welcome to pages social</h5>
            <h1 class="text-white no-margin"><span class="semi-bold">social</span> cover</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- END JUMBOTRON -->
    <div class="container-fluid container-fixed-lg sm-p-l-10 sm-p-r-10">
      <div class="feed">
        <!-- START DAY -->
        <div class="day" data-social="day">
          <div class="day-list">
          <!-- START ITEM -->
          <div class="card no-border bg-transparent full-width" data-social="item"></div>
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
                <div class="hint-text pull-left">ถึงวันที่ : {{ $event->end_date_thai }}</div>
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

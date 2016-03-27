@extends('layouts.document')
@section('page_title', 'Events List')
@section('content')

<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
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
  <div class="col-md-7 event-gallery item-details padding-15">
    <div class="row">
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
    </div>
    <div class="row">
      <div class="col-sm-12 p-l-0 p-t-10">
        @forelse($event->gallery_list as $id => $image)
        <div class="gallery-item-thumb m-r-10">
          <a class="button secondary url" href="#{{ $id }}"><img src="{{ URL::asset($image) }}" class="block center-margin relative img-responsive" /></a>
        </div>
        @empty
        @endforelse
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <!-- START PANEL -->
      <h2>{{ $event->title }}</h2>
      <p>{{ $event->brief }}</p>
    <!-- END PANEL -->
  </div>
  <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!--</form>-->
<!-- END CONTAINER FLUID -->
@stop

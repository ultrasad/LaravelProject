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
          <p>Promotion</p>
        </li>
        <li><a href="#" class="active">Maps</a>
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
    <div class="col-md-12">
      <!--<button class="btn btn-primary m-l-10" data-toggle="filters">More filters</button>-->
      <div class="panel-body">
        <div id="map_canvas" class="map-canvas map-full"></div>
        <div class="row">
          <input name="location_id" type="hidden" id="location_id" value="{{ $id }}">
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

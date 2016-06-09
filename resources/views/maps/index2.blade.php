@extends('layouts.document')
@section('page_title', 'โปรโมชั่นรอบๆตัวคุณ - รวม โปรโมชั่น ลดราคา Sale ชิงโชค discount คูปอง')
@section('content')
<!--<style>
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
  #map {
    height: 100%;
  }
</style>
  <div id="map"></div>
  <script>
    var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 8
      });
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
  async defer></script>
-->

<div class="map-controls">
  <div class="pull-left">
    <div class="btn-group btn-group-vertical" data-toggle="buttons-radio">
      <button id="map-user-location" class="btn btn-success btn-xs">สาขาที่ใกล้คุณที่สุด</button>
    </div>
  </div>
</div>
<div class="map-container full-width full-height"> <!-- fullheight, hide footer-->
  <div id="map_canvas" class="map-canvas map-full full-width full-height"></div>
  <!--<div id="map_canvas" class="map-canvas map-show"></div>-->
</div>
<div class="row">
  <input name="location_lat" type="hidden" id="location_lat" value="0" />
  <input name="location_lon" type="hidden" id="location_lon" value="0" />
  <input name="location_zoom" type="hidden" id="location_zoom" value="0" />
</div>

@stop

<!--<div class="map-controls">
  <div class="pull-left">
    <div class="btn-group btn-group-vertical" data-toggle="buttons-radio">
      <button id="map-user-location" class="btn btn-success btn-xs">สาขาที่ใกล้คุณที่สุด</button>
    </div>
  </div>
</div>
<div class="map-container full-width full-height">
  <div id="map_canvas" class="map-canvas map-full full-width full-height"></div>
</div>
<div class="row">
  <input name="location_lat" type="hidden" id="location_lat" value="0" />
  <input name="location_lon" type="hidden" id="location_lon" value="0" />
  <input name="location_zoom" type="hidden" id="location_zoom" value="0" />
</div>-->

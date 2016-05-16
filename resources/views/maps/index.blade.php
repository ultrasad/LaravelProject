@extends('layouts.document')
@section('page_title', 'โปรโมชั่นรอบๆตัวคุณ')
@section('content')
    <div class="map-controls">
      <div class="pull-left">
        <div class="btn-group btn-group-vertical" data-toggle="buttons-radio">
          <button id="map-location-user" class="btn btn-success btn-xs">สาขาที่ใกล้คุณที่สุด</button>
        </div>
      </div>
    </div>
    <div id="map_canvas" class="map-canvas map-full"></div>
    <div class="row">
      <input name="location_id" type="hidden" id="location_id" value="{{ $id }}">
      <input name="location_lat" type="hidden" id="location_lat" value="0" />
      <input name="location_lon" type="hidden" id="location_lon" value="0" />
      <input name="location_zoom" type="hidden" id="location_zoom" value="0" />
    </div>
@stop

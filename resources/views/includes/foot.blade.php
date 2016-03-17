<!-- BEGIN VENDOR JS -->
<!-- <script type="text/javascript" src="{{ URL::asset('assets/pace/pace.min.js') }}"></script> -->
<script type="text/javascript" src="{{ URL::asset('assets/jquery/jquery-1.11.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/jquery-validation/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/modernizr.custom.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/jquery-metrojs/MetroJs.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/dropzone/dropzone.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-tag/bootstrap-tagsinput.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<!-- <script type="text/javascript" src="{{ URL::asset('assets/summernote/js/summernote.0.5.1.min.js') }}"></script> -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.5.1/summernote.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/switchery/js/switchery.min.js') }}"></script>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<!-- <script type="text/javascript" src="{{ URL::asset('pages/js/pages.min.js') }}"></script> -->
<script type="text/javascript" src="{{ URL::asset('pages/js/pages.js') }}"></script>
<!-- BEGIN PAGE LEVEL JS -->
<script type="text/javascript" src="{{ URL::asset('assets/js/scripts.js') }}"></script>
<!-- END PAGE LEVEL JS -->

<script type="text/javascript">
var map;
var mapObj;
function initialize() {
    mapObj = new Object(google.maps);
    var default_latlng  = new mapObj.LatLng(13.7563309, 100.50176510000006);
    var default_type = mapObj.MapTypeId.ROADMAP;
    var map_canvas = $("#map_canvas")[0];
    var options = {
        zoom: 13,
        center: default_latlng,
        mapTypeId:default_type
    };
    map = new mapObj.Map(map_canvas, options);
    mapObj.event.addListener(map, 'zoom_changed', function() {
        $("#place_zoom").val(map.getZoom());
    });

    var input = document.getElementById('searchTextField');
    var autocomplete = new mapObj.places.Autocomplete(input);
    autocomplete.bindTo('load', map);

    var infowindow = new mapObj.InfoWindow();
    var marker = new mapObj.Marker({
      map: map,
      //draggable:true,
      //title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!",
      anchorPoint: new mapObj.Point(0, -29)
    });

    var place = '';
    var address = '';
    var point = '';

    mapObj.event.addListener(marker, 'dragend', function() {
        point = marker.getPosition();
        map.panTo(point);
        $("#place_lat").val(point.lat());
        $("#place_lon").val(point.lng());
        $("#place_zoom").val(map.getZoom());
    });

    autocomplete.addListener('place_changed', function() {
      infowindow.close();
      marker.setVisible(false);
      place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("Autocomplete's returned place contains no geometry");
        return;
      }

      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
      }

      marker.setPosition(place.geometry.location);
      marker.setVisible(true);

      $("#place_lat").val(place.geometry.location.lat());
      $("#place_lon").val(place.geometry.location.lng());

      infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
      infowindow.open(map, marker);
    });

    mapObj.event.addListener(marker, 'click', function() {
      infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
      infowindow.open(map, this);
    });

}
</script>

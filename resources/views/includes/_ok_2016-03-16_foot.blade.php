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

<!--
<script>
  var map;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 13.75633, lng: 100.50149},
      zoom: 8
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyDDKrErrg2VVxTt9rb-nfUB072YH3ax2bc&callback=initMap" async defer></script>
-->

<script type="text/javascript">
var geocoder; // กำหนดตัวแปรสำหรับ เก็บ Geocoder Object ใช้แปลงชื่อสถานที่เป็นพิกัด
var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
var my_Marker; // กำหนดตัวแปรสำหรับเก็บตัว marker
var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
function initialize() { // ฟังก์ชันแสดงแผนที่
    GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
    geocoder = new GGM.Geocoder(); // เก็บตัวแปร google.maps.Geocoder Object
    // กำหนดจุดเริ่มต้นของแผนที่
    var my_Latlng  = new GGM.LatLng(13.761728449950002,100.6527900695800);
    var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
    // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
    var my_DivObj=$("#map_canvas")[0];
    // กำหนด Option ของแผนที่
    var myOptions = {
        zoom: 13, // กำหนดขนาดการ zoom
        center: my_Latlng , // กำหนดจุดกึ่งกลาง จากตัวแปร my_Latlng
        mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่ จากตัวแปร my_mapTypeId
    };
    map = new GGM.Map(my_DivObj,myOptions); // สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map

    my_Marker = new GGM.Marker({ // สร้างตัว marker ไว้ในตัวแปร my_Marker
        position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
        map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
        draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้
        title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
    });

    // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
    GGM.event.addListener(my_Marker, 'dragend', function() {
        var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
        map.panTo(my_Point); // ให้แผนที่แสดงไปที่ตัว marker
        $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
        $("#lon_value").val(my_Point.lng());  // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
        $("#zoom_value").val(map.getZoom());  // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu
    });

    // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
    GGM.event.addListener(map, 'zoom_changed', function() {
        $("#zoom_value").val(map.getZoom());   // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
    });


    //var input = document.getElementById('namePlace');
    //var autocomplete = GGM.places.Autocomplete(input);
    //autocomplete.bindTo('bounds', map);

    var pyrmont = new google.maps.LatLng(13.755059012431785,100.61433792114258);
    var request = {
     location: pyrmont,
     radius: '500',
     types: ['store']
   };

   infowindow = new google.maps.InfoWindow();
   service = new google.maps.places.PlacesService(map);
   service.nearbySearch(request, callback);

}

function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
      var place = results[i];
      createMarker(results[i]);
    }
  }
}

function createMarker(place) {
  var placeLoc = place.geometry.location;
  var marker = new google.maps.Marker({
    map: map,
    position: place.geometry.location
  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(place.name);
    infowindow.open(map, this);
  });
}


$(function(){

    // ส่วนของฟังก์ชันค้นหาชื่อสถานที่ในแผนที่
    var searchPlace=function(){ // ฟังก์ชัน สำหรับคันหาสถานที่ ชื่อ searchPlace
        var AddressSearch=$("#namePlace").val();// เอาค่าจาก textbox ที่กรอกมาไว้ในตัวแปร
        if(geocoder){ // ตรวจสอบว่าถ้ามี Geocoder Object
            geocoder.geocode({
                 address: AddressSearch // ให้ส่งชื่อสถานที่ไปค้นหา
            },function(results, status){ // ส่งกลับการค้นหาเป็นผลลัพธ์ และสถานะ
                if(status == GGM.GeocoderStatus.OK) { // ตรวจสอบสถานะ ถ้าหากเจอ
                    var my_Point=results[0].geometry.location; // เอาผลลัพธ์ของพิกัด มาเก็บไว้ที่ตัวแปร
                    map.setCenter(my_Point); // กำหนดจุดกลางของแผนที่ไปที่ พิกัดผลลัพธ์
                    my_Marker.setMap(map); // กำหนดตัว marker ให้ใช้กับแผนที่ชื่อ map
                    my_Marker.setPosition(my_Point); // กำหนดตำแหน่งของตัว marker เท่ากับ พิกัดผลลัพธ์
                    $("#lat_value").val(my_Point.lat());  // เอาค่า latitude พิกัดผลลัพธ์ แสดงใน textbox id=lat_value
                    $("#lon_value").val(my_Point.lng());  // เอาค่า longitude พิกัดผลลัพธ์ แสดงใน textbox id=lon_value
                    $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu
                }else{
                    // ค้นหาไม่พบแสดงข้อความแจ้ง
                    alert("Geocode was not successful for the following reason: " + status);
                    $("#namePlace").val("");// กำหนดค่า textbox id=namePlace ให้ว่างสำหรับค้นหาใหม่
                 }
            });
        }
    }
    $("#SearchPlace").click(function(){ // เมื่อคลิกที่ปุ่ม id=SearchPlace ให้ทำงานฟังก์ฃันค้นหาสถานที่
        searchPlace();  // ฟังก์ฃันค้นหาสถานที่
    });
    $("#namePlace").keyup(function(event){ // เมื่อพิมพ์คำค้นหาในกล่องค้นหา
        if(event.keyCode==13){  //  ตรวจสอบปุ่มถ้ากด ถ้าเป็นปุ่ม Enter ให้เรียกฟังก์ชันค้นหาสถานที่
            searchPlace();      // ฟังก์ฃันค้นหาสถานที่
        }
    });

});
$(function(){
    // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
    // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
    // v=3.2&sensor=false&language=th&callback=initialize
    //  v เวอร์ชัน่ 3.2
    //  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
    //  language ภาษา th ,en เป็นต้น
    //  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize
    $("<script/>", {
      "type": "text/javascript",
      src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&hl=th&callback=initialize&libraries=places"
    }).appendTo("body");
});
</script>

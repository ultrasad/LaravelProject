(function($) {

    'use strict';

    $(document).ready(function() {

        $.fn.exists = function(){return this.length>0;}

    		//$(document).unbind(".mine");
    		$(document).bind("ajaxStart.mine", function(){
    			//$('#ajaxProgress').show();
    			$('.btn').attr('disabled', 'disabled');
    		});

    		$(document).bind("ajaxStop.mine", function(){
    			//$('#ajaxProgress').hide();
    			$('.btn').removeAttr('disabled');
    		});

        $(".widget-3 .metro").liveTile();
        $(".widget-7 .metro").liveTile();

        //Date Pickers
        //$('#datepicker-component, #datepicker-component2, #datepicker-component3').datepicker({ format: 'mm/dd/yyyy'});
        $('#datepicker-component, #datepicker-component2, #datepicker-component3').datepicker({ format: 'yyyy-mm-dd'});

        $('#article').submit(function(e){

            var _token, data;
            _token = $('input[name=_token]').val();
            data = new FormData(this);

            $.ajax({
                url: '/articles',
                headers: {'X-CSRF-TOKEN': _token},
                data: data,
                type: 'POST',
                datatype: 'JSON',
                processData: false,
                contentType: false,
                success: function (resp) {
                  console.log('response => ' + resp);
                    /*$.each(resp.subramos, function (key, value) {
                        $('#subramos').append('<option>'+ value.nombre_subramo +'</option>');
                    });*/
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    console.log('ERRORS: ' + jqXHR + ' ,textStatus => ' + textStatus + ' ,errorThrown => ' + errorThrown);
                    //var resJson = JSON.stringify(jqXHR);
                    console.log(JSON.stringify(jqXHR.responseJSON));
                    // STOP LOADING SPINNER
                }
            });

            e.preventDefault();
        });

        /* cache by bootstrap js */
        $('#my-awesome-dropzone-form').validate({
             //ignore: ".ignore :hidden" //is telling it to ignore hidden fields with the class ignore.
             //ignore: ".ignore", //will tell it to only ignore fields will class .ignore.
             //ignore: ".ignore, :hidden", //will tell it to ignore fields will class .ignore AND fields that are hidden.
             //ignore:[], // tells the plugin to ignore nothing and validate everything.
             ignore: ".ignore, :hidden",
             focusInvalid: false,
             ignoreTitle: true,
             errorClass:'error',
             validClass:'success',
             errorElement:'span',
             highlight: function (element, errorClass, validClass) {
                 $(element).parents("div[class='clearfix']").addClass(errorClass).removeClass(validClass);
             },
             unhighlight: function (element, errorClass, validClass) {
                 $(element).parents(".error").removeClass(errorClass).addClass(validClass);
             },
             rules: {
                title: {
                  required: true
                },
                url_slug: {
                  required: true
                },
                brief: {
                   required: true
                },
                published_at: {
                  required: true
                }
                /*
                fb_message: {
                   required: true
                }*/
             },
             messages: {
                title:{
                	required: "This field is required.",
                },
                url_slug:{
                	required: "This field is required.",
                },
                brief: {
                  required: "This field is required.",
                },
                published_at: {
                  required: "This field is required.",
                }
                /*
                fb_message: {
                  required: "This field is required.",
                }*/
        		 },
             submitHandler: function(form) {
                 // optional callback function
                 // only fires on a valid form submission
                 // do something only if/when form is valid
                 // like process the dropzone queue HERE instead
                 // then use .ajax() OR .submit()

                 //$(form).submit();
                 //$('#my-awesome-dropzone-form')[0].submit();
             }
        });

        Dropzone.options.myAwesomeDropzoneForm = { // The camelized version of the ID of the form element
          // The configuration we've talked about above
          paramName: "gallery",
          autoDiscover: false,
          autoProcessQueue: false,
          uploadMultiple: true,
          parallelUploads: 100,
          maxFiles: 20,
          maxFilesize: 2, // MB
          acceptedFiles: "image/*",
          addRemoveLinks: true,
          //previewTemplate: previewTemplate,
          //autoQueue: false, // Make sure the files aren't queued until manually added
          previewsContainer: "#previews", // Define the container to display the previews
          clickable: ".dropzone-file-previews",
          //createImageThumbnails: false,
          //clickable: false,
          //clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.

          // The setting up of the dropzone
          init: function() {
            var myDropzone = this;

            // First change the button to actually tell Dropzone to process the queue.
            this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {

              e.preventDefault();
              e.stopPropagation();

               if($('#my-awesome-dropzone-form').valid()){

                var description = $('textarea[name="description"]').html($('#summernote').code());

                if (myDropzone.getQueuedFiles().length > 0) {
                     myDropzone.processQueue();
                     //$('#my-awesome-dropzone-form')[0].submit();
                } else {
                     var _token, data;
                     _token = $('input[name=_token]').val();
                     var form = document.getElementById('my-awesome-dropzone-form');
                     data = new FormData(form);

                     //events.append("description_x", html);
                     //events.description = description;

                     //$('#my-awesome-dropzone-form')[0].submit();

                     $.ajax({
                         url: '/events',
                         headers: {'X-CSRF-TOKEN': _token},
                         data: data,
                         type: 'POST',
                         datatype: 'JSON',
                         processData: false,
                         contentType: false,
                         success: function (resp) {
                           console.log('ajax response => ' + resp);
                           window.location.href = base_url + '/events';
                         },
                         error: function(jqXHR, textStatus, errorThrown)
                         {
                             $('.error-reponse').html(jqXHR.responseJSON);

                             //console.log('=> ' + jqXHR);
                             //console.log('ERRORS: ' + jqXHR + ' ,textStatus => ' + textStatus + ' ,errorThrown => ' + errorThrown);

                             //Handle errors here
                             //console.log('ERRORS: ' + jqXHR + ' ,textStatus => ' + textStatus + ' ,errorThrown => ' + errorThrown);
                             //var resJson = JSON.stringify(jqXHR);
                             //console.log(JSON.stringify(jqXHR.responseJSON));
                             // STOP LOADING SPINNER
                         }
                     });

                }
               } //valid
            });

            this.on("sending", function(file, xhr, data) {
                var file = $("#image")[0].files[0];
                //data.append('file-1', file);
                data.append("image", file);
                //data.append("filetype", "avataruploadtype");

                // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
                data.append("_token", $('[name=_token').val()); // Laravel expect the token post value to be named _token by default
            });

            // Execute when file uploads are complete
            this.on("complete", function() {
              // If all files have been uploaded
              if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                var _this = this;
                // Remove all files
                //_this.removeAllFiles();

                //console.log('drop response => ' + _this);
                window.location.href = base_url + '/events';
              }
            });

            this.on("addedfile", function(file) {
              if($('.dropzone-previews').find('.dz-preview').length > 0){
                $('.dropzone-file-previews .dz-message').hide();
              }
            });

            this.on("removedfile", function(file) {
              if($('.dropzone-previews').find('.dz-preview').length < 1){
                $('.dropzone-file-previews .dz-message').show();
              }
            });

            // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
            // of the sending event because uploadMultiple is set to true.
            this.on("sendingmultiple", function() {
              // Gets triggered when the form is actually being sent.
              // Hide the success button or the complete form.
            });
            this.on("successmultiple", function(files, response) {
              // Gets triggered when the files have successfully been sent.
              // Redirect user or notify of success.
            });
            this.on("errormultiple", function(files, response) {
              // Gets triggered when there was an error sending the files.
              // Maybe show form again, and notify user of error
            });
          }

        }

        //Single instance of tag inputs - can be initiated with simply using data-role="tagsinput" attribute in any input field
        $('.custom-tag-input').tagsinput({ maxTags: 20, tagClass: function(item) {return 'label label-custom-tag';} });

        var $summernote = $('#summernote').summernote({
            height: 200,
            toolbar: [
              // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline', 'clear']],
              //['font', ['strikethrough', 'superscript', 'subscript']],
              ['fontsize', ['fontsize']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['height', ['height']],
              ['picture', ['picture']]
            ],
            onImageUpload: function(files, editor, $editable) {
              //console.log('file => ' + files[0]);
              sendFile(files[0],editor,$editable);
            }
        });

        //ignore valid popup model
        $('.note-modal-form').each( function() { $(this).validate({}) });

        //Switchery
        var changeCheckbox = document.querySelector('.js-check-change')
          , changeField = document.querySelector('.js-check-change-field');

        if($('.social_group').exists()){
          changeCheckbox.onchange = function() {
            changeField.value = changeCheckbox.checked;
            if(changeCheckbox.checked == true){
              $('.social_group').show();
            } else {
              $('.social_group').hide();
            }
            //console.log('change => ' + changeCheckbox.checked);
          };
        }

        //brand
        if($('.cs-select').exists()){
          var el = $('.cs-select-brand').get(0);
          $(el).wrap('<div class="cs-wrapper" />');
          new SelectFx(el, {
              onChange: function(e) {
                   var brand_id = $(e).val();
                   var data = new FormData();
                   var _branch = $('.branch_child .list');
                   data.append("id", brand_id);
                   $.ajax({
                     url: "/brand/branch",
                     data: data,
                     cache: false,
                     contentType: false,
                     processData: false,
                     dataType: 'json',
                     type: 'POST',
                     success: function(data){
                      if(Object.keys(data).length > 0){
                        _branch.html('');
                        $.each(data, function(id, value) {
                            _branch.append(
                              '<div class="checkbox check-warning">'
                              + '<input type="checkbox" checked="checked" name="branch[]" class="branch" value="'+id+'" id="branch_'+id+'">'
                              + '<label for="branch_'+id+'">'+value+'</label>'
                              + '</div>'
                            );
                        });
                        _branch.append('<div class="clearfix"></div>');
                      }
                     },
                     error: function(jqXHR, textStatus, errorThrown) {
                       console.log(textStatus+" "+errorThrown);
                     }
                  });
              }
          });
        }

        $(document).on('change', '.branch_all', function(e){
          var _child = $('.branch_child');
          _child.find(':checkbox').prop('checked', this.checked);
        });

        $(document).on('change', '.branch', function(e){
            var _parent = $('.branch_all');
            var _child = $('.branch_child');
            var _chk = $(this);
            if (_chk.is(':checked')) {
               _parent.prop('checked', _child.has(':checkbox:not(:checked)').length == 0);
            } else {
               _parent.prop('checked', false);
            }
        });

        //publiched
        $(document).on('change', '.published_check', function(e){
          if(this.checked) {
              $('.published_set_time').hide();
          } else {
              $('.published_set_time').show();
          }
        });

        if($('#map_canvas').exists()){
          console.log('map..');
          $("<script/>", {
            "type": "text/javascript",
            src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&zoom=false&language=th&hl=th&callback=initialize&libraries=places"
          }).appendTo("body");
        }

        $(document).on('change', '.btn-file :file', function() {
          var input = $(this),
              numFiles = input.get(0).files ? input.get(0).files.length : 1,
              label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
          input.trigger('fileselect', [numFiles, label]);
        });

        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        });

    });

})(window.jQuery);

function sendFile(file,editor,welEditable)
{
    var data = new FormData();
    data.append("file_upload", file);
     $.ajax({
       url: "/events/desc_upload",
       data: data,
       cache: false,
       contentType: false,
       processData: false,
       type: 'POST',
       success: function(data){
        editor.insertImage(welEditable, data);
       },
       error: function(jqXHR, textStatus, errorThrown) {
         console.log(textStatus+" "+errorThrown);
       }
    });
}

/*
    Look for data-image attribute and apply those
    images as CSS background-image
*/
$('.item-slideshow > div').each(function(index) {
    var img = $(this).data('image');
    //console.log(img);
    var html = $("<a class='button secondary url' href='#"+index+"'>").append($("<div class='gallery-item-thumb owl-item m-r-10'>").css({
        'background-image': 'url(' + img + ')',
        'background-size': 'cover',
        'background-position': 'center'
    }));
    $('.thumb > div').append(html);
    $(this).css({
        'background-image': 'url(' + img + ')',
        'background-repeat': 'no-repeat',
        'background-size': 'contain',
        'background-position': 'center'
    });
});

/*
    Touch enabled slideshow for gallery item images using owlCarousel
    www.owlcarousel.owlgraphic.com
*/
var owl = $(".item-slideshow").owlCarousel({
    /*items: 1,
    nav: true,
    navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
    dots: true*/
    items:1,
    nav: false,
    //navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
    //loop:true,
    //center:true,
    //margin:10,
    dots: false,
    URLhashListener:true,
    onInitialized: loaded,
    //autoplayHoverPause:true,
    //startPosition: 'URLHash'
});

function loaded(e){
  $('.thumb').find(".owl-item").eq(0).addClass('synced');
}

owl.on('changed.owl.carousel', function(e) {
  var current = e.item.index;
  var thumbnail = $('.thumb');
  thumbnail.find('.owl-item').removeClass('synced');
  thumbnail.find(".owl-item").eq(current).addClass('synced');
});

//google map application
var map;
var mapObj;
function initialize() {
    mapObj = new Object(google.maps);
    var default_latlng  = new mapObj.LatLng(13.7563309, 100.50176510000006);
    var default_type = mapObj.MapTypeId.ROADMAP;
    var map_canvas = $("#map_canvas")[0];
    var options = {
        zoom: 13,
        scrollwheel: false,
        center: default_latlng,
        mapTypeId:default_type
    };
    map = new mapObj.Map(map_canvas, options);
    mapObj.event.addListener(map, 'zoom_changed', function() {
        $("#location_zoom").val(map.getZoom());
    });

    var input = document.getElementById('location_name');
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
        $("#location_lat").val(point.lat());
        $("#location_lon").val(point.lng());
        $("#location_zoom").val(map.getZoom());
    });

    autocomplete.addListener('place_changed', function() {
      infowindow.close();
      marker.setVisible(false);
      place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("Autocomplete's returned place contains no geometry");
        return;
      } else {
        map.setZoom(17);
        map.setCenter(place.geometry.location);
        //console.log('set center');
      }

      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport){
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
      }

      marker.setPosition(place.geometry.location);
      marker.setVisible(true);

      $("#location_lat").val(place.geometry.location.lat());
      $("#location_lon").val(place.geometry.location.lng());

      infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
      infowindow.open(map, marker);
    });

    mapObj.event.addListener(marker, 'click', function() {
      infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
      infowindow.open(map, this);
    });

}

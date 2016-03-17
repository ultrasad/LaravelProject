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

        console.log('check..');

        //Date Pickers
        $('#datepicker-component, #datepicker-component2, #datepicker-component3').datepicker();

        $('#article').submit(function(e){

            var article, token, url, data;
            token = $('input[name=_token]').val();
            article = new FormData(this);

            $.ajax({
                url: '/articles',
                headers: {'X-CSRF-TOKEN': token},
                data: article,
                type: 'POST',
                datatype: 'JSON',
                processData: false,
                contentType: false,
                success: function (resp) {
                  console.log('resp => ' + resp);
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
                 }
             },
             messages: {
        					title:{
        								required: "This field is required.",
        					},
        					url_slug:{
        								required: "This field is required.",
        					},
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
          maxFiles: 100,
          acceptedFiles: "image/*",
          addRemoveLinks: true,
          //previewTemplate: previewTemplate,
          autoQueue: false, // Make sure the files aren't queued until manually added
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
                     var events, token, url, data;
                     token = $('input[name=_token]').val();
                     var form = document.getElementById('my-awesome-dropzone-form');
                     events = new FormData(form);
                     //events.append("description_x", html);
                     //events.description = description;

                     $.ajax({
                         url: '/events',
                         headers: {'X-CSRF-TOKEN': token},
                         data: events,
                         type: 'POST',
                         datatype: 'JSON',
                         processData: false,
                         contentType: false,
                         success: function (resp) {
                           console.log('resp => ' + resp);
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
                }
               } //valid
            });

            this.on("sending", function(file, xhr, data) {
                var file = $("#image")[0].files[0];
                //data.append('file-1', file);
                data.append("image", file);
                //data.append("filetype", "avataruploadtype");
            });

            // Execute when file uploads are complete
            this.on("complete", function() {
              // If all files have been uploaded
              if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                var _this = this;
                // Remove all files
                _this.removeAllFiles();
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
        });

        //ignore valid popup model
        $('.note-modal-form').each( function() { $(this).validate({}) });

    });

    $("<script/>", {
      "type": "text/javascript",
      src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&hl=th&callback=initialize&libraries=places"
    }).appendTo("body");

})(window.jQuery);

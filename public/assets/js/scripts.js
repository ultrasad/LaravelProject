(function($) {

    'use strict';

    $(document).ready(function() {
        $(".widget-3 .metro").liveTile();
        $(".widget-7 .metro").liveTile();

        console.log('check..');

        $('#summernote').summernote({
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
            onfocus: function(e) {
                $('body').addClass('overlay-disabled');
            },
            onblur: function(e) {
                $('body').removeClass('overlay-disabled');
            }
        });

        //Date Pickers
        $('#datepicker-component, #datepicker-component2, #datepicker-component3').datepicker();

        $('#article').submit(function(e){

            //Dropzone.processQueue();

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

        // jQuery dropzone
        // Setting auto discover to false immediately after including the script.
        //Dropzone.autoDiscover = false;
        //Dropzone.autoProcessQueue = false;
        /*$("div.dropzonex").dropzone({
          url: "/events/post_upload",
          autoProcessQueue:false,
          parallelUploads: 10,
        });
        */

        /*var md = new Dropzone(".dropzone_mix", {
            init: function() {
              var myDropzone2 = this;
              //$('.dropzone-file-previews .dz-message').css('background-image','none');

              // First change the button to actually tell Dropzone to process the queue.
              this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                // Make sure that the form isn't actually being sent.
                e.preventDefault();
                e.stopPropagation();
                //$('#my-awesome-dropzone-form')[0].submit();
                myDropzone2.processQueue();
              });
              myDropzone2.processQueue();
            },
            url: "/events2", //# your post url
            maxFilesize: "5", //#max file size for upload, 5MB
            addRemoveLinks: true, //# Add file remove button.
            autoProcessQueue:false,
            uploadMultiple: true,
        });*/

        //var myDropzone = new Dropzone("div#dropzone-image", { url: "/events/post_upload", autoDiscover: false, autoProcessQueue:false, parallelUploads: 100, uploadMultiple: true, maxFiles: 100, acceptedFiles: "image/*", addRemoveLinks: true });

        //new Dropzone($(".my-dropzone").get(0));

        //new Dropzone(document.body, { // Make the whole body a dropzone
          //url: "/upload/url", // Set the url
          //previewsContainer: "#dropzone-previews", // Define the container to display the previews
          //clickable: "#clickable" // Define the element that should be used as click trigger to select files.
        //});

        /*Dropzone.options.myDropzone = {
          init: function() {
            this.on("error", function(file, message) { alert(message); });
          }
        };*/

        //var previewNode = document.querySelector("#template");
        //previewNode.id = "";
        //var previewTemplate = previewNode.parentNode.innerHTML;
        //previewNode.parentNode.removeChild(previewNode);

        /*$(".image_1, .image_2, .image_3, .image_4").dropzone({
            url: "ajax/upload.php?product_id=" + $("#product_id").val() + "&image_number=" + $(this.element).data("id"), // Here I´ll post the id
            thumbnailWidth: 100,
            thumbnailHeight: 120,
            addRemoveLinks: false,
            previewTemplate: ""+
                "<div class=\"dz-preview dz-file-preview\">"+
                "<div class=\"dz-details\">"+
                //"<div class=\"dz-filename\"><span data-dz-name></span></div>"+
                //"<div class=\"dz-size\" data-dz-size></div>"+
                "<img data-dz-thumbnail />"+
                "</div>"+
                "<div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>"+
                "<div class=\"dz-error-message\"><span data-dz-errormessage></span></div>"+
                "</div>"
        });*/

        /* cache by bootstrap js */
        $('#my-awesome-dropzone-form').validate({
             ignore: ".note-image-input, .note-image-url", // validate hidden fields, required for cs-select
             //ignore:[],
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
            //$('.dropzone-file-previews .dz-message').css('background-image','none');

            // First change the button to actually tell Dropzone to process the queue.
            this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
              // Make sure that the form isn't actually being sent.
              //var data = new FormData();
              //var file = $("#image_main")[0].files[0];
              //data.append('file-1', file);

              e.preventDefault();
              e.stopPropagation();
              //$('#my-awesome-dropzone-form')[0].submit();

               if($('#my-awesome-dropzone-form').valid()){
                  //var description = $('textarea[name="description"]').val($('#summernote').code());
                  //var html = $('#summernote').summernote('code')[0];
                  var description = $('textarea[name="description"]').html($('#summernote').code());
                  //console.log(description);

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

            /*
            $('#my-awesome-dropzone-form').submit(function(e){
              console.log('submit >>');
              //return false;

              $("#previews .dz-image-preview").each(function(e) {
                console.log($(this).find('.dz-details .dz-filename').text());
                var file = $(this).find('.dz-details .dz-filename').text();
                $("#my-awesome-dropzone-form").append($('<input type="hidden" ' + 'name="files[]" ' + 'value="' + file + '">'));
                //alert($(this).text());    //Prints out the text contained in this DIV
            });

              return false;
            });
            */

            /*
            $('#my-awesome-dropzone-form').submit(function(e){
                e.preventDefault();
                e.stopPropagation();
                //myDropzone.processQueue();
                //saveForm();

                var events, token, url, data;
                token = $('input[name=_token]').val();
                var form = document.getElementById('my-awesome-dropzone-form');
                events = new FormData(form);

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

            });
            */

            /*this.on('thumbnail',function(file){
                var cachedFilename = file.name;
                var reader = new FileReader();
                var $img = $('<img />');
                reader.onloadend = function (file) {
                    var image = new Image();
                    image.src = file.target.result;
                    image.onload = function() {
                        $img.attr('src', reader.result);
                    }
                }
                reader.readAsDataURL(file);
                //console.log('cachedFilename => ' + cachedFilename + ', reader => ' + reader + ', file => ' + file.toSource());
            });*/

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

            /* this ok work, 2016-03-15
            this.on("addedfile", function(file) {
              if($('.dropzone-previews').find('.dz-preview').length > 0){
                $('.dropzone-file-previews .dz-message').hide();
              }
              var cachedFilename = file.name;
              var reader = new FileReader();
              var $img = $('<img />');
              reader.onloadend = function (file) {
                  var image = new Image();
                  image.src = file.target.result;
                  image.onload = function() {
                      $img.attr('src', reader.result);
                  }
                  //$('#base64data').attr('value', reader.result);
                  $('.dropzone-file-previews').append("<input type='hidden' name='gallery[]' value='"+cachedFilename+"' />");
                  //$('#my-awesome-dropzone-form').append(image);
              }
              reader.readAsDataURL(file);
              //var form = new FormData();
              //form.append("file_image", file);
              //console.log('cachedFilename => ' + cachedFilename);
              console.log('cachedFilename => ' + cachedFilename + ', reader => ' + reader + ', file => ' + file.toSource());

              //console.log(file.toSource());
              //$("#my-awesome-dropzone-form").append($('<input type="hidden" ' + 'name="files[]" ' + 'value="' + file + '">'));
            });
            */

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

        /*
        function saveForm()
        {
            var form = document.getElementById('my-awesome-dropzone-form');
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/events', true);
            xhr.onreadystatechange = function ()
            {
                if (xhr.readyState === 4)
                {
                    if (xhr.status === 200)
                    {
                        console.info('Success');
                    }
                    else
                    {
                        $('#error-msg').html('A connection error has occured. Please try again.');
                        $('#page-error').fadeIn(300).delay(3000).fadeOut(500);
                    }
                }
            };
            xhr.send(formData);
            return false;
        }
        */

        //Single instance of tag inputs - can be initiated with simply using data-role="tagsinput" attribute in any input field
        $('.custom-tag-input').tagsinput({ maxTags: 20, tagClass: function(item) {return 'label label-custom-tag';} });

        /*var myCustomTemplates = {
                "font-styles": function(locale) {
                    return '<li class="dropdown">' + '<a data-toggle="dropdown" class="btn btn-default dropdown-toggle ">' + '<span class="editor-icon editor-icon-headline"></span>' + '<span class="current-font">Normal</span>' + '<b class="caret"></b>' + '</a>' + '<ul class="dropdown-menu">' + '<li><a tabindex="-1" data-wysihtml5-command-value="p" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">Normal</a></li>' + '<li><a tabindex="-1" data-wysihtml5-command-value="h1" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">1</a></li>' + '<li><a tabindex="-1" data-wysihtml5-command-value="h2" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">2</a></li>' + '<li><a tabindex="-1" data-wysihtml5-command-value="h3" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">3</a></li>' + '<li><a tabindex="-1" data-wysihtml5-command-value="h4" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">4</a></li>' + '<li><a tabindex="-1" data-wysihtml5-command-value="h5" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">5</a></li>' + '<li><a tabindex="-1" data-wysihtml5-command-value="h6" data-wysihtml5-command="formatBlock" href="javascript:;" unselectable="on">6</a></li>' + '</ul>' + '</li>';
                },
                emphasis: function(locale) {
                    return '<li>' + '<div class="btn-group">' + '<a tabindex="-1" title="CTRL+B" data-wysihtml5-command="bold" class="btn  btn-default" href="javascript:;" unselectable="on"><i class="editor-icon editor-icon-bold"></i></a>' + '<a tabindex="-1" title="CTRL+I" data-wysihtml5-command="italic" class="btn  btn-default" href="javascript:;" unselectable="on"><i class="editor-icon editor-icon-italic"></i></a>' + '<a tabindex="-1" title="CTRL+U" data-wysihtml5-command="underline" class="btn  btn-default" href="javascript:;" unselectable="on"><i class="editor-icon editor-icon-underline"></i></a>' + '</div>' + '</li>';
                },
                blockquote: function(locale) {
                    return '<li>' + '<a tabindex="-1" data-wysihtml5-display-format-name="false" data-wysihtml5-command-value="blockquote" data-wysihtml5-command="formatBlock" class="btn  btn-default" href="javascript:;" unselectable="on">' + '<i class="editor-icon editor-icon-quote"></i>' + '</a>' + '</li>'
                },
                lists: function(locale) {
                    return '<li>' + '<div class="btn-group">' + '<a tabindex="-1" title="Unordered list" data-wysihtml5-command="insertUnorderedList" class="btn  btn-default" href="javascript:;" unselectable="on"><i class="editor-icon editor-icon-ul"></i></a>' + '<a tabindex="-1" title="Ordered list" data-wysihtml5-command="insertOrderedList" class="btn  btn-default" href="javascript:;" unselectable="on"><i class="editor-icon editor-icon-ol"></i></a>' + '<a tabindex="-1" title="Outdent" data-wysihtml5-command="Outdent" class="btn  btn-default" href="javascript:;" unselectable="on"><i class="editor-icon editor-icon-outdent"></i></a>' + '<a tabindex="-1" title="Indent" data-wysihtml5-command="Indent" class="btn  btn-default" href="javascript:;" unselectable="on"><i class="editor-icon editor-icon-indent"></i></a>' + '</div>' + '</li>'
                },
                image: function(locale) {
                    return '<li>' + '<div class="bootstrap-wysihtml5-insert-image-modal modal fade">' + '<div class="modal-dialog ">' + '<div class="modal-content">' + '<div class="modal-header">' + '<a data-dismiss="modal" class="close">×</a>' + '<h3>Insert image</h3>' + '</div>' + '<div class="modal-body">' + '<input class="bootstrap-wysihtml5-insert-image-url form-control" value="http://">' + '</div>' + '<div class="modal-footer">' + '<a data-dismiss="modal" class="btn btn-default">Cancel</a>' + '<a data-dismiss="modal" class="btn btn-primary">Insert image</a>' + '</div>' + '</div>' + '</div>' + '</div>' + '<a tabindex="-1" title="Insert image" data-wysihtml5-command="insertImage" class="btn  btn-default" href="javascript:;" unselectable="on">' + '<i class="editor-icon editor-icon-image"></i>' + '</a>' + '</li>'
                },
                link: function(locale) {
                    return '<li>' + '<div class="bootstrap-wysihtml5-insert-link-modal modal fade">' + '<div class="modal-dialog ">' + '<div class="modal-content">' + '<div class="modal-header">' + '<a data-dismiss="modal" class="close">×</a>' + '<h3>Insert link</h3>' + '</div>' + '<div class="modal-body">' + '<input class="bootstrap-wysihtml5-insert-link-url form-control" value="http://">' + '<label class="checkbox"> <input type="checkbox" checked="" class="bootstrap-wysihtml5-insert-link-target">Open link in new window</label>' + '</div>' + '<div class="modal-footer">' + '<a data-dismiss="modal" class="btn btn-default">Cancel</a>' + '<a data-dismiss="modal" class="btn btn-primary" href="#">Insert link</a>' + '</div>' + '</div>' + '</div>' + '</div>' + '<a tabindex="-1" title="Insert link" data-wysihtml5-command="createLink" class="btn  btn-default" href="javascript:;" unselectable="on">' + '<i class="editor-icon editor-icon-link"></i>' + '</a>' + '</li>'
                },
                html: function(locale) {
                    return '<li>' + '<div class="btn-group">' + '<a tabindex="-1" title="Edit HTML" data-wysihtml5-action="change_view" class="btn  btn-default" href="javascript:;" unselectable="on">' + '<i class="editor-icon editor-icon-html"></i>' + '</a>' + '</div>' + '</li>'
                }
            }
            //TODO: chrome doesn't apply the plugin on load
        setTimeout(function() {
            $('#wysiwyg5').wysihtml5({
                html: true,
                stylesheets: ["pages/css/editor.css"],
                customTemplates: myCustomTemplates
            });
        }, 500);
        */

        /*
        $("#submit_event").click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            myDropzone.processQueue();
            console.log('xx');
            //return false;
        });
        */

    });

})(window.jQuery);

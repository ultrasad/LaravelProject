var events_locations;
var branch_list;
var fx_select_brand;

(function($) {

    'use strict';

    $(document).ready(function() {

        //var $container = $('.day');
        //$container.masonry({itemSelector: '.card', columnWidth: '.col1', gutter: 10 });

        /*$('.grid').masonry({
          // options
          itemSelector: '.grid-item',
          columnWidth: 200
        });*/

        /*
        $('.day').isotope({
            "itemSelector": '.card',
            "masonry": {
                "columnWidth": '.col1',
                "gutter": 20,
                "isFitWidth": true
            }
        });
        */

        var delay = (function(){
          var timer = 0;
          return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
          };
        })();

        // Initializes search overlay plugin.
        // Replace onSearchSubmit() and onKeyEnter() with
        // your logic to perform a search and display results
        $(".list-view-wrapper").scrollbar();

        $(document).on('click.pg.search.data-api', '[data-toggle="search"]', function(e) {
            $('.row_result, .row_result_map').html('');
            $('.result_pro, .result_map').hide();
        });

        $('[data-pages="search"]').search({
            // Bind elements that are included inside search overlay
            searchField: '#overlay-search',
            closeButton: '.overlay-close',
            suggestions: '#overlay-suggestions',
            brand: '.brand',
             // Callback that will be run when you hit ENTER button on search box
            onSearchSubmit: function(searchString) {
                console.log("Search for: " + searchString);
            },
            // Callback that will be run whenever you enter a key into search box.
            // Perform any live search here.
            onKeyEnter: function(searchString) {
                console.log("Live search for: " + searchString);
                var searchField = $('#overlay-search');
                var searchResults = $('.search-results');

                var _token, data;
                _token = $('input[name=_token]').val();
                //data = new FormData(this);
                if($('#overlay-search').val() != ''){

                  delay(function(){
                    //alert('Time elapsed!');
                    $.ajax({
                        url: '/events/search/' + searchString,
                        headers: {'X-CSRF-TOKEN': _token},
                        type: 'GET',
                        datatype: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function (resp) {
                          //console.log('response => ' + resp);
                          //var results = $.parseJSON(resp);
                          //console.log(results);

                          $('.row_result, .row_result_map').html('');
                          $('.result_map').hide();

                          var results = $.parseJSON(resp);
                          if($.isEmptyObject(results.event)){
                            //console.log('yyy');
                            $('.row_result').append('<div class="row p-l-15">ไม่พบข้อมูล...</div>');
                            //console.log('xxxx');

                          } else {
                            //var results = $.parseJSON(resp);
                            var $index  =0;
                            $.each(results.event, function (key, value) {
                                //console.log('val => ' + key);
                                $('.result_pro').show();
                                var $clone = $('.col_hidden_search > div.col_result').clone();
                                $clone.find('span.result-title').html(value.title);
                                $clone.find('img.result-image').attr('src', '/' + value.image).attr('data-src', '/' + value.image).html(value.title);
                                $clone.find('span.result-brief').html(value.brief);
                                $clone.find('a.result-url').attr('href', '/events/' + value.url_slug).attr('title', value.title);
                                $clone.find('p.result-brand').html('via ' + value.brand);
                                $clone.css('display','block');
                                //$clone.find('.branch').attr('id', 'branch_' + bid).val(bid);
                                //console.log($clone);

                                if($index % 2 == 0){
                                  //var $new_row = $('<div class="row new_create_row"></div>');
                                  //$clone.appendTo($new_row);
                                  var $div = $("<div class='row new_index_row'></div>").append($clone);
                                  $div.appendTo('.row_result');
                                } else {
                                  $clone.appendTo('.row_result .new_index_row:last');
                                }

                                $index++;

                                //$('.row_search_result .col_result:last').after($clone);
                                //$('#subramos').append('<option>'+ value.nombre_subramo +'</option>');
                            });
                          }

                          //event maps
                          if(!$.isEmptyObject(results.map)){
                            $('.result_map').show();
                            var $index  =0;
                            $.each(results.map, function (key, value) {
                                var $clone = $('.col_hidden_search > div.col_result_map').clone();
                                $clone.find('span.result-title').html(value.name);
                                $clone.find('a.result-url').attr('href', '/maps/location/' + value.id).attr('title', value.name); //check map event location, event branch
                                $clone.css('display','block');

                                if($index % 2 == 0){
                                  var $div = $("<div class='row new_index_row_result'></div>").append($clone);
                                  $div.appendTo('.row_result_map');
                                } else {
                                  $clone.appendTo('.row_result_map .new_index_row_result:last');
                                }

                                $index++;
                            });
                          }
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

                  }, 1000 ); //delay
                } //end check null

                //    Do AJAX call here to get search results
                //    and update DOM and use the following block
                //    'searchResults.find('.result-name').each(function() {...}'
                //    inside the AJAX callback to update the DOM

                // Timeout is used for DEMO purpose only to simulate an AJAX call
                /*
                clearTimeout($.data(this, 'timer'));
                searchResults.fadeOut("fast"); // hide previously returned results until server returns new results
                var wait = setTimeout(function() {
                    searchResults.find('.result-name').each(function() {
                        if (searchField.val().length != 0) {
                            $(this).html(searchField.val());
                            searchResults.fadeIn("fast"); // reveal updated results
                        }
                    });
                }, 500);
                $(this).data('timer', wait);
                */
            }
        });

        //$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), cache: true}});

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

        //$(".widget-3 .metro").liveTile();
        //$(".widget-7 .metro").liveTile();
        /*
            Show a sliding item using MetroJS
            http://www.drewgreenwell.com/projects/metrojs
        */
        $(".live-tile").liveTile();

        /* FILTERS OVERLAY
       -------------------------------------------------------------*/

       $('[data-toggle="filters"]').click(function() {
           $('#filters').toggleClass('open');
       });

       $('.quickview-wrapper ul.map-items').scrollbar({
           ignoreOverlay: false
       });

        //Date Pickers
        //$('#datepicker-component, #datepicker-component2, #datepicker-component3').datepicker({ format: 'mm/dd/yyyy'});
        $('#datepicker-component, #datepicker-component2, #datepicker-component3').datepicker({ format: 'yyyy-mm-dd'});

        //facebook login
		    /*
        if($('.brand-form').exists()){
          console.log('load fb');

          window.fbAsyncInit = function() {
            FB.init({
          	appId     : '1532458647022405',
          	cookie   : true,  // enable cookies to allow the server to access // the session
          	xfbml      : true,  // parse social plugins on this page
          	status     : true,
          	version    : 'v2.3' // use version 2.3
            });
          };

          (function(d, s, id){
          	 var js, fjs = d.getElementsByTagName(s)[0];
          	 if (d.getElementById(id)) {return;}
          	 js = d.createElement(s); js.id = id;
          	 js.src = "//connect.facebook.net/en_US/sdk.js";
          	 fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));

        } //exists brand register form
		    */

        if($('.brand-form').exists()){
      		$.getScript('//connect.facebook.net/en_US/sdk.js', function(){
      			FB.init({
      			  appId: '1532458647022405',
              cookie   : true,  // enable cookies to allow the server to access // the session
      			  version: 'v2.5' // or v2.0, v2.1, v2.2, v2.3
      			});
      			$('#FBLogin,#feedbutton').removeAttr('disabled');
      			FB.getLoginStatus(statusChangeCallback);
      		});
        }

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

        $('#brand-register-form').on('submit',function(e){
          if($(this).valid()){
            e.preventDefault(e);
            var _token, data;
            _token = $('input[name=_token]').val();
            //var form = $('#brand-register-form');
            var form = document.getElementById('brand-register-form');
            data = new FormData(form);

            console.log(data);

            $.ajax({
                url: '/brand',
                headers: {'X-CSRF-TOKEN': _token},
                data: data,
                type: 'POST',
                datatype: 'JSON',
                processData: false,
                contentType: false,
                success: function (resp) {
                  //console.log('ajax response => ' + resp);
                  if(resp.status == 'success'){
                    window.location.href = base_url + '/events/create';
                  }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    $('.error-reponse').html(jqXHR.responseJSON);
                }
            });

          }
          return false;
        });

        if($('#brand-register-form').exists()){
          console.log('brand form..');
          $('#brand-register-form').validate({
               //ignore: ".ignore :hidden" //is telling it to ignore hidden fields with the class ignore.
               //ignore: ".ignore", //will tell it to only ignore fields will class .ignore.
               //ignore: ".ignore, :hidden", //will tell it to ignore fields will class .ignore AND fields that are hidden.
               //ignore:[], // tells the plugin to ignore nothing and validate everything.
               ignore: ".ignore, :hidden:not(.validate)",
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
                  name: {
                    required: true
                  },
                  url_slug: {
                    required: true
                  },
                  "category[]": {
                    required: true
                  },
                  detail: {
                     required: true
                  },
                  branch_name: {
                    required: true,
                  },
                  username: {
                    required: true,
                  },
                  password: {
                    required: true,
                  },
                  published_at: {
                    required: true
                  }
               },
               messages: {
                  name:{
                  	required: "This field is required.",
                  },
                  url_slug:{
                  	required: "This field is required.",
                  },
                  "category[]": {
                    required: "This field is required.",
                  },
                  detail: {
                    required: "This field is required.",
                  },
                  branch_name: {
                    required: "This field is required.",
                  },
                  username: {
                    required: "This field is required.",
                  },
                  password: {
                    required: "This field is required.",
                  },
                  published_at: {
                    required: "This field is required.",
                  }
          		 },
               submitHandler: function(form) {
                   // optional callback function
                   // only fires on a valid form submission
                   // do something only if/when form is valid
                   // like process the dropzone queue HERE instead
                   // then use .ajax() OR .submit();
               }
          });
        }

        $.validator.addMethod("checkTags", function(value) { //add custom method
            //Tags input plugin converts input into div having id #YOURINPUTID_tagsinput
            //now you can count no of tags
            return ($(".bootstrap-tagsinput").find(".label-custom-tag").length > 0);
        });

        /* cache by bootstrap js */
        if($('#my-awesome-dropzone-form').exists()){
          $('#my-awesome-dropzone-form').validate({
               //ignore: ".ignore :hidden" //is telling it to ignore hidden fields with the class ignore.
               //ignore: ".ignore", //will tell it to only ignore fields will class .ignore.
               //ignore: ".ignore, :hidden", //will tell it to ignore fields will class .ignore AND fields that are hidden.
               //ignore:[], // tells the plugin to ignore nothing and validate everything.
               ignore: ".ignore, :hidden:not(.validate)",
               focusInvalid: false,
               ignoreTitle: true,
               errorClass:'error',
               validClass:'success',
               errorElement:'span',
               highlight: function (element, errorClass, validClass) {
                   //console.log(element.name);
                   $(element).parents("div[class='clearfix']").addClass(errorClass).removeClass(validClass);
               },
               unhighlight: function (element, errorClass, validClass) {
                   $(element).parents(".error").removeClass(errorClass).addClass(validClass);
               },
               /*
              //When there is an error normally you just add the class to the element.
              // But in the case of select2s you must add it to a UL to make it visible.
              // The select element, which would otherwise get the class, is hidden from
              // view.
              highlight: function (element, errorClass, validClass) {
                var elem = $(element);
                console.log(element.name);
                if (elem.hasClass("select2-offscreen")) {
                    $("#s2id_" + elem.attr("id") + " a").addClass(errorClass);
                    console.log('has class');
                } else {
                    elem.addClass(errorClass);
                    console.log('no class');
                }
              },
              //When removing make the same adjustments as when adding
              unhighlight: function (element, errorClass, validClass) {
                var elem = $(element);
                if (elem.hasClass("select2-offscreen")) {
                    $("#s2id_" + elem.attr("id") + " a").removeClass(errorClass);
                } else {
                    elem.removeClass(errorClass);
                }
              },*/
               rules: {
                  title: {
                    required: true
                  },
                  url_slug: {
                    required: true
                  },
                  "category[]": {
                    required: true
                  },
                  tag_list: {
                    required: true,
                    "checkTags": true
                  },
                  brief: {
                     required: true
                  },
                  branch_name: {
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
                  "category[]": {
                    required: "This field is required.",
                  },
                  tag_list: {
                    required: "This field is required.",
                    "checkTags": "This field is required.",
                  },
                  brief: {
                    required: "This field is required.",
                  },
                  branch_name: {
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
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".dropzone-file-previews",

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
                       //var form = $('#my-awesome-dropzone-form');
                       var form = document.getElementById('my-awesome-dropzone-form');
                       data = new FormData(form);

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
                             //window.location.href = base_url + '/events';
                             window.location.href = base_url;
                           },
                           error: function(jqXHR, textStatus, errorThrown)
                           {
                               $('.error-reponse').html(jqXHR.responseJSON);
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

        }

        //dropzone edit form
        if($('#my-awesome-dropzone-form-edit').exists()){
          $('#my-awesome-dropzone-form-edit').validate({
               //ignore: ".ignore :hidden" //is telling it to ignore hidden fields with the class ignore.
               //ignore: ".ignore", //will tell it to only ignore fields will class .ignore.
               //ignore: ".ignore, :hidden", //will tell it to ignore fields will class .ignore AND fields that are hidden.
               //ignore:[], // tells the plugin to ignore nothing and validate everything.
               ignore: ".ignore, :hidden:not(.validate)",
               focusInvalid: false,
               ignoreTitle: true,
               errorClass:'error',
               validClass:'success',
               errorElement:'span',
               highlight: function (element, errorClass, validClass) {
                   //console.log(element.name);
                   $(element).parents("div[class='clearfix']").addClass(errorClass).removeClass(validClass);
               },
               unhighlight: function (element, errorClass, validClass) {
                   $(element).parents(".error").removeClass(errorClass).addClass(validClass);
               },
               /*
              //When there is an error normally you just add the class to the element.
              // But in the case of select2s you must add it to a UL to make it visible.
              // The select element, which would otherwise get the class, is hidden from
              // view.
              highlight: function (element, errorClass, validClass) {
                var elem = $(element);
                console.log(element.name);
                if (elem.hasClass("select2-offscreen")) {
                    $("#s2id_" + elem.attr("id") + " a").addClass(errorClass);
                    console.log('has class');
                } else {
                    elem.addClass(errorClass);
                    console.log('no class');
                }
              },
              //When removing make the same adjustments as when adding
              unhighlight: function (element, errorClass, validClass) {
                var elem = $(element);
                if (elem.hasClass("select2-offscreen")) {
                    $("#s2id_" + elem.attr("id") + " a").removeClass(errorClass);
                } else {
                    elem.removeClass(errorClass);
                }
              },*/
               rules: {
                  title: {
                    required: true
                  },
                  url_slug: {
                    required: true
                  },
                  "category[]": {
                    required: true
                  },
                  tag_list: {
                    required: true,
                    "checkTags": true
                  },
                  brief: {
                     required: true
                  },
                  branch_name: {
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
                  "category[]": {
                    required: "This field is required.",
                  },
                  tag_list: {
                    required: "This field is required.",
                    "checkTags": "This field is required.",
                  },
                  brief: {
                    required: "This field is required.",
                  },
                  branch_name: {
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
               }
          });

          //console.log('dropzone exists...');
          Dropzone.options.myAwesomeDropzoneFormEdit = { // The camelized version of the ID of the form element
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
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".dropzone-file-previews",

            // The setting up of the dropzone
            init: function() {
              var myDropzone = this;

              //console.log('dropzone...');

              //Populate any existing thumbnails
              var thumb = $.parseJSON($('#thumb_mock').val());
              $.each(thumb, function(key,value){ //loop through it
                  console.log('value => ' + value.name);
                  var mockFile = { name: value.name, size: value.size }; // here we get the file name and size as response
                  myDropzone.options.addedfile.call(myDropzone, mockFile);
                  myDropzone.options.thumbnail.call(myDropzone, mockFile, value.fileinfo);//uploadsfolder is the folder where you have all those uploaded files
              });

              // First change the button to actually tell Dropzone to process the queue.
              this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {

                e.preventDefault();
                e.stopPropagation();

                 if($('#my-awesome-dropzone-form-edit').valid()){

                  var description = $('textarea[name="description"]').html($('#summernote').code());

                  if (myDropzone.getQueuedFiles().length > 0) {
                       myDropzone.processQueue();
                       //$('#my-awesome-dropzone-form')[0].submit();

                       console.log('drop zone file..');
                  } else {
                      console.log('drop zone null, ajax post file..');

                       var _token, data;
                       _token = $('input[name=_token]').val();
                       //var form = $('#my-awesome-dropzone-form');
                       var form = document.getElementById('my-awesome-dropzone-form-edit');
                       data = new FormData(form);

                       var event_edit_id = $('.event_edit_id').val();

                       $.ajax({
                           url: base_url + '/events/' + event_edit_id,
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
        } //end dropzone edit

        //Single instance of tag inputs - can be initiated with simply using data-role="tagsinput" attribute in any input field
        if($('.custom-tag-input').exists()){
          $('.custom-tag-input').tagsinput({ maxTags: 20, tagClass: function(item) {return 'label label-custom-tag';} });
        }

        //$(".custom-tag-input").on('itemRemoved', function (event) {
           //console.log('remove');
        //});

        if($('#summernote').exists()){
          var $summernote = $('#summernote').summernote({
              height: 200,
              styleTags: ['pre', 'h1', 'h2'],
              toolbar: [
                // [groupName, [list of button]]
                ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                //['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['view', ['fullscreen', 'codeview']],
                //['insert', ['link', 'picture', 'hr']],
                ['picture', ['picture']]
              ],
              onImageUpload: function(files, editor, $editable) {
                //console.log('file => ' + files[0]);
                sendFile(files[0],editor,$editable);
              }
          });
        }

        //ignore valid popup model
        $('.note-modal-form').each( function() { $(this).validate({}) });

        //Multiselect - Select2 plug-in
        if($('#category').exists()){
          $("#category").select2({
            //maximumSelectionLength: 2,
            maximumSelectionSize: 2,
            formatSelectionTooBig: function (limit) {
                // Callback
                return 'Too many selected items';
            }
          });
        }

        $('#category').on('change', function() {
            $(this).valid();
        });

        if($('.social_group').exists()){
          //Switchery
          var changeCheckbox = document.querySelector('.js-check-change')
            , changeField = document.querySelector('.js-check-change-field');

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
                   window.fx_select_brand = brand_id;
                   var _branch = $('.branch_child .list');
                   //var data = new FormData();
                   //data.append("id", brand_id);
                   //$('.new_branch_panel').hide(); //hide add panel
                   if ($('.new_branch_panel').css('display') != 'none'){
                     $('.add_new_branch').trigger('click');
                   }

                   _branch.html('');
                   $('.new_branch_btn').hide(); //hide new branch btn
                   $('.check-branch-all').hide(); //hide check all branch

                   if(brand_id > 0){
                   $.ajax({
                     url: "/events/branch/" + brand_id,
                     //data: data,
                     //cache: false,
                     contentType: false,
                     processData: false,
                     dataType: 'JSON',
                     type: 'GET',
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
                        $('.check-branch-all').show(); //show check all branch
                      } else {
                        $('.branch_child .list').append('<div class="checkbox"></div>');
                      }
                      $('.new_branch_btn').show(); //show new branch btn

                     },
                     error: function(jqXHR, textStatus, errorThrown) {
                       console.log(textStatus+" "+errorThrown);
                     }
                  });
                }
              }
          });
        }

        //add branch
        if($('.new_branch_panel').exists()){}

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

        if($('#map_canvas').exists() || $('#brand-register-form').exists()){
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

    $('.panel-collapse label').on('click', function(e){
        e.stopPropagation();
    });

})(window.jQuery);

function statusChangeCallback(response){
  if(response.status === 'connected'){

    if (response.authResponse){

	   /*
     FB.api('/me/permissions/publish_actions', 'get', function(response){
       //console.log('status => ' + response.data[0].status);
       if(response.data[0].status != 'granted'){
         console.log('permissnion publish_actions status declined.');
       } else {
         var access_token =   FB.getAuthResponse()['accessToken'];
         //console.log('Access Token = '+ access_token);

         FB.api('/me', function(response){
          //console.log('Good to see you, ' + response.name + '.');
          $.each(response, function(key, element){
            if(key == 'id'){
              $("#fbPostModal .modal-body #fbId").val(element);
            } else if(key == 'first_name') {
              $("#fbPostModal .modal-body #firstName").val(element);
            } else if(key == 'last_name') {
              $("#fbPostModal .modal-body #lastName").val(element);
            } else if(key == 'gender') {
              $("#fbPostModal .modal-body #gender").val(element);
            } else if(key == 'email') {
              $("#fbPostModal .modal-body #email").val(element);
            }
            //console.log('reponse => ' + key + ', value => ' + element);
          });

          //$('#fbPostModal').modal({show:true});
          //$("#fbPostModal .modal-body #tokenId").val( access_token );
         });
       }
     });
	   */

      FB.api('/me/accounts', function(response){
       //console.log('account => ' + response.toSource());
       var i = 0;
       $.each(response.data, function(k,v){
         ++i;
         if(v.id == '192272534234138'){
         $("#fbPostModal .modal-body #tokenId").val( v.access_token );
         }
         console.log('k => ' + k.toSource() + ' v => '+ v.id + ' => ' + v.name + ' => ' + v.access_token);
       });
       console.log('account => ' + response.data[0].name);
      });


     } else {
         console.log('User cancelled login or did not fully authorize.');
     }

  } else if (response.status === 'not_authorized') {
    console.log('Please log into this app.');
  } else {
     console.log('Please log into Facebook.');
  }
}

function facebookLogin() {
  FB.login(function(response) {
      statusChangeCallback(response);
    },{scope: 'email,public_profile,publish_pages,manage_pages'});

  return false;
}

$(document).on('click', "#FBLogin", function(){
  facebookLogin();
  return false;
});

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

//add branch
$(document).on('click', '#add_branch', function(){
  if($('#branch_name').valid()){
    console.log('branch ok');
    console.log('brand id => ' + window.fx_select_brand);

    var _token = $('input[name=_token]').val();
    var brand_id = window.fx_select_brand;
    var brand_branch_row = $('.brand_branch_row');
    var event_branch_row = $('.event_branch_row');
    var branch_name = $('#branch_name').val();
    var branch_detail = $('#branch_detail').val();
    var branch_location = $('#branch_location').val();
    var branch_lat = $('#branch_location_lat').val();
    var branch_lon = $('#branch_location_lon').val();
    var branch_zoom = $('#branch_location_zoom').val();

    var data = {'brand_id':brand_id, 'branch_name':branch_name, 'branch_detail':branch_detail, 'branch_location':branch_location, 'branch_lat':branch_lat, 'branch_lon':branch_lon, 'branch_zoom':branch_zoom};
    $.ajax({
        url: '/brand/add_branch',
        headers: {'X-CSRF-TOKEN': _token},
        data: JSON.stringify(data), //stringify is important
        //data: data,
        type: 'POST',
        datatype: 'JSON',
        processData: false,
        contentType: false,
        success: function (resp) {

          var bname = $('#branch_name').val();
          var bid = resp.branch_id;
          //console.log('response => ' + bid + ' => ' + bname);

          if(resp.status == 'success'){
            if(brand_id != '' && $(event_branch_row).exists()){ //event, brand add new bracnh

                //console.log('event branch');
                var $clone = $('.event_branch_row > div.branch_row').clone();
                $clone.find('label').attr('for', 'branch_' + bid).html(bname);
                $clone.find('.branch').attr('id', 'branch_' + bid).val(bid);
                //console.log($clone);

                $('.list .checkbox:last').after($clone);

            } else if($(brand_branch_row).exists()) { //brand add new branch

              //console.log('brand branch....');
              var $clone = $('.brand_branch_row > div.branch_row').clone();
              $clone.find('.branch_name_list').html(bname);
              $clone.find('.branch_id').val(bid);
              //console.log($clone);

              $clone.appendTo('#branch_list');
              //$('#branch_list').append($clone);

            }

            if($('.check-branch-all').css('display') == 'none'){
              $('.check-branch-all').show(); //show check all branch
            }

            $('.add_new_branch').trigger('click');
            $('html, body').animate({
                scrollTop: $('.master-checkbox-all').offset().top - 20
            }, 'slow');
          }
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

  } else {
    console.log('branch is valid');
  }
});

/*
    Look for data-image attribute and apply those
    images as CSS background-image
*/
/*
var s_length = $('.item-slideshow > div').length;
$('.item-slideshow > div').each(function(index) {
    var img = $(this).data('image');
    //console.log(img);
    var html = $("<a class='button secondary url' href='#"+index+"'>").append($("<div class='gallery-item-thumb owl-item m-r-10'>").css({
        'background-image': 'url(' + img + ')',
        'background-size': 'cover',
        'background-position': 'center'
    }));
    //console.log('=> ' + $('.item-slideshow > div').length);
    if(s_length > 1){
      $('.thumb > div').append(html);
    } else {
      $('.item-details .thumb .col-md-12').hide();
    }
    $(this).css({
        'background-image': 'url(' + img + ')',
        'background-repeat': 'no-repeat',
        'background-size': 'contain',
        'background-position': 'center'
    });
});
*/

/*
    Touch enabled slideshow for gallery item images using owlCarousel
    www.owlcarousel.owlgraphic.com
*/
/*
var owl = $(".item-slideshow").owlCarousel({
    items:1,
    nav: false,
    dots: false,
    URLhashListener:true,
    onInitialized: loaded,
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
*/

//google map application
var map;
var mapObj;
var place = '';
var address = '';
var point = '';

function initialize() {

  console.log('initialize..');

    mapObj = new Object(google.maps);
    var default_latlng  = new mapObj.LatLng(13.7563309, 100.50176510000006);

    //Map default
    //Create LatLngBounds object.
    if($('#map_canvas').exists()){
      var latlngbounds = new mapObj.LatLngBounds();
      var default_type = mapObj.MapTypeId.ROADMAP;
      var map_canvas = $("#map_canvas")[0];
      var options = {
          zoom: 14,
          scrollwheel: false,
          center: default_latlng,
          mapTypeId:default_type
      };

      map = new mapObj.Map(map_canvas, options);
      mapObj.event.addListener(map, 'zoom_changed', function() {
          $("#location_zoom").val(map.getZoom());
      });

      var infowindow = new mapObj.InfoWindow();
      var marker = new mapObj.Marker({
        map: map,
        anchorPoint: new mapObj.Point(0, -29)
      });
    }

    //map branch location
    if($('#map_canvas_branch').exists()){
      var mapBranch;
      var mapObjBranch;
      var placeBranch = '';
      var addressBranch = '';

      mapObjBranch = new Object(google.maps);
      var latlngboundsBranch = new mapObjBranch.LatLngBounds();
      var map_canvas_branch = $("#map_canvas_branch")[0];
      mapBranch = new mapObjBranch.Map(map_canvas_branch, options);
      mapObjBranch.event.addListener(mapBranch, 'zoom_changed', function() {
          $("#branch_location_zoom").val(mapBranch.getZoom());
      });

      var infowindowBranch = new mapObjBranch.InfoWindow();
      var markerBranch = new mapObjBranch.Marker({
        map: mapBranch,
        anchorPoint: new mapObj.Point(0, -29)
      });
    }

    if($('.map-full').exists()){ //main map full
      $.ajax({
          url: '/maps/locations/',
          type: 'GET',
          datatype: 'JSON',
          processData: false,
          contentType: false,
          success: function (resp) {
            var locations = $.parseJSON(resp);
            var markers = [];

            //var location_list = locations.split(",");
            //console.log(location_list[0] +'=>'+ location_list[1] +'=>'+ location_list[2]);
            window.events_locations = new Array();
            //var loop = 0;
            //var bounds = new google.maps.LatLngBounds();
            $.each(locations, function(k, v){
                //window.events_locations = [];
                var data = [];
                $.each(v, function(x, y){
                    //window.events_locations.push(y);
                    data.push(y);
                    //data.index = k;
                    //data.value = y;
                });
                window.events_locations[k] = data;

                //console.log('y => ' + window.events_locations[k]);

                var location_list = k.split(",");
                var name = location_list[2];
                var lat = location_list[0];
                var lon = location_list[1];
                //console.log(location_list[0] +'=>'+ location_list[1] +'=>'+ location_list[2]);
                //console.log('=> ' + k + ' => ' + name + ' => ' + lat + '=> ' + lon);
                //var markerID = i;
                var markerName = name;
                var markerLat = lat;
                var markerLng = lon;
                var markerLatLng=new mapObj.LatLng(markerLat,markerLng);
                markers[k] = new mapObj.Marker({
                    position:markerLatLng,
                    map: map,
                    title:markerName
                });

                mapObj.event.addListener(markers[k], 'click', function() {
                    infowindow.setContent('<div class="popup_container"><strong class="marker_name">'+ markerName +'</strong></div><p><a href="#" data-index="'+k+'" class="events_locations">มี '+ data.length +' โปรโมชั่นที่นี่</a></p>');
                    infowindow.open(map,markers[k]);
                    map.panTo(markers[k].getPosition());
                    //map.setZoom(14);
                });

                //Extend each marker's position in LatLngBounds object.
                latlngbounds.extend(markers[k].position);

                //loop++;
            });

            //Get the boundaries of the Map.
            //var bounds = new mapObj.LatLngBounds();

            //Center map and adjust Zoom based on the position of all markers.
            map.setCenter(latlngbounds.getCenter());
            map.fitBounds(latlngbounds);

            $(document).on('click', '.events_locations', function(e){
              var index = $(this).data('index');
              //mapObj.event.trigger(markers[index], 'click');
              //return false;
              //console.log('index => ' + index);
              //console.log('value => ' + window.events_locations[index]);
              $('#filters.maps').removeClass('open');
              $('ul#map-items').html('');
              $.each(window.events_locations[index], function(k,v){
                //console.log(' => ' + v.title + ' => ' + v.slug + ' => ' + v.brand);
                var clone = '<li class="map-event-list clearfix">';
                    clone += '<span class="col-xs-height col-top p-t-5">';
                    clone += '<span class="thumbnail-wrapper d32 circular bg-success">';
                    clone += '<span class="thumbnail-wrapper d32 circular bg-success"><img width="34" height="34" class="col-top" src="/'+v.image+'" data-src="/'+v.image+'" data-src-retina="/'+v.image+'" alt=""></span>';
                    clone += '</span>';
                    clone += '<div class="p-l-10 col-xs-height col-middle col-xs-12">';
                    clone += '<span class="text-master"><strong>'+v.brand+'</strong></span>';
                    clone += '<span class="block text-master hint-text fs-12">'+v.category+'</span>';
                    clone += '<p><strong><a target="_blank" title="'+v.title+'" href="/events/'+v.slug+'">'+v.title+'</a></strong></p>';
                    clone += '</div></li>';

                    //console.log('clone => ' + clone);
                    $('ul#map-items').append(clone);
              });
              $('#filters .map-location').html($(this).closest('div').find('.marker_name').html());
              $('#filters.maps').addClass('open');
              return false;
            });

            /*$('.event').on('click', '.place', function(e){
              var index = $(this).data('index');
              mapObj.event.trigger(markers[index], 'click');
              return false;
            });*/

          },
          error: function(jqXHR, textStatus, errorThrown)
          {
              console.log('ERRORS: ' + jqXHR + ' ,textStatus => ' + textStatus + ' ,errorThrown => ' + errorThrown);
              console.log(JSON.stringify(jqXHR.responseJSON));
          }
      });
    }

    if($('.event_id').exists()){ //event locations
      //console.log('evetn id >>');
      $.ajax({
          url: '/events/locations/'+$('.event_id').val(),
          type: 'GET',
          datatype: 'JSON',
          processData: false,
          contentType: false,
          success: function (resp) {
            var locations = $.parseJSON(resp);
            var markers = [];

            $.each(locations, function(k, v){
                //var markerID = v.id;
                var markerName = v.name;
                var markerLat = v.lat;
                var markerLng = v.lon;
                var markerLatLng=new mapObj.LatLng(markerLat,markerLng);
                markers[k] = new mapObj.Marker({
                    position:markerLatLng,
                    map: map,
                    title:markerName
                });

                mapObj.event.addListener(markers[k], 'click', function() {
                    infowindow.setContent('<div class="popup_container"><strong>'+ markerName +'</strong></div><p><a href="#" data-index="relate xxx" class="events_locations">ดูโปรโมชั่นอื่นๆ ของที่นี่</a></p>');
                    infowindow.open(map,markers[k]);
                    map.panTo(markers[k].getPosition());
                    //map.setZoom(14);
                });

                latlngbounds.extend(markers[k].position);
            });

            //Center map and adjust Zoom based on the position of all markers.
            map.setCenter(latlngbounds.getCenter());
            //console.log('length => ' + locations.length);
            if(locations.length > 1){
              map.fitBounds(latlngbounds);
            }

            $('.event').on('click', '.place', function(e){
              var index = $(this).data('index');
              mapObj.event.trigger(markers[index], 'click');
              return false;
            });
          },
          error: function(jqXHR, textStatus, errorThrown)
          {
              console.log('ERRORS: ' + jqXHR + ' ,textStatus => ' + textStatus + ' ,errorThrown => ' + errorThrown);
              console.log(JSON.stringify(jqXHR.responseJSON));
          }
      });
    }

    //event location
    if($('#event_location').exists()){ //search box
      var input = document.getElementById('event_location');
      var autocomplete = new mapObj.places.Autocomplete(input);
      autocomplete.bindTo('load', map);

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
          //console.log('map set center');
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport){
          map.fitBounds(place.geometry.viewport);
          //console.log('map fitBounds' + place.geometry.viewport);
        }
        /*else {
          map.setCenter(place.geometry.location);
          map.setZoom(17);  // Why 17? Because it looks good.
        }*/

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        $("#location_lat").val(place.geometry.location.lat());
        $("#location_lon").val(place.geometry.location.lng());

        //infowindow.setContent('<div><strong>' + place.name + '</strong></div><br>' + address);
        infowindow.setContent('<div><strong>' + place.name + '</strong></div>');
        infowindow.open(map, marker);
      });

      //event edit
      if($('.event_location_name').exists() && $('.event_location_name').val() != ''){
        console.log('event location edit....');
        var markerEdit;

        var markerName = $('.event_location_name').val();
        var markerLat = $('#location_lat').val();
        var markerLng = $('#location_lon').val();
        var markerZoom = parseInt($('#location_zoom').val());
        var markerLatLng=new mapObj.LatLng(markerLat, markerLng);
        markerEdit = new mapObj.Marker({
            position:markerLatLng,
            map: map,
            title:markerName
        });

        mapObj.event.addListener(markerEdit, 'click', function() {
            infowindow.setContent('<div><strong>'+ markerName +'</strong></div>');
            infowindow.open(map,markerEdit);
            map.panTo(markerEdit.getPosition());
            //map.setZoom(markerZoom);
        });

        //Extend each marker's position in LatLngBounds object.
        latlngbounds.extend(markerEdit.position);

        map.setZoom(markerZoom);
        map.setCenter(latlngbounds.getCenter());
        //map.fitBounds(latlngbounds);
      }

      mapObj.event.addListener(marker, 'click', function() {
        //infowindow.setContent('<div><strong>' + place.name + '</strong></div><br>' + address);
        infowindow.setContent('<div><strong>' + place.name + '</strong></div>');
        infowindow.open(map, marker);
      });
    }

    //branch location
    if($('#branch_location').exists()){ //search box
      var inputBranch = document.getElementById('branch_location');
      var autocompleteBranch = new mapObjBranch.places.Autocomplete(inputBranch);
      autocompleteBranch.bindTo('load', mapBranch);

      autocompleteBranch.addListener('place_changed', function(){
        infowindowBranch.close();
        markerBranch.setVisible(false);
        placeBranch = autocompleteBranch.getPlace();
        if (!placeBranch.geometry){
          window.alert("Autocomplete's returned place contains no geometry");
          return;
        } else {
          mapBranch.setZoom(17);
          mapBranch.setCenter(placeBranch.geometry.location);
          //console.log('branch set center');
        }

        // If the place has a geometry, then present it on a map.
        if (placeBranch.geometry.viewport){
          mapBranch.fitBounds(placeBranch.geometry.viewport);
          //console.log('branch fitBounds' + placeBranch.geometry.viewport);
        }
        /*else {
          mapBranch.setCenter(placeBranch.geometry.location);
          mapBranch.setZoom(17);  // Why 17? Because it looks good.
          console.log('branch location');
        }*/

        markerBranch.setPosition(placeBranch.geometry.location);
        markerBranch.setVisible(true);

        $("#branch_location_lat").val(placeBranch.geometry.location.lat());
        $("#branch_location_lon").val(placeBranch.geometry.location.lng());

        //infowindowBranch.setContent('<div><strong>' + placeBranch.name + '</strong></div><br>' + addressBranch);
        infowindowBranch.setContent('<div><strong>' + placeBranch.name + '</strong></div>');
        infowindowBranch.open(mapBranch, markerBranch);
      });

      mapObjBranch.event.addListener(markerBranch, 'click', function(){
        //infowindowBranch.setContent('<div><strong>' + placeBranch.name + '</strong></div><br>' + addressBranch);
        infowindowBranch.setContent('<div><strong>' + placeBranch.name + '</strong></div>');
        infowindowBranch.open(mapBranch, markerBranch);
      });

      $(document).on('click', '.add_new_branch', function(e){
        $('.new_branch_panel').toggle();
        $('i.pg-minus', this).toggleClass('pg-plus');
        if ($('.new_branch_panel').css('display') != 'none'){
          //markerBranch = [];
          //markerBranch.setVisible(false);
          $('#branch_location').val('');
          //markerBranch.setMap(null);
          infowindowBranch.close();
          markerBranch.setVisible(false);

          mapBranch.setZoom(14);
          mapObjBranch.event.trigger(mapBranch, 'resize');
          //mapBranch.setCenter(placeBranch.geometry.location);
          mapBranch.setCenter(default_latlng);
          //google.maps.event.addDomListener(window, 'resize', function() {
              //map.setCenter(center);
          //});
        }
      });
    }

    $(document).on('click', '.btn_branch_delete', function(e){
      $(this).closest('.branch_row').remove();
    });

}

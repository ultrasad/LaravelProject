<!-- BEGIN VENDOR JS -->
<!-- <script type="text/javascript" src="{{ URL::asset('assets/pace/pace.min.js') }}"></script> -->
<script type="text/javascript" src="{{ URL::asset('assets/jquery/jquery-1.11.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/jquery-validation/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/modernizr.custom.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/classie/classie.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/jquery-metrojs/MetroJs.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/dropzone/dropzone.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-tag/bootstrap-tagsinput.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<!-- <script type="text/javascript" src="{{ URL::asset('assets/summernote/js/summernote.0.5.1.min.js') }}"></script> -->
<script type="text/javascript" src="{{ URL::asset('assets/summernote/js/summernote.0.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/switchery/js/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/jquery-isotope/isotope.pkgd.min.js') }}" ></script>
<script type="text/javascript" src="{{ URL::asset('assets/codrops-stepsform/js/stepsForm.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/fotorama/fotorama.js') }}"></script>
<!--<script type="text/javascript" src="{{ URL::asset('assets/owl-carousel/owl.carousel.min.js') }}"></script>-->
<!--<script type="text/javascript" src="{{ URL::asset('assets/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>-->
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<!-- <script type="text/javascript" src="{{ URL::asset('pages/js/pages.min.js') }}"></script> -->
<script type="text/javascript" src="{{ URL::asset('pages/js/pages.js') }}"></script>
<!--<script type="text/javascript" src="{{ URL::asset('pages/js/pages.social.js') }}"></script>-->
<!-- BEGIN PAGE LEVEL JS -->
<script type="text/javascript" src="{{ URL::asset('assets/js/scripts.js') }}"></script>
<!-- END PAGE LEVEL JS -->

<script type="text/javascript">
$( document ).ready(function() {

  	// Takes the gutter width from the bottom margin of .post

  	//var gutter = parseInt(jQuery('.card').css('marginBottom'));
  	//var $container = $('.day');

  	// Creates an instance of Masonry on #posts
  	/*$container.masonry({
  		//gutter: gutter,
      //gutter: 20,
  		itemSelector: '.card',
  		columnWidth: '.col1',
      isFitWidth: true
  	});*/

    (function($,sr){
      // debouncing function from John Hann
      // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
      var debounce = function (func, threshold, execAsap) {
          var timeout;

          return function debounced () {
              var obj = this, args = arguments;
              function delayed () {
                  if (!execAsap)
                      func.apply(obj, args);
                  timeout = null;
              };

              if (timeout)
                  clearTimeout(timeout);
              else if (execAsap)
                  func.apply(obj, args);

              timeout = setTimeout(delayed, threshold || 100);
          };
      }
    	// smartresize
    	jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

    })(jQuery,'smartresize');

    /*var $container = $('.day');
    var margin = 20;
    var colWidth = function () {
        var w = $container.width(),
            columnNum   = 1,
            columnWidth = 0;
        if (w > 1200) {
            columnNum  = 5;
        } else if (w > 900) {
            columnNum  = 4;
        }
        columnWidth = Math.floor(w/columnNum);
        $container.find('.col1').each(function() {
            $(this).css({
                width: columnWidth - margin,
            });
        });
        return columnWidth;
    }

    var isoday = function(){
          console.log('col width => ' + colWidth());
          $('.day').isotope({
          itemSelector: '.card',
          masonry: {
              //columnWidth: 300,
              columnWidth: colWidth(),
              gutter: 20,
              isFitWidth: true
          }
      });
    }*/

    var $container = $('.day'),
    margin = 20,
    colWidth = function () {
        /* old master
        var w = $container.width(),
            columnNum   = 1,
            columnWidth = 0;
        if (w > 1200) {
            columnNum  = 5;
        } else if (w > 900) {
            columnNum  = 4;
        }
        columnWidth = Math.floor(w/columnNum);
        $container.find('.col1').each(function() {
            $(this).css({
                width: columnWidth - margin,
            });
        });
        return columnWidth;
        */

        var w = $container.width(),
            columnNum   = 1,
            columnWidth = 300;

        if (w < 600) {
            columnWidth = w;
            $container.find('.col1').each(function() {
                var columnHeight = $(this).height();
                $(this).css({
                    width: columnWidth - margin,
                    height: columnHeight
                });
            });
        } else {
          $container.find('.col1').each(function() {
              var columnHeight = $(this).height();
              $(this).css({
                  width: 300,
                  height: columnHeight
              });
          });
        }
        console.log('width => ' + w);
        return columnWidth;
    },
    isotope = function(){
    $grid = $container.isotope({
          itemSelector: '.card',
          //layoutMode: 'fitRows',
          //resizable: false,
          masonry: {
              //columnWidth: 300,
              //columnWidth: colWidth(),
              columnWidth: '.col1-test',
              //gutter: 20,
              isFitWidth: true
              //isFitWidth: false,
              //originLeft: false
          }
      });
    };

    //var $container = $('.day');
    //$container.masonry({itemSelector: '.card', columnWidth: '.col1', isFitWidth: true});

    isotope();
    //$(window).on('debouncedresize', isotope);
    //$(window).on('debouncedresize', isotope);
    // usage:
    $(window).smartresize(function(){
      // code that takes it easy...
      var $windowSize = $('.feed').width();
      console.log('window feed Size => ' + $windowSize);

      /*$grid.isotope({
            itemSelector: '.card',
            masonry: {
                columnWidth: '.col1-test',
                isFitWidth: true
            }
      });*/
      isotope();
      $grid.isotope('layout');
      //isotope();
      //$container.isotope('layout');
    });

    //$(window).on('resize', function() {
        //var $windowSize = $('.feed').width();
        //console.log('window feed Size => ' + $windowSize);

        //$('[data-social="day"]').masonry({itemSelector: '.card', isFitWidth: false, columnWidth: 400});
        //$('[data-social="day"]').css({width: '100%'}).find('.card').css({width: '100%'});
        //$('[data-social="day"]').isotope('layout');

        //$('.day').css({width: '400'});

        //if ($windowSize < 768) {
          //console.log('windowSize ');
          //$('[data-social="day"]').css({width: ($('.column-default').width()-20)});
          //$('[data-social="day"]').find('.card').addClass('column-default');
          //$('[data-social="day"]').css({width:'400px'});

          //$('.day').find('.card').css({width: '400px'});
          //$isotope.isotope('layout');
          //$('[data-social="day"]').isotope('layout');
          //container.isotope('layout', {"columnWidth": 250, "isFitWidth": false});

          /*$('[data-social="day"]').masonry(
          {
              itemSelector: '.card',
              columnWidth:  '.col1',
              isFitWidth: false
          });*/

      //  } else {
          //$('[data-social="day"]').css({width: ''});
          //$('[data-social="day"]').find('.card').css({width:'300px'});
          //$('[data-social="day"]').isotope('layout');
          //$('[data-social="day"]').find('.col1').css({width:'300px'});
        //}

        //$container.isotope('layout');
        //$('[data-social="day"]').isotope('layout');

        //container.isotope('reLayout');
    //});

  	// This code fires every time a user resizes the screen and only affects .post elements
  	// whose parent class isn't .container. Triggers resize first so nothing looks weird.
  	/*jQuery(window).bind('resize', function () {
      console.log('resize..');
  		if (!jQuery('#posts').parent().hasClass('container')) {

  			// Resets all widths to 'auto' to sterilize calculations
  			post_width = jQuery('.post').width() + gutter;
  			jQuery('#posts, body > #grid').css('width', 'auto');

  			// Calculates how many .post elements will actually fit per row. Could this code be cleaner?
  			posts_per_row = jQuery('#posts').innerWidth() / post_width;
  			floor_posts_width = (Math.floor(posts_per_row) * post_width) - gutter;
  			ceil_posts_width = (Math.ceil(posts_per_row) * post_width) - gutter;
  			posts_width = (ceil_posts_width > jQuery('#posts').innerWidth()) ? floor_posts_width : ceil_posts_width;
  			if (posts_width == jQuery('.post').width()) {
  				posts_width = '100%';
  			}

  			// Ensures that all top-level elements have equal width and stay centered
  			jQuery('#posts, #grid').css('width', posts_width);
  			jQuery('#grid').css({'margin': '0 auto'});

  		}
  	}).trigger('resize');*/

  //var $container = $('.day').masonry({itemSelector: '.card', columnWidth: '.col1', gutter: 20, isFitWidth: true });
  /*var $container = $('.day').isotope({
      "itemSelector": '.item',
      //"percentPosition": true,
      "masonry": {
          "columnWidth": '.item',
          //"gutter": 4,
          "isFitWidth": true
      }
  });*/

  /*$('.day').isotope({
    itemSelector: '.card',
    masonry: {
      columnWidth: '.col1',
      gutter: 20,
      isFitWidth: true
    }
  });*/

  /* activate jquery isotope */

  /*
  var $container = $('.day').isotope({
    "itemSelector": '.card',
    //"percentPosition": true,
    "masonry": {
        "columnWidth": '.col1',
        "gutter": 20,
        "isFitWidth": true
    }
  });
  */

  /*
  var $container = $('.social').isotope({
    "itemSelector": '[data-social="item"]',
    "masonry": {
        "columnWidth": '.col-sm-3',
        //"gutter": 20,
        "isFitWidth": true
    }
    //itemSelector : '.card',
    //isFitWidth: true
  });

  $(window).smartresize(function(){
    $container.isotope({
      columnWidth: '.col-sm-3'
    });
  });

  $container.isotope({ filter: '*' });

  // filter items on button click
  $('#filters').on( 'click', 'button', function() {
    var filterValue = $(this).attr('data-filter');
    $container.isotope({ filter: filterValue });
  });*/
});
</script>

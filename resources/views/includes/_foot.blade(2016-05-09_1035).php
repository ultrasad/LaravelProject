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
<script type="text/javascript" src="{{ URL::asset('assets/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>

<script src="{{ URL::asset('assets/jquery-datatable/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/jquery-datatable/media/js/dataTables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>

<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<!-- <script type="text/javascript" src="{{ URL::asset('pages/js/pages.min.js') }}"></script> -->
<script type="text/javascript" src="{{ URL::asset('pages/js/pages.js') }}"></script>
<!--<script type="text/javascript" src="{{ URL::asset('pages/js/pages.social.js') }}"></script>-->
<!-- BEGIN PAGE LEVEL JS -->
<script type="text/javascript" src="{{ URL::asset('assets/js/scripts.js') }}"></script>
<script src="{{ URL::asset('assets/js/datatables.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->

<script type="text/javascript">
$( document ).ready(function() {

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

    var resizeTimeout,
    $grid,
    $container = $('.day'),
    margin = 20,
    $grid = $container.isotope({
        itemSelector: '.card',
        //layoutMode: 'fitRows',
        //animationEngine: 'best-available',
        resizable: false,
        masonry: {
          columnWidth: '.col1-test',
        }
    });

    $grid.isotope( 'on', 'arrangeComplete', function() {
      console.log('arrange is complete');
    });

    // layout Isotope after each image loads
    $grid.imagesLoaded().progress( function() {
      $grid.isotope('layout');
    });

    $(window).on('load', function() {
      //isotope();
    });

    $(window).smartresize(function(){
      // code that takes it easy...
      var $windowSize = $('body').width();
      //console.log('window feed Size => ' + $windowSize);

      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(function() {
          // $social.data('pg.social').setContainerWidth();
          //isotope();
          $grid.isotope('layout');
          //$grid.isotope({ filter: '*' });
      }, 810);
    });
});
</script>

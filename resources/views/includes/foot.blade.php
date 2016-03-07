<!-- BEGIN VENDOR JS -->
{{ Html::script('assets/pace/pace.min.js') }}
{{ Html::script('assets/jquery/jquery.min.js') }}
{{ Html::script('assets/modernizr.custom.js') }}
{{-- Html::script('assets/jquery-ui/jquery-ui.min.js') --}}
{{ Html::script('assets/bootstrap/js/bootstrap.min.js') }}

{{ Html::script('assets/jquery-scrollbar/jquery.scrollbar.min.js') }}
{{ Html::script('assets/jquery-metrojs/MetroJs.min.js') }}

{{--
{{ Html::script('assets/jquery/jquery-easy.js') }}
{{ Html::script('assets/jquery-unveil/jquery.unveil.min.js') }}
{{ Html::script('assets/jquery-bez/jquery.bez.min.js') }}
{{ Html::script('assets/jquery-ios-list/jquery.ioslist.min.js') }}
{{ Html::script('assets/jquery-actual/jquery.actual.min.js') }}

{{ Html::script('assets/bootstrap-select2/select2.min.js') }}
{{ Html::script('assets/classie/classie.js') }}
{{ Html::script('assets/switchery/js/switchery.min.js') }}
{{ Html::script('assets/nvd3/lib/d3.v3.js') }}
{{ Html::script('assets/nvd3/nv.d3.min.js') }}
{{ Html::script('assets/nvd3/src/utils.js') }}
{{ Html::script('assets/nvd3/src/tooltip.js') }}
{{ Html::script('assets/nvd3/src/interactiveLayer.js') }}
{{ Html::script('assets/nvd3/src/models/axis.js') }}
{{ Html::script('assets/nvd3/src/models/line.js') }}
{{ Html::script('assets/nvd3/src/models/lineWithFocusChart.js') }}
{{ Html::script('assets/mapplic/js/hammer.js') }}
{{ Html::script('assets/mapplic/js/jquery.mousewheel.js') }}
{{ Html::script('assets/mapplic/js/mapplic.js') }}
{{ Html::script('assets/rickshaw/rickshaw.min.js') }}

{{ Html::script('assets/jquery-sparkline/jquery.sparkline.min.js') }}
{{ Html::script('assets/skycons/skycons.js') }}
{{ Html::script('assets/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
--}}

<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
{{ Html::script('pages/js/pages.min.js') }}
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
{{-- Html::script('assets/js/dashboard.js') --}}
{{-- Html::script('assets/js/scripts.js') --}}
<!-- END PAGE LEVEL JS -->

<script type="text/javascript">
(function($) {
  'use strict';
  $(document).ready(function() {
      $(".widget-3 .metro").liveTile();
  });
})(window.jQuery);
</script>

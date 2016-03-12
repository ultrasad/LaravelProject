<!-- BEGIN VENDOR JS -->
<script type="text/javascript" src="{{ URL::asset('assets/pace/pace.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/modernizr.custom.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/jquery-metrojs/MetroJs.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/dropzone/dropzone.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script type="text/javascript" src="{{ URL::asset('pages/js/pages.min.js') }}"></script>
<!-- BEGIN PAGE LEVEL JS -->
<script type="text/javascript" src="{{ URL::asset('assets/js/scripts.js') }}"></script>
<!-- END PAGE LEVEL JS -->

<script type="text/javascript">
(function($) {
  'use strict';
  $(document).ready(function() {
      $(".widget-3 .metro").liveTile();
      $(".widget-7 .metro").liveTile();
  });
})(window.jQuery);
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#article').submit(function(e){
            {{--
            var formData = $(this).serialize(); // form data as string
            var formAction = $(this).attr('action'); // form handler url
            var formMethod = $(this).attr('method'); // GET, POST
            --}}

            var article, token, url, data;
            token = $('input[name=_token]').val();
            {{-- article = $('#article').serialize(); --}} // form data as string
            //article = new FormData($(this)[0]);
            article = new FormData(this);

            alert(article + '<=== article');
            {{-- article.append('image', input.images[0]); --}}
            {{-- var fd = new FormData(); --}}
            {{-- fd.append( 'file', input.files[0] ); --}}
            {{-- url = '{{route('articles')}}'; --}}
            {{-- data = {article: article}; --}}
            {{-- $('#subramos').empty(); --}}
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
        Dropzone.autoDiscover = false;
        $("div#dropzone-image").dropzone({ url: "/events/post_upload" });
    });
</script>

<!-- BEGIN VENDOR JS -->
<script type="text/javascript" src="{{ elixir(URL::asset('assets/jquery/jquery-1.11.1.min.js')) }}"></script>
<script type="text/javascript" src="{{ elixir(URL::asset('assets/modernizr.custom.js')) }}"></script>
<script type="text/javascript" src="{{ elixir(URL::asset('assets/bootstrap/js/bootstrap.min.js')) }}"></script>
<script type="text/javascript" src="{{ elixir(URL::asset('assets/jquery-scrollbar/jquery.scrollbar.min.js')) }}"></script>
<script type="text/javascript" src="{{ elixir(URL::asset('assets/jquery-cookie/jquery.cookie.js')) }}"></script>
<script type="text/javascript" src="{{ elixir(URL::asset('assets/jquery-metrojs/MetroJs.min.js')) }}"></script>

<script type="text/javascript" src="{{ elixir(URL::asset('assets/jquery-isotope/isotope.pkgd.min.js')) }}" ></script>
<script type="text/javascript" src="{{ elixir(URL::asset('assets/fotorama/fotorama.js')) }}"></script>

<script type="text/javascript" src="{{ elixir(URL::asset('assets/imagesloaded/imagesloaded.pkgd.min.js')) }}"></script>
<script type="text/javascript" src="{{ elixir(URL::asset('assets/jquery-infinite-scroll/jquery.infinitescroll.min.js')) }}"></script>
<script type="text/javascript" src="{{ elixir(URL::asset('assets/datatables-responsive/js/lodash.min.js')) }}"></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1532458647022405";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script type="text/javascript" src="{{ URL::asset('pages/js/pages.js') }}"></script>
<!-- BEGIN PAGE LEVEL JS -->
<script type="text/javascript" src="{{ URL::asset('assets/js/scripts.js') }}"></script>
<!-- END PAGE LEVEL JS -->

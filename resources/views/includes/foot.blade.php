@if(Request::route()->getName() == 'slug')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=586408658176811";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
@endif

@if(Request::is('contact'))
<script type="text/javascript" src="{{ URL::asset('assets/classie/classie.js') }}"></script>
@endif
<script type="text/javascript" src="{{ elixir('js/all.js') }}"></script>
<!--<script type="text/javascript" src="{{ elixir('js/scripts.js') }}"></script>-->
<script type="text/javascript" src="{{ URL::asset('assets/js/scripts.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initialize&libraries=places" async defer></script>

<!doctype html>
<html>
<body>
  <p>Close this window to continue</p>
  <!--<script type="text/javascript" src="{{ URL::asset('assets/jquery/jquery-1.11.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('assets/js/scripts.js?v=1.0.0') }}"></script>-->
  <script type="text/javascript">
    var twit = {};
    window.twit.social_id = '{{ $twitter }}';
    window.twit.user_name = '{{ $user_name }}';
    window.opener.setTwitterAuthData(window.twit);
    window.close();
  </script>
</body></html>

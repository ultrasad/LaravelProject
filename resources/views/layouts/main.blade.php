<!Document html>
<html>
  <head>
    <title>Laravel 5 - @yield('page_title')</title>
    {{ Html::style('bootstrap/css/bootstrap.min.css') }}
  </head>
  <body>
    <div class='container'>
      @yield('content')
    </div>
  </body>
  {{ Html::script('js/jquery.min.js') }}
  {{ Html::script('bootstrap/js/bootstrap.min.js') }}
</html>

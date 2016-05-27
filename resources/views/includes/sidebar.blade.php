<!-- BEGIN SIDEBPANEL-->
<nav class="page-sidebar" data-pages="sidebar">
  <div class="sidebar-header">
    <a href="/" title="WELOVEPRO | รวม โปรโมชั่น ลดราคา Sale ชิงโชค discount คูปอง" class="clearfix"><img src="{{ URL::asset('assets/img/logo_white.png') }}" alt="รวม โปรโมชั่น ลดราคา Sale ชิงโชค discount คูปอง" class="brand" data-src="{{ URL::asset('assets/img/logo_white.png') }}" data-src-retina="{{ URL::asset('assets/img/logo_white_2x.png') }}" width="" height="38"></a>
  </div>

  <!-- START SIDEBAR MENU -->
  <div class="sidebar-menu">
    <!-- BEGIN SIDEBAR MENU ITEMS-->
    <ul class="menu-items">
      <li class="m-t-30">
        <a href="{{ url('/') }}" class="detailed">
          <span class="title">โปรโมชั่นทั้งหมด</span>
        </a>
        <span class="icon-thumbnail icon-category {{ Request::is('/') ? 'bg-success' : '' }}">
          <i class="fa fa-home" aria-hidden="true"></i>
        </span>
      </li>
      <li class="">
        <a href="{{ url('/map') }}" class="detailed" title="โปรโมชั่นรอบๆตัวคุณ">
          <span class="title">โปรโมชั่นรอบๆตัวคุณ</span>
        </a>
        <span class="icon-thumbnail icon-category {{ Request::is('map') ? 'bg-success' : '' }}">
          <i class="fa pg-map"></i>
        </span>
      </li>
      <li class="m-t-0 m-b-5">
        <span class="title-header-category p-l-32">BRAND</span>
        <span class="icon-thumbnail">B</span>
      </li>
      @foreach(menuHelper::brand() as $brand)
        <li class="">
          <a href="/brand/{{ $brand->url_slug }}" class="detailed" title="{{ $brand->name }}">
            <span class="title">{{ $brand->name }}</span>
          </a>
          <span class="icon-thumbnail icon-category {{ Request::is('brand/'. $brand->url_slug) ? 'bg-success' : '' }}">
          @if(isset($brand->category->first()->icon))
            <img src="{{ URL::asset('assets/img/category/icons/'.$brand->category->first()->icon) }}" alt="{{ $brand->name }}" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/'.$brand->category->first()->icon) }}" data-src-retina="{{ URL::asset('assets/img/category/icons/'.$brand->category->first()->icon) }}" width="20" height="20">
          @endif
          </span>
        </li>
      @endforeach
      <li class="m-t-0 m-b-5">
        <span class="title-header-category p-l-32">CATEGORY</span>
        <span class="icon-thumbnail">C</span>
      </li>
      @foreach(menuHelper::menu() as $menu)
        <li class="">
          <a href="/category/{{ $menu->category }}" class="detailed" title="{{ $menu->name }}">
            <span class="title">{{ $menu->name }}</span>
          </a>
          <span class="icon-thumbnail icon-category {{ Request::is('category/'. $menu->category) ? 'bg-success' : '' }}">
            <img src="{{ URL::asset('assets/img/category/icons/'.$menu->icon) }}" alt="{{ $menu->name }}" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/'.$menu->icon) }}" data-src-retina="{{ URL::asset('assets/img/category/icons/'.$menu->icon) }}" width="20" height="20">
          </span>
        </li>
      @endforeach
    <div class="clearfix"></div>
  </div>
  <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
<!-- END SIDEBPANEL-->

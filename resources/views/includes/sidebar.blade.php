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
        <span class="title-header-category p-l-32">แบรนด์</span>
        <span class="icon-thumbnail">B</span>
      </li>
      <?php $i = 0; $j = 0; ?>
      @foreach(menuHelper::brand() as $brand)
        @if($i == 0)
          <li class="brand-group">
          <?php ++$i; ?>
        @endif
        @if($brand->master_group == 'Y')
          <a href="/brand/{{ $brand->url_slug }}" title="{{ $brand->name }}">
            <img src="{{ GlideImage::load($brand->logo_image)->modify(['w'=> 100]) }}" alt="{{ $brand->name }}" class="category-img" data-src="" data-src-retina="" width="35" height="35">
          </a>
        @else
          @if($j == 0)
            </li>
            <li class="">
            <a href="javascript:;"><span class="title title-group">แบรนด์ทั้งหมด</span>
            <span class="arrow"></span></a>
            <span class="icon-thumbnail"><i class="pg-menu_lv"></i></span>
            <ul class="sub-menu">
            <?php ++$j; ?>
          @else
            <li class="">
              <a href="/brand/{{ $brand->url_slug }}" class="detailed" title="{{ $brand->name }}">
                <span class="title">{{ $brand->name }}</span>
              </a>
              <span class="icon-thumbnail icon-category {{ Request::is('brand/'. $brand->url_slug) ? 'bg-success' : '' }}">
              @if(isset($brand->category->first()->icon))
                <img src="{{ GlideImage::load('assets/img/category/icons/'.$brand->category->first()->icon)->modify(['w'=> 40]) }}" alt="{{ $brand->name }}" class="category-img" data-src="" data-src-retina="" width="20" height="20">
              @endif
              </span>
            </li>
          @endif
        @endif
      @endforeach
        </ul>
      </li>
      <li class="m-t-0 m-b-5">
        <span class="title-header-category p-l-32">หมวดหมู่</span>
        <span class="icon-thumbnail">C</span>
      </li>
      <?php $k = 0; ?>
      @foreach(menuHelper::menu() as $menu)
        @if($menu->master_group == 'Y')
        <li class="">
          <a href="/category/{{ $menu->category }}" class="detailed" title="{{ $menu->name }}">
            <span class="title">{{ $menu->name }}</span>
          </a>
          <span class="icon-thumbnail icon-category {{ Request::is('category/'. $menu->category) ? 'bg-success' : '' }}">
            <img src="{{ GlideImage::load('assets/img/category/icons/'.$menu->icon)->modify(['w'=> 40]) }}" alt="{{ $menu->name }}" class="category-img" data-src="" data-src-retina="" width="20" height="20">
          </span>
        </li>
        @else
          @if($k == 0)
          <li class="">
          <a href="javascript:;"><span class="title title-group">หมวดหมู่อื่นๆ</span>
          <span class="arrow"></span></a>
          <span class="icon-thumbnail"><i class="pg-menu_lv"></i></span>
          <ul class="sub-menu">
          <?php ++$k; ?>
          @endif
            <li class="">
              <a href="/category/{{ $menu->category }}" class="detailed" title="{{ $menu->name }}">
                <span class="title">{{ $menu->name }}</span>
              </a>
              <span class="icon-thumbnail icon-category {{ Request::is('category/'. $menu->category) ? 'bg-success' : '' }}">
                <img src="{{ GlideImage::load('assets/img/category/icons/'.$menu->icon)->modify(['w'=> 40]) }}" alt="{{ $menu->name }}" class="category-img" data-src="" data-src-retina="" width="20" height="20">
              </span>
            </li>
        @endif
      @endforeach
        </ul>
      </li>
    <div class="clearfix"></div>
  </div>
  <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
<!-- END SIDEBPANEL-->

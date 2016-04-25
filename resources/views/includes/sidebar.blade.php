<!-- BEGIN SIDEBPANEL-->
<nav class="page-sidebar" data-pages="sidebar">
  <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
  {{--
  <div class="sidebar-overlay-slide from-top" id="appMenu">
    <div class="row">
      <div class="col-xs-6 no-padding">
        <a href="#" class="p-l-40"><img src="{{ URL::asset('assets/img/demo/social_app.svg') }}" alt="socail">
        </a>
      </div>
      <div class="col-xs-6 no-padding">
        <a href="#" class="p-l-10"><img src="{{ URL::asset('assets/img/demo/email_app.svg') }}" alt="socail">
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6 m-t-20 no-padding">
        <a href="#" class="p-l-40"><img src="{{ URL::asset('assets/img/demo/calendar_app.svg') }}" alt="socail">
        </a>
      </div>
      <div class="col-xs-6 m-t-20 no-padding">
        <a href="#" class="p-l-10"><img src="{{ URL::asset('assets/img/demo/add_more.svg') }}" alt="socail">
        </a>
      </div>
    </div>
  </div>
  --}}
  <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
  <!-- BEGIN SIDEBAR MENU HEADER-->
  {{--
  <div class="sidebar-header">
    <img src="{{ URL::asset('assets/img/logo_white.png') }}" alt="logo" class="brand" data-src="{{ URL::asset('assets/img/logo_white.png') }}" data-src-retina="{{ URL::asset('assets/img/logo_white_2x.png') }}" width="78" height="22">
    <div class="sidebar-header-controls">
      <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu"><i class="fa fa-angle-down fs-16"></i>
      </button>
      <button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar"><i class="fa fs-12"></i>
      </button>
    </div>
  </div>
  --}}
  <!-- END SIDEBAR MENU HEADER-->
  <!-- START SIDEBAR MENU -->
  <div class="sidebar-menu">
    <!-- BEGIN SIDEBAR MENU ITEMS-->
    <ul class="menu-items">
      {{--
      <li class="m-t-30">
        <a href="index.html" class="detailed">
          <span class="title">Home</span>
          <span class="details">หน้าแรก</span>
        </a>
        <span class="bg-success icon-thumbnail"><i class="fa fa-home"></i></span>
      </li>
      --}}
      <li class="m-t-30">
        <a href="{{ url('/') }}" class="detailed">
          <span class="title">All Promotions</span>
          <span class="details">โปรโมชั่นทั้งหมด</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <i class="fa fa-heart-o fa-2x" aria-hidden="true"></i>
          <!--<img src="{{ URL::asset('assets/img/category/icons/computer.png') }}" alt="Computer / IT" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/computer.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/computer_2x.png') }}" width="40" height="40">-->
        </span>
      </li>
      <li class="">
        <a href="{{ url('/maps') }}" class="detailed">
          <span class="title">Promotions Map</span>
          <span class="details">โปรโมชั่นรอบๆตัวคุณ</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <i class="fa pg-map"></i>
          <!--<img src="{{ URL::asset('assets/img/category/icons/computer.png') }}" alt="Computer / IT" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/computer.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/computer_2x.png') }}" width="40" height="40">-->
        </span>
      </li>

      <li class="m-t-5">
        <span class="title-header-category">BRAND</span>
        <span class="icon-thumbnail">B</span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Food / Drink</span>
          <span class="details">อาหาร / เครื่องดื่ม</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/food_drink.png') }}" alt="Food / Drink" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/food_drink.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/food_drink_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Clothes</span>
          <span class="details">เสื้อผ้า / แฟชั่น / เครื่องประดับ</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/clothes.png') }}" alt="Clothes" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/clothes.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/clothes_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Cosmetic</span>
          <span class="details">เครื่องสำอาง / ความงาม</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/cosmetic.png') }}" alt="Cosmetic" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/cosmetic.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/cosmetic_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Supermarket</span>
          <span class="details">ห้างฯ / ซูเปอร์มาเก็ต</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/supermarket.png') }}" alt="Cosmetic" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/supermarket.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/supermarket_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Airline</span>
          <span class="details">สายการบิน / การเดินทาง</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/airline.png') }}" alt="Airline / Travel" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/airline.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/airline_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Sport</span>
          <span class="details">กีฬา</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/sport.png') }}" alt="Sport" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/sport.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/sport_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Mobile</span>
          <span class="details">มือถือ / สื่อสาร</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/mobile.png') }}" alt="Mobile" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/mobile.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/mobile_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Electronics</span>
          <span class="details">เครื่องใช้ไฟฟ้า</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/electronics.png') }}" alt="Electronics" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/electronics.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/electronics_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Travel</span>
          <span class="details">ท่องเที่ยว / ที่พัก / โรงแรม / รีสอร์ท</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/travel.png') }}" alt="Travel" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/travel.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/travel_2x.png') }}" width="40" height="40">
        </span>
      </li>

      <li class="m-t-5">
        <span class="title-header-category">CATEGORY</span>
        <span class="icon-thumbnail">C</span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Computer / IT</span>
          <span class="details">คอมพิวเตอร์</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/computer.png') }}" alt="Computer / IT" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/computer.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/computer_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Furniture</span>
          <span class="details">เฟอร์นิเจอร์ / ของใช้ในบ้าน</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/furniture.png') }}" alt="Furniture" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/furniture.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/furniture_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Entertainment</span>
          <span class="details">บันเทิง / ดนตรี / ภาพยนตร์</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/entertainment.png') }}" alt="Entertainment" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/entertainment.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/entertainment_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Money / Bank</span>
          <span class="details">การเงิน-ธนาคาร</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/money_bank.png') }}" alt="Money / Bank" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/money_bank.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/money_bank_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Home / Condo</span>
          <span class="details">บ้าน / คอนโด</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/home_condo.png') }}" alt="Home / Condo" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/home_condo.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/home_condo_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Automotive</span>
          <span class="details">ยานยนต์</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/automotive.png') }}" alt="Automotive" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/automotive.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/automotive_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Health</span>
          <span class="details">สุขภาพ / ร่างกาย</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/health.png') }}" alt="Health" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/health.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/health_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Book / Stationery</span>
          <span class="details">หนังสือ / เครื่องเขียน</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/book.png') }}" alt="Book / stationery" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/book.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/book_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Camera / Photograph</span>
          <span class="details">กล้อง / ถ่ายภาพ</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/camera.png') }}" alt="Camera / Photograph" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/camera.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/camera_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Gift Shop</span>
          <span class="details">ของขวัญ</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/gift.png') }}" alt="Gift Shop" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/gift.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/gift_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Office Supplies</span>
          <span class="details">เครื่องใช้สำนักงาน</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/office_supplies.png') }}" alt="Office Supplies" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/office_supplies.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/office_supplies_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Kids</span>
          <span class="details">เด็ก</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/kids.png') }}" alt="Kids" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/kids.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/kids_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Pet</span>
          <span class="details">สัตว์เลี้ยง</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/pet.png') }}" alt="Pet" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/pet.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/pet_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Education</span>
          <span class="details">การศึกษา</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/education.png') }}" alt="Education" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/education.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/education_2x.png') }}" width="40" height="40">
        </span>
      </li>
      <li class="">
        <a href="#" class="detailed">
          <span class="title">Consumer Goods</span>
          <span class="details">เครื่องอุปโภคบริโภค</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <img src="{{ URL::asset('assets/img/category/icons/consumer_goods.png') }}" alt="Consumer Goods" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/consumer_goods.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/consumer_goods_2x.png') }}" width="40" height="40">
        </span>
      </li>
      {{--
      <li class="">
        <a href="http://pages.revox.io/dashboard/latest/html/widget.html" class="detailed">
          <span class="title">Widgets</span>
          <span class="details">22 items</span>
        </a>
        <span class="icon-thumbnail">W</span>
      </li>
      <li class="">
        <a href="email.html" class="detailed">
          <span class="title">Email</span>
          <span class="details">234 New Emails</span>
        </a>
        <span class="icon-thumbnail"><i class="pg-mail"></i></span>
      </li>
      <li class="">
        <a href="social.html"><span class="title">Social</span></a>
        <span class="icon-thumbnail"><i class="pg-social"></i></span>
      </li>
      <li>
        <a href="javascript:;"><span class="title">Calendar</span>
        <span class=" arrow"></span></a>
        <span class="icon-thumbnail"><i class="pg-calender"></i></span>
        <ul class="sub-menu">
          <li class="">
            <a href="calendar.html">Basic</a>
            <span class="icon-thumbnail">c</span>
          </li>
          <li class="">
            <a href="calendar_lang.html">Languages</a>
            <span class="icon-thumbnail">L</span>
          </li>
          <li class="">
            <a href="calendar_month.html">Month</a>
            <span class="icon-thumbnail">M</span>
          </li>
          <li class="">
            <a href="calendar_lazy.html">Lazy load</a>
            <span class="icon-thumbnail">La</span>
          </li>
          <li class="">
            <a href="http://pages.revox.io/dashboard/2.1.0/doc/#calendar" target="_blank">Documentation</a>
            <span class="icon-thumbnail">D</span>
          </li>
        </ul>
      </li>
      <li class="">
        <a href="builder.html">
          <span class="title">Builder</span>
        </a>
        <span class="icon-thumbnail"><i class="pg-layouts"></i></span>
      </li>
      <li>
        <a href="javascript:;"><span class="title">Layouts</span>
        <span class=" arrow"></span></a>
        <span class="icon-thumbnail"><i class="pg-layouts2"></i></span>
        <ul class="sub-menu">
          <li class="">
            <a href="default_layout.html">Default</a>
            <span class="icon-thumbnail">dl</span>
          </li>
          <li class="">
            <a href="secondary_layout.html">Secondary</a>
            <span class="icon-thumbnail">sl</span>
          </li>
          <li class="">
            <a href="boxed_layout.html">Boxed</a>
            <span class="icon-thumbnail">bl</span>
          </li>
          <li class="">
            <a href="sidemenu_and_horizontal_menu.html">Horizontal Menu</a>
            <span class="icon-thumbnail">hm</span>
          </li>
          <li class="">
            <a href="rtl_layout.html">RTL</a>
            <span class="icon-thumbnail">rl</span>
          </li>
          <li class="">
            <a href="builder.html#tabContent">Columns</a>
            <span class="icon-thumbnail">cl</span>
          </li>
        </ul>
      </li>
      <li>
        <a href="javascript:;"><span class="title">UI Elements</span>
        <span class=" arrow"></span></a>
        <span class="icon-thumbnail">Ui</span>
        <ul class="sub-menu">
          <li class="">
            <a href="color.html">Color</a>
            <span class="icon-thumbnail">c</span>
          </li>
          <li class="">
            <a href="typography.html">Typography</a>
            <span class="icon-thumbnail">t</span>
          </li>
          <li class="">
            <a href="icons.html">Icons</a>
            <span class="icon-thumbnail">i</span>
          </li>
          <li class="">
            <a href="buttons.html">Buttons</a>
            <span class="icon-thumbnail">b</span>
          </li>
          <li class="">
            <a href="notifications.html">Notifications</a>
            <span class="icon-thumbnail">n</span>
          </li>
          <li class="">
            <a href="modals.html">Modals</a>
            <span class="icon-thumbnail">m</span>
          </li>
          <li class="">
            <a href="progress.html">Progress &amp; Activity</a>
            <span class="icon-thumbnail">pa</span>
          </li>
          <li class="">
            <a href="tabs_accordian.html">Tabs &amp; Accordions</a>
            <span class="icon-thumbnail">ta</span>
          </li>
          <li class="">
            <a href="sliders.html">Sliders</a>
            <span class="icon-thumbnail">s</span>
          </li>
          <li class="">
            <a href="tree_view.html">Tree View</a>
            <span class="icon-thumbnail">tv</span>
          </li>
          <li class="">
            <a href="nestables.html">Nestable</a>
            <span class="icon-thumbnail">ns</span>
          </li>
        </ul>
      </li>
      <li>
        <a href="javascript:;">
          <span class="title">Forms</span>
          <span class=" arrow"></span>
        </a>
        <span class="icon-thumbnail"><i class="pg-form"></i></span>
        <ul class="sub-menu">
          <li class="">
            <a href="form_elements.html">Form Elements</a>
            <span class="icon-thumbnail">fe</span>
          </li>
          <li class="">
            <a href="form_layouts.html">Form Layouts</a>
            <span class="icon-thumbnail">fl</span>
          </li>
          <li class="">
            <a href="form_wizard.html">Form Wizard</a>
            <span class="icon-thumbnail">fw</span>
          </li>
        </ul>
      </li>
      <li class="">
        <a href="portlets.html">
          <span class="title">Portlets</span>
        </a>
        <span class="icon-thumbnail"><i class="pg-grid"></i></span>
      </li>
      <li class="">
        <a href="views.html">
          <span class="title">Views</span>
        </a>
        <span class="icon-thumbnail"><i class="pg pg-ui"></i></span>
      </li>
      <li>
        <a href="javascript:;"><span class="title">Tables</span>
        <span class=" arrow"></span></a>
        <span class="icon-thumbnail"><i class="pg-tables"></i></span>
        <ul class="sub-menu">
          <li class="">
            <a href="tables.html">Basic Tables</a>
            <span class="icon-thumbnail">bt</span>
          </li>
          <li class="">
            <a href="datatables.html">Data Tables</a>
            <span class="icon-thumbnail">dt</span>
          </li>
        </ul>
      </li>
      <li>
        <a href="javascript:;"><span class="title">Maps</span>
        <span class=" arrow"></span></a>
        <span class="icon-thumbnail"><i class="pg-map"></i></span>
        <ul class="sub-menu">
          <li class="">
            <a href="google_map.html">Google Maps</a>
            <span class="icon-thumbnail">gm</span>
          </li>
          <li class="">
            <a href="vector_map.html">Vector Maps</a>
            <span class="icon-thumbnail">vm</span>
          </li>
        </ul>
      </li>
      <li class="">
        <a href="charts.html"><span class="title">Charts</span></a>
        <span class="icon-thumbnail"><i class="pg-charts"></i></span>
      </li>
      <li>
        <a href="javascript:;"><span class="title">Extra</span>
        <span class=" arrow"></span></a>
        <span class="icon-thumbnail"><i class="pg-bag"></i></span>
        <ul class="sub-menu">
          <li class="">
            <a href="invoice.html">Invoice</a>
            <span class="icon-thumbnail">in</span>
          </li>
          <li class="">
            <a href="404.html">404 Page</a>
            <span class="icon-thumbnail">pg</span>
          </li>
          <li class="">
            <a href="500.html">500 Page</a>
            <span class="icon-thumbnail">pg</span>
          </li>
          <li class="active">
            <a href="blank_template.html">Blank Page</a>
            <span class="icon-thumbnail">bp</span>
          </li>
          <li class="">
            <a href="login.html">Login</a>
            <span class="icon-thumbnail">l</span>
          </li>
          <li class="">
            <a href="register.html">Register</a>
            <span class="icon-thumbnail">re</span>
          </li>
          <li class="">
            <a href="lock_screen.html">Lockscreen</a>
            <span class="icon-thumbnail">ls</span>
          </li>
          <li class="">
            <a href="gallery.html">Gallery</a>
            <span class="icon-thumbnail">gl</span>
          </li>
          <li class="">
            <a href="timeline.html">Timeline</a>
            <span class="icon-thumbnail">t</span>
          </li>
        </ul>
      </li>
      <li class="">
        <a href="javascript:;"><span class="title">Menu Levels</span>
        <span class="arrow"></span></a>
        <span class="icon-thumbnail"><i class="pg-menu_lv"></i></span>
        <ul class="sub-menu">
          <li>
            <a href="javascript:;">Level 1</a>
            <span class="icon-thumbnail">L1</span>
          </li>
          <li>
            <a href="javascript:;"><span class="title">Level 2</span>
            <span class="arrow"></span></a>
            <span class="icon-thumbnail">L2</span>
            <ul class="sub-menu">
              <li>
                <a href="javascript:;">Sub Menu</a>
                <span class="icon-thumbnail">Sm</span>
              </li>
              <li>
                <a href="ujavascript:;">Sub Menu</a>
                <span class="icon-thumbnail">Sm</span>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      --}}
    </ul>
    <div class="clearfix"></div>
  </div>
  <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
<!-- END SIDEBPANEL-->

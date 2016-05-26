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

  <div class="sidebar-header">
    <img src="{{ URL::asset('assets/img/logo_white.png') }}" alt="logo" class="brand" data-src="{{ URL::asset('assets/img/logo_white.png') }}" data-src-retina="{{ URL::asset('assets/img/logo_white_2x.png') }}" width="" height="38">
    <!--<div class="sidebar-header-controls">
      <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu"><i class="fa fa-angle-down fs-16"></i>
      </button>
      <button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar"><i class="fa fs-12"></i>
      </button>
    </div>-->
  </div>

  <!-- END SIDEBAR MENU HEADER-->
  <!-- START SIDEBAR MENU -->
  <div class="sidebar-menu">
    <!-- BEGIN SIDEBAR MENU ITEMS-->
    <ul class="menu-items">
      <li class="m-t-30">
        <a href="{{ url('/') }}" class="detailed">
          <span class="title">โปรโมชั่นทั้งหมด</span>
        </a>
        <span class="icon-thumbnail icon-category bg-success">
          <i class="fa fa-heart" aria-hidden="true"></i>
          <!--<img src="{{ URL::asset('assets/img/category/icons/computer.png') }}" alt="Computer / IT" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/computer.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/computer_2x.png') }}" width="20" height="20">-->
        </span>
      </li>
      <li class="">
        <a href="{{ url('/maps') }}" class="detailed" title="โปรโมชั่นรอบๆตัวคุณ">
          <span class="title">โปรโมชั่นรอบๆตัวคุณ</span>
        </a>
        <span class="icon-thumbnail icon-category">
          <i class="fa pg-map"></i>
          <!--<img src="{{ URL::asset('assets/img/category/icons/computer.png') }}" alt="Computer / IT" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/computer.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/computer_2x.png') }}" width="20" height="20">-->
        </span>
      </li>
      <li class="">
        <a href="/category/food-drink" class="detailed" title="อาหาร / เครื่องดื่ม">
          <span class="title">อาหาร / เครื่องดื่ม</span>
        </a>
        <span class="icon-thumbnail icon-category">
          <img src="{{ URL::asset('assets/img/category/icons/food_drink.png') }}" alt="Food / Drink" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/food_drink.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/food_drink_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/clothes" class="detailed" title="เสื้อผ้า / แฟชั่น / เครื่องประดับ">
          <span class="title">เสื้อผ้า / แฟชั่น / เครื่องประดับ</span>
        </a>
        <span class="icon-thumbnail icon-category">
          <img src="{{ URL::asset('assets/img/category/icons/clothes.png') }}" alt="Clothes" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/clothes.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/clothes_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/cosmetic" class="detailed" title="เครื่องสำอาง / ความงาม">
          <span class="title">เครื่องสำอาง / ความงาม</span>
        </a>
        <span class="icon-thumbnail icon-category">
          <img src="{{ URL::asset('assets/img/category/icons/cosmetic.png') }}" alt="Cosmetic" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/cosmetic.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/cosmetic_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/supermarket" class="detailed" title="ห้างฯ / ซูเปอร์มาเก็ต">
          <span class="title">ห้างฯ / ซูเปอร์มาเก็ต</span>
        </a>
        <span class="icon-thumbnail icon-category">
          <img src="{{ URL::asset('assets/img/category/icons/supermarket.png') }}" alt="Cosmetic" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/supermarket.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/supermarket_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/airline" class="detailed" title="สายการบิน / การเดินทาง">
          <span class="title">สายการบิน / การเดินทาง</span>
        </a>
        <span class="icon-thumbnail icon-category">
          <img src="{{ URL::asset('assets/img/category/icons/airline.png') }}" alt="Airline / Travel" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/airline.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/airline_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/sport" class="detailed" title="กีฬา">
          <span class="title">กีฬา</span>
        </a>
        <span class="icon-thumbnail icon-category">
          <img src="{{ URL::asset('assets/img/category/icons/sport.png') }}" alt="Sport" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/sport.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/sport_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/mobile" class="detailed" title="มือถือ / สื่อสาร">
          <span class="title">มือถือ / สื่อสาร</span>
        </a>
        <span class="icon-thumbnail icon-category">
          <img src="{{ URL::asset('assets/img/category/icons/mobile.png') }}" alt="Mobile" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/mobile.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/mobile_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/electronics" class="detailed" title="เครื่องใช้ไฟฟ้า">
          <span class="title">เครื่องใช้ไฟฟ้า</span>
        </a>
        <span class="icon-thumbnail icon-category">
          <img src="{{ URL::asset('assets/img/category/icons/electronics.png') }}" alt="Electronics" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/electronics.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/electronics_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/travel" class="detailed" title="ท่องเที่ยว / ที่พัก / โรงแรม / รีสอร์ท">
          <span class="title">ท่องเที่ยว / ที่พัก / โรงแรม / รีสอร์ท</span>
        </a>
        <span class="icon-thumbnail icon-category">
          <img src="{{ URL::asset('assets/img/category/icons/travel.png') }}" alt="Travel" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/travel.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/travel_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/computer" class="detailed" title="คอมพิวเตอร์">
          <span class="title">คอมพิวเตอร์</span>
        </a>
        <span class="icon-thumbnail icon-category">
          <img src="{{ URL::asset('assets/img/category/icons/computer.png') }}" alt="Computer / IT" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/computer.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/computer_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/furniture" class="detailed" title="เฟอร์นิเจอร์ / ของใช้ในบ้าน">
          <span class="title">เฟอร์นิเจอร์ / ของใช้ในบ้าน</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/furniture.png') }}" alt="Furniture" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/furniture.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/furniture_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/entertainment" class="detailed" title="บันเทิง / ดนตรี / ภาพยนตร์">
          <span class="title">บันเทิง / ดนตรี / ภาพยนตร์</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/entertainment.png') }}" alt="Entertainment" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/entertainment.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/entertainment_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/money-bank" class="detailed" title="การเงิน / ธนาคาร">
          <span class="title">การเงิน / ธนาคาร</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/money_bank.png') }}" alt="Money / Bank" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/money_bank.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/money_bank_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/home-condo" class="detailed" title="บ้าน / คอนโด">
          <span class="title">บ้าน / คอนโด</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/home_condo.png') }}" alt="Home / Condo" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/home_condo.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/home_condo_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/automotive" class="detailed" title="ยานยนต์">
          <span class="title">ยานยนต์</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/automotive.png') }}" alt="Automotive" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/automotive.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/automotive_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/health" class="detailed" title="สุขภาพ / ร่างกาย">
          <span class="title">สุขภาพ / ร่างกาย</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/health.png') }}" alt="Health" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/health.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/health_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/book-stationery" class="detailed" title="หนังสือ / เครื่องเขียน">
          <span class="title">หนังสือ / เครื่องเขียน</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/book.png') }}" alt="Book / stationery" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/book.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/book_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/camera-photograph" class="detailed" title="กล้อง / ถ่ายภาพ">
          <span class="title">กล้อง / ถ่ายภาพ</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/camera.png') }}" alt="Camera / Photograph" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/camera.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/camera_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/gift" class="detailed" title="ของขวัญ">
          <span class="title">ของขวัญ</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/gift.png') }}" alt="Gift Shop" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/gift.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/gift_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/office-supplies" class="detailed" title="เครื่องใช้สำนักงาน">
          <span class="title">เครื่องใช้สำนักงาน</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/office_supplies.png') }}" alt="Office Supplies" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/office_supplies.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/office_supplies_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/kids" class="detailed" title="เด็ก">
          <span class="title">เด็ก</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/kids.png') }}" alt="Kids" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/kids.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/kids_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/pet" class="detailed" title="สัตว์เลี้ยง">
          <span class="title">สัตว์เลี้ยง</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/pet.png') }}" alt="Pet" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/pet.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/pet_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/education" class="detailed" title="การศึกษา">
          <span class="title">การศึกษา</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/education.png') }}" alt="Education" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/education.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/education_2x.png') }}" width="20" height="20">
        </span>
      </li>
      <li class="">
        <a href="/category/consumer-goods" class="detailed" title="เครื่องอุปโภคบริโภค">
          <span class="title">เครื่องอุปโภคบริโภค</span>
        </a>
        <span class="icon-thumbnail icon-category ">
          <img src="{{ URL::asset('assets/img/category/icons/consumer_goods.png') }}" alt="Consumer Goods" class="category-img" data-src="{{ URL::asset('assets/img/category/icons/consumer_goods.png') }}" data-src-retina="{{ URL::asset('assets/img/category/icons/consumer_goods_2x.png') }}" width="20" height="20">
        </span>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
<!-- END SIDEBPANEL-->

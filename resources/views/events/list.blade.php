@extends('layouts.document')
@section('page_title', 'Events List')
@section('content')

<div class="social-wrapper">
  <div class="social-test" data-pages="social">
    <div class="container-fluid container-fixed-lg sm-p-l-10 sm-p-r-10">
      <div class="feed">
        <!-- START DAY -->
        <div class="day" data-social="day">
          <!-- START ITEM -->
          <div class="card no-border bg-transparent full-width" data-social="item"></div>
          <!-- END ITEM -->
          <!-- START ITEM -->

          <div class="card col2-test col-centered" data-social="item">
            <div class="gallery-item" data-width="2" data-height="2">
              <div class="live-tile slide" data-speed="750" data-delay="4000" data-mode="carousel">
                <div class="slide-front">
                  <img src="/images/events/2016-03-30/gallery/43/20160330-141855-Promotion-Reebok-Grand-Sale-2016-Sale-up-to-70-Off.png" />
               </div>
               <div class="slide-back">
                  <img src="/images/events/2016-03-30/20160330-120609-Promotion-Crocs-End-Of-Season-Sale-up-to-50-Mar.2016.jpg" class="img-responsive" />
               </div>
                <!--<div class="slide-front">
                  <img src="/images/events/2016-03-29/gallery/23/20160329-203343-12022415_596810460475531_3646114147447548534_o.jpg" alt="" class="image-responsive-height">
                </div>
                <div class="slide-back">
                  <img src="/images/events/2016-03-29/gallery/23/20160329-203343-10685358_905301056158769_2856217830528359547_n.jpg" alt="" class="image-responsive-height">
                </div>
                <div class="slide-back">
                  <img src="/images/events/2016-03-29/gallery/23/20160329-203343-12715564_1296116563738753_7950416355389444727_n.jpg" alt="" class="image-responsive-height">
                </div>
                <div class="slide-back">
                  <img src="/images/events/2016-03-29/gallery/23/20160329-203343-10400016_1548065595523282_8650181045517873917_n.jpg" alt="" class="image-responsive-height">
                </div>
                -->
              </div>
              <div class="overlayer bottom-left full-width">
                <div class="overlayer-wrapper item-info more-content">
                  <div class="gradient-grey p-l-20 p-r-20 p-t-50 p-b-5">
                    <div class="">
                      <h3 class="pull-left bold text-white no-margin">โปรโมชั่น Sports Revolution Warehouse Sale ครั้งที่4 Nike, Under Armour, ASICS, Crocs Sale ลดสูงสุด 80%</h3>
						          <!--<h3 class="pull-right semi-bold text-white font-montserrat bold no-margin">$25.00</h3>-->
                      <div class="clearfix"></div>
                      <!--<span class="hint-text pull-left text-white">Hand and mind crafted</span>-->
                      <div class="clearfix"></div>
                    </div>
                    <!--<div class="">
                      <h5 class="text-white light">Most Sold Item in the marketplace</h5>
                    </div>-->
                    <div class="m-t-10">
                      <div class="thumbnail-wrapper d32 circular m-t-5">
                        <img width="40" height="40" src="/assets/img/profiles/avatar.jpg" data-src="/assets/img/profiles/avatar.jpg" data-src-retina="/assets/img/profiles/avatar2x.jpg" alt="">
                      </div>
                      <div class="inline m-l-10">
                        <p class="no-margin text-white fs-12"><strong>Super Sport</strong></p>
						            <p class="rating">หมวดหมู่แบรนด์</p>
                        <!--<p class="rating">
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star"></i>
                        </p>-->
                      </div>
                      <!--<div class="pull-right m-t-10">
                        <button class="btn btn-white btn-xs btn-mini bold fs-14" type="button">+</button>
                      </div>-->
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!--
          <div class="card col2" data-social="item">
              <div class="ar-3-2 widget-1-wrapper">
                <div class="widget-1 panel no-border bg-complete no-margin widget-loader-circle-lg">
                  <div class="panel-heading top-right">
                    <div class="panel-controls">
                      <ul>
                        <li><a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i class="portlet-icon portlet-icon-refresh-lg-master"></i></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="pull-bottom bottom-left bottom-right ">
                      <span class="label font-montserrat fs-11">NEWS</span>
                      <br />
                      <h2 class="text-white">Click anywhere to get Quick Search</h2>
                      <p class="text-white hint-text">Learn More at Project Pages</p>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          -->
          <!-- END ITEM -->
          <!-- START ITEM -->
          {{--
          <div class="card share col1" data-social="item">
            <div class="circle" data-toggle="tooltip" title="Label" data-container="body">
            </div>
            <div class="card-header clearfix">
              <div class="user-pic">
                <img width="40" height="40" src="{{ URL::asset('assets/img/profiles/3x.jpg') }}" data-src="{{ URL::asset('assets/img/profiles/3.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/3x.jpg') }}" alt="">
              </div>
              <h5>Shannon Williams</h5>
              <h6>Shared a photo</h6>
            </div>
            <div class="card-content">
              <ul class="buttons ">
                <li>
                  <a href="#"><i class="fa fa-expand"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-heart-o"></i></a>
                </li>
              </ul>
              <img src="{{ URL::asset('assets/img/social-post-image.png') }}" class="block center-margin relative" alt="Social Post" />
            </div>
            <div class="card-description">
              <p>Inspired by : good design is obvious, great design is transparent</p>
              <div class="via">via welovepro</div>
            </div>
            <div class="card-footer clearfix">
              <div class="time">few seconds ago</div>
              <ul class="reactions">
                <li><a href="#">5,345 <i class="fa fa-comment-o"></i></a>
                </li>
                <li><a href="#">23K <i class="fa fa-heart-o"></i></a>
                </li>
              </ul>
            </div>
          </div>
          --}}
          <!-- END ITEM -->
          @forelse($events as $event)
          <!-- START ITEM -->
          <div class="card col1-test col-centered" data-social="item" data-col="column">
            <div class="panel no-border  no-margin">
              <div class="padding-15">
                <div class="item-header clearfix">
                  <div class="thumbnail-wrapper d32 circular">
                    <img width="40" height="40" src="{{ URL::asset('assets/img/profiles/3x.jpg') }}" data-src="{{ URL::asset('assets/img/profiles/3.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/3x.jpg') }}" alt="{{ $event->brand_name }}" />
                  </div>
                  <div class="inline m-l-10">
                    <p class="no-margin">
                      <strong>{{ $event->brand_name }}</strong>
                    </p>
                    <p class="no-margin hint-text">{{ isset($event->category_first->name) ? $event->category_first->name : 'ไม่ระบุ หมวดหมู่' }}</p>
                  </div>
                  <div class="pull-top pull-right list-inline">
                    <i class="pg-map"></i>
                  </div>
                </div>
              </div>
              <hr class="no-margin">
              <div class="relative">
                <div class="no-overflow">
                  <a href="{{ URL::to('events', $event->url_slug) }}" title="{{ $event->title }}"><img src="{{ URL::asset($event->image) }}" class="block center-margin relative img-responsive" alt="{{ $event->title }}" /></a>
                </div>
              </div>
              <div class="padding-15">
                <strong><a href="{{ URL::to('events', $event->url_slug) }}" title="{{ $event->title }}" class="card_title">{{ $event->title }}</a></strong>
                <p>{{ $event->brief }}</p>
                <div class="hint-text small-text">via {{ $event->brand_name }}</div>
              </div>
              <div class="padding-15 card_footer">
                <div class="pull-left">ถึงวันที่ : {{ $event->end_date_thai }}</div>
                <ul class="list-inline pull-right no-margin">
                  <li><a class="text-info-link" href="#">5,345 <i class="fa fa-comment-o"></i></a>
                  </li>
                  <li><a class="text-info-link" href="#">23K <i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- END ITEM -->
          @empty
          @endforelse
          <div class="clearfix">&nbsp;</div>
        </div>
        <!-- END DAY -->
      </div>
      <!-- END FEED -->
    </div>
    <!-- END CONTAINER FLUID -->
  </div>
  <!-- /container -->
</div>
@stop

@extends('layouts.document')
@section('page_title', 'Events List')
@section('content')

{{--
<!-- START CONTAINER FLUID -->
<div class="container-fluid padding-25 sm-padding-10">
  <div class="row">
    <div class="col-md-6 col-xlg-4">
      <div class="row">
        <div class="col-md-12 m-b-10">
          <div class="ar-3-2 widget-1-wrapper">
            <!-- START WIDGET widget_imageWidget-->
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
            <!-- END WIDGET -->
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xlg-4">
        <div class="row">
          <div class="col-sm-6 m-b-10">
            <div class="panel no-border  no-margin">
              <div class="padding-15">
                <div class="item-header clearfix">
                  <div class="thumbnail-wrapper d32 circular">
                    <img width="40" height="40" src="{{ URL::asset('assets/img/profiles/3x.jpg') }}" data-src="{{ URL::asset('assets/img/profiles/3.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/3x.jpg') }}" alt="">
                  </div>
                  <div class="inline m-l-10">
                    <p class="no-margin">
                      <strong>Anne Simons</strong>
                    </p>
                    <p class="no-margin hint-text">Shared a link
                      <span class="location semi-bold"><i class="fa fa-map-marker"></i> NY center</span>
                    </p>
                  </div>
                </div>
              </div>
              <hr class="no-margin">
              <div class="padding-15">
                <p>Inspired by : good design is obvious, great design is transparent</p>
                <div class="hint-text">via themeforest</div>
              </div>
              <div class="relative">
                <ul class="buttons pull-top top-right list-inline p-r-10 p-t-10">
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-expand"></i></a>
                  </li>
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="widget-19-post no-overflow">
                  <img src="{{ URL::asset('assets/img/social-post-image.png') }}" class="block center-margin relative" alt="Post">
                </div>
              </div>
              <div class="padding-15">
                <div class="hint-text pull-left">few seconds ago</div>
                <ul class="list-inline pull-right no-margin">
                  <li><a class="text-master hint-text" href="#">5,345 <i class="fa fa-comment-o"></i></a>
                  </li>
                  <li><a class="text-master hint-text" href="#">23K <i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 m-b-10">
            <div class="panel no-border  no-margin">
              <div class="padding-15">
                <div class="item-header clearfix">
                  <div class="thumbnail-wrapper d32 circular">
                    <img width="40" height="40" src="{{ URL::asset('assets/img/profiles/3x.jpg') }}" data-src="{{ URL::asset('assets/img/profiles/3.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/3x.jpg') }}" alt="">
                  </div>
                  <div class="inline m-l-10">
                    <p class="no-margin">
                      <strong>Anne Simons</strong>
                    </p>
                    <p class="no-margin hint-text">Shared a link
                      <span class="location semi-bold"><i class="fa fa-map-marker"></i> NY center</span>
                    </p>
                  </div>
                </div>
              </div>
              <hr class="no-margin">
              <div class="padding-15">
                <p>Inspired by : good design is obvious, great design is transparent</p>
                <div class="hint-text">via themeforest</div>
              </div>
              <div class="relative">
                <ul class="buttons pull-top top-right list-inline p-r-10 p-t-10">
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-expand"></i></a>
                  </li>
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="widget-19-post no-overflow">
                  <img src="{{ URL::asset('assets/img/social-post-image.png') }}" class="block center-margin relative" alt="Post">
                </div>
              </div>
              <div class="padding-15">
                <div class="hint-text pull-left">few seconds ago</div>
                <ul class="list-inline pull-right no-margin">
                  <li><a class="text-master hint-text" href="#">5,345 <i class="fa fa-comment-o"></i></a>
                  </li>
                  <li><a class="text-master hint-text" href="#">23K <i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- Filler -->
  </div>
</div>
<!-- END CONTAINER FLUID -->
--}}

<div class="social-wrapper">
  <div class="social " data-pages="social">
    <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
      <div class="feed">
        <!-- START DAY -->
        <div class="day" data-social="day">
          <!-- START ITEM -->
          <div class="card no-border bg-transparent full-width" data-social="item">

          </div>
          <!-- END ITEM -->
          <!-- START ITEM -->
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
          <!-- END ITEM -->
          <!-- START ITEM -->
          <div class="card col1" data-social="item">
            <div class="panel no-border  no-margin">
              <div class="padding-15">
                <div class="item-header clearfix">
                  <div class="thumbnail-wrapper d32 circular">
                    <img width="40" height="40" src="{{ URL::asset('assets/img/profiles/3x.jpg') }}" data-src="{{ URL::asset('assets/img/profiles/3.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/3x.jpg') }}" alt="">
                  </div>
                  <div class="inline m-l-10">
                    <p class="no-margin">
                      <strong>Anne Simons 1</strong>
                    </p>
                    <p class="no-margin hint-text">Shared a link</p>
                  </div>
                  <div class="pull-top pull-right list-inline">
                    <i class="pg-map"></i>
                  </div>
                </div>
              </div>
              <hr class="no-margin">
              <div class="relative">
                <ul class="buttons pull-top top-right list-inline p-r-10 p-t-10">
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-expand"></i></a>
                  </li>
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="widget-19-post no-overflow">
                  <img src="{{ URL::asset('assets/img/social-post-image.png') }}" class="block center-margin relative" alt="Post">
                </div>
              </div>
              <div class="padding-15">
                <p>Inspired by : good design is obvious, great design is transparent</p>
                <div class="hint-text">via themeforest</div>
              </div>
              <div class="padding-15">
                <div class="hint-text pull-left">few seconds ago</div>
                <ul class="list-inline pull-right no-margin">
                  <li><a class="text-master hint-text" href="#">5,345 <i class="fa fa-comment-o"></i></a>
                  </li>
                  <li><a class="text-master hint-text" href="#">23K <i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- END ITEM -->
          {{--
          <!-- START ITEM -->
          <div class="card col1" data-social="item">
            <div class="panel no-border  no-margin">
              <div class="padding-15">
                <div class="item-header clearfix">
                  <div class="thumbnail-wrapper d32 circular">
                    <img width="40" height="40" src="{{ URL::asset('assets/img/profiles/3x.jpg') }}" data-src="{{ URL::asset('assets/img/profiles/3.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/3x.jpg') }}" alt="">
                  </div>
                  <div class="inline m-l-10">
                    <p class="no-margin">
                      <strong>Anne Simons 2</strong>
                    </p>
                    <p class="no-margin hint-text">Shared a link
                      <span class="location semi-bold"><i class="fa fa-map-marker"></i> NY center</span>
                    </p>
                  </div>
                </div>
              </div>
              <hr class="no-margin">
              <div class="padding-15">
                <p>Inspired by : good design is obvious, great design is transparent</p>
                <div class="hint-text">via themeforest</div>
              </div>
              <div class="relative">
                <ul class="buttons pull-top top-right list-inline p-r-10 p-t-10">
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-expand"></i></a>
                  </li>
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="widget-19-post no-overflow">
                  <img src="{{ URL::asset('assets/img/social-post-image.png') }}" class="block center-margin relative" alt="Post">
                </div>
              </div>
              <div class="padding-15">
                <div class="hint-text pull-left">few seconds ago</div>
                <ul class="list-inline pull-right no-margin">
                  <li><a class="text-master hint-text" href="#">5,345 <i class="fa fa-comment-o"></i></a>
                  </li>
                  <li><a class="text-master hint-text" href="#">23K <i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- END ITEM -->
          <!-- START ITEM -->
          <div class="card col1" data-social="item">
            <div class="panel no-border  no-margin">
              <div class="padding-15">
                <div class="item-header clearfix">
                  <div class="thumbnail-wrapper d32 circular">
                    <img width="40" height="40" src="{{ URL::asset('assets/img/profiles/3x.jpg') }}" data-src="{{ URL::asset('assets/img/profiles/3.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/3x.jpg') }}" alt="">
                  </div>
                  <div class="inline m-l-10">
                    <p class="no-margin">
                      <strong>Anne Simons 3</strong>
                    </p>
                    <p class="no-margin hint-text">Shared a link
                      <span class="location semi-bold"><i class="fa fa-map-marker"></i> NY center</span>
                    </p>
                  </div>
                </div>
              </div>
              <hr class="no-margin">
              <div class="padding-15">
                <p>Inspired by : good design is obvious, great design is transparent</p>
                <div class="hint-text">via themeforest</div>
              </div>
              <div class="relative">
                <ul class="buttons pull-top top-right list-inline p-r-10 p-t-10">
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-expand"></i></a>
                  </li>
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="widget-19-post no-overflow">
                  <img src="{{ URL::asset('assets/img/social-post-image.png') }}" class="block center-margin relative" alt="Post">
                </div>
              </div>
              <div class="padding-15">
                <div class="hint-text pull-left">few seconds ago</div>
                <ul class="list-inline pull-right no-margin">
                  <li><a class="text-master hint-text" href="#">5,345 <i class="fa fa-comment-o"></i></a>
                  </li>
                  <li><a class="text-master hint-text" href="#">23K <i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- END ITEM -->
          <!-- START ITEM -->
          <div class="card col1" data-social="item">
            <div class="panel no-border  no-margin">
              <div class="padding-15">
                <div class="item-header clearfix">
                  <div class="thumbnail-wrapper d32 circular">
                    <img width="40" height="40" src="{{ URL::asset('assets/img/profiles/3x.jpg') }}" data-src="{{ URL::asset('assets/img/profiles/3.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/3x.jpg') }}" alt="">
                  </div>
                  <div class="inline m-l-10">
                    <p class="no-margin">
                      <strong>Anne Simons 4</strong>
                    </p>
                    <p class="no-margin hint-text">Shared a link
                      <span class="location semi-bold"><i class="fa fa-map-marker"></i> NY center</span>
                    </p>
                  </div>
                </div>
              </div>
              <hr class="no-margin">
              <div class="padding-15">
                <p>Inspired by : good design is obvious, great design is transparent</p>
                <div class="hint-text">via themeforest</div>
              </div>
              <div class="relative">
                <ul class="buttons pull-top top-right list-inline p-r-10 p-t-10">
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-expand"></i></a>
                  </li>
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="widget-19-post no-overflow">
                  <img src="{{ URL::asset('assets/img/social-post-image.png') }}" class="block center-margin relative" alt="Post">
                </div>
              </div>
              <div class="padding-15">
                <div class="hint-text pull-left">few seconds ago</div>
                <ul class="list-inline pull-right no-margin">
                  <li><a class="text-master hint-text" href="#">5,345 <i class="fa fa-comment-o"></i></a>
                  </li>
                  <li><a class="text-master hint-text" href="#">23K <i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- END ITEM -->
          <!-- START ITEM -->
          <div class="card col1" data-social="item">
            <div class="panel no-border  no-margin">
              <div class="padding-15">
                <div class="item-header clearfix">
                  <div class="thumbnail-wrapper d32 circular">
                    <img width="40" height="40" src="{{ URL::asset('assets/img/profiles/3x.jpg') }}" data-src="{{ URL::asset('assets/img/profiles/3.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/3x.jpg') }}" alt="">
                  </div>
                  <div class="inline m-l-10">
                    <p class="no-margin">
                      <strong>Anne Simons 5</strong>
                    </p>
                    <p class="no-margin hint-text">Shared a link
                      <span class="location semi-bold"><i class="fa fa-map-marker"></i> NY center</span>
                    </p>
                  </div>
                </div>
              </div>
              <hr class="no-margin">
              <div class="padding-15">
                <p>Inspired by : good design is obvious, great design is transparent</p>
                <div class="hint-text">via themeforest</div>
              </div>
              <div class="relative">
                <ul class="buttons pull-top top-right list-inline p-r-10 p-t-10">
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-expand"></i></a>
                  </li>
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="widget-19-post no-overflow">
                  <img src="{{ URL::asset('assets/img/social-post-image.png') }}" class="block center-margin relative" alt="Post">
                </div>
              </div>
              <div class="padding-15">
                <div class="hint-text pull-left">few seconds ago</div>
                <ul class="list-inline pull-right no-margin">
                  <li><a class="text-master hint-text" href="#">5,345 <i class="fa fa-comment-o"></i></a>
                  </li>
                  <li><a class="text-master hint-text" href="#">23K <i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- END ITEM -->
          <!-- START ITEM -->
          <div class="card col1" data-social="item">
            <div class="panel no-border  no-margin">
              <div class="padding-15">
                <div class="item-header clearfix">
                  <div class="thumbnail-wrapper d32 circular">
                    <img width="40" height="40" src="{{ URL::asset('assets/img/profiles/3x.jpg') }}" data-src="{{ URL::asset('assets/img/profiles/3.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/3x.jpg') }}" alt="">
                  </div>
                  <div class="inline m-l-10">
                    <p class="no-margin">
                      <strong>Anne Simons 6</strong>
                    </p>
                    <p class="no-margin hint-text">Shared a link
                      <span class="location semi-bold"><i class="fa fa-map-marker"></i> NY center</span>
                    </p>
                  </div>
                </div>
              </div>
              <hr class="no-margin">
              <div class="padding-15">
                <p>Inspired by : good design is obvious, great design is transparent</p>
                <div class="hint-text">via themeforest</div>
              </div>
              <div class="relative">
                <ul class="buttons pull-top top-right list-inline p-r-10 p-t-10">
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-expand"></i></a>
                  </li>
                  <li>
                    <a class="text-white" href="#"><i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="widget-19-post no-overflow">
                  <img src="{{ URL::asset('assets/img/social-post-image.png') }}" class="block center-margin relative" alt="Post">
                </div>
              </div>
              <div class="padding-15">
                <div class="hint-text pull-left">few seconds ago</div>
                <ul class="list-inline pull-right no-margin">
                  <li><a class="text-master hint-text" href="#">5,345 <i class="fa fa-comment-o"></i></a>
                  </li>
                  <li><a class="text-master hint-text" href="#">23K <i class="fa fa-heart-o"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- END ITEM -->
          --}}
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

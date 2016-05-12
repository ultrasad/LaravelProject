<!-- START HEADER -->
<div class="header">
  <!-- START MOBILE CONTROLS -->
  <div class="container-fluid relative">
    <!-- LEFT SIDE -->
    <div class="pull-left full-height visible-sm visible-xs">
      <!-- START ACTION BAR -->
      <div class="header-inner">
        <a href="#" class="btn-link toggle-sidebar visible-sm-inline-block visible-xs-inline-block p-l-5 p-r-5" data-toggle="sidebar">
          <span class="icon-set menu-hambuger"></span>
        </a>
        <a href="#" class="search-link" data-toggle="search"><i class="pg-search"></i><span class="bold">search</span></a>
      </div>
      <!-- END ACTION BAR -->
    </div>
    <div class="pull-center hidden-md hidden-lg">
      <div class="header-inner">
        <div class="brand inline">
          <!--<img src="{{ URL::asset('assets/img/logo.png') }}" alt="logo" data-src="{{ URL::asset('assets/img/logo.png') }}" data-src-retina="{{ URL::asset('assets/img/logo_2x.png') }}" width="78" height="22">-->
          <!--<div class="nav-logo nav-logo-center">
              <a title="WELOVEPRO" href="/">
                  <img src="{{ URL::asset('assets/img/tnw.png') }}" class="img-responsive" alt="WELOVEPRO" />
              </a>
          </div>-->
        </div>
      </div>
    </div>
    <!-- RIGHT SIDE -->
    <div class="pull-right full-height visible-sm visible-xs">
      <!-- START ACTION BAR -->
      <div class="header-inner">
        <a href="/events/create" class="btn-link visible-sm-inline-block visible-xs-inline-block">
          <span class="icon-set menu-hambuger-plus"></span>
        </a>
      </div>
      <!-- END ACTION BAR -->
    </div>

    <div class="pull-right full-height visible-sm visible-xs">
      <div class="header-inner">
        <ul class="nav-follow">
          <li><a target="_blank" href="#" title="Follow us on Facebook" class="visible-sm-inline-block visible-xs-inline-block"><i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i></a></li>
          <li><a target="_blank" href="#" title="Follow us on Twitter" class="visible-sm-inline-block visible-xs-inline-block"><i class="fa fa-twitter-square fa-lg" aria-hidden="true"></i></a></li>
          <li><a target="_blank" href="#" title="Follow us on Youtube" class="visible-sm-inline-block visible-xs-inline-block"><i class="fa fa-youtube-square fa-lg" aria-hidden="true"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- END MOBILE CONTROLS -->
  <div class="pull-left sm-table hidden-xs hidden-sm">
    <div class="header-inner">
      <div class="brand inline">
        <img src="{{ URL::asset('assets/img/logo.png') }}" alt="logo" data-src="{{ URL::asset('assets/img/logo.png') }}" data-src-retina="{{ URL::asset('assets/img/logo_2x.png') }}" width="78" height="22">
        <!--<div class="nav-logo">
            <a title="WELOVEPRO" href="/">
                <img src="{{ URL::asset('assets/img/tnw.png') }}" class="img-responsive" alt="WELOVEPRO" />
            </a>
        </div>-->
      </div>
      <a href="#" class="search-link" data-toggle="search"><i class="pg-search"></i>Type anywhere to <span class="bold">search</span></a>
    </div>
  </div>

  @if (Auth::check())
    @if( Auth::User()->hasRole(['Administrator', 'Manager', 'Company Manager']))
    <div class=" pull-right">
      <div class="header-inner">
        <a href="/events/create" title="Create Promotion" class="btn-link icon-set menu-hambuger-plus m-l-20 sm-no-margin hidden-sm hidden-xs"></a>
      </div>
    </div>
    <div class=" pull-right">
      <!-- START User Info-->
        <div class="visible-lg visible-md m-t-10">
          <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
            <span class="semi-bold">{{ Auth::user()->name}}</span>
          </div>
          <div class="dropdown pull-right">
            <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="thumbnail-wrapper d32 circular inline m-t-5">
                <img src="{{ URL::asset('assets/img/profiles/c.jpg') }}" alt="" data-src="{{ URL::asset('assets/img/profiles/c.jpg') }}" data-src-retina="{{ URL::asset('assets/img/profiles/c2x.jpg') }}" width="32" height="32">
              </span>
            </button>
            <ul class="dropdown-menu profile-dropdown" role="menu">
              <li><a href="#"><i class="pg-settings_small"></i> Settings</a>
              </li>
              <li><a href="#"><i class="pg-outdent"></i> Feedback</a>
              </li>
              <li><a href="#"><i class="pg-signals"></i> Help</a>
              </li>
              <li class="bg-master-lighter">
                <a href="/logout" class="clearfix">
                  <span class="pull-left">Logout</span>
                  <span class="pull-right"><i class="pg-power"></i></span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      <!-- END User Info-->
    </div>
    @endif
  @else
  <div class=" pull-right">
    <div class="header-inner">
      <a href="/login" title="Member Login" class="btn-link icon-set menu-hambuger-plus m-l-20 sm-no-margin hidden-sm hidden-xs"></a>
    </div>
  </div>
  @endif
  <div class="pull-right">
    <div class="header-inner">
      <ul class="nav-follow">
        <li><a target="_blank" href="#" title="Follow us on Facebook" class="hidden-sm hidden-xs"><i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i></a></li>
        <li><a target="_blank" href="#" title="Follow us on Twitter" class="hidden-sm hidden-xs"><i class="fa fa-twitter-square fa-lg" aria-hidden="true"></i></a></li>
        <li><a target="_blank" href="#" title="Follow us on Youtube" class="hidden-sm hidden-xs"><i class="fa fa-youtube-square fa-lg" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </div>
</div>
<!-- END HEADER -->

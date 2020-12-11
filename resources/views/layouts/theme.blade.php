<!DOCTYPE html>
<!--
**********************************************************************************************************
    Copyright (c) 2020 .
    **********************************************************************************************************  -->
<!--
Template Name: Next Hour - Movie Tv Show & Video Subscription Portal Cms Web and Mobile App
Version: 3.0.1
Author: Media City
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]> -->

<html lang="en">
<!-- <![endif]-->
<!-- head -->
<head>
  <meta charset="utf-8" />
  <title>@yield('title') - {{$w_title}}</title>
  
  {!! SEO::generate() !!}
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="MobileOptimized" content="320" />    
  @yield('custom-meta')
  <meta name="csrf-token" content="{{ csrf_token() }}"><!-- CSRF Token -->

  <link rel="icon" type="image/icon" href="{{url('images/favicon/favicon.png')}}"> <!-- favicon icon -->
  <link href="{{url('css/starrating.css')}}" rel="stylesheet" type="text/css"/> 
  <!-- Star Rating -->
  <!-- theme style -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> <!-- google font -->
  <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/> <!-- bootstrap css -->
  <link href="{{url('css/menumaker.css')}}" type="text/css" rel="stylesheet"> <!-- menu css -->
  <link href="{{url('css/owl.carousel.min.css')}}" rel="stylesheet" type="text/css"/> <!-- owl carousel css -->
  <link href="{{url('css/owl.theme.default.min.css')}}" rel="stylesheet" type="text/css"/> <!-- owl carousel css -->
  <link href="{{url('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/> <!-- fontawsome css -->
  <link href="{{url('css/popover.css')}}" rel="stylesheet" type="text/css"/> <!-- bootstrap popover css -->
  <link href="{{url('css/layers.css')}}" rel="stylesheet" type="text/css"/> <!-- revolution css -->
  <link href="{{url('css/navigation.css')}}" rel="stylesheet" type="text/css"/> <!-- revolution css -->
  <link href="{{url('css/pe-icon-7-stroke.css')}}" rel="stylesheet" type="text/css"/> <!-- revolution css -->
  <link href="{{url('css/settings.css')}}" rel="stylesheet" type="text/css"/> <!-- revolution css -->
  <link rel="stylesheet" href="{{ url('css/colorbox.css') }}">
  @if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    <link rel="manifest" href="{{url('/manifest.json')}}"> 
  @endif
  
  <link rel="stylesheet" href="{{url('css/venom-button.min.css')}}">

  @yield('head-script')

  
  {{-- style css for different color schemes --}}
  @if($color=='default')
  @if($color_dark==1)
  {{-- light color --}}
  <link href="{{url('css/style-light.css')}}" rel="stylesheet" type="text/css"/>
  @else
   
      <link href="{{url('css/style.css')}}" rel="stylesheet" type="text/css"/>
 
  {{-- dark color --}}
  @endif
  @elseif($color=='green')
  @if($color_dark==1)
  {{-- light color --}}
    <link href="{{url('css/style-light-green.css')}}" rel="stylesheet" type="text/css"/>
  @else
  {{-- dark color --}}
   <link href="{{url('css/style-green.css')}}" rel="stylesheet" type="text/css"/>
  @endif
  @elseif($color=='orange')
  @if($color_dark==1)
  {{-- light color --}}
     <link href="{{url('css/style-light-orange.css')}}" rel="stylesheet" type="text/css"/>
  @else
  {{-- dark color --}}
   <link href="{{url('css/style-orange.css')}}" rel="stylesheet" type="text/css"/>
  @endif
  @elseif($color=='yellow')
  @if($color_dark==1)
  {{-- light color --}}
    <link href="{{url('css/style-light-yellow.css')}}" rel="stylesheet" type="text/css"/>
  @else
  {{-- dark color --}}
   <link href="{{url('css/style-yellow.css')}}" rel="stylesheet" type="text/css"/>
  @endif
   @elseif($color=='red')
  @if($color_dark==1)
  {{-- light color --}}
    <link href="{{url('css/style-light-red.css')}}" rel="stylesheet" type="text/css"/>
  @else
  {{-- dark color --}}
   <link href="{{url('css/style-red.css')}}" rel="stylesheet" type="text/css"/>
  @endif
  @elseif($color=='pink')
  @if($color_dark==1)
  {{-- light color --}}
   <link href="{{url('css/style-light-pink.css')}}" rel="stylesheet" type="text/css"/>
  @else
  {{-- dark color --}}
    <link href="{{url('css/style-pink.css')}}" rel="stylesheet" type="text/css"/>
  @endif
  @endif
  
  <link href="{{url('css/custom-style.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{url('css/goto.css')}}" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="{{ url('content/global.css') }}"><!-- go to top css -->
  <script src="//js.stripe.com/v3/"></script> <!-- stripe script -->
  <script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{ url('java/FWDUVPlayer.js') }}"></script> <!-- jquery library js -->

  <script>
    window.Laravel =  <?php echo json_encode([
      'csrfToken' => csrf_token(),
      ]); ?>
    </script>
    <script type="text/javascript" src="{{url('js/app.js')}}"></script> <!-- app library js -->
    <!-- notification icon style -->
    <style type="text/css">
     #ex4 .p1[data-count]:after{
      position:absolute;
      right:10%;
      top:8%;
      content: attr(data-count);
      font-size:40%;
      padding:.2em;
      border-radius:50%;
      line-height:1em;
      color: white;
      background:#c0392b;
      text-align:center;
      min-width: 1em;
      //font-weight:bold;
    }
  </style>
  <!-- end theme style -->


  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>

  <script>
    $(function(){
      "use strict";
      $('.lazy').lazy({
          effect: "fadeIn",
          effectTime: 2000,
          scrollDirection: 'both',
          threshold: 0
      });
    });
  </script>
  @yield('player-sc')



  @php
    if(isset(Auth::user()->paypal_subscriptions)){
        //Run wallet point expire background process
        App\Jobs\CheckUserPlanValidity::dispatchNow();
    }
  @endphp

</head>
<!-- end head -->
<!--body start-->
<body>
  <!-- preloader -->
  @if ($preloader == 1)
  <div class="loading">
    <div class="logo">
      <img src="{{ url('images/logo/'.$logo) }}" class="img-responsive" alt="{{$w_title}}">
    </div>
    <div class="loading-text">
      <span class="loading-text-words">L</span>
      <span class="loading-text-words">O</span>
      <span class="loading-text-words">A</span>
      <span class="loading-text-words">D</span>
      <span class="loading-text-words">I</span>
      <span class="loading-text-words">N</span>
      <span class="loading-text-words">G</span>
    </div>
  </div>
  @endif
  <!-- end preloader -->
  <div class="body-overlay-bg"></div>

  @if (Session::has('added'))
  <div id="sessionModal" class="sessionmodal rgba-green-strong z-depth-2">
    <i class="fa fa-check-circle"></i> <p>{{session('added')}}</p>
  </div>
  @elseif (Session::has('updated'))
  <div id="sessionModal" class="sessionmodal rgba-cyan-strong z-depth-2">
    <i class="fa fa-exclamation-triangle"></i> <p>{{session('updated')}}</p>
  </div>
  @elseif (Session::has('deleted'))
  <div id="sessionModal" class="sessionmodal rgba-red-strong z-depth-2">
    <i class="fa fa-window-close"></i> <p>{{session('deleted')}}</p>
  </div>
  @endif
  <!-- preloader -->
  <div class="preloader">
    <div class="status">
      <div class="status-message">
      </div>
    </div>
  </div>

 @php
  $auth = Illuminate\Support\Facades\Auth::user();
  $subscribed = null;
  $withlogin= App\Config::findOrFail(1)->withlogin;
  $catlog = App\Config::findOrFail(1)->catlog;   
   Stripe\Stripe::setApiKey(env('STRIPE_SECRET')); 
  if (isset($auth)) {
    $current_date = Illuminate\Support\Carbon::now();
    $paypal=App\PaypalSubscription::where('user_id',$auth->id)->orderBy('created_at','desc')->first();

    if (isset($paypal)) {
      if (date($current_date) <= date($paypal->subscription_to)) {
        if ($paypal->package_id==0) {
          $nav_menus=App\Menu::all();
          $subscribed=1;
        }
      }
    }

    
    if ($auth->is_admin == 1) {
      $subscribed = 1;
      $nav_menus=App\Menu::orderBy('position','ASC')->get();
    } else{
      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      if ($auth->stripe_id != null) {
         $customer = \Laravel\Cashier\Cashier::findBillable($auth->stripe_id);
        // $customer = Stripe\Customer::retrieve($auth->stripe_id);
      }
      if (isset($customer)) {         
        $data = $auth->subscriptions->last();      
      } 
      if (isset($paypal) && $paypal != null && $paypal->count()>0) {
        $last = $paypal;
      } 
      $stripedate = isset($data) ? $data->created_at : null;
      $paydate = isset($last) ? $last->created_at : null;
      if($stripedate > $paydate){
        if($auth->subscribed($data->name) && date($current_date) <= date($data->subscription_to) && $data->ends_at == null){
          $subscribed = 1;
          $planmenus= DB::table('package_menu')->where('package_id',$data->stripe_plan)->get();
           if(isset($planmenus)){ 
            foreach ($planmenus as $key => $value) {
              $menus[]=$value->menu_id;
            }
          }
          if(isset($menus)){ 
            $nav_menus=App\Menu::whereIn('id',$menus)->get();
          }
        }
      }
      elseif($stripedate < $paydate){
        if ((date($current_date) <= date($last->subscription_to)) && $last->status == 1){
          $subscribed = 1;
          $planmenus= DB::table('package_menu')->where('package_id', $last->plan['plan_id'])->get();
          if(isset($planmenus)){ 
            foreach ($planmenus as $key => $value) {
              $menus[]=$value->menu_id;
            }
          }
          if(isset($menus)){ 
            $nav_menus=App\Menu::whereIn('id',$menus)->get();
          }
        }
      }
    }
  }
$menuh=App\Menu::orderBy('position','ASC')->get();
$config=App\Config::first();
$custom_page = App\CustomPage::where('in_show_menu','1')->where('is_active','1')->get();

@endphp

<!-- end preloader -->
<!-- navigation -->
<div class="navigation">
  <div class="container-fluid nav-container">
    <div class="row">
      <div class="col-sm-2 col-md-1 col-lg-2">
        <div class="nav-logo">
           <a href="{{url('/')}}" title="{{$w_title}}"><img src="{{url('images/logo/'.$logo)}}" class="img-responsive" alt="{{$w_title}}"></a>
        </div>
      </div>
     <div class="col-sm-4 col-md-5 col-lg-4">
        @if($catlog==1)
          <div id="cssmenu">
            @if (isset($menuh) || isset($custom_page))
            <ul>
              @if(isset($menuh) && count($menuh) > 0)
                @foreach ($menuh as $menus)
                  @if($auth && $subscribed ==1)
                  
                    <li>
                      <a class="{{ Nav::hasSegment($menus->slug) }}" href="{{url('/', $menus->slug)}}"  title="{{$menus->name}}">
                        {{ $menus->name }}
                      </a>
                    </li>
                  @else
                   
                    <li>
                      <a class="{{ Nav::hasSegment($menus->slug) }}" href="{{url('/guest', $menus->slug)}}"  title="{{$menus->name}}">
                        {{ $menus->name }}
                      </a>
                    </li>
                  @endif
                @endforeach
              @endif
              
              @if(isset($custom_page) && count($custom_page) >0)
                @foreach($custom_page as $custom)
                  @if(isset($custom))
                    <li>
                      <a class="{{ Nav::hasSegment($custom->slug) }}" href="{{url('/page', $custom->slug)}}"  title="{{$custom->title}}">
                        {{ $custom->title }}
                      </a>
                    </li>
                  @endif
                @endforeach 
              @endif
              {{--  <li><a>...</a></li> --}}
            </ul>
            @endif
          </div>
        @elseif($catlog == 0 && $subscribed == 1)
          <div id="cssmenu">

            @if (isset($menuh) )
              <ul>
                @if(isset($menuh) && count($menuh) > 0)
                  @foreach ($menuh as $menus)
                    <li>
                      <a class="{{ Nav::hasSegment($menus->slug) }}" href="{{url('/', $menus->slug)}}"  title="{{$menus->name}}">
                        {{ $menus->name }}
                      </a>
                    </li>
                  @endforeach
                @endif
              
                @if(isset($custom_page) && count($custom_page) >0)
                  @foreach($custom_page as $custom)
                    @if(isset($custom))
                      <li>
                        <a class="{{ Nav::hasSegment($custom->slug) }}" href="{{url('/page', $custom->slug)}}"  title="{{$custom->title}}">
                          {{ $custom->title }}
                        </a>
                      </li>
                    @endif
                  @endforeach 
                @endif
                <li><a>...</a></li>
              </ul>
            @endif
          </div>
        @endif
     </div>
      <div class="col-sm-6 col-md-6 col-lg-6 pull-right">
        <div class="login-panel-main-block small-screen-block">
          <ul>
          	@auth
            @if($catlog == 0 && $subscribed == 1)
              <li class="prime-search-block">
                <a href="#find"><i class="fa fa-search"></i></a>
              </li>
            @elseif($catlog == 1)
              <li class="prime-search-block">
                <a href="#find"><i class="fa fa-search"></i></a>
              </li>
            @endif
            @endauth
          
            <!-- notificaion -->
            @auth
            @if($subscribed == 1)
            <li> 
              <div id="ex4" class="dropdown prime-dropdown">

                <span class="p1 fa-stack fa-2x has-badge dropdown-toggle" type="button" data-toggle="dropdown" data-count="{{auth()->user()->unreadnotifications->count()}}">

                  <i class="p3 fa fa-bell-o fa-stack-1x xfa-inverse" data-count="4b"></i>

                </span>

                <ul class="dropdown-menu prime-dropdown-menu">

                  @foreach (auth()->user()->unreadnotifications as $n) 
                    <li>
                      @php
                        $tv=null;$movie=null;$tvname=null;$moviename=null;
                        if(isset($n->tv_id) && !is_null($n->tv_id)){
                          $season=App\Season::where('id',$n->tv_id)->first();
                          if(isset($season)){
                            $tv=App\TvSeries::findOrFail($season->tv_series_id);
                          }
                        }
                        if(isset($n->movie_id) && !is_null($n->movie_id)){
                          $movie=App\Movie::where('id',$n->movie_id)->get();
                          if(isset($movie)){
                            foreach($movie as $m){
                              $moviename=$m->title;
                            }

                          }
                        }
                      @endphp
                      <div id="notification_id" onclick="readed('{{$n->id}}')" class="card" style="padding: 6px;" >
                        <p style="color: #2980b9; font-size: 17px; padding: 3px;"><b> {{$n->title}}</b></p>
                        <p style="margin-top: -6px; font-size: 16px;"> {{$n->data['data']}} &nbsp; 
                          @if(isset($tv))
                            <a type="button" href="{{url('show/detail',$season->id)}}" style="font-size: 16px; color:  #a9ea81">
                              <b> "{{$tv->title}}"</b></a>
                          @endif 
                          &nbsp;
                          @if(isset($moviename))
                            <a type="button" href="{{url('movie/detail', $n->movie_id)}}" style="font-size: 16px;color: #a9ea81">
                              <b> "{{$moviename}}"</b>
                            </a>
                          @endif 
                        </p>

                      </div>
                      <hr style="margin-top: 1px;">
                    </li>
                  @endforeach
                </ul>
              </div> 
            </li>
            @endif
            @if (isset($languages) && count($languages) > 1)
              @if(count($languages) > 1)
                <li class="sign-in-block language-switch-block">
                <div class="dropdown prime-dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-globe"></i> {{Session::has('changed_language') ? ucfirst(Session::get('changed_language')) : ''}}</button>
                  <span class="caret caret-one"></span></button>
                  <ul class="dropdown-menu prime-dropdown-menu">
                  
                     @foreach ($languages as $language)

                    <li>

                      <a href="{{ route('languageSwitch', $language->local) }}">
                        {{$language->name}} 
                      </a>
                    </li>

                    @endforeach
                  
                  </ul>
                </div>
                </li>
              @endif
            @endif
            <li class="sign-in-block">
              <div class="dropdown prime-dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user-circle"></i> @if(Session::has('nickname')) {{ Session::get('nickname') }} @else {{$auth ? $auth->name : ''}} @endif
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu prime-dropdown-menu">
                    @if($auth->is_admin == 1)
                      <li><a href="{{url('admin')}}" target="_blank">{{__('staticwords.AdminDashboard')}}</a></li>
                    @endif
                    @if($auth->is_assistant == 1)
                      <li>
                        <a href="{{url('admin/movies')}}" target="_blank"> {{__('staticwords.ProducerDashboard')}}</a>
                      </li>
                    @endif
                    @if($subscribed == 1)

                      <li><a href="{{route('protectedvideo')}}">{{__('staticwords.protectedcontent')}}</a></li>
                      <li><a href="{{route('watchhistory')}}" >{{__('staticwords.watchhistory')}}</a></li>


                    @else
                     
                      <li><a href="{{url('account/purchaseplan')}}">{{__('staticwords.subscribe')}}</a></li>
                    @endif
                   
                   
                     @if($catlog == 0 && $subscribed == 1)
                        @if(isset($nav_menus))
                          @foreach ($nav_menus as $menu)
                            <li><a href="{{url('account/watchlist', $menu->slug)}}" class="active">{{__('staticwords.watchlist')}}</a></li>
                            @break;
                          @endforeach
                        @endif
                      @elseif($catlog ==1)
                         @if(isset($menuh))
                          @foreach ($menuh as $menu1)
                            <li><a href="{{url('account/watchlist', $menu1->slug)}}" class="active">{{__('staticwords.watchlist')}}</a></li>
                            @break;
                          @endforeach
                        @endif
                      @endif
                    <li><a href="{{url('account')}}">{{__('staticwords.dashboard')}}</a></li>
                    @if(isset(Auth::user()->paypal_subscriptions) && $subscribed == 1 && $config->blog==1)
                      <li><a href="{{url('account/blog')}}">{{__('staticwords.blog')}}</a></li>
                    @endif
                    @if(isset(Auth::user()->paypal_subscriptions) && $subscribed == 1)
                      <li><a href="{{url('/manageprofile/mus/'.Auth::user()->id)}}">{{__('staticwords.manageprofile')}}</a></li>
                    @endif
                      @php
                        $data=App\Config::findOrFail(1);
                        $donation= $data->donation;
                        $donation_link=$data->donation_link;
                      @endphp
                    @if(!is_null($donation) && !is_null($donation_link) && $donation==1)
                      <li><a target="_blank" href="{{$donation_link}}">{{__('staticwords.donation')}}</a></li>
                    @endif
                    <li><a href="{{url('faq')}}">{{__('staticwords.faq')}}</a></li>

                    <li>
                      <a href="{{ route('custom.logout') }}">
                      {{__('staticwords.signout')}}
                     </a>
                     
                  </li>
                </ul>
              </div>
            </li>
            @else

            <li class="sign-in-block sign-in-block-one sign-in-block-two mrgn-rt-20"><a class="sign-in" href="{{url('login')}}"><i class="fa fa-sign-in"></i> {{__('staticwords.signin')}}</a></li>
            <li class="sign-in-block sign-in-block-one "><a class="sign-in" href="{{url('register')}}"><i class="fa fa-user-plus"></i>{{__('staticwords.register')}}</a></li>
            @endauth
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div>



<!-- small screen navigation start-->
 <div id="wrapper">
      <div class="overlay"></div>
      <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
          <span class="hamb-top"></span>
          <span class="hamb-middle"></span>
          <span class="hamb-bottom"></span>
      </button>
      @auth
      @if($catlog == 0 && $subscribed == 1)
        <div class="prime-search-block">
          <a href="#find"><i class="fa fa-search"></i></a>
        </div>
      @elseif($catlog == 1)
        <div class="prime-search-block">
          <a href="#find"><i class="fa fa-search"></i></a>
        </div>
      @endif
      @endauth
      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <h3 class="wrapper-heading">Menu</h3>
            <ul class="nav sidebar-nav">
                @if($catlog==1)
                    @if (isset($menuh) || isset($custom_page))
                      @if(isset($menuh) && count($menuh) > 0)
                        @foreach ($menuh as $menus)
                          @if($auth && $subscribed ==1)
                            <li>
                              <a class="{{ Nav::hasSegment($menus->slug) }}" href="{{url('/', $menus->slug)}}"  title="{{$menus->name}}">
                                {{ $menus->name }}
                              </a>
                            </li>
                          @else
                            <li>
                              <a class="{{ Nav::hasSegment($menus->slug) }}" href="{{url('/guest', $menus->slug)}}"  title="{{$menus->name}}">
                                {{ $menus->name }}
                              </a>
                            </li>
                          @endif
                        @endforeach
                      @endif
                      @if(isset($custom_page) && count($custom_page) >0)
                        @foreach($custom_page as $custom)
                          @if(isset($custom))
                            <li>
                              <a class="{{ Nav::hasSegment($custom->slug) }}" href="{{url('/page', $custom->slug)}}"  title="{{$custom->title}}">
                                {{ $custom->title }}
                              </a>
                            </li>
                          @endif
                        @endforeach 
                      @endif
                 
                    @endif
                @elseif($catlog == 0 && $subscribed == 1)
                  @if (isset($menuh) )
                      @if(isset($menuh) && count($menuh) > 0)
                        @foreach ($menuh as $menus)
                          <li>
                            <a class="{{ Nav::hasSegment($menus->slug) }}" href="{{url('/', $menus->slug)}}"  title="{{$menus->name}}">
                              {{ $menus->name }}
                            </a>
                          </li>
                        @endforeach
                      @endif
                    
                      @if(isset($custom_page) && count($custom_page) >0)
                        @foreach($custom_page as $custom)
                          @if(isset($custom))
                            <li>
                              <a class="{{ Nav::hasSegment($custom->slug) }}" href="{{url('/page', $custom->slug)}}"  title="{{$custom->title}}">
                                {{ $custom->title }}
                              </a>
                            </li>
                          @endif
                        @endforeach 
                      @endif
                  @endif
                @endif




             
              <!-- notificaion -->
            @auth
            @if($subscribed == 1)
            <li> 
              <div id="ex4" class="dropdown prime-dropdown">

                <span class="p1 fa-stack fa-2x has-badge dropdown-toggle" type="button" data-toggle="dropdown" data-count="{{auth()->user()->unreadnotifications->count()}}">

                  <i class="p3 fa-stack-1x xfa-inverse" data-count="4b">Notification</i>

                </span>

                <ul class="dropdown-menu prime-dropdown-menu">

                  @foreach (auth()->user()->unreadnotifications as $n) 
                    <li>
                      @php
                        $tv=null;$movie=null;$tvname=null;$moviename=null;
                        if(isset($n->tv_id) && !is_null($n->tv_id)){
                          $season=App\Season::where('id',$n->tv_id)->first();
                          if(isset($season)){
                            $tv=App\TvSeries::findOrFail($season->tv_series_id);
                          }
                        }
                        if(isset($n->movie_id) && !is_null($n->movie_id)){
                          $movie=App\Movie::where('id',$n->movie_id)->get();
                          if(isset($movie)){
                            foreach($movie as $m){
                              $moviename=$m->title;
                            }

                          }
                        }
                      @endphp
                      <div id="notification_id" onclick="readed('{{$n->id}}')" class="card" style="padding: 6px;" >
                        <p style="color: #2980b9; font-size: 17px; padding: 3px;"><b> {{$n->title}}</b></p>
                        <p style="margin-top: -6px; font-size: 16px;"> {{$n->data['data']}} &nbsp; 
                          @if(isset($tv))
                            <a type="button" href="{{url('show/detail',$season->id)}}" style="font-size: 16px; color:  #a9ea81">
                              <b> "{{$tv->title}}"</b></a>
                          @endif 
                          &nbsp;
                          @if(isset($moviename))
                            <a type="button" href="{{url('movie/detail', $n->movie_id)}}" style="font-size: 16px;color: #a9ea81">
                              <b> "{{$moviename}}"</b>
                            </a>
                          @endif 
                        </p>

                      </div>
                      <hr style="margin-top: 1px;">
                    </li>
                  @endforeach
                </ul>
              </div> 
            </li>
            @endif
            @if (isset($languages) && count($languages) > 1)
              @if(count($languages) > 1)
                <li class="sign-in-block language-switch-block">
                <div class="dropdown prime-dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-globe"></i> {{Session::has('changed_language') ? ucfirst(Session::get('changed_language')) : ''}}</button>
                  <span class="caret caret-one"></span></button>
                  <ul class="dropdown-menu prime-dropdown-menu">
                  
                     @foreach ($languages as $language)

                    <li>

                      <a href="{{ route('languageSwitch', $language->local) }}">
                        {{$language->name}} 
                      </a>
                    </li>

                    @endforeach
                  
                  </ul>
                </div>
                </li>
              @endif
            @endif
            <li class="sign-in-block">
              <div class="dropdown prime-dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user-circle"></i> @if(Session::has('nickname')) {{ Session::get('nickname') }} @else {{$auth ? $auth->name : ''}} @endif
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu prime-dropdown-menu">
                    @if($auth->is_admin == 1)
                      <li><a href="{{url('admin')}}" target="_blank">{{__('staticwords.AdminDashboard')}}</a></li>
                    @endif
                    @if($auth->is_assistant == 1)
                      <li>
                        <a href="{{url('admin/movies')}}" target="_blank"> {{__('staticwords.ProducerDashboard')}}</a>
                      </li>
                    @endif
                    @if($subscribed == 1)
                      <li><a href="{{route('protectedvideo')}}">{{__('staticwords.protectedcontent')}}</a></li>
                      <li><a href="{{route('watchhistory')}}" >{{__('staticwords.watchhistory')}}</a></li>
                    @else
                     
                      <li><a href="{{url('account/purchaseplan')}}">{{__('staticwords.subscribe')}}</a></li>
                    @endif
                   
                   
                     @if($catlog == 0 && $subscribed == 1)
                        @if(isset($nav_menus))
                          @foreach ($nav_menus as $menu)
                            <li><a href="{{url('account/watchlist', $menu->slug)}}" class="active">{{__('staticwords.watchlist')}}</a></li>
                            @break;
                          @endforeach
                        @endif
                      @elseif($catlog ==1)
                         @if(isset($menuh))
                          @foreach ($menuh as $menu1)
                            <li><a href="{{url('account/watchlist', $menu1->slug)}}" class="active">{{__('staticwords.watchlist')}}</a></li>
                            @break;
                          @endforeach
                        @endif
                      @endif
                    <li><a href="{{url('account')}}">{{__('staticwords.dashboard')}}</a></li>
                    @if(isset(Auth::user()->paypal_subscriptions) && $subscribed == 1 && $config->blog==1)
                      <li><a href="{{url('account/blog')}}">{{__('staticwords.blog')}}</a></li>
                    @endif
                    @if(isset(Auth::user()->paypal_subscriptions) && $subscribed == 1)
                      <li><a href="{{url('/manageprofile/mus/'.Auth::user()->id)}}">{{__('staticwords.manageprofile')}}</a></li>
                    @endif
                      @php
                        $data=App\Config::findOrFail(1);
                        $donation= $data->donation;
                        $donation_link=$data->donation_link;
                      @endphp
                    @if(!is_null($donation) && !is_null($donation_link) && $donation==1)
                      <li><a target="_blank" href="{{$donation_link}}">{{__('staticwords.donation')}}</a></li>
                    @endif
                    <li><a href="{{url('faq')}}">{{__('staticwords.faq')}}</a></li>

                    <li>
                      <a href="{{ route('custom.logout') }}">
                      {{__('staticwords.signout')}}
                     </a>
                     
                  </li>
                </ul>
              </div>
            </li>
            @else

            <li class="sign-in-block sign-in-block-one sign-in-block-two mrgn-rt-20"><a class="sign-in" href="{{url('login')}}"><i class="fa fa-sign-in"></i> {{__('staticwords.signin')}}</a></li>
            <li class="sign-in-block sign-in-block-one "><a class="sign-in" href="{{url('register')}}"><i class="fa fa-user-plus"></i>{{__('staticwords.register')}}</a></li>
            @endauth
            </ul>
      </nav>
</div>
<div id="find">
  <div class="themesearch">
    <button type="button" class="close">×</button>
     {!! Form::open(['method' => 'GET', 'action' => 'HomeController@search', 'class' => 'search_form']) !!}
      <a href="{{url()->previous()}}"><i class="fa fa-arrow-left searcharrow"></i></a>  
        <input type="find"  name="search" value="" placeholder="Type something to search.." />
       {{--   {!! Form::find('search', null, ['class' => 'search-input', 'placeholder' => 'type keyword(s) here','required']) !!} --}}
        <button type="submit" class="btn btn-outline-info btn_sm">Search</button>
     {!! Form::close() !!}
  </div>
</div>


@if($auth)
   @if($subscribed != 1)
    <div class="purchase-sticky">
     <p>{{__('staticwords.pleasesubscribetoaplan')}} &nbsp;<a href="{{url('account/purchaseplan')}}" style="color: #1B1464;"><button class="btn btn-sm text-white agree_btn js-cookie-consent-agree cookie-consent__agree">{{__('staticwords.clickhere')}}</button></a></p>
    </div>
  @endif
@endif



<!-- end navigation -->
@yield('main-wrapper')

<!-- footer -->
@if($prime_footer == 1)
<footer id="prime-footer" class="prime-footer-main-block">
  <div class="container-fluid">
    <div style="height:0px;">
      <a id="back2Top" title="Back to top" href="#">&#10148;</a>
    </div>
    <div class="logo">
      <img src="{{url('images/logo/'.$logo)}}" class="img-responsive" alt="{{$w_title}}">
    </div>

    <div class="text-center">
      @php
        $si = App\SocialIcon::first();
      @endphp
      <div class="footer-widgets social-widgets social-btns">
        <ul>
          @if(isset( $si->url1))<li><a href="{{ $si->url1 }}" target="_blank"><i class="fa fa-facebook"></i></a></li>@endif
          @if(isset($si->url2))<li><a href="{{ $si->url2 }}" target="_blank"><i class="fa fa-twitter"></i></a></li>@endif
          @if(isset($si->url3))<li><a href="{{ $si->url3 }}" target="_blank"><i class="fa fa-youtube"></i></a></li>@endif
        </ul>
      </div>
    </div>
    @php
      $config=App\Config::first();
      $isplay=$config->is_playstore;
      $isappstore=$config->is_appstore;
      $appstore=$config->appstore;
      $playstore=$config->playstore;
    @endphp
    <div class="text-center">
      <div class="footer-widgets social-widgets social-btns">
        <ul>
         @if($isappstore==1 &&  $isappstore != NULL)
         <li> <a href="{{$appstore}}" target="_blank"> <img width="12%" height="12%" src="{{url('images/app_store_download.png')}}"></a></li>
         @endif
         @if($isplay==1 && $isplay != NULL)
         <li>
           <a href="{{$playstore}}"  target="_blank"> <img  width="12%" height="12%" src="{{url('images/google_play_download.png')}}"></a>
         </li>
         @endif
       </ul>
      </div>
    </div>

    <div class="copyright">
      <ul>
        <li>
          @if(isset($copyright))
          &copy;{{date('Y')}} {!! $copyright !!}
          @endif
        </li>
      </ul>
      <ul>
        @if(isset($config->terms_condition) && $config->terms_condition != NULL)
          <li><a href="{{url('terms_condition')}}">{{ __('staticwords.termsandcondition') }}</a></li>
        @endif
        @if(isset($config->privacy_pol) && $config->privacy_pol != NULL)
          <li><a href="{{url('privacy_policy')}}">{{__('staticwords.privacypolicy')}}</a></li>
        @endif
        @if(isset($config->refund_pol) && $config->refund_pol != NULL)
          <li><a href="{{url('refund_policy')}}">{{__('staticwords.refundpolicy')}}</a></li>
        @endif
        <li><a href="{{url('faq')}}">{{__('staticwords.help')}}</a></li>
        <li><a href="{{url('contactus')}}">{{__('staticwords.contactus')}}</a></li>
      </ul>
    </div>
  </div>
</footer>
@else
<footer id="footer-main-block" class="footer-main-block">
  <div class="pre-footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="footer-logo footer-widgets">
            @if(isset($logo))
            <img src="{{url('images/logo/'.$logo)}}" class="img-responsive" alt="{{$w_title}}">
            @endif
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="footer-widgets">
            <div class="row">
              <div class="col-md-6">
                <div class="footer-links-block">
                  <h4 class="footer-widgets-heading">{{__('staticwords.corporate')}}</h4>
                  <ul>
                    @php
                      $config = App\Config::first();
                    @endphp
                      @if(isset($config->terms_condition) && $config->terms_condition != NULL)
                    <li><a href="{{url('terms_condition')}}">{{ __('staticwords.termsandcondition') }}</a></li>
                    @endif
                      @if(isset($config->privacy_policy) && $config->privacy_policy != NULL)
                    <li><a href="{{url('privacy_policy')}}">{{__('staticwords.privacypolicy')}}</a></li>
                    @endif
                      @if(isset($config->refund_policy) && $config->refund_policy != NULL)
                    <li><a href="{{url('refund_policy')}}">{{__('staticwords.refundpolicy')}}</a></li>
                    @endif
                    <li><a href="{{url('faq')}}">{{__('staticwords.help')}}</a></li>

                  </ul>
                </div>
              </div>
              <div class="col-md-6">
                <div class="footer-links-block">
                  <h4 class="footer-widgets-heading">{{__('staticwords.sitemap')}}</h4>
                  <ul>
                  
                    @php
                      $memu = App\Menu::all();
                    @endphp
                    @if(isset($memu))
                      @foreach($memu as $value)
                        @if($value->slug != null ||$value->slug != '')  
                              @php $mySlug = $value->slug; @endphp
                               <li><a href="{{url($mySlug)}}">{{$value->name}}</a></li>
                        @endif      
                      @endforeach
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-widgets subscribe-widgets">
            <h4 class="footer-widgets-heading">{{__('staticwords.subscribe')}}</h4>
            <p class="subscribe-text">{{__('staticwords.subscribetext')}}</p>
            {!! Form::open(['method' => 'POST', 'action' => 'emailSubscribe@subscribe']) !!}
            {{ csrf_field() }}
            <div class="form-group">
              <input type="email" name="email" class="form-control subscribe-input" placeholder="Enter your e-mail">
              <button type="submit" class="subscribe-btn"><i class="fa fa-long-arrow-alt-right" style="color:red;"></i></button>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
        <div class="col-md-2">
          @php
          $si = App\SocialIcon::first();
          @endphp
          <div class="footer-widgets social-widgets social-btns">
            <ul>
              @if(isset( $si->url1))<li><a href="{{ $si->url1 }}" target="_blank"><i class="fa fa-facebook"></i></a></li>@endif
              @if(isset($si->url2))<li><a href="{{ $si->url2 }}" target="_blank"><i class="fa fa-twitter"></i></a></li>@endif
              @if(isset($si->url3))<li><a href="{{ $si->url3 }}" target="_blank"><i class="fa fa-youtube"></i></a></li>@endif
              @php
              $config=App\Config::first();
              $isplay=$config->is_playstore;
              $isappstore=$config->is_appstore;
              $appstore=$config->appstore;
              $playstore=$config->playstore;
              @endphp
              
              @if($isappstore==1 && $isappstore != NULL)
              <li> <a href="{{$appstore}}" target="_blank"> <img width="72%" height="72%" src="{{url('images/app_store_download.png')}}"></a></li>
              @endif
              @if($isplay==1 && isplay != NULL)
              <li>
               <a href="{{$playstore}}"  target="_blank"> <img  width="72%" height="72%" src="{{url('images/google_play_download.png')}}"></a>
             </li>
             @endif
             
           </ul>
         </div>
       </div>
     </div>
   </div>

 </div>

  <div class="container-fluid">
    <div class="copyright-footer">
      @if(isset($copyright))
     &copy;{{date('Y')}} {!! $copyright !!}
      @endif
    </div>
  </div>
</footer>

@endif
<!-- end footer -->

<div id="myButton"></div>

<!-- jquery -->
<script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script> <!-- bootstrap js -->
<script type="text/javascript" src="{{url('js/jquery.popover.js')}}"></script> <!-- bootstrap popover js -->
<script type="text/javascript" src="{{url('js/menumaker.js')}}"></script> <!-- menumaker js -->
<script type="text/javascript" src="{{url('js/jquery.curtail.min.js')}}"></script> <!-- menumaker js -->
<script type="text/javascript" src="{{url('js/owl.carousel.min.js')}}"></script> <!-- owl carousel js -->
<script type="text/javascript" src="{{url('js/jquery.scrollSpeed.js')}}"></script> <!-- owl carousel js -->
<script type="text/javascript" src="{{url('js/TweenMax.min.js')}}"></script> <!-- animation gsap js -->
<script type="text/javascript" src="{{url('js/ScrollMagic.min.js')}}"></script> <!-- custom js -->
<script type="text/javascript" src="{{url('js/animation.gsap.min.js')}}"></script> <!-- animation gsap js -->
<script type="text/javascript" src="{{url('js/modernizr-custom.js')}}"></script> <!-- debug addIndicators js -->
<script type="text/javascript" src="{{url('js/theme.js')}}"></script> <!-- custom js -->
<script type="text/javascript" src="{{url('js/custom-js.js')}}"></script>
<script type="text/javascript" src="{{ url('js/colorbox.js') }}"></script>
<script type="text/javascript" src="{{ url('js/checkit.js') }}"></script>
{{-- start rating js --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

<!-- venomem -->
<script type="text/javascript" src="{{ url('js/venom-button.min.js')}}"></script>

<!-- end jquery -->
@yield('custom-script')
@yield('script')

<!-- cookie -->
@include('cookieConsent::index')
<!-- end cookie -->
 @php
    $chat = App\ChatSetting::where('key','whatsapp')->first();
  @endphp

@if(isset($chat) && $chat->enable_whatsapp == 1)
<!-- whatsapp chat -->
<script type="text/javascript">

    $('#myButton').venomButton({
        phone: {{$chat->mobile}},
        popupMessage: {{$chat->text}},
        message: "",
        showPopup: true,
        position: "right",
        linkButton: false,
        showOnIE: false,
        heigth:{{$chat->size}},
        width:{{$chat->size}},
        headerTitle: {{$chat->header}},
        headerColor: {{$chat->color}},
        backgroundColor: '#25d366',
        buttonImage: '<img src="{{url('/images/whatsapp.svg')}}" />'
    });

</script>
@endif
<!-- end whatsapp chat -->

<script>
$(function(){
  $('.hamburger').on('click',function(){
    $('#wrapper').addClass("toggled");
  })
});
</script>


@if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
  <script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('{{ url('sw.js') }}')
          .then((reg) => {
            console.log('Service worker registered.', reg);
          });
    });
  }
  </script>
@endif
<script type="text/javascript">
   var colors = [ '#f44336',
        '#E91E63',
        '#9C27B0',
        '#673AB7',
        '#3F51B5',
        '#2196F3',
        '#03A9F4',
        '#00BCD4',
        '#009688',
        '#4CAF50',
        '#8BC34A',
        '#CDDC39',
        '#FFC107',
        '#FF9800',
        '#FF5722'];
    var divs = $('.allgenre');
    

    for (var i = 0; i < divs.length; i++) {
        var color = colors[i % colors.length];

        $(divs[i]).css('background-color', color);
    };

</script>
<script>
  (function($) {
// Session Popup
$('.sessionmodal').addClass("active");
setTimeout(function() {
  $('.sessionmodal').removeClass("active");
}, 7000);

if (window.location.hash == '#_=_'){
  history.replaceState
  ? history.replaceState(null, null, window.location.href.split('#')[0])
  : window.location.hash = '';
}
})(jQuery);
</script>

@if($google)
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '{{$google}}', 'auto');
  ga('send', 'pageview');

</script>
@endif
@if($fb)
<!-- facebook pixel -->
<script>
  !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
      document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '{{$fb}}');
    fbq('track', 'PageView');
  </script>
  <!--End facebook pixel -->
  @endif

  @if($rightclick == 1)
  <script type="text/javascript" language="javascript">
// Right click disable
$(function() {
  $(this).bind("contextmenu", function(inspect) {
    inspect.preventDefault();
  });
});
// End Right click disable
</script>
@endif

@if($inspect == 1)
<script type="text/javascript" language="javascript">
//all controller is disable
$(function() {
  var isCtrl = false;
  document.onkeyup=function(e){
    if(e.which == 17) isCtrl=false;
  }

  document.onkeydown=function(e){
    if(e.which == 17) isCtrl=true;
    if(e.which == 85 && isCtrl == true) {
      return false;
    }
  };
  $(document).keydown(function (event) {
        if (event.keyCode == 123) { // Prevent F12
          return false;
        }
      else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
        return false;
      }
    });
});
// end all controller is disable
</script>
@endif


@if($goto==1)
<script type="text/javascript">
 // go to top
 $(window).scroll(function() {
  var height = $(window).scrollTop();
  if (height > 100) {
    $('#back2Top').fadeIn();
  } else {
    $('#back2Top').fadeOut();
  }
});
 $(document).ready(function() {
  $("#back2Top").click(function(event) {
    event.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });

});
// end go to top
</script>
@endif
 
<!---------------- UC browser block --------------->
@if($uc_browser =="1")
<script >
$(document).ready(function() {
 // var detect=navigator.userAgent.indexOf("UBrowser");
 // alert(detect);

   if ( navigator.userAgent.indexOf("UBrowser")>=0 || navigator.userAgent.indexOf("UCBrowser")>=0)
  {
    
    // Run custom code for Internet Explorer.
    // window.document.write("/404 error");
    alert('Oops ! Its Look Like you are using a UCBrowser.We Blocked the access in it kindly use another browser like chrome.');

    window.location.replace("http://www.ucweb.com/");
  }

 
});
</script>
@endif

<!--------------- end UC browser Block ------------>

<script type="text/javascript">
 function readed(id){

   $.ajax({
    type : 'GET',
    data : { id:id },
    url  : '{{ url('/user/notification/read') }}/'+id,
    success :function(data){
      console.log(data);
    }
  });
 }
 
</script>

<!------ colorbox script ------->

<script>
      $(document).ready(function(){
        
        $(".group1").colorbox({rel:'group1'});
        $(".group2").colorbox({rel:'group2', transition:"fade"});
        $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
        $(".group4").colorbox({rel:'group4', slideshow:true});
        $(".ajax").colorbox();
        $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
        $(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
        $(".iframe").colorbox({iframe:true, width:"100%", height:"100%",controllist:"nodownload"});
        $(".inline").colorbox({inline:true, width:"50%"});
        $(".callbacks").colorbox({
          onOpen:function(){ alert('onOpen: colorbox is about to open'); },
          onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
          onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
          onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
          onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
        });

        $('.non-retina').colorbox({rel:'group5', transition:'none'})
        $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
        
        
        $("#click").click(function(){ 
          $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
          return false;
        });
      });
    </script>

 

   <script src="{{ url('js/slider.js') }}"></script>


<!------- end colorbox script----------->
<!---- facebook chat ------->
@php
  $script = App\ChatSetting::where('key','messanger')->first();
@endphp
@if(isset($script) && $script->enable_messanger == 1)
<script src="{{$script->script}}" async></script>
@endif

<!----- end facebook --------->

</body>
<!--body end -->
</html>

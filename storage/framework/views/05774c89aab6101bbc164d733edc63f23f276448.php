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
  <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e($w_title); ?></title>
  
  <?php echo SEO::generate(); ?>

  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="MobileOptimized" content="320" />    
  <?php echo $__env->yieldContent('custom-meta'); ?>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"><!-- CSRF Token -->

  <link rel="icon" type="image/icon" href="<?php echo e(url('images/favicon/favicon.png')); ?>"> <!-- favicon icon -->
  <link href="<?php echo e(url('css/starrating.css')); ?>" rel="stylesheet" type="text/css"/> 
  <!-- Star Rating -->
  <!-- theme style -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> <!-- google font -->
  <link href="<?php echo e(url('css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css"/> <!-- bootstrap css -->
  <link href="<?php echo e(url('css/menumaker.css')); ?>" type="text/css" rel="stylesheet"> <!-- menu css -->
  <link href="<?php echo e(url('css/owl.carousel.min.css')); ?>" rel="stylesheet" type="text/css"/> <!-- owl carousel css -->
  <link href="<?php echo e(url('css/owl.theme.default.min.css')); ?>" rel="stylesheet" type="text/css"/> <!-- owl carousel css -->
  <link href="<?php echo e(url('css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css"/> <!-- fontawsome css -->
  <link href="<?php echo e(url('css/popover.css')); ?>" rel="stylesheet" type="text/css"/> <!-- bootstrap popover css -->
  <link href="<?php echo e(url('css/layers.css')); ?>" rel="stylesheet" type="text/css"/> <!-- revolution css -->
  <link href="<?php echo e(url('css/navigation.css')); ?>" rel="stylesheet" type="text/css"/> <!-- revolution css -->
  <link href="<?php echo e(url('css/pe-icon-7-stroke.css')); ?>" rel="stylesheet" type="text/css"/> <!-- revolution css -->
  <link href="<?php echo e(url('css/settings.css')); ?>" rel="stylesheet" type="text/css"/> <!-- revolution css -->
  <link rel="stylesheet" href="<?php echo e(url('css/colorbox.css')); ?>">
  <?php if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'): ?>
    <link rel="manifest" href="<?php echo e(url('/manifest.json')); ?>"> 
  <?php endif; ?>
  
  <link rel="stylesheet" href="<?php echo e(url('css/venom-button.min.css')); ?>">

  <?php echo $__env->yieldContent('head-script'); ?>

  
  
  <?php if($color=='default'): ?>
  <?php if($color_dark==1): ?>
  
  <link href="<?php echo e(url('css/style-light.css')); ?>" rel="stylesheet" type="text/css"/>
  <?php else: ?>
   
      <link href="<?php echo e(url('css/style.css')); ?>" rel="stylesheet" type="text/css"/>
 
  
  <?php endif; ?>
  <?php elseif($color=='green'): ?>
  <?php if($color_dark==1): ?>
  
    <link href="<?php echo e(url('css/style-light-green.css')); ?>" rel="stylesheet" type="text/css"/>
  <?php else: ?>
  
   <link href="<?php echo e(url('css/style-green.css')); ?>" rel="stylesheet" type="text/css"/>
  <?php endif; ?>
  <?php elseif($color=='orange'): ?>
  <?php if($color_dark==1): ?>
  
     <link href="<?php echo e(url('css/style-light-orange.css')); ?>" rel="stylesheet" type="text/css"/>
  <?php else: ?>
  
   <link href="<?php echo e(url('css/style-orange.css')); ?>" rel="stylesheet" type="text/css"/>
  <?php endif; ?>
  <?php elseif($color=='yellow'): ?>
  <?php if($color_dark==1): ?>
  
    <link href="<?php echo e(url('css/style-light-yellow.css')); ?>" rel="stylesheet" type="text/css"/>
  <?php else: ?>
  
   <link href="<?php echo e(url('css/style-yellow.css')); ?>" rel="stylesheet" type="text/css"/>
  <?php endif; ?>
   <?php elseif($color=='red'): ?>
  <?php if($color_dark==1): ?>
  
    <link href="<?php echo e(url('css/style-light-red.css')); ?>" rel="stylesheet" type="text/css"/>
  <?php else: ?>
  
   <link href="<?php echo e(url('css/style-red.css')); ?>" rel="stylesheet" type="text/css"/>
  <?php endif; ?>
  <?php elseif($color=='pink'): ?>
  <?php if($color_dark==1): ?>
  
   <link href="<?php echo e(url('css/style-light-pink.css')); ?>" rel="stylesheet" type="text/css"/>
  <?php else: ?>
  
    <link href="<?php echo e(url('css/style-pink.css')); ?>" rel="stylesheet" type="text/css"/>
  <?php endif; ?>
  <?php endif; ?>
  
  <link href="<?php echo e(url('css/custom-style.css')); ?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo e(url('css/goto.css')); ?>" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="<?php echo e(url('content/global.css')); ?>"><!-- go to top css -->
  <script src="//js.stripe.com/v3/"></script> <!-- stripe script -->
  <script type="text/javascript" src="<?php echo e(url('js/jquery.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(url('java/FWDUVPlayer.js')); ?>"></script> <!-- jquery library js -->

  <script>
    window.Laravel =  <?php echo json_encode([
      'csrfToken' => csrf_token(),
      ]); ?>
    </script>
    <script type="text/javascript" src="<?php echo e(url('js/app.js')); ?>"></script> <!-- app library js -->
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
  <?php echo $__env->yieldContent('player-sc'); ?>



  <?php
    if(isset(Auth::user()->paypal_subscriptions)){
        //Run wallet point expire background process
        App\Jobs\CheckUserPlanValidity::dispatchNow();
    }
  ?>

</head>
<!-- end head -->
<!--body start-->
<body>
  <!-- preloader -->
  <?php if($preloader == 1): ?>
  <div class="loading">
    <div class="logo">
      <img src="<?php echo e(url('images/logo/'.$logo)); ?>" class="img-responsive" alt="<?php echo e($w_title); ?>">
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
  <?php endif; ?>
  <!-- end preloader -->
  <div class="body-overlay-bg"></div>

  <?php if(Session::has('added')): ?>
  <div id="sessionModal" class="sessionmodal rgba-green-strong z-depth-2">
    <i class="fa fa-check-circle"></i> <p><?php echo e(session('added')); ?></p>
  </div>
  <?php elseif(Session::has('updated')): ?>
  <div id="sessionModal" class="sessionmodal rgba-cyan-strong z-depth-2">
    <i class="fa fa-exclamation-triangle"></i> <p><?php echo e(session('updated')); ?></p>
  </div>
  <?php elseif(Session::has('deleted')): ?>
  <div id="sessionModal" class="sessionmodal rgba-red-strong z-depth-2">
    <i class="fa fa-window-close"></i> <p><?php echo e(session('deleted')); ?></p>
  </div>
  <?php endif; ?>
  <!-- preloader -->
  <div class="preloader">
    <div class="status">
      <div class="status-message">
      </div>
    </div>
  </div>

 <?php
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

?>

<!-- end preloader -->
<!-- navigation -->
<div class="navigation">
  <div class="container-fluid nav-container">
    <div class="row">
      <div class="col-sm-2 col-md-1 col-lg-2">
        <div class="nav-logo">
           <a href="<?php echo e(url('/')); ?>" title="<?php echo e($w_title); ?>"><img src="<?php echo e(url('images/logo/'.$logo)); ?>" class="img-responsive" alt="<?php echo e($w_title); ?>"></a>
        </div>
      </div>
     <div class="col-sm-4 col-md-5 col-lg-4">
        <?php if($catlog==1): ?>
          <div id="cssmenu">
            <?php if(isset($menuh) || isset($custom_page)): ?>
            <ul>
              <?php if(isset($menuh) && count($menuh) > 0): ?>
                <?php $__currentLoopData = $menuh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($auth && $subscribed ==1): ?>
                  
                    <li>
                      <a class="<?php echo e(Nav::hasSegment($menus->slug)); ?>" href="<?php echo e(url('/', $menus->slug)); ?>"  title="<?php echo e($menus->name); ?>">
                        <?php echo e($menus->name); ?>

                      </a>
                    </li>
                  <?php else: ?>
                   
                    <li>
                      <a class="<?php echo e(Nav::hasSegment($menus->slug)); ?>" href="<?php echo e(url('/guest', $menus->slug)); ?>"  title="<?php echo e($menus->name); ?>">
                        <?php echo e($menus->name); ?>

                      </a>
                    </li>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
              
              <?php if(isset($custom_page) && count($custom_page) >0): ?>
                <?php $__currentLoopData = $custom_page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(isset($custom)): ?>
                    <li>
                      <a class="<?php echo e(Nav::hasSegment($custom->slug)); ?>" href="<?php echo e(url('/page', $custom->slug)); ?>"  title="<?php echo e($custom->title); ?>">
                        <?php echo e($custom->title); ?>

                      </a>
                    </li>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
              <?php endif; ?>
              
            </ul>
            <?php endif; ?>
          </div>
        <?php elseif($catlog == 0 && $subscribed == 1): ?>
          <div id="cssmenu">

            <?php if(isset($menuh) ): ?>
              <ul>
                <?php if(isset($menuh) && count($menuh) > 0): ?>
                  <?php $__currentLoopData = $menuh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                      <a class="<?php echo e(Nav::hasSegment($menus->slug)); ?>" href="<?php echo e(url('/', $menus->slug)); ?>"  title="<?php echo e($menus->name); ?>">
                        <?php echo e($menus->name); ?>

                      </a>
                    </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              
                <?php if(isset($custom_page) && count($custom_page) >0): ?>
                  <?php $__currentLoopData = $custom_page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($custom)): ?>
                      <li>
                        <a class="<?php echo e(Nav::hasSegment($custom->slug)); ?>" href="<?php echo e(url('/page', $custom->slug)); ?>"  title="<?php echo e($custom->title); ?>">
                          <?php echo e($custom->title); ?>

                        </a>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                <?php endif; ?>
                <li><a>...</a></li>
              </ul>
            <?php endif; ?>
          </div>
        <?php endif; ?>
     </div>
      <div class="col-sm-6 col-md-6 col-lg-6 pull-right">
        <div class="login-panel-main-block small-screen-block">
          <ul>
          	<?php if(auth()->guard()->check()): ?>
            <?php if($catlog == 0 && $subscribed == 1): ?>
              <li class="prime-search-block">
                <a href="#find"><i class="fa fa-search"></i></a>
              </li>
            <?php elseif($catlog == 1): ?>
              <li class="prime-search-block">
                <a href="#find"><i class="fa fa-search"></i></a>
              </li>
            <?php endif; ?>
            <?php endif; ?>
          
            <!-- notificaion -->
            <?php if(auth()->guard()->check()): ?>
            <?php if($subscribed == 1): ?>
            <li> 
              <div id="ex4" class="dropdown prime-dropdown">

                <span class="p1 fa-stack fa-2x has-badge dropdown-toggle" type="button" data-toggle="dropdown" data-count="<?php echo e(auth()->user()->unreadnotifications->count()); ?>">

                  <i class="p3 fa fa-bell-o fa-stack-1x xfa-inverse" data-count="4b"></i>

                </span>

                <ul class="dropdown-menu prime-dropdown-menu">

                  <?php $__currentLoopData = auth()->user()->unreadnotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <li>
                      <?php
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
                      ?>
                      <div id="notification_id" onclick="readed('<?php echo e($n->id); ?>')" class="card" style="padding: 6px;" >
                        <p style="color: #2980b9; font-size: 17px; padding: 3px;"><b> <?php echo e($n->title); ?></b></p>
                        <p style="margin-top: -6px; font-size: 16px;"> <?php echo e($n->data['data']); ?> &nbsp; 
                          <?php if(isset($tv)): ?>
                            <a type="button" href="<?php echo e(url('show/detail',$season->id)); ?>" style="font-size: 16px; color:  #a9ea81">
                              <b> "<?php echo e($tv->title); ?>"</b></a>
                          <?php endif; ?> 
                          &nbsp;
                          <?php if(isset($moviename)): ?>
                            <a type="button" href="<?php echo e(url('movie/detail', $n->movie_id)); ?>" style="font-size: 16px;color: #a9ea81">
                              <b> "<?php echo e($moviename); ?>"</b>
                            </a>
                          <?php endif; ?> 
                        </p>

                      </div>
                      <hr style="margin-top: 1px;">
                    </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div> 
            </li>
            <?php endif; ?>
            <?php if(isset($languages) && count($languages) > 1): ?>
              <?php if(count($languages) > 1): ?>
                <li class="sign-in-block language-switch-block">
                <div class="dropdown prime-dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-globe"></i> <?php echo e(Session::has('changed_language') ? ucfirst(Session::get('changed_language')) : ''); ?></button>
                  <span class="caret caret-one"></span></button>
                  <ul class="dropdown-menu prime-dropdown-menu">
                  
                     <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <li>

                      <a href="<?php echo e(route('languageSwitch', $language->local)); ?>">
                        <?php echo e($language->name); ?> 
                      </a>
                    </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  
                  </ul>
                </div>
                </li>
              <?php endif; ?>
            <?php endif; ?>
            <li class="sign-in-block">
              <div class="dropdown prime-dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user-circle"></i> <?php if(Session::has('nickname')): ?> <?php echo e(Session::get('nickname')); ?> <?php else: ?> <?php echo e($auth ? $auth->name : ''); ?> <?php endif; ?>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu prime-dropdown-menu">
                    <?php if($auth->is_admin == 1): ?>
                      <li><a href="<?php echo e(url('admin')); ?>" target="_blank"><?php echo e(__('staticwords.AdminDashboard')); ?></a></li>
                    <?php endif; ?>
                    <?php if($auth->is_assistant == 1): ?>
                      <li>
                        <a href="<?php echo e(url('admin/movies')); ?>" target="_blank"> <?php echo e(__('staticwords.ProducerDashboard')); ?></a>
                      </li>
                    <?php endif; ?>
                    <?php if($subscribed == 1): ?>

                      <li><a href="<?php echo e(route('protectedvideo')); ?>"><?php echo e(__('staticwords.protectedcontent')); ?></a></li>
                      <li><a href="<?php echo e(route('watchhistory')); ?>" ><?php echo e(__('staticwords.watchhistory')); ?></a></li>


                    <?php else: ?>
                     
                      <li><a href="<?php echo e(url('account/purchaseplan')); ?>"><?php echo e(__('staticwords.subscribe')); ?></a></li>
                    <?php endif; ?>
                   
                   
                     <?php if($catlog == 0 && $subscribed == 1): ?>
                        <?php if(isset($nav_menus)): ?>
                          <?php $__currentLoopData = $nav_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(url('account/watchlist', $menu->slug)); ?>" class="active"><?php echo e(__('staticwords.watchlist')); ?></a></li>
                            <?php break; ?>;
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      <?php elseif($catlog ==1): ?>
                         <?php if(isset($menuh)): ?>
                          <?php $__currentLoopData = $menuh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(url('account/watchlist', $menu1->slug)); ?>" class="active"><?php echo e(__('staticwords.watchlist')); ?></a></li>
                            <?php break; ?>;
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    <li><a href="<?php echo e(url('account')); ?>"><?php echo e(__('staticwords.dashboard')); ?></a></li>
                    <?php if(isset(Auth::user()->paypal_subscriptions) && $subscribed == 1 && $config->blog==1): ?>
                      <li><a href="<?php echo e(url('account/blog')); ?>"><?php echo e(__('staticwords.blog')); ?></a></li>
                    <?php endif; ?>
                    <?php if(isset(Auth::user()->paypal_subscriptions) && $subscribed == 1): ?>
                      <li><a href="<?php echo e(url('/manageprofile/mus/'.Auth::user()->id)); ?>"><?php echo e(__('staticwords.manageprofile')); ?></a></li>
                    <?php endif; ?>
                      <?php
                        $data=App\Config::findOrFail(1);
                        $donation= $data->donation;
                        $donation_link=$data->donation_link;
                      ?>
                    <?php if(!is_null($donation) && !is_null($donation_link) && $donation==1): ?>
                      <li><a target="_blank" href="<?php echo e($donation_link); ?>"><?php echo e(__('staticwords.donation')); ?></a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo e(url('faq')); ?>"><?php echo e(__('staticwords.faq')); ?></a></li>

                    <li>
                      <a href="<?php echo e(route('custom.logout')); ?>">
                      <?php echo e(__('staticwords.signout')); ?>

                     </a>
                     
                  </li>
                </ul>
              </div>
            </li>
            <?php else: ?>

            <li class="sign-in-block sign-in-block-one sign-in-block-two mrgn-rt-20"><a class="sign-in" href="<?php echo e(url('login')); ?>"><i class="fa fa-sign-in"></i> <?php echo e(__('staticwords.signin')); ?></a></li>
            <li class="sign-in-block sign-in-block-one "><a class="sign-in" href="<?php echo e(url('register')); ?>"><i class="fa fa-user-plus"></i><?php echo e(__('staticwords.register')); ?></a></li>
            <?php endif; ?>
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
      <?php if(auth()->guard()->check()): ?>
      <?php if($catlog == 0 && $subscribed == 1): ?>
        <div class="prime-search-block">
          <a href="#find"><i class="fa fa-search"></i></a>
        </div>
      <?php elseif($catlog == 1): ?>
        <div class="prime-search-block">
          <a href="#find"><i class="fa fa-search"></i></a>
        </div>
      <?php endif; ?>
      <?php endif; ?>
      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <h3 class="wrapper-heading">Menu</h3>
            <ul class="nav sidebar-nav">
                <?php if($catlog==1): ?>
                    <?php if(isset($menuh) || isset($custom_page)): ?>
                      <?php if(isset($menuh) && count($menuh) > 0): ?>
                        <?php $__currentLoopData = $menuh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($auth && $subscribed ==1): ?>
                            <li>
                              <a class="<?php echo e(Nav::hasSegment($menus->slug)); ?>" href="<?php echo e(url('/', $menus->slug)); ?>"  title="<?php echo e($menus->name); ?>">
                                <?php echo e($menus->name); ?>

                              </a>
                            </li>
                          <?php else: ?>
                            <li>
                              <a class="<?php echo e(Nav::hasSegment($menus->slug)); ?>" href="<?php echo e(url('/guest', $menus->slug)); ?>"  title="<?php echo e($menus->name); ?>">
                                <?php echo e($menus->name); ?>

                              </a>
                            </li>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                      <?php if(isset($custom_page) && count($custom_page) >0): ?>
                        <?php $__currentLoopData = $custom_page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if(isset($custom)): ?>
                            <li>
                              <a class="<?php echo e(Nav::hasSegment($custom->slug)); ?>" href="<?php echo e(url('/page', $custom->slug)); ?>"  title="<?php echo e($custom->title); ?>">
                                <?php echo e($custom->title); ?>

                              </a>
                            </li>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                      <?php endif; ?>
                 
                    <?php endif; ?>
                <?php elseif($catlog == 0 && $subscribed == 1): ?>
                  <?php if(isset($menuh) ): ?>
                      <?php if(isset($menuh) && count($menuh) > 0): ?>
                        <?php $__currentLoopData = $menuh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li>
                            <a class="<?php echo e(Nav::hasSegment($menus->slug)); ?>" href="<?php echo e(url('/', $menus->slug)); ?>"  title="<?php echo e($menus->name); ?>">
                              <?php echo e($menus->name); ?>

                            </a>
                          </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    
                      <?php if(isset($custom_page) && count($custom_page) >0): ?>
                        <?php $__currentLoopData = $custom_page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if(isset($custom)): ?>
                            <li>
                              <a class="<?php echo e(Nav::hasSegment($custom->slug)); ?>" href="<?php echo e(url('/page', $custom->slug)); ?>"  title="<?php echo e($custom->title); ?>">
                                <?php echo e($custom->title); ?>

                              </a>
                            </li>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                      <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>




             
              <!-- notificaion -->
            <?php if(auth()->guard()->check()): ?>
            <?php if($subscribed == 1): ?>
            <li> 
              <div id="ex4" class="dropdown prime-dropdown">

                <span class="p1 fa-stack fa-2x has-badge dropdown-toggle" type="button" data-toggle="dropdown" data-count="<?php echo e(auth()->user()->unreadnotifications->count()); ?>">

                  <i class="p3 fa-stack-1x xfa-inverse" data-count="4b">Notification</i>

                </span>

                <ul class="dropdown-menu prime-dropdown-menu">

                  <?php $__currentLoopData = auth()->user()->unreadnotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <li>
                      <?php
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
                      ?>
                      <div id="notification_id" onclick="readed('<?php echo e($n->id); ?>')" class="card" style="padding: 6px;" >
                        <p style="color: #2980b9; font-size: 17px; padding: 3px;"><b> <?php echo e($n->title); ?></b></p>
                        <p style="margin-top: -6px; font-size: 16px;"> <?php echo e($n->data['data']); ?> &nbsp; 
                          <?php if(isset($tv)): ?>
                            <a type="button" href="<?php echo e(url('show/detail',$season->id)); ?>" style="font-size: 16px; color:  #a9ea81">
                              <b> "<?php echo e($tv->title); ?>"</b></a>
                          <?php endif; ?> 
                          &nbsp;
                          <?php if(isset($moviename)): ?>
                            <a type="button" href="<?php echo e(url('movie/detail', $n->movie_id)); ?>" style="font-size: 16px;color: #a9ea81">
                              <b> "<?php echo e($moviename); ?>"</b>
                            </a>
                          <?php endif; ?> 
                        </p>

                      </div>
                      <hr style="margin-top: 1px;">
                    </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div> 
            </li>
            <?php endif; ?>
            <?php if(isset($languages) && count($languages) > 1): ?>
              <?php if(count($languages) > 1): ?>
                <li class="sign-in-block language-switch-block">
                <div class="dropdown prime-dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-globe"></i> <?php echo e(Session::has('changed_language') ? ucfirst(Session::get('changed_language')) : ''); ?></button>
                  <span class="caret caret-one"></span></button>
                  <ul class="dropdown-menu prime-dropdown-menu">
                  
                     <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <li>

                      <a href="<?php echo e(route('languageSwitch', $language->local)); ?>">
                        <?php echo e($language->name); ?> 
                      </a>
                    </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  
                  </ul>
                </div>
                </li>
              <?php endif; ?>
            <?php endif; ?>
            <li class="sign-in-block">
              <div class="dropdown prime-dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user-circle"></i> <?php if(Session::has('nickname')): ?> <?php echo e(Session::get('nickname')); ?> <?php else: ?> <?php echo e($auth ? $auth->name : ''); ?> <?php endif; ?>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu prime-dropdown-menu">
                    <?php if($auth->is_admin == 1): ?>
                      <li><a href="<?php echo e(url('admin')); ?>" target="_blank"><?php echo e(__('staticwords.AdminDashboard')); ?></a></li>
                    <?php endif; ?>
                    <?php if($auth->is_assistant == 1): ?>
                      <li>
                        <a href="<?php echo e(url('admin/movies')); ?>" target="_blank"> <?php echo e(__('staticwords.ProducerDashboard')); ?></a>
                      </li>
                    <?php endif; ?>
                    <?php if($subscribed == 1): ?>
                      <li><a href="<?php echo e(route('protectedvideo')); ?>"><?php echo e(__('staticwords.protectedcontent')); ?></a></li>
                      <li><a href="<?php echo e(route('watchhistory')); ?>" ><?php echo e(__('staticwords.watchhistory')); ?></a></li>
                    <?php else: ?>
                     
                      <li><a href="<?php echo e(url('account/purchaseplan')); ?>"><?php echo e(__('staticwords.subscribe')); ?></a></li>
                    <?php endif; ?>
                   
                   
                     <?php if($catlog == 0 && $subscribed == 1): ?>
                        <?php if(isset($nav_menus)): ?>
                          <?php $__currentLoopData = $nav_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(url('account/watchlist', $menu->slug)); ?>" class="active"><?php echo e(__('staticwords.watchlist')); ?></a></li>
                            <?php break; ?>;
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      <?php elseif($catlog ==1): ?>
                         <?php if(isset($menuh)): ?>
                          <?php $__currentLoopData = $menuh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(url('account/watchlist', $menu1->slug)); ?>" class="active"><?php echo e(__('staticwords.watchlist')); ?></a></li>
                            <?php break; ?>;
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    <li><a href="<?php echo e(url('account')); ?>"><?php echo e(__('staticwords.dashboard')); ?></a></li>
                    <?php if(isset(Auth::user()->paypal_subscriptions) && $subscribed == 1 && $config->blog==1): ?>
                      <li><a href="<?php echo e(url('account/blog')); ?>"><?php echo e(__('staticwords.blog')); ?></a></li>
                    <?php endif; ?>
                    <?php if(isset(Auth::user()->paypal_subscriptions) && $subscribed == 1): ?>
                      <li><a href="<?php echo e(url('/manageprofile/mus/'.Auth::user()->id)); ?>"><?php echo e(__('staticwords.manageprofile')); ?></a></li>
                    <?php endif; ?>
                      <?php
                        $data=App\Config::findOrFail(1);
                        $donation= $data->donation;
                        $donation_link=$data->donation_link;
                      ?>
                    <?php if(!is_null($donation) && !is_null($donation_link) && $donation==1): ?>
                      <li><a target="_blank" href="<?php echo e($donation_link); ?>"><?php echo e(__('staticwords.donation')); ?></a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo e(url('faq')); ?>"><?php echo e(__('staticwords.faq')); ?></a></li>

                    <li>
                      <a href="<?php echo e(route('custom.logout')); ?>">
                      <?php echo e(__('staticwords.signout')); ?>

                     </a>
                     
                  </li>
                </ul>
              </div>
            </li>
            <?php else: ?>

            <li class="sign-in-block sign-in-block-one sign-in-block-two mrgn-rt-20"><a class="sign-in" href="<?php echo e(url('login')); ?>"><i class="fa fa-sign-in"></i> <?php echo e(__('staticwords.signin')); ?></a></li>
            <li class="sign-in-block sign-in-block-one "><a class="sign-in" href="<?php echo e(url('register')); ?>"><i class="fa fa-user-plus"></i><?php echo e(__('staticwords.register')); ?></a></li>
            <?php endif; ?>
            </ul>
      </nav>
</div>
<div id="find">
  <div class="themesearch">
    <button type="button" class="close">×</button>
     <?php echo Form::open(['method' => 'GET', 'action' => 'HomeController@search', 'class' => 'search_form']); ?>

      <a href="<?php echo e(url()->previous()); ?>"><i class="fa fa-arrow-left searcharrow"></i></a>  
        <input type="find"  name="search" value="" placeholder="Type something to search.." />
       
        <button type="submit" class="btn btn-outline-info btn_sm">Search</button>
     <?php echo Form::close(); ?>

  </div>
</div>


<?php if($auth): ?>
   <?php if($subscribed != 1): ?>
    <div class="purchase-sticky">
     <p><?php echo e(__('staticwords.pleasesubscribetoaplan')); ?> &nbsp;<a href="<?php echo e(url('account/purchaseplan')); ?>" style="color: #1B1464;"><button class="btn btn-sm text-white agree_btn js-cookie-consent-agree cookie-consent__agree"><?php echo e(__('staticwords.clickhere')); ?></button></a></p>
    </div>
  <?php endif; ?>
<?php endif; ?>



<!-- end navigation -->
<?php echo $__env->yieldContent('main-wrapper'); ?>

<!-- footer -->
<?php if($prime_footer == 1): ?>
<footer id="prime-footer" class="prime-footer-main-block">
  <div class="container-fluid">
    <div style="height:0px;">
      <a id="back2Top" title="Back to top" href="#">&#10148;</a>
    </div>
    <div class="logo">
      <img src="<?php echo e(url('images/logo/'.$logo)); ?>" class="img-responsive" alt="<?php echo e($w_title); ?>">
    </div>

    <div class="text-center">
      <?php
        $si = App\SocialIcon::first();
      ?>
      <div class="footer-widgets social-widgets social-btns">
        <ul>
          <?php if(isset( $si->url1)): ?><li><a href="<?php echo e($si->url1); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
          <?php if(isset($si->url2)): ?><li><a href="<?php echo e($si->url2); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
          <?php if(isset($si->url3)): ?><li><a href="<?php echo e($si->url3); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li><?php endif; ?>
        </ul>
      </div>
    </div>
    <?php
      $config=App\Config::first();
      $isplay=$config->is_playstore;
      $isappstore=$config->is_appstore;
      $appstore=$config->appstore;
      $playstore=$config->playstore;
    ?>
    <div class="text-center">
      <div class="footer-widgets social-widgets social-btns">
        <ul>
         <?php if($isappstore==1 &&  $isappstore != NULL): ?>
         <li> <a href="<?php echo e($appstore); ?>" target="_blank"> <img width="12%" height="12%" src="<?php echo e(url('images/app_store_download.png')); ?>"></a></li>
         <?php endif; ?>
         <?php if($isplay==1 && $isplay != NULL): ?>
         <li>
           <a href="<?php echo e($playstore); ?>"  target="_blank"> <img  width="12%" height="12%" src="<?php echo e(url('images/google_play_download.png')); ?>"></a>
         </li>
         <?php endif; ?>
       </ul>
      </div>
    </div>

    <div class="copyright">
      <ul>
        <li>
          <?php if(isset($copyright)): ?>
          &copy;<?php echo e(date('Y')); ?> <?php echo $copyright; ?>

          <?php endif; ?>
        </li>
      </ul>
      <ul>
        <?php if(isset($config->terms_condition) && $config->terms_condition != NULL): ?>
          <li><a href="<?php echo e(url('terms_condition')); ?>"><?php echo e(__('staticwords.termsandcondition')); ?></a></li>
        <?php endif; ?>
        <?php if(isset($config->privacy_pol) && $config->privacy_pol != NULL): ?>
          <li><a href="<?php echo e(url('privacy_policy')); ?>"><?php echo e(__('staticwords.privacypolicy')); ?></a></li>
        <?php endif; ?>
        <?php if(isset($config->refund_pol) && $config->refund_pol != NULL): ?>
          <li><a href="<?php echo e(url('refund_policy')); ?>"><?php echo e(__('staticwords.refundpolicy')); ?></a></li>
        <?php endif; ?>
        <li><a href="<?php echo e(url('faq')); ?>"><?php echo e(__('staticwords.help')); ?></a></li>
        <li><a href="<?php echo e(url('contactus')); ?>"><?php echo e(__('staticwords.contactus')); ?></a></li>
      </ul>
    </div>
  </div>
</footer>
<?php else: ?>
<footer id="footer-main-block" class="footer-main-block">
  <div class="pre-footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="footer-logo footer-widgets">
            <?php if(isset($logo)): ?>
            <img src="<?php echo e(url('images/logo/'.$logo)); ?>" class="img-responsive" alt="<?php echo e($w_title); ?>">
            <?php endif; ?>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="footer-widgets">
            <div class="row">
              <div class="col-md-6">
                <div class="footer-links-block">
                  <h4 class="footer-widgets-heading"><?php echo e(__('staticwords.corporate')); ?></h4>
                  <ul>
                    <?php
                      $config = App\Config::first();
                    ?>
                      <?php if(isset($config->terms_condition) && $config->terms_condition != NULL): ?>
                    <li><a href="<?php echo e(url('terms_condition')); ?>"><?php echo e(__('staticwords.termsandcondition')); ?></a></li>
                    <?php endif; ?>
                      <?php if(isset($config->privacy_policy) && $config->privacy_policy != NULL): ?>
                    <li><a href="<?php echo e(url('privacy_policy')); ?>"><?php echo e(__('staticwords.privacypolicy')); ?></a></li>
                    <?php endif; ?>
                      <?php if(isset($config->refund_policy) && $config->refund_policy != NULL): ?>
                    <li><a href="<?php echo e(url('refund_policy')); ?>"><?php echo e(__('staticwords.refundpolicy')); ?></a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo e(url('faq')); ?>"><?php echo e(__('staticwords.help')); ?></a></li>

                  </ul>
                </div>
              </div>
              <div class="col-md-6">
                <div class="footer-links-block">
                  <h4 class="footer-widgets-heading"><?php echo e(__('staticwords.sitemap')); ?></h4>
                  <ul>
                  
                    <?php
                      $memu = App\Menu::all();
                    ?>
                    <?php if(isset($memu)): ?>
                      <?php $__currentLoopData = $memu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($value->slug != null ||$value->slug != ''): ?>  
                              <?php $mySlug = $value->slug; ?>
                               <li><a href="<?php echo e(url($mySlug)); ?>"><?php echo e($value->name); ?></a></li>
                        <?php endif; ?>      
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-widgets subscribe-widgets">
            <h4 class="footer-widgets-heading"><?php echo e(__('staticwords.subscribe')); ?></h4>
            <p class="subscribe-text"><?php echo e(__('staticwords.subscribetext')); ?></p>
            <?php echo Form::open(['method' => 'POST', 'action' => 'emailSubscribe@subscribe']); ?>

            <?php echo e(csrf_field()); ?>

            <div class="form-group">
              <input type="email" name="email" class="form-control subscribe-input" placeholder="Enter your e-mail">
              <button type="submit" class="subscribe-btn"><i class="fa fa-long-arrow-alt-right" style="color:red;"></i></button>
            </div>
            <?php echo Form::close(); ?>

          </div>
        </div>
        <div class="col-md-2">
          <?php
          $si = App\SocialIcon::first();
          ?>
          <div class="footer-widgets social-widgets social-btns">
            <ul>
              <?php if(isset( $si->url1)): ?><li><a href="<?php echo e($si->url1); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
              <?php if(isset($si->url2)): ?><li><a href="<?php echo e($si->url2); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
              <?php if(isset($si->url3)): ?><li><a href="<?php echo e($si->url3); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li><?php endif; ?>
              <?php
              $config=App\Config::first();
              $isplay=$config->is_playstore;
              $isappstore=$config->is_appstore;
              $appstore=$config->appstore;
              $playstore=$config->playstore;
              ?>
              
              <?php if($isappstore==1 && $isappstore != NULL): ?>
              <li> <a href="<?php echo e($appstore); ?>" target="_blank"> <img width="72%" height="72%" src="<?php echo e(url('images/app_store_download.png')); ?>"></a></li>
              <?php endif; ?>
              <?php if($isplay==1 && isplay != NULL): ?>
              <li>
               <a href="<?php echo e($playstore); ?>"  target="_blank"> <img  width="72%" height="72%" src="<?php echo e(url('images/google_play_download.png')); ?>"></a>
             </li>
             <?php endif; ?>
             
           </ul>
         </div>
       </div>
     </div>
   </div>

 </div>

  <div class="container-fluid">
    <div class="copyright-footer">
      <?php if(isset($copyright)): ?>
     &copy;<?php echo e(date('Y')); ?> <?php echo $copyright; ?>

      <?php endif; ?>
    </div>
  </div>
</footer>

<?php endif; ?>
<!-- end footer -->

<div id="myButton"></div>

<!-- jquery -->
<script type="text/javascript" src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script> <!-- bootstrap js -->
<script type="text/javascript" src="<?php echo e(url('js/jquery.popover.js')); ?>"></script> <!-- bootstrap popover js -->
<script type="text/javascript" src="<?php echo e(url('js/menumaker.js')); ?>"></script> <!-- menumaker js -->
<script type="text/javascript" src="<?php echo e(url('js/jquery.curtail.min.js')); ?>"></script> <!-- menumaker js -->
<script type="text/javascript" src="<?php echo e(url('js/owl.carousel.min.js')); ?>"></script> <!-- owl carousel js -->
<script type="text/javascript" src="<?php echo e(url('js/jquery.scrollSpeed.js')); ?>"></script> <!-- owl carousel js -->
<script type="text/javascript" src="<?php echo e(url('js/TweenMax.min.js')); ?>"></script> <!-- animation gsap js -->
<script type="text/javascript" src="<?php echo e(url('js/ScrollMagic.min.js')); ?>"></script> <!-- custom js -->
<script type="text/javascript" src="<?php echo e(url('js/animation.gsap.min.js')); ?>"></script> <!-- animation gsap js -->
<script type="text/javascript" src="<?php echo e(url('js/modernizr-custom.js')); ?>"></script> <!-- debug addIndicators js -->
<script type="text/javascript" src="<?php echo e(url('js/theme.js')); ?>"></script> <!-- custom js -->
<script type="text/javascript" src="<?php echo e(url('js/custom-js.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('js/colorbox.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('js/checkit.js')); ?>"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

<!-- venomem -->
<script type="text/javascript" src="<?php echo e(url('js/venom-button.min.js')); ?>"></script>

<!-- end jquery -->
<?php echo $__env->yieldContent('custom-script'); ?>
<?php echo $__env->yieldContent('script'); ?>

<!-- cookie -->
<?php echo $__env->make('cookieConsent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- end cookie -->
 <?php
    $chat = App\ChatSetting::where('key','whatsapp')->first();
  ?>

<?php if(isset($chat) && $chat->enable_whatsapp == 1): ?>
<!-- whatsapp chat -->
<script type="text/javascript">

    $('#myButton').venomButton({
        phone: <?php echo e($chat->mobile); ?>,
        popupMessage: <?php echo e($chat->text); ?>,
        message: "",
        showPopup: true,
        position: "right",
        linkButton: false,
        showOnIE: false,
        heigth:<?php echo e($chat->size); ?>,
        width:<?php echo e($chat->size); ?>,
        headerTitle: <?php echo e($chat->header); ?>,
        headerColor: <?php echo e($chat->color); ?>,
        backgroundColor: '#25d366',
        buttonImage: '<img src="<?php echo e(url('/images/whatsapp.svg')); ?>" />'
    });

</script>
<?php endif; ?>
<!-- end whatsapp chat -->

<script>
$(function(){
  $('.hamburger').on('click',function(){
    $('#wrapper').addClass("toggled");
  })
});
</script>


<?php if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'): ?>
  <script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('<?php echo e(url('sw.js')); ?>')
          .then((reg) => {
            console.log('Service worker registered.', reg);
          });
    });
  }
  </script>
<?php endif; ?>
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

<?php if($google): ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo e($google); ?>', 'auto');
  ga('send', 'pageview');

</script>
<?php endif; ?>
<?php if($fb): ?>
<!-- facebook pixel -->
<script>
  !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
      document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?php echo e($fb); ?>');
    fbq('track', 'PageView');
  </script>
  <!--End facebook pixel -->
  <?php endif; ?>

  <?php if($rightclick == 1): ?>
  <script type="text/javascript" language="javascript">
// Right click disable
$(function() {
  $(this).bind("contextmenu", function(inspect) {
    inspect.preventDefault();
  });
});
// End Right click disable
</script>
<?php endif; ?>

<?php if($inspect == 1): ?>
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
<?php endif; ?>


<?php if($goto==1): ?>
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
<?php endif; ?>
 
<!---------------- UC browser block --------------->
<?php if($uc_browser =="1"): ?>
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
<?php endif; ?>

<!--------------- end UC browser Block ------------>

<script type="text/javascript">
 function readed(id){

   $.ajax({
    type : 'GET',
    data : { id:id },
    url  : '<?php echo e(url('/user/notification/read')); ?>/'+id,
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

 

   <script src="<?php echo e(url('js/slider.js')); ?>"></script>


<!------- end colorbox script----------->
<!---- facebook chat ------->
<?php
  $script = App\ChatSetting::where('key','messanger')->first();
?>
<?php if(isset($script) && $script->enable_messanger == 1): ?>
<script src="<?php echo e($script->script); ?>" async></script>
<?php endif; ?>

<!----- end facebook --------->

</body>
<!--body end -->
</html>
<?php /**PATH S:\laragon\www\dummywebapp\resources\views/layouts/theme.blade.php ENDPATH**/ ?>
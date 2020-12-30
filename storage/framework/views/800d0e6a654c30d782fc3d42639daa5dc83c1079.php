<?php $__env->startSection('title',"Search result for $searchKey"); ?>
<?php $__env->startSection('main-wrapper'); ?>
  <!-- main wrapper -->
<?php
 $withlogin= App\Config::findOrFail(1)->withlogin;
 $auth=Auth::user();
   $subscribed = null;

  
  if (isset($auth)) {

    $current_date = date("d/m/y");
        
    $auth = Illuminate\Support\Facades\Auth::user();
    if ($auth->is_admin == 1) {
      $subscribed = 1;
    } else if ($auth->stripe_id != null) {
      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      if(isset($invoices) && $invoices != null && count($invoices->data) > 0)
      
      {
      $user_plan_end_date = date("d/m/y", $invoice->lines->data[0]->period->end);
      $plans = App\Package::all();
      foreach ($plans as $key => $plan) {
        if ($auth->subscriptions($plan->plan_id)) {
         
        if($current_date <= $user_plan_end_date)
        {
        
            $subscribed = 1;
        }
            
        }
      } 
      }
      
      
    } else if (isset($auth->paypal_subscriptions)) {  
      //Check Paypal Subscription of user
      $last_payment = $auth->paypal_subscriptions->last();
      if (isset($last_payment) && $last_payment->status == 1) {
        //check last date to current date
        $current_date = Illuminate\Support\Carbon::now();
        if (date($current_date) <= date($last_payment->subscription_to)) {
          $subscribed = 1;
        }
      }
    }
  }

?>
  <section class="main-wrapper main-wrapper-single-movie-prime">
    <?php if(isset($filter_video)): ?>
      <?php if(count($filter_video) > 0): ?>

        <div class="container-fluid movie-series-section search-section">
           <?php if(isset($actor)): ?>
              <div class="movie-series-block">
                <div class="row">
                  <div class="col-sm-3">

                    <div class="movie-series-img">
                      <?php if(!is_null($actor->image)): ?>
                        <img data-src="<?php echo e(asset('images/actors/'.$actor->image)); ?>" class="img-responsive actor_image lazy" alt="genre-image">
                      <?php else: ?>
                        <img data-src="<?php echo e(asset('images/default-thumbnail.jpg')); ?>" class="img-responsive actor_image lazy" alt="genre-image">
                     
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-sm-7 pad-0">
                    <h5 class="movie-series-heading movie-series-name">
                        
                        <?php echo e($actor->name); ?>

                    
                    </h5>
                      <p>
                      <?php echo e(__('staticwords.dob')); ?>- <?php echo e($actor->DOB); ?> </p>
                    <p>
                       <?php echo e(__('staticwords.placeofbirth')); ?>- <?php echo e($actor->place_of_birth); ?> </p>
                   
                   
                    <p>
                    
                        <?php echo e($actor->biography); ?>

                    
                    </p>
                  </div>
                </div>
              </div>
              
            <h5 class="movie-series-heading"><?php echo e(count($filter_video)); ?> <?php echo e(__('staticwords.foundfor')); ?> "<?php echo e($searchKey); ?>"</h5>
            <div>
         
    
            <?php endif; ?>

            <?php if(isset($director)): ?>
                       <div class="movie-series-block">
                <div class="row">
                  <div class="col-sm-3">

                    <div class="movie-series-img">
                      <?php if(!is_null($director->image)): ?>
                        <img data-src="<?php echo e(asset('images/directors/'.$director->image)); ?>" class="img-responsive actor_image lazy" alt="Director-image">
                      <?php else: ?>
                        <img data-src="<?php echo e(asset('images/default-thumbnail.jpg')); ?>" class="img-responsive actor_image lazydata-src" alt="genre-image">
                     
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-sm-7 pad-0">
                    <h5 class="movie-series-heading movie-series-name">
                        
                        <?php echo e($director->name); ?>

                    
                    </h5>
                      <p>
                      <?php echo e(__('staticwords.dob')); ?>- <?php echo e($director->DOB); ?> </p>
                    <p>
                       <?php echo e(__('staticwords.placeofbirth')); ?>- <?php echo e($director->place_of_birth); ?> </p>
                   
                   
                    <p>
                    
                        <?php echo e($director->biography); ?>

                    
                    </p>
                  </div>
                </div>
              </div>
          <h5 class="movie-series-heading"><?php echo e(count($filter_video)); ?> <?php echo e(__('staticwords.foundfor')); ?> "<?php echo e($searchKey); ?>"</h5>
          <div>
         
    
            <?php endif; ?>
            <?php $__currentLoopData = $filter_video->unique('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <?php
              
              if($auth){
                if ($item->type == 'M')
                {
                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['movie_id', '=', $item->id],
                                                                           ])->first();
                } else {
                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['season_id', '=', $item->id],
                                                                           ])->first();
                }
              }
              ?>

            
              <div class="movie-series-block">
                <div class="row">
                  <div class="col-sm-3">

                    <div class="movie-series-img">
                      <?php if($item->type == 'M' && $item->thumbnail != null): ?>
                        <img data-src="<?php echo e(asset('images/movies/thumbnails/'.$item->thumbnail)); ?>" class="img-responsive lazy" alt="genre-image">
                      <?php elseif($item->type == 'M' && $item->thumbnail == null): ?>
                        <img data-src="<?php echo e(asset('images/default-thumbnail.jpg')); ?>" class="img-responsive lazy" alt="genre-image">
                      <?php elseif($item->type == 'S'): ?>
                        <?php if($item->thumbnail != null): ?>
                          <img data-src="<?php echo e(asset('images/tvseries/thumbnails/'.$item->thumbnail)); ?>" class="img-responsive lazy" alt="genre-image">
                        <?php elseif($item->tvseries->thumbnail != null): ?>
                          <img data-src="<?php echo e(asset('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)); ?>" class="img-responsive lazy" alt="genre-image">
                        <?php else: ?>
                          <img data-src="<?php echo e(asset('images/default-thumbnail.jpg')); ?>" class="img-responsive lazy" alt="genre-image">
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-sm-7 pad-0">
                    <h5 class="movie-series-heading movie-series-name">
                      <?php if($item->type == 'M'): ?>
                        <?php if($auth && $subscribed == 1): ?>
                          <a href="<?php echo e(url('movie/detail', $item->slug)); ?>"><?php echo e($item->title); ?></a>
                        <?php else: ?>
                           <a href="<?php echo e(url('movie/guest/detail', $item->slug)); ?>"><?php echo e($item->title); ?></a>
                        <?php endif; ?>
                      <?php elseif($item->type == 'S'): ?>
                        <?php if($auth && $subscribed == 1): ?>
                          <a href="<?php echo e(url('show/detail', $item->season_slug)); ?>"><?php echo e($item->tvseries->title); ?></a>
                        <?php else: ?>
                          <a href="<?php echo e(url('show/guest/detail', $item->season_slug)); ?>"><?php echo e($item->tvseries->title); ?></a>
                        <?php endif; ?>
                      <?php endif; ?>
                    </h5>
                    <ul class="movie-series-des-list">
                      <?php if($item->type == 'M'): ?>
                        <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                      <?php endif; ?>
                      <?php if($item->type == 'S'): ?>
                        <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->tvseries->rating); ?></li>
                      <?php endif; ?>
                      <li>
                        <?php if($item->type == 'M'): ?>
                          <?php echo e($item->duration); ?> <?php echo e(__('staticwords.mins')); ?>

                        <?php else: ?>
                         <?php echo e(__('staticwords.season')); ?> <?php echo e($item->season_no); ?>

                        <?php endif; ?>
                      </li>
                      <?php if($item->type == 'M'): ?>
                        <li><?php echo e($item->released); ?></li>
                      <?php else: ?>
                        <li><?php echo e($item->publish_year); ?></li>
                      <?php endif; ?>
                      <li>
                        <?php if($item->type == 'M'): ?>
                          <?php echo e($item->maturity_rating); ?>

                        <?php else: ?>
                          <?php echo e($item->tvseries->maturity_rating); ?>

                        <?php endif; ?>
                      </li>
                      <?php if($item->subtitle == 1): ?>
                        <li>
                          <?php echo e(__('staticwords.subtitles')); ?>

                        </li>
                      <?php endif; ?>
                    </ul>
                    <p>
                      <?php if($item->type == 'M'): ?>
                        <?php echo e(str_limit($item->detail, 360)); ?>

                      <?php else: ?>
                        <?php if($item->detail != null || $item->detail != ''): ?>
                          <?php echo e($item->detail); ?>

                        <?php else: ?>
                          <?php echo e(str_limit($item->tvseries->detail, 360)); ?>

                        <?php endif; ?>
                      <?php endif; ?>
                    </p>
                     
                    <div class="des-btn-block des-in-list">
                      <?php if($subscribed==1 && $auth): ?>
                      <?php if($item->type == 'M'): ?>
                      <?php if($item->maturity_rating =='all age' || $age>=str_replace('+', '',$item->maturity_rating)): ?>
                       <?php if($item->video_link['iframeurl'] != null): ?>
                          
                              <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play search-btn iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                              </a>

                             <?php else: ?> 

                             <a href="<?php echo e(route('watchmovie', $item->id)); ?>" class="iframe btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                             </a>

                        <?php endif; ?>
                        <?php else: ?>
                          <a onclick="myage(<?php echo e($age); ?>)" class="btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                              </a>
                        <?php endif; ?>
                        <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                          
                          <a href="<?php echo e(route('watchTrailer',$item->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                        <?php endif; ?>
                     

                      <?php else: ?>
                        <?php if(isset($item->episodes[0])): ?>
                           <?php if($item->episodes[0]->video_link->iframeurl !=""): ?>

                            <a href="#" onclick="playoniframe('<?php echo e($item->episodes[0]->video_link->iframeurl); ?>','<?php echo e($item->id); ?>','tv')" class="btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                             </a>

                             <?php else: ?> 
                            <a href="<?php echo e(route('watchTvShow', $item->id)); ?>" class="iframe btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                            <?php endif; ?>
                          <?php endif; ?>
                       
                      <?php endif; ?>
                    </div>
                    <?php else: ?>
                     <div class="des-btn-block des-in-list">
                        <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                          
                          <a href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                        <?php endif; ?>
                       
                      </div>
                   <?php endif; ?>
                   <?php if($auth): ?>
                     <?php if(isset($wishlist_check->added)): ?>
                          <a onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></a>
                        <?php else: ?>
                      <a onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></a>
                        <?php endif; ?>
                   <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      <?php else: ?>
        <div class="container-fluid movie-series-section search-section">
          <h5 class="movie-series-heading">0 <?php echo e(__('staticwords.foundfor')); ?> "<?php echo e($searchKey); ?>"</h5>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </section>
  <!-- end main wrapper -->
 



<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
  <script>
  var app = new Vue({
    el: '.des-btn-block',
    data: {
      result: {
        id: '',
        type: '',
      },
    },
    methods: {
      addToWishList(id, type) {
        this.result.id = id;
        this.result.type = type;
        this.$http.post('<?php echo e(route('addtowishlist')); ?>', this.result).then((response) => {
        }).catch((e) => {
          console.log(e);
        });
        this.result.item_id = '';
        this.result.item_type = '';
      }
    }
  });

    

    
    function playTrailer(url) {
      $('.video-player').css({
        "visibility" : "visible",
        "z-index" : "99999",
      });
      $('body').css({
        "overflow": "hidden"
      });
      $('#my_video').show();
      $('.vjs-control-bar').removeClass('hide-visible');
      let str = url;
      let youtube_slice_1 = str.slice(0, 14);
      let youtube_slice_2 = str.slice(0, 20);
      if (youtube_slice_1 == "https://youtu." || youtube_slice_2 == "https://www.youtube.")
      {
        $('.vjs-control-bar').addClass('hide-visible');
        player.src({ type: "video/youtube", src: url});
      } else {
        player.src({ type: "video/mp4", src: url});
      }

      setTimeout(function(){
        player.play();
      }, 300);
    }

    

    function addWish(id, type) {
      app.addToWishList(id, type);
      setTimeout(function() {
        $('.addwishlistbtn'+id+type).text(function(i, text){
          return text == "<?php echo e(__('staticwords.addtowatchlist')); ?>" ? "<?php echo e(__('staticwords.removefromwatchlist')); ?>" : "<?php echo e(__('staticwords.addtowatchlist')); ?>";
        });
      }, 100);
    }

</script>



    <script>

      function playoniframe(url,id,type){
        $(document).ready(function(){
          var SITEURL = '<?php echo e(URL::to('')); ?>';
           $.ajax({
                type: "get",
                url: SITEURL + "/user/watchhistory/"+id+'/'+type,
                success: function (data) {
                 console.log(data);
                },
                error: function (data) {
                   console.log(data)
                }
            });
      
        });       
        $.colorbox({ href: url, width: '100%', height: '100%', iframe: true });
      }
      
    </script>
  <script>  
      function myage(age){
        if (age==0) {
        $('#ageModal').modal('show'); 
      }else{
          $('#ageWarningModal').modal('show');
      }
    }
      
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/search.blade.php ENDPATH**/ ?>
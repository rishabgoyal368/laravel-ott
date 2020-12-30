<?php $__env->startSection('title',"$menu->name"); ?>
<?php $__env->startSection('main-wrapper'); ?>
<?php
 $age=0;
  $config=App\Config::first();
  if ($config->age_restriction==1) {
    if(Auth::user()){
      $user_id=Auth::user()->id;
      $user=App\User::findOrfail($user_id);
      $age=$user->age;
    }
  }else{
    $age=100;
  }
?>

  <!-- main wrapper  slider -->
  <section id="wishlistelement" class="main-wrapper">

    <div>
     
        <div id="home-main-block" class="home-main-block">
          <div id="home-slider-one" class="home-slider-one owl-carousel">
            <?php if(isset($home_slides) && count($home_slides) > 0): ?>
              <?php $__currentLoopData = $home_slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($slide->active == 1): ?>
                  <div class="slider-block">
                    <div class="slider-image">
                      <?php if(isset($slide->slide_image)): ?>  
                        <?php if($slide->movie_id != null): ?>
                          <?php if(isset($auth) && $subscribed==1): ?>

                            <a href="<?php echo e(url('movie/detail', $slide->movie->slug)); ?>">
                              <?php if($slide->slide_image != null): ?>
                                <?php
                                  $image = 'images/home_slider/movies/'. $slide->slide_image;
                                    // Read image path, convert to base64 encoding
                                    
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                   $src = '';
                                   }
                                ?>
                                <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="slider-image">
                                <?php elseif($slide->movie->poster != null): ?>
                                  <?php
                                     $image = 'images/movies/posters/'. $slide->movie->poster;
                                    // Read image path, convert to base64 encoding
                                    
                                    $imageData = base64_encode(@file_get_contents($image));
                                    if($src){
                                    // Format the image SRC:  data:{mime};base64,{data};
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                    }else{
                                     $src = '';
                                     }
                                  ?>
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="slider-image">
                                <?php endif; ?>
                            </a>
                          <?php else: ?>
                            <a href="<?php echo e(url('movie/guest/detail', $slide->movie->slug)); ?>">
                              <?php if($slide->slide_image != null): ?>
                                <?php
                                  $image = 'images/home_slider/movies/'. $slide->slide_image;
                                    // Read image path, convert to base64 encoding
                                    
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                    // Format the image SRC:  data:{mime};base64,{data};
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                     $src = '';
                                  }
                                ?>
                                <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="slider-image">
                              <?php elseif($slide->movie->poster != null): ?>
                                <?php
                                  $image = 'images/movies/posters/'. $slide->movie->poster;
                                    // Read image path, convert to base64 encoding
                                    
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($src){
                                    // Format the image SRC:  data:{mime};base64,{data};
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                     $src = '';
                                  }
                                ?>
                                <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="slider-image">
                              <?php endif; ?>
                            </a>
                          <?php endif; ?>
                        <?php elseif($slide->tv_series_id != null && isset($slide->tvseries->seasons[0])): ?>
                          <?php if($auth && $subscribed== 1): ?>
                            <a href="<?php echo e(url('show/detail', $slide->tvseries->seasons[0]->season_slug)); ?>">
                              <?php if($slide->slide_image != null): ?>
                                <img data-src="<?php echo e(url('images/home_slider/shows/'. $slide->slide_image)); ?>" class="img-responsive owl-lazy" alt="slider-image">
                              <?php elseif($slide->tvseries->poster != null): ?>
                                <img data-src="<?php echo e(url('images/tvseries/posters/'. $slide->tvseries->poster)); ?>" class="img-responsive owl-lazy" alt="slider-image">
                              <?php endif; ?>
                            </a>
                          <?php else: ?>
                            <a href="<?php echo e(url('show/guest/detail', $slide->tvseries->seasons[0]->season_slug)); ?>">
                              <?php if($slide->slide_image != null): ?>
                                <img data-src="<?php echo e(url('images/home_slider/shows/'. $slide->slide_image)); ?>" class="img-responsive owl-lazy" alt="slider-image">
                              <?php elseif($slide->tvseries->poster != null): ?>
                                <img data-src="<?php echo e(url('images/tvseries/posters/'. $slide->tvseries->poster)); ?>" class="img-responsive owl-lazy" alt="slider-image">
                              <?php endif; ?>
                            </a>
                          <?php endif; ?>
                        <?php else: ?>
                         <a href="#">
                            <?php if($slide->slide_image != null): ?>
                              <img data-src="<?php echo e(url('images/home_slider/'. $slide->slide_image)); ?>" class="img-responsive owl-lazy" alt="slider-image">
                            <?php endif; ?>
                          </a>
                        <?php endif; ?>
                      <?php endif; ?>
                      
                    </div>
                  </div>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </div>
          
        </div>
 
<!-- age modal -->
 <?php echo $__env->make('modal.agemodal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--- end age modal -->

<!-- age warning modal -->
 <?php echo $__env->make('modal.agewarning', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- end age warning modal -->

<?php if(count($menu->menusections)>0): ?>

  <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $recentlyadded = [];
       
        foreach ($recent_data as $key => $item) {
          
            $rm =  App\Movie::join('videolinks','videolinks.movie_id','=','movies.id')
                         ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id','movies.thumbnail as thumbnail','movies.live as live','movies.rating as rating','movies.duration as duration','movies.publish_year as publish_year','movies.maturity_rating as maturity_rating','movies.detail as detail','movies.trailer_url as trailer_url','videolinks.iframeurl as iframeurl','movies.slug as slug')
                         ->where('movies.id',$item->movie_id)->first();
              
            $recentlyadded[] = $rm;

            
            if($section->order == 1){
              arsort($recentlyadded);
            }
           

            if(count($recentlyadded) == $section->item_limit){
                break;
                exit(1);
            }
        }

        foreach ($recent_data as $key => $item) {
            
            $rectvs =  App\TvSeries::
                          join('seasons','seasons.tv_series_id','=','tv_series.id')
                          ->join('episodes','episodes.seasons_id','=','seasons.id')
                          ->join('videolinks','videolinks.episode_id','=','episodes.id')
                          ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.thumbnail as thumbnail','tv_series.title as title','tv_series.rating as rating','seasons.publish_year as publish_year','tv_series.maturity_rating as age_req','tv_series.detail as detail','seasons.season_no as season_no','videolinks.iframeurl as iframeurl','seasons.season_slug as season_slug','seasons.trailer_url as trailer_url')
                          ->where('tv_series.id',$item->tv_series_id)->first();
              
            $recentlyadded[] = $rectvs;

            if($section->order == 1){
              arsort($recentlyadded);
            }
            
            if(count($recentlyadded) == $section->item_limit){
                break;
                exit(1);
            }

        }
        
        

        $recentlyadded = array_values(array_filter($recentlyadded));
        
    ?>
     
    <?php if($section->section_id == 1 && $recentlyadded != NULL && count($recentlyadded) >0): ?>
      <div class="genre-prime-block genre-prime-block-one genre-paddin-top genre-top-slider">
        <div class="container-fluid">
             
           <h5 class="section-heading"><?php echo e(__('staticwords.RecentlyAddedIn')); ?> <?php echo e($menu->name); ?></h5>
              <?php if($auth && $subscribed==1): ?>
                
                <a href="<?php echo e(route('showall',['menuid' => $menu->id, 'menuname' => $menu->name])); ?>" class="see-more"> <b><?php echo e(__('staticwords.viewall')); ?></b></a>
       
              <?php else: ?>
                
                <a href="<?php echo e(route('guestshowall',['menuid' => $menu->id, 'menuname' => $menu->name])); ?>" class="see-more"> <b><?php echo e(__('staticwords.viewall')); ?></b></a>
         
              <?php endif; ?>

          <!-- Recently added movies and tv shows in list view End-->
            <?php if($section->view == 1): ?>
              <div class="genre-prime-slider owl-carousel">
                 <?php $__currentLoopData = $recentlyadded; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                     if(isset($auth)){


                       if ($item->type == 'M') {
                        $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                          ['user_id', '=', $auth->id],
                                                                          ['movie_id', '=', $item->id],
                                                                        ])->first();
                      }
                       }

                       if(isset($auth)){

                          $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                          if (isset($gets1)) {


                            $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                        ['user_id', '=', $auth->id],
                                                                        ['season_id', '=', $gets1->id],
                              ])->first();


                            }

                          }
                          else{
                             $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                          }
                    ?>

                    <?php if($item->status == 1): ?>
                      <?php if($item->type == 'M'): ?>
                        <?php
                          $image = 'images/movies/thumbnails/'.$item->thumbnail;
                          // Read image path, convert to base64 encoding
                          
                          $imageData = base64_encode(@file_get_contents($image));
                          if($imageData){
                              $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                          }else{
                              $src = url('images/default-thumbnail.jpg');
                          }
                        ?>
                        <div class="genre-prime-slide">
                          <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?>" data-pt-interactive="false">
                            <?php if($auth && $subscribed==1): ?>
                              <a href="<?php echo e(url('movie/detail',$item->slug)); ?>">
                                <?php if($src): ?>
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                <?php else: ?>
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                <?php endif; ?>
                              </a>
                            <?php else: ?>
                              <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>">
                                <?php if($src): ?>
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                <?php else: ?>
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                <?php endif; ?>
                              </a>
                            <?php endif; ?>
                          </div>

                          <?php if($protip == 1): ?>

                          <div id="prime-mix-description-block<?php echo e($item->id); ?>" class="prime-description-block">
                            <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                            
                            <ul class="description-list">
                              <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                              <li><?php echo e($item->duration); ?> <?php echo e(__('staticwords.mins')); ?></li>
                              <li><?php echo e($item->publish_year); ?></li>
                              <li><?php echo e($item->maturity_rating); ?></li>
                             
                            </ul>
                            <div class="main-des">
                              <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                              <?php if($auth && $subscribed == 1): ?>
                                <a href="<?php echo e(url('movie/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                              <?php else: ?>
                                 <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                              <?php endif; ?>
                            </div>
                        

                            
                            <div class="des-btn-block">
                              <?php if($auth && $subscribed==1): ?>
                                <?php if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating)): ?>
                             
                                  <?php if($item->video_link['iframeurl'] != null): ?>
                                  
                                  <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                  </a>

                                  <?php else: ?>
                                    <a href="<?php echo e(route('watchmovie',$item->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                    </a>
                                  <?php endif; ?>
                                <?php else: ?>
                                 <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play play-btn-icon"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                   
                                <?php endif; ?>
                                <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                  <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                <?php endif; ?>
                              <?php else: ?>
                                <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                  <a class="iframe btn btn-default" href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                <?php endif; ?>
                              <?php endif; ?>
                              <?php if($catlog == 0 && $subscribed == 1): ?>
                                <?php if(isset($wishlist_check->added)): ?>
                                  <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></button>
                                <?php else: ?>
                               
                                  <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                <?php endif; ?>
                              <?php elseif($catlog == 1): ?>
                                <?php if($auth): ?>
                                  <?php if(isset($wishlist_check->added)): ?>
                                    <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></button>
                                  <?php else: ?>
                                    <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                  <?php endif; ?>
                                <?php endif; ?>
                              <?php endif; ?>
                            </div>
                          </div>
                          <?php endif; ?>
                                   
                        </div>
                      <?php elseif($item->type == 'T'): ?>
                          <?php
                               $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                              // Read image path, convert to base64 encoding
                              
                              $imageData = base64_encode(@file_get_contents($image));
                              if($imageData){
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                              }else{
                                  $src = url('images/default-thumbnail.jpg');
                              }
                          ?>
                         <div class="genre-prime-slide">
                            <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>">
                              <?php if($auth && $subscribed==1): ?>
                                <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                  <?php if($item->thumbnail != null): ?>
                                    
                                    <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                  
                                  <?php else: ?>
                                    <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                  <?php endif; ?>
                                </a>
                              <?php else: ?>
                                <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                  <?php if($item->thumbnail != null): ?>
                                    <img src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                
                                  <?php else: ?>
                                    <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                  <?php endif; ?>
                                </a>
                              <?php endif; ?> 
                            </div>
                            <?php if(isset($protip) && $protip == 1): ?>
                            <div id="prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>" class="prime-description-block">
                              <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                              
                              <ul class="description-list">
                                <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                                <li><?php echo e(__('staticwords.season')); ?> <?php echo e($item->season_no); ?></li>
                                <li><?php echo e($item->publish_year); ?></li>
                                <li><?php echo e($item->age_req); ?></li>
                               
                              </ul>
                              <div class="main-des">
                                <?php if($item->detail != null || $item->detail != ''): ?>
                                  <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                <?php else: ?>
                                  <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                <?php endif; ?>
                                <?php if($auth && $subscribed == 1): ?>
                                  <a href="<?php echo e(url('show/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                <?php else: ?>
                                   <a href="<?php echo e(url('show/guest/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                <?php endif; ?>
                              </div>
                             
                              <div class="des-btn-block">
                                <?php if($auth && $subscribed==1): ?>
                                  <?php if(isset($gets1->episodes[0])): ?>
                                    <?php if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req)): ?>
                                      <?php if($gets1->episodes[0]->video_link['iframeurl'] !=""): ?>
                                   
                                        <a href="#" onclick="playoniframe('<?php echo e($gets1->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($gets1->episodes[0]->seasons->tvseries->id); ?>','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                        </a>

                                      <?php else: ?>
                                        <a href="<?php echo e(route('watchTvShow',$gets1->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                      <?php endif; ?>
                                    <?php else: ?>
                                     <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                  <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                    <a href="<?php echo e(route('watchtvTrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                  <?php endif; ?>
                                <?php else: ?>
                                   <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                    <a href="<?php echo e(route('guestwatchtvtrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                  <?php endif; ?>
                                <?php endif; ?>
                                <?php if($catlog == 1 && $subscribed == 1): ?>
                                  <?php if(isset($gets1)): ?>
                                    <?php if(isset($wishlist_check->added)): ?>
                                      <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></a>
                                    <?php else: ?>
                                      <?php if($gets1): ?>
                                        <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                        </a>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                <?php elseif($catlog ==1 && $auth): ?>

                                  <?php if(isset($gets1)): ?>
                                    <?php if(isset($wishlist_check->added)): ?>
                                      <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></a>
                                    <?php else: ?>
                                      <?php if($gets1): ?>
                                        <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                        </a>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                <?php endif; ?>
                              </div>
                            </div>
                            <?php endif; ?>
                         </div>
                      <?php endif; ?>
                    <?php endif; ?>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
              </div>
            <?php endif; ?>
          <!-- Recently added movies and tv shows in list view End-->
            
          <!-- Recently Tvshows and movies in Grid view -->
            <?php if($section->view == 0): ?>
                 <div class="genre-prime-block">
                    <?php $__currentLoopData = $recentlyadded; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php
                         if(isset($auth)){


                           if ($item->type == 'M') {
                            $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                              ['user_id', '=', $auth->id],
                                                                              ['movie_id', '=', $item->id],
                                                                            ])->first();
                          }
                           }

                           if(isset($auth)){

                              $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                              if (isset($gets1)) {


                                $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['season_id', '=', $gets1->id],
                                  ])->first();


                                }

                              }
                              else{
                                 $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                              }
                        ?>
                        <?php if($item->status == 1): ?>
                          <?php if($item->type == 'M'): ?>
                          <?php
                           $image = 'images/movies/thumbnails/'.$item->thumbnail;
                          // Read image path, convert to base64 encoding
                          
                          $imageData = base64_encode(@file_get_contents($image));
                          if($imageData){
                          // Format the image SRC:  data:{mime};base64,{data};
                          $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                          }else{
                              $src = url('images/default-thumbnail.jpg');
                          }
                      ?>
                      <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                        <div class="cus_img">
                          <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?>">
                            <?php if($auth && $subscribed==1): ?>
                            <a href="<?php echo e(url('movie/detail',$item->slug)); ?>">
                              <?php if($src): ?>
                                <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                              <?php else: ?>
                                <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                              <?php endif; ?>
                            </a>
                            <?php else: ?>
                             <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>">
                                <?php if($src): ?>
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                <?php else: ?>
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                <?php endif; ?>
                              </a>

                            <?php endif; ?>
                         
                          </div>

                          <?php if(isset($protip) && $protip == 1): ?>

                          <div id="prime-mix-description-block<?php echo e($item->id); ?>" class="prime-description-block">
                            <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                            
                            <ul class="description-list">
                              <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                              <li><?php echo e($item->duration); ?><?php echo e(__('staticwords.mins')); ?></li>
                              <li><?php echo e($item->publish_year); ?></li>
                              <li><?php echo e($item->maturity_rating); ?></li>
                              
                            </ul>
                            <div class="main-des">
                              <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                              <?php if($auth && $subscribed == 1): ?>
                                <a href="<?php echo e(url('movie/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                              <?php else: ?>
                                 <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                              <?php endif; ?>
                            </div>
                            
                            <div class="des-btn-block">
                              <?php if($auth && $subscribed==1): ?>
                                <?php if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating)): ?>
                             
                                  <?php if($item->video_link['iframeurl'] != null): ?>
                                  
                                  <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                  </a>

                                  <?php else: ?>
                                    <a href="<?php echo e(route('watchmovie',$item->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                    </a>
                                  <?php endif; ?>
                                <?php else: ?>
                                 <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play play-btn-icon"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                   
                                <?php endif; ?>
                                <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                  <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                <?php endif; ?>
                              <?php else: ?>
                                <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                  <a class="iframe btn btn-default" href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                <?php endif; ?>
                              <?php endif; ?>
                              <?php if($catlog == 0 && $subscribed == 1): ?>
                                <?php if(isset($wishlist_check->added)): ?>
                                  <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></button>
                                <?php else: ?>
                               
                                  <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                <?php endif; ?>
                              <?php elseif($catlog == 1): ?>
                                <?php if($auth): ?>
                                  <?php if(isset($wishlist_check->added)): ?>
                                    <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></button>
                                  <?php else: ?>
                                    <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                  <?php endif; ?>
                                <?php endif; ?>
                              <?php endif; ?>
                            </div>
                          </div>
                          <?php endif; ?>
                        </div>
                      </div>
                      <?php elseif($item->type == 'T'): ?>
                        <?php
                           $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                          // Read image path, convert to base64 encoding
                          
                          $imageData = base64_encode(@file_get_contents($image));
                          if($imageData){
                          // Format the image SRC:  data:{mime};base64,{data};
                          $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                          }else{
                              $src = url('images/default-thumbnail.jpg');
                          }
                        ?>
                            <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                                <div class="cus_img">
                                <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>">
                                   <?php if($auth && $subscribed==1): ?>
                                    <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                      <?php if($src): ?>
                                        
                                        <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                      
                                      <?php else: ?>
                                        <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                      <?php endif; ?>
                                    </a>
                                    <?php else: ?>
                                     <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                      <?php if($src): ?>
                                        <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                      
                                      <?php else: ?>
                                        <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                      <?php endif; ?>
                                    </a>
                                    <?php endif; ?>

                                </div>
                                <?php if(isset($protip) && $protip == 1): ?>
                                <div id="prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>" class="prime-description-block">
                                    <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                                   
                                    <ul class="description-list">
                                      <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                                      <li><?php echo e(__('staticwords.season')); ?> <?php echo e($item->season_no); ?></li>
                                      <li><?php echo e($item->publish_year); ?></li>
                                      <li><?php echo e($item->age_req); ?></li>
                                      
                                    </ul>
                                    <div class="main-des">
                                      <?php if($item->detail != null || $item->detail != ''): ?>
                                        <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                      <?php else: ?>
                                        <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                      <?php endif; ?>
                                      <?php if($auth && $subscribed == 1): ?>
                                        <a href="<?php echo e(url('show/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                      <?php else: ?>
                                         <a href="<?php echo e(url('show/guest/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                      <?php endif; ?>
                                    </div>
                                     <div class="des-btn-block">
                                      <?php if($auth && $subscribed==1): ?>
                                        <?php if(isset($gets1->episodes[0])): ?>
                                          <?php if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req)): ?>
                                            <?php if($gets1->episodes[0]->video_link['iframeurl'] !=""): ?>
                                         
                                              <a href="#" onclick="playoniframe('<?php echo e($gets1->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($gets1->episodes[0]->seasons->tvseries->id); ?>','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                              </a>

                                            <?php else: ?>
                                              <a href="<?php echo e(route('watchTvShow',$gets1->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                            <?php endif; ?>
                                          <?php else: ?>
                                           <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                          <a href="<?php echo e(route('watchtvTrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                        <?php endif; ?>
                                      <?php else: ?>
                                        <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                          <a href="<?php echo e(route('guestwatchtvtrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                      <?php if($catlog == 1 && $subscribed == 1): ?>
                                        <?php if(isset($gets1)): ?>
                                          <?php if(isset($wishlist_check->added)): ?>
                                            <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></a>
                                          <?php else: ?>
                                            <?php if($gets1): ?>
                                              <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                              </a>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                      <?php elseif($catlog ==1 && $auth): ?>

                                        <?php if(isset($gets1)): ?>
                                          <?php if(isset($wishlist_check->added)): ?>
                                            <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></a>
                                          <?php else: ?>
                                            <?php if($gets1): ?>
                                              <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                              </a>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                    </div>
                                  </div>
                                  <?php endif; ?>    
                               
                              </div>
                            </div>
                          <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </div>
            <?php endif; ?>
          <!-- Recently Tvshows and movies in Grid view END-->

          </div>
      </div> 
    <?php endif; ?>
      
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
  <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
  <!-- Featured Movies and TvShows -->
    <?php
        $featuresitems = [];
        foreach ($menu_data as $key => $item) {
            
            $fmovie =  App\Movie::join('videolinks','videolinks.movie_id','=','movies.id')
                         ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id','movies.thumbnail as thumbnail','movies.rating as rating','movies.duration as duration','movies.publish_year as publish_year','movies.maturity_rating as maturity_rating','movies.detail as detail','movies.trailer_url as trailer_url','movies.slug as slug')
                         ->where('movies.id',$item->movie_id)->where('featured', '1')->first();
              
             $featuresitems[] = $fmovie;

            if($section->order == 1){
              arsort($featuresitems);
            }

            if(count($featuresitems) == $section->item_limit){
                break;
                exit();
            }


        }

        foreach ($menu_data as $key => $item) {
           $ftvs = App\TvSeries::
                          join('seasons','seasons.tv_series_id','=','tv_series.id')
                          ->join('episodes','episodes.seasons_id','=','seasons.id')
                          ->join('videolinks','videolinks.episode_id','=','episodes.id')
                          ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.thumbnail as thumbnail','tv_series.title as title','tv_series.rating as rating','seasons.publish_year as publish_year','tv_series.maturity_rating as age_req','tv_series.detail as detail','seasons.season_no as season_no','videolinks.iframeurl as iframeurl','seasons.season_slug as season_slug','seasons.trailer_url as trailer_url')
                          ->where('tv_series.id',$item->tv_series_id)->where('tv_series.featured','1')->first();
              
            $featuresitems[] = $ftvs;

            if($section->order == 1){
              arsort($featuresitems);
            }
            
            if(count($featuresitems) == $section->item_limit+1){
                break;
                exit();
            }

        }

        $featuresitems = array_values(array_filter($featuresitems));
        
    ?>


    <?php if($section->section_id == 3 && $featuresitems != NULL && count($featuresitems)>0): ?>
      <div class="genre-prime-block genre-prime-block-one genre-paddin-top">
         <div class="container-fluid">
              
              <h5 class="section-heading"><?php echo e(__('staticwords.FeaturedIn')); ?> <?php echo e($menu->name); ?></h5>

              
              <!-- Featured Tvshows and movies in List view -->
              <?php if($section->view == 1): ?>
                <div class="genre-prime-slider owl-carousel">
                   <?php $__currentLoopData = $featuresitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php
                       if(isset($auth)){


                         if ($item->type == 'M') {
                          $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['movie_id', '=', $item->id],
                                                                          ])->first();
                        }
                         }

                         if(isset($auth)){

                            $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                            if (isset($gets1)) {


                              $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                          ['user_id', '=', $auth->id],
                                                                          ['season_id', '=', $gets1->id],
                                ])->first();


                              }

                            }
                            else{
                               $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                            }
                      ?>

                      <?php if($item->status == 1): ?>
                        <?php if($item->type == 'M'): ?>
                        <?php
                           $image = 'images/movies/thumbnails/'.$item->thumbnail;
                          // Read image path, convert to base64 encoding
                        
                          $imageData = base64_encode(@file_get_contents($image));
                          if($imageData){
                          // Format the image SRC:  data:{mime};base64,{data};
                          $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                          }else{
                              $src = url('images/default-thumbnail.jpg');
                          }
                        ?>

                          <div class="genre-prime-slide">
                            <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?>">
                              <?php if($auth && $subscribed==1): ?>
                              <a href="<?php echo e(url('movie/detail',$item->slug)); ?>">
                                <?php if($src): ?>
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                <?php else: ?>
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                <?php endif; ?>
                              </a>
                              <?php else: ?>
                                <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>">
                                <?php if($src): ?>
                                  <img src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                <?php else: ?>
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                <?php endif; ?>
                              </a>
                              <?php endif; ?>
                            </div>
                            <?php if(isset($protip) && $protip == 1): ?>
                            <div id="prime-mix-description-block<?php echo e($item->id); ?>" class="prime-description-block">
                                <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                               
                                <ul class="description-list">
                                  <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                                  <li><?php echo e($item->duration); ?> <?php echo e(__('staticwords.mins')); ?></li>
                                  <li><?php echo e($item->publish_year); ?></li>
                                  <li><?php echo e($item->maturity_rating); ?></li>
                                  
                                </ul>
                                <div class="main-des">
                                  <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                  <?php if($auth && $subscribed == 1): ?>
                                    <a href="<?php echo e(url('movie/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                  <?php else: ?>
                                     <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                  <?php endif; ?>
                                </div>
                              
                                  
                                <div class="des-btn-block">
                                  <?php if($auth && $subscribed==1): ?>
                                    <?php if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating)): ?>
                                      <?php if($item->video_link['iframeurl'] != null): ?>
                                  
                                        <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                        </a>
                                      <?php else: ?>
                                        <a href="<?php echo e(route('watchmovie',$item->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                        </a>
                                      <?php endif; ?>
                                    <?php else: ?>
                                      <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                      </a>
                                    <?php endif; ?>
                                    <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                       <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                    <?php endif; ?>
                                  <?php else: ?>
                                    <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                      <a class="iframe btn btn-default" href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                    <?php endif; ?>
                                  <?php endif; ?>

                                  <?php if($catlog == 0 && $subscribed ==1): ?>
                                    <?php if(isset($wishlist_check->added)): ?>
                                      <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></button>
                                    <?php else: ?>
                                   
                                      <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                    <?php endif; ?>
                                  <?php elseif($catlog ==1 && $auth): ?>
                                    <?php if(isset($wishlist_check->added)): ?>
                                      <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></button>
                                    <?php else: ?>
                                   
                                      <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                  
                                </div>
                               
                            </div>
                            <?php endif; ?>
                          </div>
                        <?php elseif($item->type == 'T'): ?>
                        
                        <?php
                           $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                          // Read image path, convert to base64 encoding
                        
                          $imageData = base64_encode(@file_get_contents($image));
                          if($imageData){
                          // Format the image SRC:  data:{mime};base64,{data};
                          $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                          }else{
                              $src = url('images/default-thumbnail.jpg');
                          }
                        ?>


                         <div class="genre-prime-slide">
                            <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>">
                              <?php if($auth && $subscribed==1): ?>
                              <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                <?php if($src): ?>
                                  
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                
                                <?php else: ?>
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                <?php endif; ?>
                              </a>
                              <?php else: ?>
                               <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                <?php if($src): ?>
                                  
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                
                                <?php else: ?>
                                  <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                <?php endif; ?>
                              </a>
                              <?php endif; ?>
                              
                              </div>
                              <?php if(isset($protip) && $protip == 1): ?>
                              <div id="prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>" class="prime-description-block">
                                  <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                                 
                                  <ul class="description-list">
                                    <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                                    <li><?php echo e(__('staticwords.season')); ?> <?php echo e($item->season_no); ?></li>
                                    <li><?php echo e($item->publish_year); ?></li>
                                    <li><?php echo e($item->age_req); ?></li>
                                   
                                  </ul>
                                  <div class="main-des">
                                    <?php if($item->detail != null || $item->detail != ''): ?>
                                      <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                    <?php else: ?>
                                      <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                    <?php endif; ?>
                                    <?php if($auth && $subscribed == 1): ?>
                                      <a href="<?php echo e(url('show/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                    <?php else: ?>
                                       <a href="<?php echo e(url('show/guest/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                    <?php endif; ?>
                                  </div>
                                 
                                  <div class="des-btn-block">
                                    <?php if($auth && $subscribed==1): ?>
                                      <?php if(isset($gets1->episodes[0])): ?>
                                        <?php if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req)): ?>

                                          <?php if($gets1->episodes[0]->video_link['iframeurl'] !=""): ?>
                                       
                                            <a href="#" onclick="playoniframe('<?php echo e($gets1->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($gets1->episodes[0]->seasons->tvseries->id); ?>','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                             </a>

                                          <?php else: ?>
                                            <a href="<?php echo e(route('watchTvShow',$gets1->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                          <?php endif; ?>
                                        <?php else: ?>
                                          <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                      <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                        <a href="<?php echo e(route('watchtvTrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                      <?php endif; ?>
                                    <?php else: ?>
                                       <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                        <a href="<?php echo e(route('guestwatchtvtrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                      <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($catlog== 0 && $subscribed ==1): ?>
                                      <?php if(isset($gets1)): ?>
                                        <?php if(isset($wishlist_check->added)): ?>
                                          <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwaychlist') : __('staticwords.addtowatchlist')); ?></a>
                                        <?php else: ?>
                                          <?php if($gets1): ?>
                                            <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                            </a>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                    <?php elseif($catlog ==1 && $auth): ?>
                                      <?php if(isset($gets1)): ?>
                                        <?php if(isset($wishlist_check->added)): ?>
                                          <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwaychlist') : __('staticwords.addtowatchlist')); ?></a>
                                        <?php else: ?>
                                          <?php if($gets1): ?>
                                            <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                            </a>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                  </div>
                                </div>
                              <?php endif; ?>
                         </div>
                        <?php endif; ?>
                      <?php endif; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </div>
              <?php endif; ?>
              <!-- Featured Tvshows and movies in List view END -->

              <!-- Featured Tvshows and movies in Grid view -->
              <?php if($section->view == 0): ?>
                   <div class="genre-prime-block">
                      <?php $__currentLoopData = $featuresitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php
                           if(isset($auth)){


                             if ($item->type == 'M') {
                              $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                ['user_id', '=', $auth->id],
                                                                                ['movie_id', '=', $item->id],
                                                                              ])->first();
                            }
                             }

                             if(isset($auth)){

                                $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                if (isset($gets1)) {


                                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                              ['user_id', '=', $auth->id],
                                                                              ['season_id', '=', $gets1->id],
                                    ])->first();


                                  }

                                }
                                else{
                                   $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                                }
                          ?>
                          <?php if($item->status == 1): ?>
                            <?php if($item->type == 'M'): ?>
                            <?php
                               $image = 'images/movies/thumbnails/'.$item->thumbnail;
                              // Read image path, convert to base64 encoding
                            
                              $imageData = base64_encode(@file_get_contents($image));
                              if($imageData){
                              // Format the image SRC:  data:{mime};base64,{data};
                              $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                              }else{
                                  $src = url('images/default-thumbnail.jpg');
                              }
                            ?>




                              <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                                  <div class="cus_img">
                                    <div class="genre-slide-image protip " data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?>">
                                      <?php if($auth && $subscribed==1): ?>
                                      <a href="<?php echo e(url('movie/detail',$item->slug)); ?>">
                                      <?php if($src): ?>
                                        <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                      <?php else: ?>
                                        <img data-src="<?php echo e($src); ?>" class="img-responsive" alt="genre-image">
                                      <?php endif; ?>
                                    </a>
                                    <?php else: ?>
                                     <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>">
                                      <?php if($src): ?>
                                        <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                      <?php else: ?>
                                        <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                      <?php endif; ?>
                                    </a>

                                    <?php endif; ?>
                                   
                                  </div>
                                  <?php if(isset($protip) && $protip == 1): ?>
                                  <div id="prime-mix-description-block<?php echo e($item->id); ?>" class="prime-description-block">
                                    <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                                  
                                    <ul class="description-list">
                                      <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                                      <li><?php echo e($item->duration); ?> <?php echo e(__('staticwords.mins')); ?></li>
                                      <li><?php echo e($item->publish_year); ?></li>
                                      <li><?php echo e($item->maturity_rating); ?></li>
                                     
                                    </ul>
                                    <div class="main-des">
                                      <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                      <?php if($auth && $subscribed == 1): ?>
                                        <a href="<?php echo e(url('movie/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                      <?php else: ?>
                                         <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                      <?php endif; ?>
                                    </div>
                                    <div class="des-btn-block">
                                      <?php if($auth && $subscribed==1): ?>
                                        <?php if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating)): ?>
                                          <?php if($item->video_link['iframeurl'] != null): ?>
                                      
                                            <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                            </a>
                                          <?php else: ?>
                                            <a href="<?php echo e(route('watchmovie',$item->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                            </a>
                                          <?php endif; ?>
                                        <?php else: ?>
                                          <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                          </a>
                                        <?php endif; ?>
                                        <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                           <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                        <?php endif; ?>
                                      <?php else: ?>
                                        <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                          <a class="iframe btn btn-default" href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                        <?php endif; ?>
                                      <?php endif; ?>

                                      <?php if($catlog == 0 && $subscribed ==1): ?>
                                        <?php if(isset($wishlist_check->added)): ?>
                                          <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></button>
                                        <?php else: ?>
                                       
                                          <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                        <?php endif; ?>
                                      <?php elseif($catlog ==1 && $auth): ?>
                                        <?php if(isset($wishlist_check->added)): ?>
                                          <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></button>
                                        <?php else: ?>
                                       
                                          <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                      
                                    </div> 
                                       
                                  </div>
                                   <?php endif; ?> 
                                
                                  </div>
                              </div>
                            <?php elseif($item->type == 'T'): ?>
                            <?php
                               $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                              // Read image path, convert to base64 encoding
                            
                              $imageData = base64_encode(@file_get_contents($image));
                              if($imageData){
                              // Format the image SRC:  data:{mime};base64,{data};
                              $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                              }else{
                                  $src = url('images/default-thumbnail.jpg');
                              }
                            ?>




                              <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                                  <div class="cus_img">
                                  <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>">
                                     <?php if($auth && $subscribed==1): ?>
                                      <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                        <?php if($src): ?>
                                         
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                       
                                        <?php else: ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                        <?php endif; ?>
                                      </a>
                                      <?php else: ?>
                                       <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                        <?php if($src): ?>
                                          
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                        
                                        <?php else: ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                        <?php endif; ?>
                                      </a>
                                      <?php endif; ?>

                                  </div>
                                  <?php if(isset($protip) && $protip == 1): ?>
                                  <div id="prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>" class="prime-description-block">
                                    <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                                  
                                    <ul class="description-list">
                                      <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                                      <li><?php echo e(__('staticwords.season')); ?> <?php echo e($item->season_no); ?></li>
                                      <li><?php echo e($item->publish_year); ?></li>
                                      <li><?php echo e($item->age_req); ?></li>
                                   
                                    </ul>
                                    <div class="main-des">
                                      <?php if($item->detail != null || $item->detail != ''): ?>
                                        <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                      <?php else: ?>
                                        <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                      <?php endif; ?>
                                      <?php if($auth && $subscribed == 1): ?>
                                        <a href="<?php echo e(url('show/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                      <?php else: ?>
                                         <a href="<?php echo e(url('show/guest/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                      <?php endif; ?>
                                    </div>
                                    
                                    <div class="des-btn-block">
                                    <?php if($auth && $subscribed==1): ?>
                                      <?php if(isset($gets1->episodes[0])): ?>
                                        <?php if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req)): ?>

                                          <?php if($gets1->episodes[0]->video_link['iframeurl'] !=""): ?>
                                       
                                            <a href="#" onclick="playoniframe('<?php echo e($gets1->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($gets1->episodes[0]->seasons->tvseries->id); ?>','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                             </a>

                                          <?php else: ?>
                                            <a href="<?php echo e(route('watchTvShow',$gets1->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                          <?php endif; ?>
                                        <?php else: ?>
                                          <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($catlog== 0 && $subscribed ==1): ?>
                                      <?php if(isset($gets1)): ?>
                                        <?php if(isset($wishlist_check->added)): ?>
                                          <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwaychlist') : __('staticwords.addtowatchlist')); ?></a>
                                        <?php else: ?>
                                          <?php if($gets1): ?>
                                            <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                            </a>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                          <a href="<?php echo e(route('watchtvTrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                        <?php endif; ?>
                                      <?php else: ?>
                                         <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                          <a href="<?php echo e(route('guestwatchtvtrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                    <?php elseif($catlog ==1 && $auth): ?>
                                      <?php if(isset($gets1)): ?>
                                        <?php if(isset($wishlist_check->added)): ?>
                                          <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwaychlist') : __('staticwords.addtowatchlist')); ?></a>
                                        <?php else: ?>
                                          <?php if($gets1): ?>
                                            <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                            </a>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                  </div>
                                  <?php endif; ?>
                                  </div>
                                 
                                </div>
                              </div>
                            <?php endif; ?>
                          <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </div>
              <?php endif; ?>
              <!-- Featured Tvshows and movies in Grid view END-->
          </div>
      </div> 
    <?php endif; ?>  

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <!-- Featured Tv Shows and Movies end-->


<!------------- because you watched ------------------->
  <?php if(Auth::user() && $subscribed==1): ?>

    <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
         
          $watchistory_last_movie=App\WatchHistory::where('user_id',$auth->id)->orderBy('id','DESC')->where('movie_id','!=',NULL)->take(3)->get();

          $watchistory_last_tv=App\WatchHistory::where('user_id',$auth->id)->orderBy('id','DESC')->where('tv_id','!=',NULL)->take(3)->get();

          $customGenreMovie = [];
          $customGenreTv = [];

          foreach ($watchistory_last_movie as $key => $w) {
             $movie_find_last = App\Movie::where('id','=',$w->movie_id)->first();
             if(isset($movie_find_last)){
              $customGenreMovie[] = $movie_find_last->genre_id;
             }
          }

          foreach ($watchistory_last_tv as $key => $k) {
             $tv_show = App\TvSeries::where('id','=',$k->tv_id)->first();
             if(isset($tv_show)){
              $customGenreTv[] = $tv_show->genre_id;
             }
          }
         

       

        $customGenreMovie =  array_unique($customGenreMovie);
        $customGenreTv =  array_unique($customGenreTv);

       
        
        $recom_block = collect();

        $customGenreMovie =  array_unique($customGenreMovie);
        $customGenreTv =  array_unique($customGenreTv);

       
       
        //Getting Recommnaded Movies based on genre
        foreach ($customGenreMovie as $key => $g) {
          $x = App\Movie::orderBy('id','DESC')->where('genre_id', 'LIKE', '%' . $g . '%')->take(50)->get();
           $recom_block->push($x);
           
        }
       
        //Getting Recommnaded Tv Series based on genre
         foreach ($customGenreTv as $key => $g) {
           $y =App\TvSeries::orderBy('id','DESC')->where('genre_id', 'LIKE', '%' . $g . '%')->take(50)->get();
           $recom_block->push($y);
        }

         //$recom_movies = array_values(array_filter($recom_movies));
        $recom_block = $recom_block->flatten();

        //dd($recom_block);
            
        ?>
         
        <?php if($section->section_id == 4 && $recom_block != NULL && count($recom_block)>0): ?>
          <div class="genre-prime-block genre-prime-block-one genre-paddin-top">
             <div class="container-fluid">
                 <?php
                 $watch = App\WatchHistory::OrderBy('id','DESC')->first();
                 $movie = App\Movie::where('id',$watch->movie_id)->first();
                 $tv = App\Movie::where('id',$watch->tv_id)->first();
                 ?>
                 <?php if(isset($movie)): ?>
                  <h5 class="section-heading"><?php echo e(__('staticwords.Becauseyouwatched')); ?>: <?php echo e(ucfirst($movie->title)); ?></h5>
                <?php else: ?>
                    <h5 class="section-heading"><?php echo e(__('staticwords.Becauseyouwatched')); ?> : <?php echo e(ucfirst($tv->title)); ?></h5>
                <?php endif; ?>
                 

                  <!-- best in intrest  added movies and tv shows in list view End-->
                      <?php if($section->view == 1): ?>
                        <div class="genre-prime-slider owl-carousel">
                           <?php $__currentLoopData = $recom_block; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <?php
                               if(isset($auth)){


                                 if ($item->type == 'M') {
                                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                    ['user_id', '=', $auth->id],
                                                                                    ['movie_id', '=', $item->id],
                                                                                  ])->first();
                                }
                                 }

                                 if(isset($auth)){

                                    $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                    if (isset($gets1)) {


                                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                  ['user_id', '=', $auth->id],
                                                                                  ['season_id', '=', $gets1->id],
                                        ])->first();


                                      }

                                    }
                                    else{
                                       $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                                    }
                              ?>

                              <?php if($item->status == 1): ?>
                                <?php if($item->type == 'M'): ?>
                                <?php
                                     $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                    // Read image path, convert to base64 encoding
                                    
                                    $imageData = base64_encode(@file_get_contents($image));
                                    if($imageData){
                                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                    }else{
                                        $src = url('images/default-thumbnail.jpg');
                                    }
                                ?>
                                  <div class="genre-prime-slide">
                                    <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?>">
                                      <?php if($auth && $subscribed==1): ?>
                                      <a href="<?php echo e(url('movie/detail',$item->slug)); ?>">
                                        <?php if($src): ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                        <?php else: ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                        <?php endif; ?>
                                      </a>
                                      <?php else: ?>
                                        <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>">
                                        <?php if($src): ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                        <?php else: ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                        <?php endif; ?>
                                      </a>
                                      <?php endif; ?>
                                    </div>
                                    <?php if(isset($protip) && $protip == 1): ?>
                                    <div id="prime-mix-description-block<?php echo e($item->id); ?>" class="prime-description-block">
                                      <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                                     
                                      <ul class="description-list">
                                        <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                                        <li><?php echo e($item->duration); ?> <?php echo e(__('staticwords.mins')); ?></li>
                                        <li><?php echo e($item->publish_year); ?></li>
                                        <li><?php echo e($item->maturity_rating); ?></li>
                                        
                                      </ul>
                                      <div class="main-des">
                                        <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                        <?php if($auth && $subscribed == 1): ?>
                                          <a href="<?php echo e(url('movie/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                        <?php else: ?>
                                           <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                        <?php endif; ?>
                                      </div>
                                     
                                       
                                      <div class="des-btn-block">
                                        <?php if($auth && $subscribed==1): ?>
                                          <?php if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating)): ?>
                                            <?php if($item->video_link['iframeurl'] != null): ?>
                                        
                                              <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                             </a>

                                            <?php else: ?>
                                              <a href="<?php echo e(route('watchmovie',$item->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                              </a>
                                            <?php endif; ?>
                                          <?php else: ?>
                                            <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                            </a>
                                          <?php endif; ?>
                                          <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                            <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                          <?php endif; ?>
                                        <?php else: ?>
                                          <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                            <a class="iframe btn btn-default" href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        
                                        <?php if($catlog == 0 && $subscribed ==1): ?>

                                          <?php if(isset($wishlist_check->added)): ?>
                                            <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') :__('staticwords.addtowatchlist')); ?></button>
                                          <?php else: ?>
                                         
                                            <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                          <?php endif; ?>
                                        <?php elseif($catlog ==1 && $auth): ?>
                                          <?php if(isset($wishlist_check->added)): ?>
                                            <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') :__('staticwords.addtowatchlist')); ?></button>
                                          <?php else: ?>
                                         
                                            <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                    <?php endif; ?>
                                  </div>
                                <?php elseif($item->type == 'T'): ?>
                                  <?php
                                       $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                      // Read image path, convert to base64 encoding
                                      
                                      $imageData = base64_encode(@file_get_contents($image));
                                      if($imageData){
                                          $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                      }else{
                                          $src = url('images/default-thumbnail.jpg');
                                      }
                                  ?>
                                   <div class="genre-prime-slide">
                                      <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>">
                                        <?php if($auth && $subscribed==1): ?>
                                        <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                          <?php if($item->thumbnail != null): ?>
                                            
                                            <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                          
                                          <?php else: ?>
                                            <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                          <?php endif; ?>
                                        </a>
                                        <?php else: ?>
                                         <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                          <?php if($item->thumbnail != null): ?>
                                            <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                        
                                          <?php else: ?>
                                            <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="genre-image">
                                          <?php endif; ?>
                                        </a>
                                        <?php endif; ?>  
                                      </div>
                                      <?php if(isset($protip) && $protip == 1): ?>
                                      <div id="prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>" class="prime-description-block">
                                        <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                                        
                                        <ul class="description-list">
                                          <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                                          <li><?php echo e(__('staticwords.season')); ?> <?php echo e($item->season_no); ?></li>
                                          <li><?php echo e($item->publish_year); ?></li>
                                          <li><?php echo e($item->age_req); ?></li>
                                         
                                        </ul>
                                        <div class="main-des">
                                          <?php if($item->detail != null || $item->detail != ''): ?>
                                            <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                          <?php else: ?>
                                            <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                          <?php endif; ?>
                                          <?php if($auth && $subscribed == 1): ?>
                                            <a href="<?php echo e(url('show/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                          <?php else: ?>
                                             <a href="<?php echo e(url('show/guest/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                          <?php endif; ?>
                                        </div>
                                       
                                        <div class="des-btn-block">
                                          <?php if($auth && $subscribed==1): ?>
                                            <?php if(isset($gets1->episodes[0])): ?>
                                              <?php if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req)): ?>

                                                <?php if($gets1->episodes[0]->video_link['iframeurl'] !=""): ?>
                                             
                                                  <a href="#" onclick="playoniframe('<?php echo e($gets1->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($gets1->episodes[0]->seasons->tvseries->id); ?>','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                                   </a>

                                                <?php else: ?>
                                                  <a href="<?php echo e(route('watchTvShow',$gets1->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                                <?php endif; ?>
                                              <?php else: ?>
                                                <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                              <?php endif; ?>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                          <?php if($catlog ==0 && $subscribed ==1): ?>
                                            <?php if(isset($gets1)): ?>
                                              <?php if(isset($wishlist_check->added)): ?>
                                                <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></a>
                                              <?php else: ?>
                                                <?php if($gets1): ?>
                                                  <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                                  </a>
                                                <?php endif; ?>
                                              <?php endif; ?>
                                            <?php endif; ?>
                                          <?php elseif($catlog == 1 && $auth): ?>
                                            <?php if(isset($gets1)): ?>
                                              <?php if(isset($wishlist_check->added)): ?>
                                                <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></a>
                                              <?php else: ?>
                                                <?php if($gets1): ?>
                                                  <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                                  </a>
                                                <?php endif; ?>
                                              <?php endif; ?>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        </div>
                                      </div>
                                      <?php endif; ?>
                                   </div>
                                <?php endif; ?>
                              <?php endif; ?>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </div>
                      <?php endif; ?>
                  <!-- best in intrest added movies and tv shows in list view End-->
                  
                   <!-- best in intrest Tvshows and movies in Grid view -->
                      <?php if($section->view == 0): ?>
                           <div class="genre-prime-block">
                              <?php $__currentLoopData = $recom_block; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php
                                   if(isset($auth)){


                                     if ($item->type == 'M') {
                                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                        ['user_id', '=', $auth->id],
                                                                                        ['movie_id', '=', $item->id],
                                                                                      ])->first();
                                    }
                                     }

                                     if(isset($auth)){

                                        $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                        if (isset($gets1)) {


                                          $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                      ['user_id', '=', $auth->id],
                                                                                      ['season_id', '=', $gets1->id],
                                            ])->first();


                                          }

                                        }
                                        else{
                                           $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                                        }
                                  ?>
                                  <?php if($item->status == 1): ?>
                                    <?php if($item->type == 'M'): ?>
                                    <?php
                                     $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                    // Read image path, convert to base64 encoding
                                    
                                    $imageData = base64_encode(@file_get_contents($image));
                                    if($imageData){
                                    // Format the image SRC:  data:{mime};base64,{data};
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                    }else{
                                        $src = url('images/default-thumbnail.jpg');
                                    }
                                ?>
                                      <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                                          <div class="cus_img">
                                            <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?>">
                                              <?php if($auth && $subscribed==1): ?>
                                                <a href="<?php echo e(url('movie/detail',$item->slug)); ?>">
                                                  <?php if($src): ?>
                                                    <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                  <?php else: ?>
                                                    <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                  <?php endif; ?>
                                                </a>
                                              <?php else: ?>
                                                <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>">
                                                  <?php if($src): ?>
                                                    <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                  <?php else: ?>
                                                    <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                  <?php endif; ?>
                                                </a>

                                              <?php endif; ?>
                                           
                                          </div>
                                          <?php if(isset($protip) && $protip == 1): ?>
                                           <div id="prime-mix-description-block<?php echo e($item->id); ?>" class="prime-description-block">
                                              <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                                              
                                              <ul class="description-list">
                                                <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                                                <li><?php echo e($item->duration); ?> <?php echo e(__('staticwords.mins')); ?></li>
                                                <li><?php echo e($item->publish_year); ?></li>
                                                <li><?php echo e($item->maturity_rating); ?></li>
                                               
                                              </ul>
                                              <div class="main-des">
                                                <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                                <?php if($auth && $subscribed == 1): ?>
                                                  <a href="<?php echo e(url('movie/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                                <?php else: ?>
                                                   <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                                <?php endif; ?>
                                              </div>
                                            
                                              <div class="des-btn-block">
                                                <?php if($auth && $subscribed==1): ?>
                                                  <?php if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating)): ?>
                                                    <?php if($item->video_link['iframeurl'] != null): ?>
                                                
                                                      <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                                     </a>

                                                    <?php else: ?>
                                                      <a href="<?php echo e(route('watchmovie',$item->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                                      </a>
                                                    <?php endif; ?>
                                                  <?php else: ?>
                                                    <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                                    </a>
                                                  <?php endif; ?>
                                                  <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                                    <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                                  <?php endif; ?>
                                                <?php else: ?>
                                                  <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                                    <a class="iframe btn btn-default" href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                                  <?php endif; ?>
                                                <?php endif; ?>
                                                
                                                <?php if($catlog == 0 && $subscribed ==1): ?>

                                                  <?php if(isset($wishlist_check->added)): ?>
                                                    <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') :__('staticwords.addtowatchlist')); ?></button>
                                                  <?php else: ?>
                                                 
                                                    <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                                  <?php endif; ?>
                                                <?php elseif($catlog ==1 && $auth): ?>
                                                  <?php if(isset($wishlist_check->added)): ?>
                                                    <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') :__('staticwords.addtowatchlist')); ?></button>
                                                  <?php else: ?>
                                                 
                                                    <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                                  <?php endif; ?>
                                                <?php endif; ?>
                                              </div>
                                            </div>
                                          <?php endif; ?>
                                          </div>
                                      </div>
                                    <?php elseif($item->type == 'T'): ?>
                                    <?php
                                     $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                    // Read image path, convert to base64 encoding
                                    
                                    $imageData = base64_encode(@file_get_contents($image));
                                    if($imageData){
                                    // Format the image SRC:  data:{mime};base64,{data};
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                    }else{
                                        $src = url('images/default-thumbnail.jpg');
                                    }
                                ?>
                                      <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                                          <div class="cus_img">
                                          <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>">
                                             <?php if($auth && $subscribed==1): ?>
                                              <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                                <?php if($src): ?>
                                                  
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                
                                                <?php else: ?>
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                <?php endif; ?>
                                              </a>
                                              <?php else: ?>
                                               <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                                <?php if($src): ?>
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                
                                                <?php else: ?>
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="genre-image">
                                                <?php endif; ?>
                                              </a>
                                              <?php endif; ?>

                                          </div>
                                          <?php if(isset($protip) && $protip == 1): ?>
                                          <div id="prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>" class="prime-description-block">
                                            <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                                           
                                            <ul class="description-list">
                                              <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                                              <li><?php echo e(__('staticwords.season')); ?> <?php echo e($item->season_no); ?></li>
                                              <li><?php echo e($item->publish_year); ?></li>
                                              <li><?php echo e($item->age_req); ?></li>
                                            
                                            </ul>
                                            <div class="main-des">
                                              <?php if($item->detail != null || $item->detail != ''): ?>
                                                <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                              <?php else: ?>
                                                <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                              <?php endif; ?>
                                              <?php if($auth && $subscribed == 1): ?>
                                                <a href="<?php echo e(url('movie/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                              <?php else: ?>
                                                 <a href="<?php echo e(url('movie/guest/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                              <?php endif; ?>
                                            </div>
                                            <div class="des-btn-block">
                                              <?php if($auth && $subscribed==1): ?>
                                                <?php if(isset($gets1->episodes[0])): ?>
                                                  <?php if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req)): ?>

                                                    <?php if($gets1->episodes[0]->video_link['iframeurl'] !=""): ?>
                                                 
                                                      <a href="#" onclick="playoniframe('<?php echo e($gets1->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($gets1->episodes[0]->seasons->tvseries->id); ?>','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                                       </a>

                                                    <?php else: ?>
                                                      <a href="<?php echo e(route('watchTvShow',$gets1->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                                    <?php endif; ?>
                                                  <?php else: ?>
                                                    <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                                  <?php endif; ?>
                                                <?php endif; ?>
                                                 <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                                  <a href="<?php echo e(route('watchtvTrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                                <?php endif; ?>
                                              <?php else: ?>
                                                 <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                                  <a href="<?php echo e(route('guestwatchtvtrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                                <?php endif; ?>
                                              <?php endif; ?>
                                              <?php if($catlog ==0 && $subscribed ==1): ?>
                                                <?php if(isset($gets1)): ?>
                                                  <?php if(isset($wishlist_check->added)): ?>
                                                    <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></a>
                                                  <?php else: ?>
                                                    <?php if($gets1): ?>
                                                      <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                                      </a>
                                                    <?php endif; ?>
                                                  <?php endif; ?>
                                                <?php endif; ?>
                                              <?php elseif($catlog == 1 && $auth): ?>
                                                <?php if(isset($gets1)): ?>
                                                  <?php if(isset($wishlist_check->added)): ?>
                                                    <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></a>
                                                  <?php else: ?>
                                                    <?php if($gets1): ?>
                                                      <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                                      </a>
                                                    <?php endif; ?>
                                                  <?php endif; ?>
                                                <?php endif; ?>
                                              <?php endif; ?>
                                            </div>
                                          </div>
                                          <?php endif; ?>
                                         
                                        </div>
                                      </div>
                                    <?php endif; ?>
                                  <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </div>
                      <?php endif; ?>
                  <!-- best in intrest Tvshows and movies in Grid view END-->

              </div>
          </div> 
        <?php endif; ?>
          
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>

<!----------- because you watched end ----------------->


<!------------- Continue Watch ------------------->
  <?php if(Auth::user() && $subscribed==1): ?>

    <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $historyadded = [];
           
            foreach ($watchistory as $key => $item) {
              
                $rm =  App\Movie::
                            join('watch_histories','movies.id','=','watch_histories.movie_id')
                            ->join('menu_videos','menu_videos.movie_id','=','movies.id')
                            ->join('videolinks','videolinks.movie_id','=','movies.id')
                             ->select('movies.id as id','watch_histories.movie_id as movie_id','movies.title as title','movies.rating as rating','movies.duration as duration','movies.publish_year as publish_year','movies.maturity_rating as maturity_rating','movies.detail as detail','movies.trailer_url as trailer_url','videolinks.iframeurl as iframeurl','movies.status as status','movies.type as type','movies.thumbnail as thumbnail','movies.slug as slug')
                             ->where('watch_histories.id',$item->id)->where('menu_videos.menu_id',$menu->id)->first();
                  
                $historyadded[] = $rm;

                
                if($section->order == 1){
                  arsort($historyadded);
                }
               

                if(count($historyadded) == $section->item_limit){
                    break;
                    exit(1);
                }
            }
           

            foreach ($watchistory as $key => $item) {
                
                $rectvs =  App\TvSeries::
                              join('watch_histories','tv_series.id','=','watch_histories.tv_id')
                                 ->join('seasons','seasons.tv_series_id','=','tv_series.id')
                              ->join('episodes','episodes.seasons_id','=','seasons.id')
                              ->join('videolinks','videolinks.episode_id','=','episodes.id')
                             ->join('menu_videos','menu_videos.tv_series_id','=','tv_series.id')
                              ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.thumbnail as thumbnail','tv_series.title as title','tv_series.rating as rating','seasons.publish_year as publish_year','tv_series.maturity_rating as age_req','tv_series.detail as detail','seasons.season_no as season_no','videolinks.iframeurl as iframeurl')
                              ->where('watch_histories.id',$item->id)->where('menu_videos.menu_id',$menu->id)->first();
                  
                $historyadded[] = $rectvs;
              

                if($section->order == 1){
                  arsort($historyadded);
                }
                
                if(count($historyadded) == $section->item_limit){
                    break;
                    exit(1);
                }

            }
            
            

            $historyadded = array_values(array_filter($historyadded));
            
        ?>
         
        <?php if($section->section_id == 5 && $historyadded != NULL && count($historyadded) >0): ?>
          <div class="genre-prime-block genre-prime-block-one genre-paddin-top">
             <div class="container-fluid">
                 
                  <h5 class="section-heading"><?php echo e(__('staticwords.ContinueWatchingFor')); ?> <?php echo e(Auth::user()->name); ?></h5>
                  <!--<?php if($auth && $subscribed==1): ?>-->
                    
                  <!--  <a href="<?php echo e(route('showall',['menuid' => $menu->id, 'menuname' => $menu->name])); ?>" class="see-more"> <b><?php echo e(__('staticwords.viewall')); ?></b></a>-->
           
                  <!--<?php else: ?>-->
                    
                  <!--  <a href="<?php echo e(route('guestshowall',['menuid' => $menu->id, 'menuname' => $menu->name])); ?>" class="see-more"> <b><?php echo e(__('staticwords.viewall')); ?></b></a>-->
             
                  <!--<?php endif; ?>-->

                  <!-- Continue Watch  added movies and tv shows in list view End-->
                      <?php if($section->view == 1): ?>
                        <div class="genre-prime-slider owl-carousel">
                           <?php $__currentLoopData = $historyadded; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <?php
                               if(isset($auth)){


                                 if ($item->type == 'M') {
                                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                    ['user_id', '=', $auth->id],
                                                                                    ['movie_id', '=', $item->id],
                                                                                  ])->first();
                                }
                                 }

                                 if(isset($auth)){

                                    $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                    if (isset($gets1)) {


                                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                  ['user_id', '=', $auth->id],
                                                                                  ['season_id', '=', $gets1->id],
                                        ])->first();


                                      }

                                    }
                                    else{
                                       $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                                    }
                              ?>

                              <?php if($item->status == 1): ?>
                                <?php if($item->type == 'M'): ?>
                                <?php
                                     $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                    // Read image path, convert to base64 encoding
                                    
                                    $imageData = base64_encode(@file_get_contents($image));
                                    if($imageData){
                                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                    }else{
                                        $src = url('images/default-thumbnail.jpg');
                                    }
                                ?>
                                  <div class="genre-prime-slide">
                                    <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?>">
                                      <?php if($auth && $subscribed==1): ?>
                                      <a href="<?php echo e(url('movie/detail',$item->slug)); ?>">
                                        <?php if($src): ?>
                                          <img data-srcdata-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="movie-image">
                                        <?php else: ?>
                                          <img data-srcdata-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="movie-image">
                                        <?php endif; ?>
                                      </a>
                                      <?php else: ?>
                                        <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>">
                                        <?php if($src): ?>
                                          <img data-srcdata-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="movie-image">
                                        <?php else: ?>
                                          <img data-srcdata-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="movie-image">
                                        <?php endif; ?>
                                      </a>
                                      <?php endif; ?>
                                    </div>
                                    <?php if(isset($protip) && $protip == 1): ?>
                                    <div id="prime-mix-description-block<?php echo e($item->id); ?>" class="prime-description-block">
                                      <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                                      
                                      <ul class="description-list">
                                        <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                                        <li><?php echo e($item->duration); ?> <?php echo e(__('staticwords.mins')); ?></li>
                                        <li><?php echo e($item->publish_year); ?></li>
                                        <li><?php echo e($item->maturity_rating); ?></li>
                                       
                                      </ul>
                                      <div class="main-des">
                                        <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                        <?php if($auth && $subscribed == 1): ?>
                                          <a href="<?php echo e(url('movie/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                        <?php else: ?>
                                           <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                        <?php endif; ?>
                                      </div>
                                    
                                       
                                      <div class="des-btn-block">
                                        <?php if($auth && $subscribed==1): ?>
                                          <?php if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating)): ?>
                                            <?php if($item->video_link['iframeurl'] != null): ?>
                                        
                                              <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                            </a>

                                            <?php else: ?>
                                              <a href="<?php echo e(route('watchmovie',$item->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                              </a>
                                            <?php endif; ?>
                                          <?php else: ?>
                                            <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                            </a>
                                          <?php endif; ?>
                                          <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                            <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                          <?php endif; ?>
                                        <?php else: ?>
                                          <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                            <a class="iframe btn btn-default" href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                        
                                        <?php if($catlog ==0 && $subscribed ==1): ?>

                                          <?php if(isset($wishlist_check->added)): ?>
                                            <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></button>
                                          <?php else: ?>
                                         
                                            <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                          <?php endif; ?>
                                        <?php elseif($catlog ==1 && $auth): ?>
                                          <?php if(isset($wishlist_check->added)): ?>
                                            <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></button>
                                          <?php else: ?>
                                       
                                            <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                    <?php endif; ?>
                                   
                                  </div>
                                <?php elseif($item->type == 'T'): ?>
                                    <?php
                                         $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                        // Read image path, convert to base64 encoding
                                        
                                        $imageData = base64_encode(@file_get_contents($image));
                                        if($imageData){
                                            $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                        }else{
                                            $src = url('images/default-thumbnail.jpg');
                                        }
                                    ?>
                                   <div class="genre-prime-slide">
                                      <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>">
                                        <?php if($auth && $subscribed==1): ?>
                                        <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                          <?php if($item->thumbnail != null): ?>
                                            
                                            <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="tvseries-image">
                                          
                                          <?php else: ?>
                                            <img data-src="<?php echo e($src); ?>" class="img-responsive owl-lazy" alt="tvseries-image">
                                          <?php endif; ?>
                                        </a>
                                        <?php else: ?>
                                         <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                          <?php if($item->thumbnail != null): ?>
                                            <img data-src="<?php echo e($src); ?>" class="img-responsive" alt="genre-image">
                                        
                                          <?php else: ?>
                                            <img data-src="<?php echo e($src); ?>" class="img-responsive" alt="genre-image">
                                          <?php endif; ?>
                                        </a>
                                        <?php endif; ?>  
                                      </div>
                                      <?php if(isset($protip) && $protip == 1): ?>
                                      <div id="prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>" class="prime-description-block">
                                        <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                                        
                                        <ul class="description-list">
                                          <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                                          <li><?php echo e(__('staticwords.season')); ?> <?php echo e($item->season_no); ?></li>
                                          <li><?php echo e($item->publish_year); ?></li>
                                          <li><?php echo e($item->age_req); ?></li>
                                         
                                        </ul>
                                        <div class="main-des">
                                          <?php if($item->detail != null || $item->detail != ''): ?>
                                            <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                          <?php else: ?>
                                            <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                          <?php endif; ?>
                                          <?php if($auth && $subscribed == 1): ?>
                                            <a href="<?php echo e(url('show/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                          <?php else: ?>
                                             <a href="<?php echo e(url('show/guest/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                          <?php endif; ?>
                                        </div>
                                        
                                        <div class="des-btn-block">
                                          <?php if($auth && $subscribed==1): ?>
                                            <?php if(isset($gets1->episodes[0])): ?>
                                              <?php if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req)): ?>

                                                <?php if($gets1->episodes[0]->video_link['iframeurl'] !=""): ?>
                                             
                                                  <a href="#" onclick="playoniframe('<?php echo e($gets1->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($gets1->episodes[0]->seasons->tvseries->id); ?>','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                                   </a>

                                                <?php else: ?>
                                                  <a href="<?php echo e(route('watchTvShow',$gets1->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                                <?php endif; ?>
                                              <?php else: ?>
                                               <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                              <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                              <a href="<?php echo e(route('watchtvTrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                            <?php endif; ?>
                                          <?php else: ?>
                                             <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                              <a href="<?php echo e(route('guestwatchtvtrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                          <?php if($catlog == 0 && $subscribed ==1): ?>
                                            <?php if(isset($gets1)): ?>
                                              <?php if(isset($wishlist_check->added)): ?>
                                                <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></a>
                                              <?php else: ?>
                                                <?php if($gets1): ?>
                                                  <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                                  </a>
                                                <?php endif; ?>
                                              <?php endif; ?>
                                            <?php endif; ?>
                                          <?php elseif($catlog ==1 && $auth): ?>
                                            <?php if(isset($gets1)): ?>
                                              <?php if(isset($wishlist_check->added)): ?>
                                                <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></a>
                                              <?php else: ?>
                                                <?php if($gets1): ?>
                                                  <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                                  </a>
                                                <?php endif; ?>
                                              <?php endif; ?>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        </div>
                                      </div>
                                      <?php endif; ?>
                                   </div>
                                <?php endif; ?>
                              <?php endif; ?>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </div>
                      <?php endif; ?>
                  <!-- continue Watch added movies and tv shows in list view End-->
                  
                   <!-- continue Watch Tvshows and movies in Grid view -->
                      <?php if($section->view == 0): ?>
                           <div class="genre-prime-block">
                              <?php $__currentLoopData = $historyadded; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php
                                   if(isset($auth)){


                                     if ($item->type == 'M') {
                                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                        ['user_id', '=', $auth->id],
                                                                                        ['movie_id', '=', $item->id],
                                                                                      ])->first();
                                    }
                                     }

                                     if(isset($auth)){

                                        $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                        if (isset($gets1)) {


                                          $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                      ['user_id', '=', $auth->id],
                                                                                      ['season_id', '=', $gets1->id],
                                            ])->first();


                                          }

                                        }
                                        else{
                                           $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                                        }
                                  ?>
                                  <?php if($item->status == 1): ?>
                                    <?php if($item->type == 'M'): ?>
                                    <?php
                                     $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                    // Read image path, convert to base64 encoding
                                    
                                    $imageData = base64_encode(@file_get_contents($image));
                                    if($imageData){
                                    // Format the image SRC:  data:{mime};base64,{data};
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                    }else{
                                        $src = url('images/default-thumbnail.jpg');
                                    }
                                ?>
                                <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                                    <div class="cus_img">
                                      <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?>">
                                        <?php if($auth && $subscribed==1): ?>
                                        <a href="<?php echo e(url('movie/detail',$item->slug)); ?>">
                                        <?php if($src): ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="movie-image">
                                        <?php else: ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="movie-image">
                                        <?php endif; ?>
                                      </a>
                                      <?php else: ?>
                                       <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>">
                                        <?php if($src): ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="movie-image">
                                        <?php else: ?>
                                          <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="movie-image">
                                        <?php endif; ?>
                                      </a>

                                      <?php endif; ?>
                                     
                                    </div>
                                    <?php if(isset($protip) && $protip == 1): ?>
                                     <div id="prime-mix-description-block<?php echo e($item->id); ?>" class="prime-description-block">
                                        <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                                        
                                        <ul class="description-list">
                                          <li><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></li>
                                          <li><?php echo e($item->duration); ?> <?php echo e(__('staticwords.mins')); ?></li>
                                          <li><?php echo e($item->publish_year); ?></li>
                                          <li><?php echo e($item->maturity_rating); ?></li>
                                         
                                        </ul>
                                        <div class="main-des">
                                          <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                          <?php if($auth && $subscribed == 1): ?>
                                            <a href="<?php echo e(url('movie/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                          <?php else: ?>
                                             <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                          <?php endif; ?>
                                        </div>
                                        <?php if($catlog==1 && is_null($subscribed)): ?>
                                        <?php if($withlogin==0 && $auth): ?>
                                          <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                             <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                          <?php endif; ?>
                                          <?php else: ?>
                                           <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                             <a class="iframe btn btn-default" href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                          <?php endif; ?>
                                          <?php endif; ?>

                                          <?php endif; ?>

                                         
                                        <div class="des-btn-block">
                                          <?php if($auth && $subscribed==1): ?>
                                            <?php if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating)): ?>
                                              <?php if($item->video_link['iframeurl'] != null): ?>
                                          
                                                <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                              </a>

                                              <?php else: ?>
                                                <a href="<?php echo e(route('watchmovie',$item->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                                </a>
                                              <?php endif; ?>
                                            <?php else: ?>
                                              <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                              </a>
                                            <?php endif; ?>
                                            <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                              <a class="iframe btn btn-default" href="<?php echo e(route('watchTrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                            <?php endif; ?>
                                          <?php else: ?>
                                            <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                              <a class="iframe btn btn-default" href="<?php echo e(route('guestwatchtrailer',$item->id)); ?>"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                          
                                          <?php if($catlog ==0 && $subscribed ==1): ?> 

                                            <?php if(isset($wishlist_check->added)): ?>
                                              <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></button>
                                            <?php else: ?>
                                           
                                              <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                            <?php endif; ?>
                                          <?php elseif($catlog ==1 && $auth): ?>
                                            <?php if(isset($wishlist_check->added)): ?>
                                              <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></button>
                                            <?php else: ?>
                                         
                                              <button onclick="addWish(<?php echo e($item->id); ?>,'<?php echo e($item->type); ?>')" class="addwishlistbtn<?php echo e($item->id); ?><?php echo e($item->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?></button>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        </div>
                                      </div>
                                    <?php endif; ?>
                                    </div>
                                 </div>
                                <?php elseif($item->type == 'T'): ?>
                                  <?php
                                     $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                    // Read image path, convert to base64 encoding
                                    
                                    $imageData = base64_encode(@file_get_contents($image));
                                    if($imageData){
                                    // Format the image SRC:  data:{mime};base64,{data};
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                    }else{
                                        $src = url('images/default-thumbnail.jpg');
                                    }
                                  ?>
                                      <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                                          <div class="cus_img">
                                          <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>">
                                             <?php if($auth && $subscribed==1): ?>
                                              <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                                <?php if($src): ?>
                                                  
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive" alt="genre-image">
                                                
                                                <?php else: ?>
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive" alt="genre-image">
                                                <?php endif; ?>
                                              </a>
                                              <?php else: ?>
                                               <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                                                <?php if($src): ?>
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="tseries-image">
                                                
                                                <?php else: ?>
                                                  <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="tvseries-image">
                                                <?php endif; ?>
                                              </a>
                                              <?php endif; ?>

                                          </div>
                                          <?php if(isset($protip) && $protip == 1): ?>
                                          <div id="prime-mix-description-block<?php echo e($item->id); ?><?php echo e($item->type); ?>" class="prime-description-block">
                                            <h5 class="description-heading"><?php echo e($item->title); ?></h5>
                                            <div class="movie-rating"><?php echo e(__('staticwords.tmdbrating')); ?> <?php echo e($item->rating); ?></div>
                                            <ul class="description-list">
                                              <li><?php echo e(__('staticwords.season')); ?> <?php echo e($item->season_no); ?></li>
                                              <li><?php echo e($item->publish_year); ?></li>
                                              <li><?php echo e($item->age_req); ?></li>
                                             
                                            </ul>
                                            <div class="main-des">
                                              <?php if($item->detail != null || $item->detail != ''): ?>
                                                <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                              <?php else: ?>
                                                <p><?php echo e(str_limit($item->detail,100,'...')); ?></p>
                                              <?php endif; ?>
                                              <?php if($auth && $subscribed == 1): ?>
                                                <a href="<?php echo e(url('show/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                              <?php else: ?>
                                                 <a href="<?php echo e(url('show/guest/detail',$item->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                              <?php endif; ?>
                                            </div>
                                           
                                            <div class="des-btn-block">
                                              <?php if($auth && $subscribed==1): ?>
                                                <?php if(isset($gets1->episodes[0])): ?>
                                                  <?php if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req)): ?>

                                                    <?php if($gets1->episodes[0]->video_link['iframeurl'] !=""): ?>
                                                   
                                                      <a href="#" onclick="playoniframe('<?php echo e($gets1->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($gets1->episodes[0]->seasons->tvseries->id); ?>','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                                      </a>

                                                    <?php else: ?>
                                                      <a href="<?php echo e(route('watchTvShow',$gets1->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                                    <?php endif; ?>
                                                  <?php else: ?>
                                                    <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                                  <?php endif; ?>
                                                <?php endif; ?>
                                                 <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                                    <a href="<?php echo e(route('watchtvTrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                                  <?php endif; ?>
                                                <?php else: ?>
                                                   <?php if($gets1->trailer_url != null || $gets1->trailer_url != ''): ?>
                                                    <a href="<?php echo e(route('guestwatchtvtrailer',$gets1->id)); ?>" class="iframe btn btn-default"><?php echo e(__('staticwords.watchtrailer')); ?></a>
                                                  <?php endif; ?>
                                              <?php endif; ?>
                                              <?php if($catlog == 0 && $subscribed ==1): ?>
                                                <?php if(isset($gets1)): ?>
                                                  <?php if(isset($wishlist_check->added)): ?>
                                                    <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></a>
                                                  <?php else: ?>
                                                    <?php if($gets1): ?>
                                                      <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                                      </a>
                                                    <?php endif; ?>
                                                  <?php endif; ?>
                                                <?php endif; ?>
                                              <?php elseif($catlog ==1 && $auth): ?>
                                                <?php if(isset($gets1)): ?>
                                                  <?php if(isset($wishlist_check->added)): ?>
                                                    <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e($wishlist_check->added == 1 ? __('staticwords.removefromwatchlist') : __('staticwords.addtowatchlist')); ?></a>
                                                  <?php else: ?>
                                                    <?php if($gets1): ?>
                                                      <a onclick="addWish(<?php echo e($gets1->id); ?>,'<?php echo e($gets1->type); ?>')" class="addwishlistbtn<?php echo e($gets1->id); ?><?php echo e($gets1->type); ?> btn-default"><?php echo e(__('staticwords.addtowatchlist')); ?>

                                                      </a>
                                                    <?php endif; ?>
                                                  <?php endif; ?>
                                                <?php endif; ?>
                                              <?php endif; ?>
                                            </div>
                                           
                                          </div>
                                          <?php endif; ?>
                                         
                                        </div>
                                      </div>
                                    <?php endif; ?>
                                  <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </div>
                      <?php endif; ?>
                  <!-- Continue watch Tvshows and movies in Grid view END-->

              </div>
          </div> 
        <?php endif; ?>
          
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>

<!----------- Continue watch end ----------------->



<!------------- Movie Pormotion ------------------->


  <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="container-fluid" >
      <?php if($section->section_id == 7 && $home_blocks != NULL && count($home_blocks)>0): ?>

      <div id="myCarousel" class="carousel slide home-dtl-slider" data-ride="carousel" style="background-image: url('<?php echo e(asset('images/home_slider/movies/slide_1591259550414580.jpg')); ?>')">
        <div class="overlay-bg"></div>
  <!-- Indicators -->
        
        <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <?php
            $homeblocks = [];
            foreach ($home_blocks as $key => $item) {
                
                $home_movie =  App\Movie::join('videolinks','videolinks.movie_id','=','movies.id')
                            ->join('home_blocks','home_blocks.movie_id','=','movies.id')
                             ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id','movies.poster as poster','movies.rating as rating','movies.duration as duration','movies.publish_year as publish_year','movies.maturity_rating as maturity_rating','movies.detail as detail','movies.trailer_url as trailer_url','movies.slug as slug')
                             ->where('movies.id',$item->movie_id)->first();
                  
                 $homeblocks[] = $home_movie;

               

            }

            foreach ($home_blocks as $key => $item) {
               $home_tvs = App\TvSeries::
                              join('seasons','seasons.tv_series_id','=','tv_series.id')
                              ->join('episodes','episodes.seasons_id','=','seasons.id')
                              ->join('videolinks','videolinks.episode_id','=','episodes.id')
                              ->join('home_blocks','home_blocks.tv_series_id','=','tv_series.id')
                              ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.thumbnail as thumbnail','tv_series.title as title','tv_series.rating as rating','seasons.publish_year as publish_year','tv_series.maturity_rating as age_req','tv_series.detail as detail','seasons.season_no as season_no','videolinks.iframeurl as iframeurl','tv_series.poster as poster','seasons.trailer_url as trailer_url')
                              ->where('tv_series.id',$item->tv_series_id)->first();
                  
                $homeblocks[] = $home_tvs;



            }

            $homeblocks = array_values(array_filter($homeblocks));

        ?>

        <?php $__currentLoopData = $homeblocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ki => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
            <?php
             if(isset($auth)){
               if ($item->type == 'M') {
                $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                  ['user_id', '=', $auth->id],
                                                                  ['movie_id', '=', $item->id],
                                                                ])->first();
                }
               }

               if(isset($auth)){

                  $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                  if (isset($gets1)) {


                    $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                ['user_id', '=', $auth->id],
                                                                ['season_id', '=', $gets1->id],
                      ])->first();


                    }

                  }
                  else{
                     $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                  }
            ?>
 
              <div class="item <?php echo e($ki==0 ? "active" : ""); ?>">
                <div class="row">
                  <?php if($item->status == 1): ?>
                    <?php if($item->type == 'M'): ?>
                      <?php
                         $image = 'images/movies/posters/'.$item->poster;
                        // Read image path, convert to base64 encoding
                      
                        $imageData = base64_encode(@file_get_contents($image));
                        if($imageData){
                        // Format the image SRC:  data:{mime};base64,{data};
                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                        }else{
                            $src = 'images/default-poster.jpg';
                        }
                      ?>
                        <div class="col-md-6">
                          <div class="slider-height">
                          
                            <?php if($auth && $subscribed==1): ?>
                              <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                  <?php
                                    $url = str_replace("https://youtu.be/", "https://youtube.com/embed/", $item->trailer_url)
                                  ?>
                                   <iframe src="<?php echo e($url); ?>" height="350" width="100%"></iframe>
                                <?php else: ?>
                                  <a href="<?php echo e(url('movie/detail',$item->slug)); ?>">
                                    <?php if($src): ?>
                                      <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="movie-image" style="width:100%">
                                    <?php else: ?>
                                      <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="movie-image" style="width:100%">
                                    <?php endif; ?>
                                  </a>
                              <?php endif; ?>              

                            <?php else: ?>
                             
                              <?php if($item->trailer_url != null || $item->trailer_url != ''): ?>
                                <?php
                                  $url = str_replace("https://youtu.be/", "https://youtube.com/embed/", $item->trailer_url)
                                ?>
                                 <iframe src="<?php echo e($url); ?>" height="215" width="100%"></iframe>
                              <?php else: ?>
                                <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>">
                                  <?php if($src): ?>
                                    <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="movie-image" style="width:100%">
                                  <?php else: ?>
                                    <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="movie-image" style="width:100%">
                                  <?php endif; ?>
                                </a>
                              <?php endif; ?>             
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="slider-height-dtl">
                            <img src="<?php echo e(url('images/logo/'.$logo)); ?>" class="img-responsive" alt="<?php echo e($w_title); ?>">
                              <h1><?php echo e($item->title); ?></h1><br/>
                              <div class="row">
                                 <div class="des-btn-block des-in-list">
                                    <?php if($auth && $subscribed==1): ?>
                                      <?php if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating)): ?>
                                        <?php if($item->video_link['iframeurl'] != null): ?>
                                          <a href="<?php echo e(route('watchmovieiframe',$item->id)); ?>"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                          </a>

                                        <?php else: ?>
                                          <a href="<?php echo e(route('watchmovie',$item->id)); ?>" class="iframe btn btn-play"> <span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                          </a>
                                        <?php endif; ?>
                                      <?php else: ?>
                                        <a onclick="myage(<?php echo e($age); ?>)" class=" iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                        </a>
                                      <?php endif; ?>
                                      
                                    <?php endif; ?>
                                   
                                    <?php if($auth && $subscribed ==1): ?>
                                      <a class="iframe btn btn-default" href="<?php echo e(url('movie/detail',$item->slug)); ?>"><i class="fa fa-info-circle"></i> <?php echo e(__('staticwords.moreinfo')); ?></a>
                                    <?php else: ?>
                                      <a class="iframe btn btn-default" href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>"><i class="fa fa-info-circle"></i> <?php echo e(__('staticwords.moreinfo')); ?></a>
                                    <?php endif; ?>
                                  </div>
                                </div>
                                <br/>
                                <p><?php echo e(str_limit($item->detail,150,'...')); ?></p>
                                <?php if($auth && $subscribed == 1): ?>
                                  <a href="<?php echo e(url('movie/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                <?php else: ?>
                                   <a href="<?php echo e(url('movie/guest/detail',$item->slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                                <?php endif; ?>
                                <br/>
                                <p class="text-right promotion"># <?php echo e(count($homeblocks)); ?>  <?php echo e(__('staticwords.topin')); ?> <?php echo e($menu->name); ?></p>
                          </div>
                        </div>
                      
                        <?php elseif($item->type === 'T'): ?>
                          <?php
                                                      
                          $image = 'images/tvseries/posters/'.$item->poster;
                            // Read image path, convert to base64 encoding
                          
                            $imageData = base64_encode(@file_get_contents($image));
                            if($imageData){
                            // Format the image SRC:  data:{mime};base64,{data};
                            $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                            }else{
                                $src = 'images/default-poster.jpg';
                            }
                          ?>
               
                        <div class="col-md-6">
                          <div class="slider-height">
                          <?php if($auth && $subscribed==1): ?>
                            <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                              <?php if($src): ?>
                               
                                <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="tvseries-image" style="width:100%">
                             
                              <?php else: ?>
                                <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="tvseries-image" style="width:100%">
                              <?php endif; ?>
                            </a>
                            <?php else: ?>
                             <a <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>" <?php endif; ?>>
                              <?php if($src): ?>
                                
                                <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="tvseries-image" style="width:100%">
                              
                              <?php else: ?>
                                <img data-src="<?php echo e($src); ?>" class="img-responsive lazy" alt="tvseries-image" style="width:100%">
                              <?php endif; ?>
                            </a>                
                          <?php endif; ?>
                        </div>
                        </div>
                        <div class="col-md-6">
                          <div class="slider-height-dtl">
                            <img data-src="<?php echo e(url('images/logo/'.$logo)); ?>" class="img-responsive lazy" alt="<?php echo e($w_title); ?>">
                            <h1><?php echo e($item->title); ?></h1>
                            <br/>
                            <div>
                             <div class="des-btn-block des-in-list">
                                <?php if(isset($gets1->episodes[0]) &&  $subscribed==1 && $auth): ?>
                                  <?php if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req)): ?>

                                    <?php if($gets1->episodes[0]->video_link['iframeurl'] !=""): ?>
                                     
                                      <a href="#" onclick="playoniframe('<?php echo e($gets1->episodes[0]->video_link['iframeurl']); ?>','<?php echo e($gets1->episodes[0]->seasons->tvseries->id); ?>','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                                       </a>

                                    <?php else: ?>
                                      <a href="<?php echo e(route('watchTvShow',$gets1->id)); ?>" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                    <?php endif; ?>
                                  <?php else: ?>
                                   <a onclick="myage(<?php echo e($age); ?>)" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span></a>
                                  <?php endif; ?>
                                 
                                <?php endif; ?>
                                <?php if($subscribed == 1 && $auth): ?>
                                  <a class="iframe btn btn-play" <?php if(isset($gets1)): ?> href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>" <?php endif; ?>><i class="fa fa-info-circle"></i> <?php echo e(__('staticwords.moreinfo')); ?></a>
                                <?php else: ?>
                                  <a class="iframe btn btn-play" <?php if(isset($gets1)): ?> href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>" <?php endif; ?>><i class="fa fa-info-circle"></i> <?php echo e(__('staticwords.moreinfo')); ?></a>

                                <?php endif; ?>
                              </div>
                            </div>

                             <br/>
                            <p><?php echo e(str_limit($item->detail,150,'...')); ?></p>
                            <?php if($auth && $subscribed == 1): ?>
                              <a href="<?php echo e(url('show/detail',$gets1->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                            <?php else: ?>
                               <a href="<?php echo e(url('show/guest/detail',$gets1->season_slug)); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                            <?php endif; ?>
                            <br/>
                            <p class="text-right promotion"># <?php echo e(count($homeblocks)); ?>  <?php echo e(__('staticwords.topin')); ?> <?php echo e($menu->name); ?></p>
                          </div>
                        </div>
                      </div>
                    <?php endif; ?>
                  <?php endif; ?>  
                </div>
              </div>     
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         
      </div>

       
       <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <?php endif; ?>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <br/>

<!----------- Movie Pormotion end ----------------->




       
  <?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php if($section->section_id == 2): ?>
      
      <div class="genre-prime-block genre-prime-block-one genre-paddin-top">
          <div class="container-fluid" id="post-data">
             
             <?php echo $__env->make('data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          
          </div>

          <div class="ajax-load text-center" style="display:none">
            <p><img src="<?php echo e(url('/images/loading.gif')); ?>"><?php echo e(__('staticwords.LoadingMore')); ?> ....</p>
          </div>
      </div> 

    <?php if(count($getallgenre) > 0): ?>
      <div class="genre-prime-block genre-prime-block-one genre-paddin-top">
          <div class="container-fluid">
               <h5 class="section-heading"><?php echo e(__('staticwords.viewallgenre')); ?></h5>
               
                <div class="genre-prime-slider owl-carousel">
                   <?php $__currentLoopData = $getallgenre; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <div class="item genre-prime-slide">
                   
                      
                          <?php if($auth && $subscribed==1): ?> 
                         
                          <a href="<?php echo e(route('show.in.genre',$genre->id)); ?>">
                            <div class="protip text-center" data-pt-placement="outside">
                            <?php if($genre->image != NULL): ?>

                              <img data-src="<?php echo e(url('images/genre/'.$genre->image)); ?>" class="img img-responsive genreview owl-lazy">
                              <?php else: ?>
                              <img data-src="<?php echo e(url('/images/default-thumbnail.jpg')); ?>" class="img img-responsive genreview owl-lazy">
                            <?php endif; ?>
                            </div>
                             <div class="content">
                              <h1 class="content-heading"><?php echo e($genre->name); ?></h1>
                            </div>

                          </a>
                          <?php else: ?>
                            <a href="<?php echo e(route('show.in.guest.genre',$genre->id)); ?>">
                             <div class="protip text-center" data-pt-placement="outside">
                            <?php if($genre->image != NULL): ?>

                              <img data-src="<?php echo e(url('images/genre/'.$genre->image)); ?>" class="img img-responsive genreview owl-lazy">
                              <?php else: ?>
                              <img data-src="<?php echo e(url('/images/default-thumbnail.jpg')); ?>" class="img img-responsive genreview owl-lazy">
                            <?php endif; ?>
                            </div>
                             <div class="content">
                              <h1 class="content-heading"><?php echo e($genre->name); ?></h1>
                            </div>
                            </a>
                          <?php endif; ?>
                        
                     
                    </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

              </div>  
          </div>
        <?php endif; ?>

    <?php endif; ?>


  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   
<?php endif; ?>
<!-- Blog Section -->
<?php $__currentLoopData = $menu->menusections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php if($section->section_id == 8): ?>
    <?php if($config->blog == '1'): ?>
      <?php if(isset($menu->getblogs) && count($menu->getblogs)>0): ?>
       <div class="genre-prime-block">
          <div class="container-fluid">
            <h5 class="section-heading"><?php echo e(__('staticwords.recentlyblog')); ?></h5>
            <div class="genre-prime-slider owl-carousel">
              <?php $__currentLoopData = $menu->getblogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($blog->blogs['is_active'] == 1): ?>
                  <div class="genre-prime-slide">
                    <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block-blog<?php echo e($blog->id); ?>">
                      <a href="<?php echo e(url('account/blog/'.$blog->blogs['slug'])); ?>">
                        <?php if($blog->blogs->image != null): ?>
                          <img data-src="<?php echo e(asset('images/blog/'.$blog->blogs['image'])); ?>" class="img-responsive owl-lazy" alt="blog-image">
                        <?php endif; ?>
                      </a>
                    </div>
                    <div id="prime-mix-description-block-blog<?php echo e($blog->id); ?>" class="prime-description-block">
                      <h5 class="description-heading"><?php echo e($blog->blogs['title']); ?></h5>
                      <ul class="description-list">
                        <li><i class="fa fa-clock-o"></i> <?php echo e(date ('d.m.Y',strtotime($blog->blogs['created_at']))); ?></li>
                        <li><i class="fa fa-user"></i> <?php echo e($blog->blogs->users['name']); ?></li>
                      </ul>
                      <div class="main-des">
                        <p><?php echo str_limit($blog->blogs->detail, 100); ?></p>
                        <a href="<?php echo e(url('account/blog/'.$blog->blogs['slug'])); ?>"><?php echo e(__('staticwords.readmore')); ?></a>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<!--------------------- live event ------------------------->

<?php if(isset($liveevent) && count($liveevent) > 0): ?>
  <div class="genre-prime-block">

    <div class="container-fluid">
      <h5 class="section-heading"><?php echo e(__('staticwords.liveevent')); ?> </h5>
      <div class="genre-prime-slider owl-carousel">
        <?php $__currentLoopData = $liveevent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $liveevents): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       
          <div class="genre-prime-slide">
            <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-title="#prime-genre-event-description-block<?php echo e($liveevents->id); ?>">
             <?php if($auth && $subscribed==1): ?>
             <a href="<?php echo e(url('event/detail',$liveevents->slug)); ?>">
              <?php if($liveevents->thumbnail != null || $liveevents->thumbnail != ''): ?>
              <img data-src="<?php echo e(asset('images/events/thumbnails/'.$liveevents->thumbnail)); ?>" class="img-responsive owl-lazy" alt="liveevent-image">
              <?php else: ?>
              <img data-src="<?php echo e(asset('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="liveevent-image">
              <?php endif; ?>
            </a>
            <?php else: ?>
            <a href="<?php echo e(url('event/guest/detail',$liveevents->slug)); ?>">
              <?php if($liveevents->thumbnail != null || $liveevents->thumbnail != ''): ?>
              <img data-src="<?php echo e(asset('images/events/thumbnails/'.$liveevents->thumbnail)); ?>" class="img-responsive owl-lazy" alt="liveevent-image">
              <?php else: ?>
              <img data-src="<?php echo e(asset('images/default-thumbnail.jpg')); ?>" class="img-responsive owl-lazy" alt="liveevent-image">
              <?php endif; ?>
            </a>
            <?php endif; ?>
          </div>
          <?php if(isset($protip) && $protip == 1): ?>
          <div id="prime-genre-event-description-block<?php echo e($liveevents->id); ?>" class="prime-description-block">
            <div class="prime-description-under-block">
              <h5 class="description-heading"><?php echo e($liveevents->title); ?></h5></br>

                <p>Start Time :- <b> <?php echo e(date('F j, Y  g:i:a',strtotime($liveevents->start_time))); ?> </b> </p>

                <p>End Time :- <b> <?php echo e(date('F j, Y  g:i:a',strtotime($liveevents->end_time))); ?> </b> </p>

                <p>Organized By :- <b> <?php echo e($liveevents->organized_by); ?> </b> </p>
            
              <div class="main-des">
                <p><?php echo e($liveevents->description); ?></p>
                
                <a href="#"><?php echo e(__('staticwords.readmore')); ?></a>
              </div>
              
             
             
                <div class="des-btn-block">
                 <?php
                    date_default_timezone_set('Asia/Calcutta');
                    $today_date = date('d jS Y | h:i:s');

                     $start_date = date('d jS Y | h:i a',strtotime($liveevents->start_time));

                     $end_date = date('d jS Y | h:i a',strtotime($liveevents->end_time));
                      
                  ?>
                    <?php if($today_date >= $start_date && $today_date <= $end_date): ?>

                      <?php if($liveevents->video_link['iframeurl'] != null): ?>
                        <?php if(Auth::check() && Auth::user()->is_admin == '1'): ?>
                          <a onclick="playoniframe('<?php echo e($liveevents['iframeurl']); ?>','<?php echo e($liveevents->id); ?>','event')" class="btn btn-play play-btn-icon<?php echo e($liveevents['id']); ?>"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                           </a>
                        <?php else: ?>

                           <a onclick="playoniframe('<?php echo e($liveevents['iframeurl']); ?>','<?php echo e($liveevents->id); ?>','event')" class="btn btn-play play-btn-icon<?php echo e($liveevents['id']); ?>"><span class="play-btn-icon "><i class="fa fa-play"></i></span><span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                            </a>
                        <?php endif; ?>

                      <?php else: ?>
                        <?php if(Auth::check() && Auth::user()->is_admin == '1'): ?>
                          <a  href="<?php echo e(route('watchevent',$liveevents->id)); ?>" class="btn btn-play play-btn-icon<?php echo e($liveevents['id']); ?>"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><?php echo e(__('staticwords.playnow')); ?></span>
                            </a>
                        <?php else: ?>
                          <a href="<?php echo e(url('/watch/event/'.$liveevents->id)); ?>" class=" btn btn-play play-btn-icon<?php echo e($liveevents['id']); ?>"><span class="play-btn-icon "><i class="fa fa-play" ><span class="play-text"><?php echo e(__('staticwords.playnow')); ?> </span></a>
                        <?php endif; ?>
                      <?php endif; ?>
                    
                    <?php endif; ?>
               </div>
               
             </div>
          </div>
          <?php endif; ?>
        </div>

     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </div>
  </div>
<?php endif; ?>


<!-------------------- end live event ---------------------->


        <!-- google adsense code -->
      <div class="container-fluid" id="adsense">
         <?php
            if (isset($ad) ) {
               if ($ad->ishome==1 && $ad->status==1) {
                  $code=  $ad->code;
                  echo html_entity_decode($code);
               }
            }
          ?>
      </div>
     
     <!-- google adsense code -->
      <div class="container-fluid" id="adsense">
         <?php
            if (isset($ad) ) {
               if ($ad->ishome==1 && $ad->status==1) {
                  $code=  $ad->code;
                  echo html_entity_decode($code);
               }
            }
          ?>
      </div>
     
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>

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

 
<script type="text/javascript">


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

    function addWish(id, type) {
      app.addToWishList(id, type);
      setTimeout(function() {
        $('.addwishlistbtn'+id+type).text(function(i, text){
          return text == "<?php echo e(__('staticwords.addtowatchlist')); ?>" ? "<?php echo e(__('staticwords.removefromwatchlist')); ?>" : "<?php echo e(__('staticwords.addtowatchlist')); ?>";
        });
      }, 100);
    }
  </script> 


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/home.blade.php ENDPATH**/ ?>
@extends('layouts.theme')
@section('title',"$menu->name")
@section('main-wrapper')

@php
 $age = AgeHelper::getage();
@endphp
  <!-- main wrapper  slider -->
  <section id="wishlistelement" class="main-wrapper">

    <div>
     <div id="home-main-block" class="home-main-block">
         
          <div id="home-slider-one" class="home-slider-one owl-carousel">
            @if(isset($home_slides) && count($home_slides) > 0)
              @foreach($home_slides as $slide)
                @if($slide->active == 1)
                  <div class="slider-block">
                    <div class="slider-image">
                      @if(isset($slide->slide_image))  
                        @if($slide->movie_id != null)
                          @if($auth && $subscribed==1)

                            <a href="{{url('movie/detail', $slide->movie->id)}}">
                              @if ($slide->slide_image != null)
                                @php
                                  $image = 'images/home_slider/movies/'. $slide->slide_image;
                                    // Read image path, convert to base64 encoding
                                    
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                   $src = '';
                                   }
                                @endphp
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="slider-image">
                                @elseif ($slide->movie->poster != null)
                                  @php
                                     $image = 'images/movies/posters/'. $slide->movie->poster;
                                    // Read image path, convert to base64 encoding
                                    
                                    $imageData = base64_encode(@file_get_contents($image));
                                    if($src){
                                    // Format the image SRC:  data:{mime};base64,{data};
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                    }else{
                                     $src = '';
                                     }
                                  @endphp
                                  <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="slider-image">
                                @endif
                            </a>
                          @else
                            <a href="{{url('movie/guest/detail', $slide->movie->slug)}}">
                              @if ($slide->slide_image != null)
                                @php
                                  $image = 'images/home_slider/movies/'. $slide->slide_image;
                                    // Read image path, convert to base64 encoding
                                    
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                    // Format the image SRC:  data:{mime};base64,{data};
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                     $src = '';
                                  }
                                @endphp
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="slider-image">
                              @elseif ($slide->movie->poster != null)
                                @php
                                  $image = 'images/movies/posters/'. $slide->movie->poster;
                                    // Read image path, convert to base64 encoding
                                    
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($src){
                                    // Format the image SRC:  data:{mime};base64,{data};
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                     $src = '';
                                  }
                                @endphp
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="slider-image">
                              @endif
                            </a>
                          @endif
                        @elseif($slide->tv_series_id != null && isset($slide->tvseries->seasons[0]))
                          @if($auth && $subscribed== 1)
                            <a href="{{url('show/detail', $slide->tvseries->seasons[0]->season_slug)}}">
                              @if ($slide->slide_image != null)
                                <img data-src="{{url('images/home_slider/shows/'. $slide->slide_image)}}" class="img-responsive owl-lazy" alt="slider-image">
                              @elseif ($slide->tvseries->poster != null)
                                <img data-src="{{url('images/tvseries/posters/'. $slide->tvseries->poster)}}" class="img-responsive owl-lazy" alt="slider-image">
                              @endif
                            </a>
                          @else
                            <a href="{{url('show/guest/detail', $slide->tvseries->seasons[0]->season_slug)}}">
                              @if ($slide->slide_image != null)
                                <img data-src="{{url('images/home_slider/shows/'. $slide->slide_image)}}" class="img-responsive owl-lazy" alt="slider-image">
                              @elseif ($slide->tvseries->poster != null)
                                <img data-src="{{url('images/tvseries/posters/'. $slide->tvseries->poster)}}" class="img-responsive owl-lazy" alt="slider-image">
                              @endif
                            </a>
                          @endif
                        @else
                         <a href="#">
                            @if ($slide->slide_image != null)
                              <img data-src="{{url('images/home_slider/'. $slide->slide_image)}}" class="img-responsive owl-lazy" alt="slider-image">
                            @endif
                          </a>
                        @endif
                      @endif
                      
                    </div>
                  </div>
                @endif
              @endforeach
            @endif
          </div>
          
        </div>

 
  <!-- Age -->
  @include('modal.agemodal')
  <!-- Age warning -->
  @include('modal.agewarning')


@if(count($menu->menusections)>0)

  @foreach($menu->menusections as $section)
        @php
            $recentlyadded = [];
            foreach ($recent_data as $key => $item) {
              
                $rm =  \DB::table('movies')
                             ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id','movies.thumbnail as thumbnail','movies.live as live','movies.slug as slug')
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
                
                $rectvs =  \DB::table('tv_series')
                              ->join('seasons','seasons.tv_series_id','=','tv_series.id')
                              ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.title as title','tv_series.thumbnail as thumbnail','seasons.season_slug as season_slug')
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
            
        @endphp
     
        @if($section->section_id == 1 && $recentlyadded != NULL && count($recentlyadded)>0)
        <div class="genre-main-block">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
                <div class="genre-dtl-block">
                 
                  <h5 class="section-heading">{{__('staticwords.RecentlyAddedIn')}} {{ $menu->name }}</h5>
                  <p class="section-dtl">{{__('staticwords.atthebigscreenathome')}}</p>
                  @if($auth && $subscribed==1)
                    
                    <a href="{{ route('showall',['menuid' => $menu->id, 'menuname' => $menu->name]) }}" class="see-more"> <b>{{__('staticwords.viewall')}}</b></a>
           
                  @else
                    
                    <a href="{{ route('guestshowall',['menuid' => $menu->id, 'menuname' => $menu->name]) }}" class="see-more"> <b>{{__('staticwords.viewall')}}</b></a>
             
                  @endif
                </div>
              </div>
                  <!-- Recently added movies and tv shows in list view End-->
                      @if($section->view == 1)
                        <div class="col-md-9">
                          <div class="genre-main-slider owl-carousel">
                           @foreach($recentlyadded as $item)
                               @php
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
                              @endphp

                              @if($item->status == 1)
                                @if($item->type == 'M')
                                @php
                                     $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                    // Read image path, convert to base64 encoding
                                    
                                    $imageData = base64_encode(@file_get_contents($image));
                                    if($imageData){
                                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                    }else{
                                        $src = url('images/default-thumbnail.jpg');
                                    }
                                @endphp
                                  <div class="genre-slide">
                                    <div class="genre-slide-image genre-image">
                                      @if($auth && $subscribed==1)
                                      <a href="{{url('movie/detail',$item->slug)}}">
                                        @if($src)
                                          <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                        @else
                                          <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                        @endif
                                      </a>
                                      @else
                                        <a href="{{url('movie/guest/detail',$item->slug)}}">
                                        @if($src)
                                          <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                        @else
                                          <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                        @endif
                                      </a>
                                      @endif
                                    </div>
                                    <div class="genre-slide-dtl">
                                      <h5 class="genre-dtl-heading">
                                         @if($auth && $subscribed==1)
                                      <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                      @else
                                      <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                                        @endif
                                      </h5>
                                    </div>
                                  </div>
                                @elseif($item->type == 'T')
                                    @php
                                         $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                        // Read image path, convert to base64 encoding
                                        
                                        $imageData = base64_encode(@file_get_contents($image));
                                        if($imageData){
                                            $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                        }else{
                                            $src = url('images/default-thumbnail.jpg');
                                        }
                                    @endphp
                                   <div class="genre-slide">
                                      <div class="genre-slide-image genre-image">
                                          @if($auth && $subscribed==1)
                                          <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                            @if($item->thumbnail != null)
                                              
                                              <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                            
                                            @else
                                              <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                            @endif
                                          </a>
                                          @else
                                           <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                                            @if($item->thumbnail != null)
                                              <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                          
                                            @else
                                              <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                            @endif
                                          </a>
                                          @endif 
                                      </div>
                                      
                                      <div class="genre-slide-dtl">
                                         @if($auth && $subscribed==1)
                                          <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                          @else
                                           <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                          @endif
                                      </div>  
                                   </div>
                                @endif
                              @endif
                           @endforeach 
                          </div>
                        </div>
                      @endif
                  <!-- Recently added movies and tv shows in list view End-->
                  
                   <!-- Recently Tvshows and movies in Grid view -->
                      @if($section->view == 0)
                          <div class="col-md-9">
                            <div class="cus_img">
                              @foreach($recentlyadded as $item)
                                 @php
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
                                  @endphp
                                  @if($item->status == 1)
                                    @if($item->type == 'M')
                                    @php
                                     $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                    // Read image path, convert to base64 encoding
                                    
                                    $imageData = base64_encode(@file_get_contents($image));
                                    if($imageData){
                                    // Format the image SRC:  data:{mime};base64,{data};
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                    }else{
                                        $src = url('images/default-thumbnail.jpg');
                                    }
                                @endphp
                                      <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                          <div class="genre-slide-image genre-grid">
                                              @if($auth && $subscribed==1)
                                                <a href="{{url('movie/detail',$item->slug)}}">
                                                @if($src)
                                                  <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                                @else
                                                  <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                                @endif
                                               </a>
                                              @else
                                                 <a href="{{url('movie/guest/detail',$item->slug)}}">
                                                  @if($src)
                                                    <img data-src="{{$src}}" class="img-responsive lazy" alt="genre-image">
                                                  @else
                                                    <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                                  @endif
                                                </a>

                                                @endif
                                          
                                           </div>
                                            <div class="genre-slide-dtl">
                                              <h5 class="genre-dtl-heading">
                                                 @if($auth && $subscribed==1)
                                                <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                                @else
                                                <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>

                                                @endif
                                              </h5>
                                            </div>
                                      </div>
                                    @elseif($item->type == 'T')
                                    @php
                                     $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                    // Read image path, convert to base64 encoding
                                    
                                    $imageData = base64_encode(@file_get_contents($image));
                                    if($imageData){
                                    // Format the image SRC:  data:{mime};base64,{data};
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                    }else{
                                        $src = url('images/default-thumbnail.jpg');
                                    }
                                @endphp
                                       <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                          <div class="genre-slide-image genre-grid">
                                             @if($auth && $subscribed==1)
                                              <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                                @if($src)
                                                  
                                                  <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                                
                                                @else
                                                  <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                                @endif
                                              </a>
                                              @else
                                               <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                                                @if($src)
                                                  <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                                
                                                @else
                                                  <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                                @endif
                                              </a>
                                              @endif
                                         
                                          </div>
                                          <div class="genre-slide-dtl">
                                              @if($auth && $subscribed==1)
                                              <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                              @else
                                               <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                              @endif
                                          </div>
                                      </div>
                                    @endif
                                  @endif
                              @endforeach
                            </div>
                          </div>
                      @endif
                  <!-- Recently Tvshows and movies in Grid view END-->
               
            </div> 
         </div>
        </div>

        
  

        @endif
      
  @endforeach
      
  @foreach($menu->menusections as $section)
  
  <!-- Featured Movies and TvShows -->
        @php
            $featuresitems = [];
            foreach ($menu_data as $key => $item) {
                
                $fmovie =  \DB::table('movies')
                             ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id','movies.thumbnail as thumbnail','movies.slug as slug')
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
               $ftvs =  \DB::table('tv_series')
                              ->join('seasons','seasons.tv_series_id','=','tv_series.id')
                              ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.title as title','tv_series.thumbnail as thumbnail','seasons.season_slug as season_slug')
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
            
        @endphp


         @if($section->section_id == 3 && $featuresitems != NULL && count($featuresitems)>0)
           <div class="genre-main-block">
              <div class="container-fluid">
               
                <div class="row">
                  <div class="col-md-3">
                    <div class="genre-dtl-block">
                        <h5 class="section-heading">{{__('staticwords.FeaturedIn')}} {{ $menu->name }}</h5>
                         <p class="section-dtl">{{__('staticwords.atthebigscreenathome')}}</p>
                          <!-- Featured Tvshows and movies in List view -->
                    </div>
                  </div>
                  @if($section->view == 1)
                    <div class="col-md-9">
                      <div class="genre-main-slider owl-carousel">
                       @foreach($featuresitems as $item)
                           @php
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
                          @endphp

                          @if($item->status == 1)
                            @if($item->type == 'M')
                            @php
                               $image = 'images/movies/thumbnails/'.$item->thumbnail;
                              // Read image path, convert to base64 encoding
                            
                              $imageData = base64_encode(@file_get_contents($image));
                              if($imageData){
                              // Format the image SRC:  data:{mime};base64,{data};
                              $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                              }else{
                                  $src = url('images/default-thumbnail.jpg');
                              }
                            @endphp

                              <div class="genre-slide">
                                <div class="genre-slide-image genre-image">
                                  @if($auth && $subscribed==1)
                                  <a href="{{url('movie/detail',$item->slug)}}">
                                    @if($src)
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    @else
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    @endif
                                  </a>
                                  @else
                                    <a href="{{url('movie/guest/detail',$item->slug)}}">
                                    @if($src)
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    @else
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    @endif
                                  </a>
                                  @endif
                                </div>
                                <div class="genre-slide-dtl">
                                  <h5 class="genre-dtl-heading">
                                     @if($auth && $subscribed==1)
                                  <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                  @else
                                  <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                                    @endif
                                  </h5>
                                </div>
                              </div>
                            @elseif($item->type == 'T')
                            
                              @php
                                 $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                // Read image path, convert to base64 encoding
                              
                                $imageData = base64_encode(@file_get_contents($image));
                                if($imageData){
                                // Format the image SRC:  data:{mime};base64,{data};
                                $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                }else{
                                    $src = url('images/default-thumbnail.jpg');
                                }
                              @endphp
                              <div class="genre-slide">
                                <div class="genre-slide-image genre-image">
                                    @if($auth && $subscribed==1)
                                    <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                      @if($item->thumbnail != null)
                                        
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      
                                      @else
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      @endif
                                    </a>
                                    @else
                                     <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                                      @if($item->thumbnail != null)
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    
                                      @else
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      @endif
                                    </a>
                                    @endif 
                                </div>
                                
                                <div class="genre-slide-dtl">
                                   @if($auth && $subscribed==1)
                                    <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                    @else
                                     <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                    @endif
                                </div>  
                             </div>
                            @endif
                          @endif
                       @endforeach 
                      </div>
                    </div>
                  @endif
                  <!-- Featured Tvshows and movies in List view END -->

                  <!-- Featured Tvshows and movies in Grid view -->
                  @if($section->view == 0)
                      <div class="col-md-9">
                        <div class="cus_img">
                          @foreach($featuresitems as $item)
                             @php
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
                              @endphp
                              @if($item->status == 1)
                                @if($item->type == 'M')
                                @php
                                   $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                  // Read image path, convert to base64 encoding
                                
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                      $src = url('images/default-thumbnail.jpg');
                                  }
                                @endphp

                                <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                  <div class="genre-slide-image genre-grid">
                                    @if($auth && $subscribed==1)
                                      <a href="{{url('movie/detail',$item->slug)}}">
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                      @else
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                      @endif
                                     </a>
                                    @else
                                       <a href="{{url('movie/guest/detail',$item->slug)}}">
                                        @if($src)
                                          <img data-src="{{$src}}" class="img-responsive lazy" alt="genre-image">
                                        @else
                                          <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                        @endif
                                      </a>

                                      @endif
                                  
                                  </div>
                                  <div class="genre-slide-dtl">
                                    <h5 class="genre-dtl-heading">
                                       @if($auth && $subscribed==1)
                                      <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                      @else
                                      <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>

                                      @endif
                                    </h5>
                                  </div>
                                </div>
                                @elseif($item->type == 'T')
                                @php
                                   $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                  // Read image path, convert to base64 encoding
                                
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                      $src = url('images/default-thumbnail.jpg');
                                  }
                                @endphp
                                  <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                      <div class="genre-slide-image genre-grid">
                                         @if($auth && $subscribed==1)
                                          <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                            @if($src)
                                              
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            
                                            @else
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            @endif
                                          </a>
                                          @else
                                           <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                                            @if($src)
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            
                                            @else
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            @endif
                                          </a>
                                          @endif
                                     
                                      </div>
                                      <div class="genre-slide-dtl">
                                          @if($auth && $subscribed==1)
                                          <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                          @else
                                           <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                          @endif
                                      </div>
                                  </div>
                                @endif
                              @endif
                          @endforeach
                        </div>
                      </div>
                  @endif
                 <!-- Featured Tvshows and movies in Grid view END-->
                      
                </div>
              </div>
            </div> 
         @endif
       
     
 
   <!-- Featured Tv Shows and Movies end-->
  @endforeach


 
  
  <!--Based on intrest Movies and TvShows -->
  @if(Auth::user() &&  $subscribed==1)

    @foreach($menu->menusections as $section)
            @php
         
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
            
        @endphp
         
        @if($section->section_id == 4 && $recom_block != NULL && count($recom_block)>0)
           <div class="genre-main-block">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-3">
                    <div class="genre-dtl-block">
                      @php
                         $watch = App\WatchHistory::OrderBy('id','DESC')->first();
                         $movie = App\Movie::where('id',$watch->movie_id)->first();
                         $tv = App\Movie::where('id',$watch->tv_id)->first();
                      @endphp
                        @if(isset($movie))
                          <h5 class="section-heading">{{__('staticwords.Becauseyouwatched')}}: {{ucfirst($movie->title)}}</h5>
                          <p class="section-dtl">{{__('staticwords.atthebigscreenathome')}}</p>
                        @else
                          <h5 class="section-heading">{{__('staticwords.Becauseyouwatched')}} : {{ucfirst($tv->title)}}</h5>
                          <p class="section-dtl">{{__('staticwords.atthebigscreenathome')}}</p>
                        @endif
                          <!-- Based on intrest tvseries and movies in List view -->
                    </div>
                  </div>
                  @if($section->view == 1)
                    <div class="col-md-9">
                      <div class="genre-main-slider owl-carousel">
                       @foreach($recom_block as $item)
                           @php
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
                          @endphp

                          @if($item->status == 1)
                            @if($item->type == 'M')
                            @php
                               $image = 'images/movies/thumbnails/'.$item->thumbnail;
                              // Read image path, convert to base64 encoding
                            
                              $imageData = base64_encode(@file_get_contents($image));
                              if($imageData){
                              // Format the image SRC:  data:{mime};base64,{data};
                              $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                              }else{
                                  $src = url('images/default-thumbnail.jpg');
                              }
                            @endphp

                              <div class="genre-slide">
                                <div class="genre-slide-image genre-image">
                                  @if($auth && $subscribed==1)
                                  <a href="{{url('movie/detail',$item->slug)}}">
                                    @if($src)
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    @else
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    @endif
                                  </a>
                                  @else
                                    <a href="{{url('movie/guest/detail',$item->slug)}}">
                                    @if($src)
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    @else
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    @endif
                                  </a>
                                  @endif
                                </div>
                                <div class="genre-slide-dtl">
                                  <h5 class="genre-dtl-heading">
                                     @if($auth && $subscribed==1)
                                  <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                  @else
                                  <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                                    @endif
                                  </h5>
                                </div>
                              </div>
                            @elseif($item->type == 'T')
                            
                              @php
                                 $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                // Read image path, convert to base64 encoding
                              
                                $imageData = base64_encode(@file_get_contents($image));
                                if($imageData){
                                // Format the image SRC:  data:{mime};base64,{data};
                                $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                }else{
                                    $src = url('images/default-thumbnail.jpg');
                                }
                              @endphp
                              <div class="genre-slide">
                                <div class="genre-slide-image genre-image">
                                    @if($auth && $subscribed==1)
                                    <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                      @if($item->thumbnail != null)
                                        
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      
                                      @else
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      @endif
                                    </a>
                                    @else
                                     <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                                      @if($item->thumbnail != null)
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    
                                      @else
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      @endif
                                    </a>
                                    @endif 
                                </div>
                                
                                <div class="genre-slide-dtl">
                                   @if($auth && $subscribed==1)
                                    <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                    @else
                                     <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                    @endif
                                </div>  
                             </div>
                            @endif
                          @endif
                       @endforeach 
                      </div>
                    </div>
                  @endif
                  <!-- Based on intrest tvseries and movies in List view END -->

                  <!-- Based on intrest tvseries and movies in Grid view -->
                  @if($section->view == 0)
                      <div class="col-md-9">
                        <div class="cus_img">
                          @foreach($recom_block as $item)
                             @php
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
                              @endphp
                              @if($item->status == 1)
                                @if($item->type == 'M')
                                @php
                                   $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                  // Read image path, convert to base64 encoding
                                
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                      $src = url('images/default-thumbnail.jpg');
                                  }
                                @endphp

                                <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                  <div class="genre-slide-image genre-grid">
                                    @if($auth && $subscribed==1)
                                      <a href="{{url('movie/detail',$item->slug)}}">
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                      @else
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                      @endif
                                     </a>
                                    @else
                                       <a href="{{url('movie/guest/detail',$item->slug)}}">
                                        @if($src)
                                          <img data-src="{{$src}}" class="img-responsive lazy" alt="genre-image">
                                        @else
                                          <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                        @endif
                                      </a>

                                      @endif
                                  
                                  </div>
                                  <div class="genre-slide-dtl">
                                    <h5 class="genre-dtl-heading">
                                       @if($auth && $subscribed==1)
                                      <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                      @else
                                      <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>

                                      @endif
                                    </h5>
                                  </div>
                                </div>
                                @elseif($item->type == 'T')
                                @php
                                   $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                  // Read image path, convert to base64 encoding
                                
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                      $src = url('images/default-thumbnail.jpg');
                                  }
                                @endphp
                                  <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                      <div class="genre-slide-image genre-grid">
                                         @if($auth && $subscribed==1)
                                          <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                            @if($src)
                                              
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            
                                            @else
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            @endif
                                          </a>
                                          @else
                                           <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                                            @if($src)
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            
                                            @else
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            @endif
                                          </a>
                                          @endif
                                     
                                      </div>
                                      <div class="genre-slide-dtl">
                                          @if($auth && $subscribed==1)
                                          <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                          @else
                                           <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                          @endif
                                      </div>
                                  </div>
                                @endif
                              @endif
                          @endforeach
                        </div>
                      </div>
                  @endif
                 <!--Based on intrest tvseries and movies in Grid view END-->
                      
                </div>
              </div>
            </div> 
         @endif
       
     
    @endforeach
  @endif
  <!-- Based on intrest watch Tv Shows and Movies end-->
  

 
  
  <!--continue watch Movies and TvShows -->
  @if(Auth::user() && $subscribed==1)

    @foreach($menu->menusections as $section)
        @php
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
                              ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.thumbnail as thumbnail','tv_series.title as title','tv_series.rating as rating','seasons.publish_year as publish_year','tv_series.maturity_rating as age_req','tv_series.detail as detail','seasons.season_no as season_no','videolinks.iframeurl as iframeurl','seasons.season_slug as season_slug')
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
            
        @endphp
         
        @if($section->section_id == 5 && $historyadded != NULL && count($historyadded)>0)
           <div class="genre-main-block">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-3">
                    <div class="genre-dtl-block">
                        <h5 class="section-heading">{{__('staticwords.ContinueWatchingFor')}} {{Auth::user()->name}}</h5>
                         <p class="section-dtl">{{__('staticwords.atthebigscreenathome')}}</p>
                        @if($auth && $subscribed==1)
                    
                         <a href="{{ route('watchhistory') }}" class="see-more"> <b>{{__('staticwords.viewall')}}</b></a>
                 
                       
                   
                        @endif 
                          <!-- continue watch and movies in List view -->
                    </div>
                  </div>
                  @if($section->view == 1)
                    <div class="col-md-9">
                      <div class="genre-main-slider owl-carousel">
                       @foreach($historyadded as $item)
                           @php
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
                          @endphp

                          @if($item->status == 1)
                            @if($item->type == 'M')
                            @php
                               $image = 'images/movies/thumbnails/'.$item->thumbnail;
                              // Read image path, convert to base64 encoding
                            
                              $imageData = base64_encode(@file_get_contents($image));
                              if($imageData){
                              // Format the image SRC:  data:{mime};base64,{data};
                              $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                              }else{
                                  $src = url('images/default-thumbnail.jpg');
                              }
                            @endphp

                              <div class="genre-slide">
                                <div class="genre-slide-image genre-image">
                                  @if($auth && $subscribed==1)
                                    <a href="{{url('movie/detail',$item->slug)}}">
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      @else
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      @endif
                                    </a>
                                  @else
                                    <a href="{{url('movie/guest/detail',$item->slug)}}">
                                    @if($src)
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    @else
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    @endif
                                  </a>
                                 
                                  @endif
                                </div>
                                <div class="genre-slide-dtl">
                                  <h5 class="genre-dtl-heading">
                                  @if($auth && $subscribed==1)
                                    <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                  @else
                                  <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                                 
                                  @endif
                                  </h5>
                                </div>
                              </div>
                            @elseif($item->type == 'T')
                            
                              @php
                                 $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                // Read image path, convert to base64 encoding
                              
                                $imageData = base64_encode(@file_get_contents($image));
                                if($imageData){
                                // Format the image SRC:  data:{mime};base64,{data};
                                $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                }else{
                                    $src = url('images/default-thumbnail.jpg');
                                }
                              @endphp
                              <div class="genre-slide">
                                <div class="genre-slide-image genre-image">
                                    @if($auth && $subscribed==1)
                                    <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                      @if($item->thumbnail != null)
                                        
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      
                                      @else
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      @endif
                                    </a>
                                   
                                    @endif 
                                </div>
                                
                                <div class="genre-slide-dtl">
                                   @if($auth && $subscribed==1)
                                    <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                   
                                    @endif
                                </div>  
                             </div>
                            @endif
                          @endif
                       @endforeach 
                      </div>
                    </div>
                  @endif
                  <!-- continue watch and movies in List view END -->

                  <!-- continue watch and movies in Grid view -->
                  @if($section->view == 0)
                      <div class="col-md-9">
                        <div class="cus_img">
                          @foreach($historyadded as $item)
                             @php
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
                              @endphp
                              @if($item->status == 1)
                                @if($item->type == 'M')
                                @php
                                   $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                  // Read image path, convert to base64 encoding
                                
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                      $src = url('images/default-thumbnail.jpg');
                                  }
                                @endphp

                                <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                  <div class="genre-slide-image genre-grid">
                                    @if($auth && $subscribed==1)
                                      <a href="{{url('movie/detail',$item->slug)}}">
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                      @else
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                      @endif
                                     </a>
                                    @else
                                       <a href="{{url('movie/guest/detail',$item->slug)}}">
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                      @else
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                      @endif
                                     </a>
                                    
                                    @endif
                                  
                                  </div>
                                  <div class="genre-slide-dtl">
                                    <h5 class="genre-dtl-heading">
                                      @if($auth && $subscribed==1)
                                        <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                      @else
                                        <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                                      @endif
                                    </h5>
                                  </div>
                                </div>
                                @elseif($item->type == 'T')
                                @php
                                   $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                  // Read image path, convert to base64 encoding
                                
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                      $src = url('images/default-thumbnail.jpg');
                                  }
                                @endphp
                                  <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                      <div class="genre-slide-image genre-grid">
                                         @if($auth && $subscribed==1)
                                          <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                            @if($src)
                                              
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            
                                            @else
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            @endif
                                          </a>
                                         
                                          @endif
                                     
                                      </div>
                                      <div class="genre-slide-dtl">
                                          @if($auth && $subscribed==1)
                                          <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                         
                                          @endif
                                      </div>
                                  </div>
                                @endif
                              @endif
                          @endforeach
                        </div>
                      </div>
                  @endif
                 <!--continue watch and movies in Grid view END-->
                      
                </div>
              </div>
            </div> 
         @endif
       
     
    @endforeach
  @endif
   <!-- continue watch Tv Shows and Movies end-->
  
<!------------- Movie Pormotion ------------------->


  @foreach($menu->menusections as $section)
     <div class="container-fluid" >
      @if($section->section_id == 7 && $home_blocks != NULL && count($home_blocks)>0)

      <div id="myCarousel" class="carousel slide home-dtl-slider" data-ride="carousel" style="background-image: url('{{ asset('images/home_slider/movies/slide_1591259550414580.jpg') }}')">
        <div class="overlay-bg"></div>
        <!-- Indicators -->
        
        <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        @php
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

        @endphp

        @foreach($homeblocks as $ki => $item)
          
            @php
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
            @endphp
 
              <div class="item {{ $ki==0 ? "active" : "" }}">
                <div class="row">
                  @if($item->status == 1)
                    @if($item->type == 'M')
                      @php
                         $image = 'images/movies/posters/'.$item->poster;
                        // Read image path, convert to base64 encoding
                      
                        $imageData = base64_encode(@file_get_contents($image));
                        if($imageData){
                        // Format the image SRC:  data:{mime};base64,{data};
                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                        }else{
                            $src = 'images/default-poster.jpg';
                        }
                      @endphp
                        <div class="col-md-6">
                          <div class="slider-height">
                          
                            @if($auth && $subscribed==1)
                              @if($item->trailer_url != null || $item->trailer_url != '')
                                  @php
                                    $url = str_replace("https://youtu.be/", "https://youtube.com/embed/", $item->trailer_url)
                                  @endphp
                                   <iframe src="{{$url}}" height="350" width="100%"></iframe>
                                @else
                                  <a href="{{url('movie/detail',$item->slug)}}">
                                    @if($src)
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy
                                      " alt="genre-image" style="width:100%">
                                    @else
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image" style="width:100%">
                                    @endif
                                  </a>
                              @endif              

                            @else
                             
                              @if($item->trailer_url != null || $item->trailer_url != '')
                                @php
                                  $url = str_replace("https://youtu.be/", "https://youtube.com/embed/", $item->trailer_url)
                                @endphp
                                 <iframe src="{{$url}}" height="215" width="100%"></iframe>
                              @else
                                <a href="{{url('movie/guest/detail',$item->slug)}}">
                                  @if($src)
                                    <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image" style="width:100%">
                                  @else
                                    <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image" style="width:100%">
                                  @endif
                                </a>
                              @endif             
                            @endif
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="slider-height-dtl">
                            <img src="{{url('images/logo/'.$logo)}}" class="img-responsive" alt="{{$w_title}}">
                              <h1>{{$item->title}}</h1><br/>
                              <div class="row">
                                 <div class="des-btn-block des-in-list">
                                    @if($auth && $subscribed==1)
                                      @if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating))
                                        @if($item->video_link['iframeurl'] != null)
                                          <a onclick="{{route('watchmovieiframe',$item->id)}}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                                          </a>

                                        @else
                                          <a href="{{route('watchmovie',$item->id)}}" class="iframe btn btn-play"> <span class="play-btn-icon"><i class="fa fa-play"></i></span><span class="play-text">{{__('staticwords.playnow')}}</span>
                                          </a>
                                        @endif
                                      @else
                                        <a onclick="myage({{$age}})" class=" iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                                        </a>
                                      @endif
                                      
                                    @endif
                                   
                                    @if($auth && $subscribed ==1)
                                      <a class="iframe btn btn-play" href="{{url('movie/detail',$item->slug)}}"><i class="fa fa-info-circle"></i> {{__('staticwords.moreinfo')}}</a>
                                    @else
                                      <a class="iframe btn btn-play" href="{{url('movie/guest/detail',$item->slug)}}"><i class="fa fa-info-circle"></i> {{__('staticwords.moreinfo')}}</a>
                                    @endif
                                  </div>
                                </div>
                                <br/>
                                <p>{{str_limit($item->detail,150)}}</p>
                                <br/>
                                <p class="text-right promotion"># {{count($homeblocks)}}  {{__('staticwords.topin')}} {{$menu->name}}</p>
                          </div>
                        </div>
                      
                        @elseif($item->type === 'T')
                          @php
                                                      
                          $image = 'images/tvseries/posters/'.$item->poster;
                            // Read image path, convert to base64 encoding
                          
                            $imageData = base64_encode(@file_get_contents($image));
                            if($imageData){
                            // Format the image SRC:  data:{mime};base64,{data};
                            $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                            }else{
                                $src = 'images/default-poster.jpg';
                            }
                          @endphp
               
                        <div class="col-md-6">
                          <div class="slider-height">
                          @if($auth && $subscribed==1)
                            <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                              @if($src)
                               
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image" style="width:100%">
                             
                              @else
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image" style="width:100%">
                              @endif
                            </a>
                            @else
                             <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                              @if($src)
                                
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image" style="width:100%">
                              
                              @else
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image" style="width:100%">
                              @endif
                            </a>                
                          @endif
                        </div>
                        </div>
                        <div class="col-md-6">
                          <div class="slider-height-dtl">
                            <img src="{{url('images/logo/'.$logo)}}" class="img-responsive" alt="{{$w_title}}">
                            <h1>{{$item->title}}</h1>
                            <br/>
                            <div>
                             <div class="des-btn-block des-in-list">
                                @if (isset($gets1->episodes[0]) &&  $subscribed==1 && $auth)
                                  @if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req))

                                    @if($gets1->episodes[0]->video_link['iframeurl'] !="")
                                     
                                      <a href="#" onclick="playoniframe('{{ $gets1->episodes[0]->video_link['iframeurl'] }}','{{ $gets1->episodes[0]->seasons->tvseries->id }}','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                                       </a>

                                    @else
                                      <a href="{{ route('watchTvShow',$gets1->id) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span></a>
                                    @endif
                                  @else
                                   <a onclick="myage({{$age}})" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span></a>
                                  @endif
                                 
                                @endif
                                @if($subscribed == 1 && $auth)
                                  <a class="iframe btn btn-play" @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif><i class="fa fa-info-circle"></i> {{__('staticwords.moreinfo')}}</a>
                                @else
                                  <a class="iframe btn btn-play" @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif><i class="fa fa-info-circle"></i> {{__('staticwords.moreinfo')}}</a>

                                @endif
                              </div>
                            </div>

                             <br/>
                            <p>{{str_limit($item->detail,150)}}</p>
                            <br/>
                            <p class="text-right promotion"># {{count($homeblocks)}}  {{__('staticwords.topin')}} {{$menu->name}}</p>
                          </div>
                        </div>
                      </div>
                    @endif
                  @endif  
                </div>
              </div>     
            @endforeach
         
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
      @endif
    </div>
  @endforeach
  <br/>

<!----------- Movie Pormotion end ----------------->


       
  @foreach($menu->menusections as $section)

     @if($section->section_id == 2)
        
        @include('data2')

       @if(count($getallgenre) > 0)
      <div class="genre-prime-block genre-prime-block-one genre-paddin-top">
          <div class="container-fluid">
               <h5 class="section-heading">{{__('staticwords.viewallgenre')}}</h5>
               
                <div class="genre-prime-slider owl-carousel">
                   @foreach($getallgenre as $genre)
                   <div class="item genre-prime-slide">
                   
                      
                          @if($auth && $subscribed==1) 
                         
                          <a href="{{ route('show.in.genre',$genre->id) }}">
                            <div class="protip text-center" data-pt-placement="outside">
                            @if($genre->image != NULL)

                              <img data-src="{{url('images/genre/'.$genre->image)}}" class="img img-responsive genreview owl-lazy">
                              @else
                              <img data-src="{{url('/images/default-thumbnail.jpg')}}" class="img img-responsive genreview owl-lazy">
                            @endif
                            </div>
                             <div class="content">
                              <h1 class="content-heading">{{$genre->name}}</h1>
                            </div>

                          </a>
                          @else
                            <a href="{{ route('show.in.guest.genre',$genre->id) }}">
                             <div class="protip text-center" data-pt-placement="outside">
                            @if($genre->image != NULL)

                              <img data-src="{{url('images/genre/'.$genre->image)}}" class="img img-responsive genreview owl-lazy">
                              @else
                              <img data-src="{{url('/images/default-thumbnail.jpg')}}" class="img img-responsive genreview owl-lazy">
                            @endif
                            </div>
                             <div class="content">
                              <h1 class="content-heading">{{$genre->name}}</h1>
                            </div>
                            </a>
                          @endif
                        
                     
                    </div>
                      @endforeach
                </div>

              </div>  
          </div>
        @endif
                      
          @endif


  @endforeach

   
@endif

<!----------------------- Blog ------------------->
@foreach($menu->menusections as $section)
  @if($section->section_id == 8)
    @if($config->blog == '1')
      @if(isset($menu->getblogs) && count($menu->getblogs)>0)
        <div class="genre-main-block">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
                <div class="genre-dtl-block">
                  <h3 class="section-heading">{{__('staticwords.recentlyblog')}}</h3>
                  <p class="section-dtl">{{__('staticwords.atthebigscreenathome')}}</p>
                  <a href="{{ route('allblog') }}" class="see-more"> <b>{{__('staticwords.viewall')}}</b></a>
                </div>
              </div>
              <div class="col-md-9">
                <div class="genre-main-slider owl-carousel">
                  @foreach($menu->getblogs as $blog)
                   @if($blog->blogs['is_active'] == 1)
                  <div class="genre-slide">
                    <div class="genre-slide-image genre-image">
                      <a href="{{url('account/blog/'.$blog->blogs['slug'])}}">
                        @if($blog->blogs['image'] != null)
                        <img data-src="{{ asset('images/blog/'.$blog->blogs['image']) }}" class="img-responsive owl-lazy" alt="genre-image">
                        @else
                        <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazydata-src" alt="genre-image">
                        @endif
                      </a>
                   
                    </div>
                    <div class="genre-slide-dtl">
                      <h5 class="genre-dtl-heading">
                        <a href="{{url('account/blog/'.$blog->blogs['slug'])}}">{{$blog->blogs['title']}}</a>
                      </h5>
                    </div>
                  </div>
                   @endif
                     
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endif
  @endif

@endforeach

<!-------------------------- end Blog ----------------->




<!----------------------- live event ------------------->

@if(isset($liveevent) && count($liveevent) > 0)
<div class="genre-main-block">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="genre-dtl-block">
          <h3 class="section-heading">{{__('staticwords.liveevent')}}</h3>
          <p class="section-dtl">{{__('staticwords.atthebigscreenathome')}}</p>
        </div>
      </div>
      <div class="col-md-9">
        <div class="genre-main-slider owl-carousel">
          @foreach($liveevent as $key => $liveevents)
          
          <div class="genre-slide">
            <div class="genre-slide-image genre-image">
              @if($auth && $subscribed==1)
              <a href="{{url('event/detail/'.$liveevents->slug)}}">
                @if($liveevents->thumbnail != null)
                <img data-src="{{asset('images/events/thumbnails/'.$liveevents->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                @else
                <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                @endif
              </a>
              @else
              <a href="{{url('event/guest/detail/'.$liveevents->slug)}}">
                @if($liveevents->thumbnail != null)
                <img data-src="{{asset('images/events/thumbnails/'.$liveevents->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                @else
                <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                @endif
              </a>
              @endif
            </div>
            <div class="genre-slide-dtl">
              <h5 class="genre-dtl-heading">
                @if($auth && $subscribed==1)
                <a href="{{url('event/detail/'.$liveevents->slug)}}">{{$liveevents->title}}</a>

                @else
                <a href="{{url('event/guest/detail/'.$liveevents->slug)}}">{{$liveevents->title}}</a>
                @endif
              </h5>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endif

<!-------------------------- end live event ----------------->


        <!-- google adsense code -->
       
     
  </section>
 <div class="container-fluid" id="adsense">
         @php
            if (isset($ad) ) {
               if ($ad->ishome==1 && $ad->status==1) {
                  $code=  $ad->code;
                  echo html_entity_decode($code);
               }
            }
          @endphp
      </div>
    

@endsection

@section('custom-script')

<script type="text/javascript">
  var page = 1;
  var wHeight;
  var dHeight;
  $(document).ready(function(){
     wHeight =  $(window).height();
     dHeight =  $(document).height();
  });
  
  $(window).scroll(function() {
     wHeight =  $(window).height();
     dHeight =  $(document).height();
     
      if($(window).scrollTop() + wHeight >= dHeight) {
          page++;
          
      }
      loadMoreData(page);
  });


  function loadMoreData(p){
    var lastVal = p;
    if(lastVal == page){
     page++;
    }
    
    $.ajax(
          {
              url: '?page=' + page,
              type: "get",
              beforeSend: function()
              {
                  $('.ajax-load').show();
              }
          })
          .done(function(data)
          {
              if(data.html == ''){
                  $('.ajax-load').html("You explored all :) we will add more...");
                  return;
              }else{
                page++;
              }
              $('.ajax-load').hide();
              $("#post-data").append(data.html);
              console.log(data.html);
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
          {
                console.log(jqXHR);
          });
  }
</script>

    <script>

      function playoniframe(url,id,type){
       
 
   $(document).ready(function(){
    var SITEURL = '{{URL::to('')}}';
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

      function playoniframe(url,id,type){
           
   
 
   $(document).ready(function(){
    var SITEURL = '{{URL::to('')}}';
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
       
   
         
  
  });        $.colorbox({ href: url, width: '100%', height: '100%', iframe: true });
       
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
      el: '#wishlistelement',
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
          this.$http.post('{{route('addtowishlist')}}', this.result).then((response) => {
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
          return text == "{{__('staticwords.addtowatchlist')}}" ? "{{ __('staticwords.removefromwatchlist') }}" : "{{__('staticwords.addtowatchlist')}}";
        });
      }, 100);
    }
  </script>

   <script src="{{ url('js/slider.js') }}"></script>
  
@endsection

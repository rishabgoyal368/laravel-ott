@extends('layouts.theme')
@section('title',__('staticwords.watchlist'))
@section('main-wrapper')
  <!-- main wrapper -->
  @php
 $withlogin= App\Config::findOrFail(1)->withlogin;
 $catlog= App\Config::findOrFail(1)->catlog;
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
         
@endphp
  <section class="main-wrapper">
    <div class="container-fluid">
      <div class="watchlist-section">
        <h5 class="watchlist-heading">{{__('staticwords.watchlist')}}</h5>
        <div class="watchlist-btn-block">
          <div class="btn-group">
            @php
               $auth=Auth::user();
               if(isset($auth) || $auth->is_admin){
               $nav=App\Menu::orderBy('position','ASC')->get();
             }
            @endphp
              @if (isset($nav))
                 
                  @foreach ($nav as $menu)
                 
                    <a class="{{isset($menu) ? 'active' : ''}}" href="{{url('account/watchlist', $menu->slug)}}"  title="{{$menu->name}}">{{$menu->name}}</a>
                    
                  @endforeach
              
              @endif
            
          </div>
        </div>
      <!-- Modal -->
  @include('modal.agemodal')
  <!-- Modal -->
  @include('modal.agewarning')
        @if(isset($movies))
          <div class="watchlist-main-block">
            @foreach($movies as $key => $item)
              @if($item->type=='S')
              @if($item->tvseries->status == 1)
              <div class="watchlist-block">
                <div class="watchlist-img-block protip" data-pt-placement="outside" data-pt-title="#prime-show-description-block{{$item->id}}">
                  <a href="{{url('show/detail',$item->season_slug)}}">
                    @if($item->thumbnail != null)
                      <img data-src="{{url('images/tvseries/thumbnails/'.$item->thumbnail)}}" class="img-responsive lazy watchlist-img" alt="genre-image">
                    @elseif($item->tvseries['thumbnail'] != null)
                      <img data-src="{{url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)}}" class="img-responsive lazy watchlist-img" alt="genre-image">
                    @else
                      <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy watchlist-img" alt="genre-image">
                    @endif
                  </a>
                </div>
                {!! Form::open(['method' => 'DELETE', 'action' => ['WishListController@showdestroy', $item->id]]) !!}
                 {{--  {!! Form::submit(__('staticwords.remove'), ["class" => "remove-btn"]) !!} --}}
                 <button type="submit" class="watchhistory_remove"><i class="fa fa-close" aria-hidden="true"></i></button><br/>
                {!! Form::close() !!}
                @if(isset($protip) && $protip == 1)
                <div id="prime-show-description-block{{$item->id}}" class="prime-description-block">
                  <h5 class="description-heading">{{$item->tvseries['title']}}</h5>
                  <div class="movie-rating">{{__('staticwords.tmdbrating')}} {{$item->tvseries['rating']}}</div>
                  <ul class="description-list">
                    <li>{{__('staticwords.season')}} {{$item->season_no}}</li>
                    <li>{{$item->publish_year}}</li>
                    <li>{{$item->tvseries['age_req']}}</li>
                    @if($item->subtitle == 1)
                      <li>
                       {{__('staticwords.subtitles')}}
                      </li>
                    @endif
                  </ul>
                  <div class="main-des">
                    @if ($item->detail != null || $item->detail != '')
                      <p>{{$item->detail}}</p>
                    @else
                      <p>{{$item->tvseries['detail']}}</p>
                    @endif
                    <a href="#"></a>
                  </div>
                  <div class="des-btn-block">
                    @if($auth && $subscribed ==1)
                      @if(isset($item->episodes[0]))
                        @if($item->tvseries['age_req'] == 'all age' || $age>=str_replace('+', '', $item->tvseries['age_req']) )
                          @if($item->episodes[0]->video_link['iframeurl'] !="")

                            <a href="#" onclick="playoniframe('{{ $item->episodes[0]->video_link['iframeurl'] }}','{{ $item->tvseries['id'] }}','tv')" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                           </a>

                          @else
                            <a href="{{ route('watchTvShow',$item->id) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span></a>
                          @endif
                        @else

                          <a onclick="myage({{$age}})" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                         </a>
                        @endif
                      @endif
                      @if($item->trailer_url != null || $item->trailer_url != '')
                        <a href="{{ route('watchtvTrailer',$item->id)  }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                      @endif
                    @else
                       @if($item->trailer_url != null || $item->trailer_url != '')
                        <a href="{{ route('guestwatchtvtrailer',$item->id)  }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                      @endif
                    @endif
                    
                  </div>
                </div>
                @endif
              </div>
              @endif
              @endif
            @endforeach
          </div>
        @endif
      
        
        @if(isset($movies))
          <div class="watchlist-main-block">
            @foreach($movies as $key => $movie)
             @if($movie->type=="M")
             @if($movie->status == 1)
              <div class="watchlist-block">
                <div class="watchlist-img-block protip" data-pt-placement="outside" data-pt-title="#prime-description-block{{$movie->id}}">
                  <a href="{{url('movie/detail',$movie->slug)}}">
                    @if($movie->thumbnail != null || $movie->thumbnail != '')
                      <img data-src="{{url('images/movies/thumbnails/'.$movie->thumbnail)}}" class="img-responsive lazy watchlist-img" alt="genre-image">
                    @else
                      <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy watchlist-img" alt="genre-image">
                    @endif
                  </a>
                </div>
                {!! Form::open(['method' => 'DELETE', 'action' => ['WishListController@moviedestroy', $movie->id]]) !!}
                    {{-- {!! Form::submit(__('staticwords.remove'), ["class" => "remove-btn"]) !!} --}}
                    <button type="submit" class="watchhistory_remove"><i class="fa fa-close" aria-hidden="true"></i></button><br/>
                {!! Form::close() !!}
                @if(isset($protip) && $protip == 1)
                <div id="prime-description-block{{$movie->id}}" class="prime-description-block">
                  <div class="prime-description-under-block">
                    <h5 class="description-heading">{{$movie->title}}</h5>
                    <div class="movie-rating">{{__('staticwords.tmdbrating')}} {{$movie->rating}}</div>
                    <ul class="description-list">
                      <li>{{$movie->duration}} {{__('staticwords.mins')}}</li>
                      <li>{{$movie->publish_year}}</li>
                      <li>{{$movie->maturity_rating}}</li>
                      @if($movie->subtitle == 1)
                        <li>
                         {{__('staticwords.subtitles')}}
                        </li>
                      @endif
                    </ul>
                    <div class="main-des">
                      <p>{{$movie->detail}}</p>
                      <a href="#"></a>
                    </div>
                    <div class="des-btn-block">
                      @if($auth && $subscribed ==1)
                        @if($movie->maturity_rating == 'all age' || $age>=str_replace('+', '', $movie->maturity_rating))
                          @if($movie->video_link['iframeurl'] != null)
                            <a href="{{route('watchmovieiframe',$item->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                            </a>

                          @else 
                            <a href="{{ route('watchmovie',$movie->id) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span></a>
                          @endif
                        @else
                          <a onclick="myage({{$age}})" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('staticwords.playnow')}}</span>
                          </a>
                        @endif
                        @if($movie->trailer_url != null || $movie->trailer_url != '')
                          <a href="{{ route('watchTrailer',$movie->id) }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                        @endif
                      @else
                        @if($movie->trailer_url != null || $movie->trailer_url != '')
                          <a href="{{ route('guestwatchtrailer',$movie->id) }}" class="iframe btn btn-default">{{__('staticwords.watchtrailer')}}</a>
                        @endif
                      @endif
                     
                      
                    </div>
                  </div>
                </div>
                @endif
              </div>
              @endif
               @endif
            @endforeach
          </div>
        @endif
        
      </div>
      
    </div>
      <!-- google adsense code -->
        <div class="container-fluid">
         <?php
          if (isset($ad)) {
           if ($ad->iswishlist==1 && $ad->status==1) {
              $code=  $ad->code;
              echo html_entity_decode($code);
           }
          }
?>
      </div>
  </section>


  <!--End-->
 
@endsection

@section('custom-script')


  

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

      function myage(age){
        if (age==0) {
        $('#ageModal').modal('show'); 
      }else{
          $('#ageWarningModal').modal('show');
      }
    }
      
    </script>

@endsection

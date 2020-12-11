@extends('layouts.theme')
@section('title',__('staticwords.welcome'))
@section('main-wrapper')
<!-- main wrapper -->

  

  <section id="main-wrapper" class="main-wrapper home-page">
    @if (isset($blocks) && count($blocks) > 0)
      @foreach ($blocks as $block)
        <!-- home out section -->
        <div id="home-out-section-1" class="home-out-section" style="background-image: url('{{ asset('images/main-home/'.$block->image) }}')">
          <div class="overlay-bg {{$block->left == 1 ? 'gredient-overlay-left' : 'gredient-overlay-right'}} "></div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 col-sm-6 {{$block->left == 1 ? 'col-md-offset-6 col-sm-offset-6 col-sm-6 col-md-6 text-right' : ''}}">
                <h2 class="section-heading">{{$block->heading}}</h2>
                <p class="section-dtl {{$block->left == 1 ? 'pad-lt-100' : ''}}">{{$block->detail}}</p>
                @if ($block->button == 1)
                  @if ($block->button_link == 'login')
                    @guest
                      <a href="{{url('login')}}" class="btn btn-prime">{{$block->button_text}}</a>
                    @endguest
                  @else
                    @guest
                      <a href="{{url('register')}}" class="btn btn-prime">{{$block->button_text}}</a>
                    @endguest
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>
        <!-- end out section -->
      @endforeach
    @endif

    
    <!-- Pricing plan main block -->
    

    @if(isset($remove_subscription) && $remove_subscription == 0) 
      @if(isset($plans) && count($plans) > 0)
        <div class="purchase-plan-main-block main-home-section-plans">
          <div class="panel-setting-main-block panel-subscribe">
            <div class="container">
              <div class="plan-block-dtl">
                <h3 class="plan-dtl-heading">{{__('staticwords.membershipplans')}}</h3>
                <ul>
                  <li>{{__('staticwords.membershiplines1')}}
                  </li>
                  <li>{{__('staticwords.membershiplines2')}} 
                    
                    @if(Auth::check())
                      @php  
                         $id = Auth::user()->id;
                         $getuserplan = App\PaypalSubscription::where('status','=','1')->where('user_id',$id)->first();
                      @endphp
                    @endif

                    <?php
                      $today =  date('Y-m-d h:i:s');
                    ?>

      
                  </li>
                </ul>
              </div>
              <div class="snip1404 row">
                  
                @foreach($plans as $plan)
                @if($plan->delete_status ==1 )
                  @if($plan->status == 1)
                    <div class="col-md-4 col-sm-6">
                      <div class="main-plan-section">
                        <header>
                          <h4 class="plan-home-title">
                            {{$plan->name}}
                          </h4>
                          <div class="plan-cost"><span class="plan-price"><i class="{{$plan->currency_symbol}}"></i>{{$plan->amount}}</span><span class="plan-type">
                              <i class="{{$plan->currency_symbol}}"></i> {{number_format(($plan->amount) / ($plan->interval_count),2)}}/
                                {{$plan->interval}}
                              
                          </span></div>
                        </header>
                        @php
                      $pricingTexts = App\PricingText::where('package_id',$plan->id)->get();
                        @endphp
                        @foreach ($pricingTexts as $element)
                        <ul class="plan-features">
                          @if (isset($pricingTexts) && count($pricingTexts) > 0)

                        @if(isset($element->title1) && !is_null($element->title1))
                          <li><i class="fa fa-check"> </i>{{ $element->title1 }}</li>
                        @endif
                        @if(isset($element->title2) && !is_null($element->title2))
                          <li><i class="fa fa-check"> </i>{{ $element->title2 }}</li>
                        @endif
                        @if(isset($element->title3) && !is_null($element->title3))
                          <li><i class="fa fa-check"> </i>{{ $element->title3 }}</li>
                        @endif
                        @if(isset($element->title4) && !is_null($element->title4))
                          <li><i class="fa fa-check"> </i>{{ $element->title4 }}</li>
                        @endif
                        @if(isset($element->title5) && !is_null($element->title5))
                          <li><i class="fa fa-check"> </i>{{ $element->title5 }}</li>
                        @endif
                        @if(isset($element->title6) && !is_null($element->title6))
                          <li><i class="fa fa-check"> </i>{{ $element->title6 }}</li>
                        @endif
                          @endif
                        </ul>
                        @endforeach
                        
                        @auth
                        @if($getuserplan['package_id'] == $plan->id && $getuserplan->status == "1" && $today <= $getuserplan->subscription_to )
                          
                          <div class="plan-select"><a class="btn btn-prime">{{__('staticwords.alreadysubscribe')}}</a></div>

                        @else
                        
                          <div class="plan-select"><a href="{{route('get_payment', $plan->id)}}" class="btn btn-prime">{{__('staticwords.subscribe')}}</a></div>

                        @endif
                          @else
                          <div class="plan-select"><a href="{{route('register')}}">{{__('staticwords.registernow')}}</a></div>
                        @endauth
                      </div>
                    </div>
                  @endif
                @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>
      @endif
    @endif



    
    <!-- end featured main block -->
    <!-- end out section -->
  </section>
<!-- end main wrapper -->
@endsection
@section('script')
<script>
        
        @if(isset(Auth::user()->multiplescreen))
        @if((Auth::user()->multiplescreen->activescreen!= NULL))
         $(document).ready(function(){

           $('#showM').hide();

           });
          @else
           $(document).ready(function(){

            $('#showM').modal();

           });
          @endif
          @endif



</script>
@endsection
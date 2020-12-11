@extends('layouts.theme')
@section('title','User Dashboard')
@section('main-wrapper')
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="container-fluid">
      <h4 class="heading">{{__('staticwords.dashboard')}}</h4>
      
      <div class="panel-setting-main-block">
        <div class="panel-setting">
          <div class="row">
            <div class="col-md-6">
              <h4 class="panel-setting-heading">{{__('staticwords.yourdetails')}}</h4>
              <p>{{__('staticwords.detaildescription')}}</p>
            </div>
            <div class="col-md-3">
              <p class="info">{{__('staticwords.youremail')}}: {{$auth->email}}</p>
            </div>
            <div class="col-md-3">
              <div class="panel-setting-btn-block text-right">
                <a href="{{url('account/profile')}}" class="btn btn-setting">{{__('staticwords.editdetail')}}</a>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-setting">
          <div class="row">
            <div class="col-md-6">
              <h4 class="panel-setting-heading">{{__('staticwords.yourmembership')}}</h4>
              <p>{{__('staticwords.wanttochangemembership')}}</p>
            </div>
            <div class="col-md-3">

              @php
                $bfree = null;
                 $config=App\Config::first();
                 $auth=Auth::user();
                  if ($auth->is_admin==1) {
                    $bfree=1;
                  }else{
                     $ps=App\PaypalSubscription::where('user_id',$auth->id)->first();
                     if (isset($ps)) {
                       $current_date = Illuminate\Support\Carbon::now();
                        if (date($current_date) <= date($ps->subscription_to)) {
                          
                          if ($ps->package_id==100 || $ps->package_id == 0) {
                              $bfree=1;
                          }else{
                            $bfree=0;
                          }
                        }
                     }
                  }
                 
              @endphp

              @if($auth->is_admin==1)
               <p class="info">{{__('staticwords.currentsubscriptionfree')}}</p>
              @else
                @if($bfree==1)

                  <p class="info">{{__('staticwords.currentsubscritptionfreetill')}}
                    <strong>{{date('F j, Y  g:i:a',strtotime($ps->subscription_to))}} </strong></p>

                @elseif($bfree==0)
                
                 @if(isset($ps))
                    @php
                       $psn=App\Package::where('id',$ps->package_id)->first();
                    @endphp
                   <p class="info">{{__('staticwords.currentsubscription')}}: {{ucfirst($psn['name'])}}</p>
                  @endif
               @else

                  @if($current_subscription != null)

                    <p class="info">{{__('staticwords.currentsubscription')}}: {{$method == 'stripe' ? ucfirst($current_subscription->name) : ucfirst($current_subscription->plan->name)}}</p>
                  @endif
                @endif
              @endif
            </div>
            <div class="col-md-3">
              <div class="panel-setting-btn-block text-right">
                @if($current_subscription != null && $method == 'stripe') 
                  @if($auth->subscription($current_subscription->name)->cancelled())
                    <a href="{{route('resumeSub', $current_subscription->stripe_plan)}}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.resumesubscription')}}</a>
                  @else
                    <a href="{{route('cancelSub', $current_subscription->stripe_plan)}}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.cancelsubscription')}}</a>
                  @endif
                @elseif($current_subscription != null && $method == 'paypal') 
                  @if($current_subscription->status == 0)
                    <a href="{{route('resumeSubPaypal')}}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.resumesubscription')}}</a>
                  @elseif ($current_subscription->status == 1)
                    <a href="{{route('cancelSubPaypal')}}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.cancelsubscription')}}</a>
                  @endif
                @else 
                  @if($auth->is_admin == 1)
                  @else              
                  <a href="{{url('account/purchaseplan')}}" class="btn btn-setting">{{__('staticwords.subscribenow')}}</a>
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="panel-setting">
          <div class="row">
            <div class="col-md-6">
              <h4 class="panel-setting-heading">{{__('staticwords.yourpaymenthistory')}}</h4>
              <p>{{__('staticwords.viewyourpaymenthistory')}}.</p>
            </div>
            <div class="col-md-offset-3 col-md-3">
              <div class="panel-setting-btn-block text-right">
                <a href="{{url('account/billing_history')}}" class="btn btn-setting">{{__('staticwords.viewdetails')}}</a>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="panel-setting">
          <div class="row">
            <div class="col-md-6">
              <h4 class="panel-setting-heading">Parent Controll</h4>
              <p>Change your parent controll settings.</p>
            </div>
            <div class="col-md-offset-3 col-md-3">
              <div class="panel-setting-btn-block text-right">
                <a href="#" class="btn btn-setting"><i class="fa fa-edit"></i>Change Settings</a>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
@endsection
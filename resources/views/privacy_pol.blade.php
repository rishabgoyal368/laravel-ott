@extends('layouts.theme')
@section('title',__('staticwords.privacypolicy'))
@section('main-wrapper')
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="container-fluid faq-main-block">
      <h4 class="heading">{{__('staticwords.privacypolicy')}}</h4>
      <ul class="bradcump">
        <li><a href="{{url('account')}}">{{__('staticwords.dashboard')}}</a></li>
        <li>/</li>
        <li>{{__('staticwords.privacypolicy')}}</li>
      </ul>
      <div class="panel-setting-main-block">
        <div class="panel-setting">
          <div class="row">
            <div class="col-md-9">
              @if(isset($pri_pol))
                <div class="info">{!! $pri_pol !!}</div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
@endsection
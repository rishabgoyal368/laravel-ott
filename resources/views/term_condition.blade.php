@extends('layouts.theme')
@section('title',__('staticwords.termsandcondition'))
@section('main-wrapper')
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="container-fluid faq-main-block">
      <h4 class="heading">{{__('staticwords.termsandcondition')}}</h4>
      <ul class="bradcump">
        <li><a href="{{url('account')}}">{{__('staticwords.dashboard')}}</a></li>
        <li>/</li>
        <li>{{__('staticwords.termsandcondition')}}</li>
      </ul>
      <div class="panel-setting-main-block">
        <div class="panel-setting">
          <div class="row">
            <div class="col-md-9">              
              @if(isset($term_con))
                <div class="info">{!! $term_con !!}</div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
@endsection
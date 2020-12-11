@extends('layouts.theme')
@section('title',__('staticwords.ourblog'))
@section('main-wrapper')
<section class="">
  <div class="container-fluid">
    @if(isset($blogs) && count($blogs) > 0)
    <div class="purchase-plan-main-block main-home-section-plans">
      <div class="panel-setting-main-block">
        <div class="container-fluid">
          <div class="plan-block-dtl">
            <h3 class="plan-dtl-heading">{{__('staticwords.ourblog')}}</h3>
          </div>
          <div class="">
            @foreach($blogs as $blog)
            <div class="col-md-3 blog-home" style="height: 600px;">
             
              <div class="blog-card spring-fever"
                style="background-image: url({{ asset('images/blog/'.$blog->image) }})">
              
                <div class="title-content">
                  <h3 class="blog-heading"><a href="{{url('account/blog/'.$blog->slug)}}">{{str_limit($blog->title, 30)}}</a></h3>
                  @php
                  $uname=App\User::where('id',$blog->user_id)->get();
                  foreach($uname as $name)
                  {
                  $user_name = $name->name;
                  }
                  @endphp

                  <div class="intro">
                    <span><i class="fa fa-user" style="color:white;"></i></span> {{$user_name}} &nbsp;
                 
                     <span><i class="fa fa-clock-o" style="color:white;"></i></span> {{date ('d.m.Y',strtotime($blog->created_at))}}
                     </div>

                  <div class="card-info">
                    {!! str_limit($blog->detail, 150) !!}
                    <a href="{{url('account/blog/'.$blog->slug)}}" class="btn btn-default">{{__('staticwords.readmore')}}</a>
                   
                  </div>
                  
                </div>
                <div class="gradient-overlay"></div>
                    <div class="color-overlay"></div>
               

              </div>
              
            </div>
           
                    @endforeach
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>

@endsection
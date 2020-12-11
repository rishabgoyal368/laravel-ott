@extends('layouts.admin')
@section('title', 'Settings')

@section('content')
<div class="admin-form-main-block mrg-t-40">
  <!-- Tab buttons for site settings -->
  <div class="tabsetting">
    <a href="#" style="color: #7f8c8d;" ><button class="tablinks active">Genral Setting</button></a>

    <a href="{{url('admin/seo')}}" style="color: #7f8c8d;" ><button class="tablinks">SEO Setting</button></a>

    <a href="{{url('admin/api-settings')}}" style="color: #7f8c8d;"><button class="tablinks">API Setting</button></a>
    <a href="{{route('mail.getset')}}" style="color: #7f8c8d;"><button class="tablinks">Mail Setting</button></a>
   

  </div>

  <!-- update general settings -->
  @if ($config)
  {!! Form::model($config, ['method' => 'PATCH', 'action' => ['ConfigController@update', $config->id], 'files' => true]) !!}
  <div class="row admin-form-block z-depth-1">
    <div class="col-md-6">

      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        {!! Form::label('title', 'Project Title') !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your project title"></i>
        {!! Form::text('title', null, ['id' => 'pr', 'onkeyup' => 'sync()', 'class' => 'form-control']) !!}
        <small class="text-danger">{{ $errors->first('title') }}</small>
      </div>

      <div class="form-group{{ $errors->has('APP_URL') ? ' has-error' : '' }}">

        {!! Form::label('APP_URL', 'Website URL') !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your website url"></i>
        <input type="text" name="APP_URL" value="{{ $env_files['APP_URL'] }}" class="form-control"/>
        <small class="text-danger">{{ $errors->first('w_name') }}</small>


      </div>

      <div class="form-group{{ $errors->has('w_email') ? ' has-error' : '' }}">
        {!! Form::label('w_email', 'Default Email') !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your default email"></i>
        {!! Form::email('w_email', null, ['class' => 'form-control', 'placeholder' => 'eg: foo@bar.com']) !!}
        <small class="text-danger">{{ $errors->first('w_email') }}</small>
      </div>

      <div class="form-group{{ $errors->has('currency_code') ? ' has-error' : '' }}">
        {!! Form::label('currency_code', 'Currency Code') !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your curreny code eg:USD"></i>
        {!! Form::text('currency_code', null, ['class' => 'form-control']) !!}
        <small class="text-danger">{{ $errors->first('currency_code') }}</small>
      </div>
      <div class="form-group{{ $errors->has('currency_symbol') ? ' has-error' : '' }} currency-symbol-block">
        {!! Form::label('currency_symbol', 'Currency Symbol') !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please select your currency symbol"></i>
        <div class="input-group">
          {!! Form::text('currency_symbol', null, ['class' => 'form-control currency-icon-picker']) !!}
          <span class="input-group-addon simple-input"><i class="glyphicon glyphicon-user"></i></span>

        </div>
        <small class="text-danger">{{ $errors->first('currency_symbol') }}</small>
      </div>
      <div class="form-group{{ $errors->has('invoice_add') ? ' has-error' : '' }}">
        {!! Form::label('invoice_add', 'Invoice Address') !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your invoice address"></i>
        {!! Form::text('invoice_add', null, ['class' => 'form-control']) !!}
        <small class="text-danger">{{ $errors->first('invoice_add') }}</small>
      </div>
      <div class="bootstrap-checkbox form-group{{ $errors->has('goto') ? ' has-error' : '' }}">
        <div class="row">
          <div class="col-md-7">
            <h5 class="bootstrap-switch-label">Go to Top</h5>
          </div>
          <div class="col-md-5 pad-0">
            <div class="make-switch">
              {!! Form::checkbox('goto', 1, ($button->goto == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]) !!}
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <small class="text-danger">{{ $errors->first('goto') }}</small>
        </div>
      </div>
      <div class="bootstrap-checkbox form-group{{ $errors->has('color') ? ' has-error' : '' }}">
        <div class="row">
          <div class="col-md-5">
            <h5 class="bootstrap-switch-label">Color Schemes</h5>
          </div>
          <div class="col-md-7 pad-0">
            <select class="form-control select2" name="color">
               @if($config->color=='default')
             <option value="default" selected="">Default</option>
             @else
               <option value="default">Default</option>
             @endif
                 @if($config->color=='green')
             <option value="green" selected="">Green</option>
             @else
              <option value="green">Green</option>
             @endif
                 @if($config->color=='orange')
             <option value="orange" selected="">Orange</option>
             @else
               <option value="orange">Orange</option>
             @endif
                 @if($config->color=='yellow')

             <option value="yellow" selected="">Yellow</option>
             @else
              <option value="yellow">Yellow</option>
             @endif
                 @if($config->color=='pink')
             <option value="pink" selected="">Pink</option>
             @else
              <option value="pink">Pink</option>
             @endif
                 @if($config->color=='red')

             <option value="red" selected="">Red</option>
             @else
             <option value="red">Red</option>
             @endif
           </select>
         </div>
       </div>
       <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('color') }}</small>
      </div>
    </div>
     <div class="bootstrap-checkbox form-group{{ $errors->has('color_dark') ? ' has-error' : ''}}">
      <div class="row">
        <div class="col-md-7">
          <h5 class="bootstrap-switch-label">Color Schemes</h5>
        </div>
        <div class="col-md-5 pad-0">
          <div class="make-switch">
            {!! Form::checkbox('color_dark', 1, ($config->color_dark == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Light", "data-off-text"=>"Dark", "data-size"=>"small"]) !!}
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('color_dark') }}</small>
      </div>
    </div>

    <div class="bootstrap-checkbox form-group{{ $errors->has('wel_eml') ? ' has-error' : '' }}">
      @if(env('MAIL_DRIVER') != NULL && env('MAIL_HOST') != NULL && env('MAIL_PORT'))
      <div class="row">
        <div class="col-md-7">
          <h5 class="bootstrap-switch-label">Welcome email for user</h5>
        </div>
        <div class="col-md-5 pad-0">
          <div class="make-switch">
            <input type="checkbox" name="wel_eml" {{ $config->wel_eml == 1 ? "checked" : "" }} class='bootswitch' data-on-text= "Enable" data-off-text= "Disable" data-size="small">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-7">
          <h5 class="bootstrap-switch-label">Verify email for user</h5>
        </div>
        <div class="col-md-5 pad-0">
          <div class="make-switch">
            <input type="checkbox" name="verify_email" {{ $config->verify_email == 1 ? "checked" : "" }} class='bootswitch' data-on-text= "Enable" data-off-text= "Disable" data-size="small">
          </div>
        </div>
      </div>
      <div class="col-md-12">
       <small>(If you enable it, a welcome email will be sent to user's register email id, make sure you updated your mail setting in Site Setting >> Mail Settings before enable it.)</small>
       <small class="text-danger">{{ $errors->first('color') }}</small>
     </div>
     @endif

     <div class="bootstrap-checkbox form-group{{ $errors->has('is_appstore') ? ' has-error' : '' }}">
       <div class="row">
        <div class="col-md-7">
          <h5 class="bootstrap-switch-label">App Store Download</h5>
        </div>
        <div class="col-md-5 pad-0">
          <div class="make-switch">
            {!! Form::checkbox('is_appstore', 1, ($config->is_appstore == '1' ? 1 : 0), ['class' => 'bootswitch appstore', 'onChange' =>'isappstore()', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]) !!}
          </div>
        </div>
      </div>
    </div>
    <div id="appstore_link" style="{{ $config->is_appstore=='1' ? "" : "display: none" }}" class="bootstrap-checkbox form-group{{ $errors->has('appstore') ? ' has-error' : '' }}">
      <div class="row">
        <div class="col-md-6">
          <h5 class="bootstrap-switch-label">App Store Link</h5>
        </div>
        <div class="col-md-6 pad-0">
          <div class="input-group">
            {!! Form::text('appstore', null, ['class' => 'form-control']) !!}

          </div>
        </div>
      </div>
      <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('appstore') }}</small>
      </div>
    </div>
    <div class="bootstrap-checkbox form-group{{ $errors->has('is_playstore') ? ' has-error' : '' }}">
     <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Play Store Download</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('is_playstore', 1, ($config->is_playstore == '1' ? 1 : 0), ['class' => 'bootswitch playstore', 'onChange' =>'isplaystore()', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
  </div>

  <div id="playstore_link" style="{{ $config->is_playstore=='1' ? "" : "display: none" }}"class="bootstrap-checkbox form-group{{ $errors->has('playstore') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-6">
        <h5 class="bootstrap-switch-label">Play Store Link</h5>
      </div>
      <div class="col-md-6 pad-0">
        <div class="input-group">
          {!! Form::text('playstore', null, ['class' => 'form-control']) !!}

        </div>

      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('playstore') }}</small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group{{ $errors->has('user_rating') ? ' has-error' : '' }}">
     <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">User Rating</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('user_rating', 1, ($config->user_rating == '1' ? 1 : 0), ['class' => 'bootswitch ', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
  </div>
    <div class="bootstrap-checkbox form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
     <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Video Comments</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('comments', 1, ($config->comments == '1' ? 1 : 0), ['class' => 'bootswitch ', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group{{ $errors->has('blog') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Blog</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('blog', null, ($config->blog == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('blog') }}</small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group{{ $errors->has('comming_soon') ? ' has-error' : '' }}">
     <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Coming  Soon</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('comming_soon', 1, ($button->comming_soon == '1' ? 1 : 0), ['class' => 'bootswitch comming_soon', 'onChange' =>'iscommingsoon()', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
  </div>
  <div id="comming_soon_link" style="{{ $button->comming_soon=='1' ? "" : "display: none" }}"class="bootstrap-checkbox form-group{{ $errors->has('commingsoon_enabled_ip') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-6">
        <h5 class="bootstrap-switch-label">Coming  Soon Enabled Ips </h5>
      </div>
      <div class="col-md-6">
        <div class="input-group" style="width:100% !important;">
          <select class="form-control select2" name="commingsoon_enabled_ip[]" multiple="multiple">
            @if(isset($button->commingsoon_enabled_ip) &&  $button->commingsoon_enabled_ip != NULL)
            @foreach($button->commingsoon_enabled_ip as $enable_ip)
            <option value="{{$enable_ip}}" @if(isset($enable_ip))selected="" @endif>{{$enable_ip}}</option>
            @endforeach
            @endif
          </select>

        </div>

      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('commingsoon_enabled_ip') }}</small>
    </div>
    <br/>
    <div class="row">
      <div class="col-md-6">
        <h5 class="bootstrap-switch-label">Coming Soon Text </h5>
      </div>
      <div class="col-md-6">
        <div class="input-group">
          <input class ="form-control" type="text" name="comming_soon_text" value="">

        </div>

      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('comming_soon_text') }}</small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group{{ $errors->has('ip_block') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">IP  Block</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
           {!! Form::checkbox('ip_block', 1, ($button->ip_block == '1' ? 1 : 0), ['class' => 'bootswitch ip_block', 'onChange' =>'isipblock()', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('ip_block') }}</small>
    </div>
  </div>
  <div id="ip_block_link" style="{{ $button->ip_block=='1' ? "" : "display: none" }}"class="bootstrap-checkbox form-group{{ $errors->has('ipblock_ip') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-6">
        <h5 class="bootstrap-switch-label">Blocked Ips </h5>
      </div>
      <div class="col-md-6 pad-0">
        <div class="input-group" style="width:100% !important;">
         <select class="form-control select2" name="block_ips[]" multiple="multiple">
          @if(isset($button->block_ips))
            @foreach($button->block_ips as $block_ip)
            <option value="{{$block_ip}}" @if(isset($block_ip))selected="" @endif>{{$block_ip}}</option>
            @endforeach
          @endif
          </select>
        </div>

      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('block_ips') }}</small>
    </div>
  </div>


</div>
</div>
<div class="col-md-6">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }} input-file-block">
        {!! Form::label('logo', 'Project Logo') !!} - <p class="inline info">Size: 200x63</p>
        {!! Form::file('logo', ['class' => 'input-file', 'id'=>'logo']) !!}
        <label for="logo" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Project Logo">
          <i class="icon fa fa-check"></i>
          <span class="js-fileName">Choose a File</span>
        </label>
        <p class="info">Choose a logo</p>
        <small class="text-danger">{{ $errors->first('logo') }}</small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="image-block">
        <img src="{{asset('images/logo/' . $config->logo)}}" class="img-responsive" alt="">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group{{ $errors->has('favicon') ? ' has-error' : '' }} input-file-block">
        {!! Form::label('favicon', 'Project Favicon Icon') !!} - <p class="inline info"></p>
        {!! Form::file('favicon', ['class' => 'input-file', 'id'=>'favicon']) !!}
        <label for="favicon" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Project Favicon">
          <i class="icon fa fa-check"></i>
          <span class="js-fileName">Choose a File</span>
        </label>
        <p class="info">Choose a favicon</p>
        <small class="text-danger">{{ $errors->first('favicon') }}</small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="image-block">
        <img src="{{asset('images/favicon/' . $config->favicon)}}" class="img-responsive" alt="">
      </div>
    </div>
  </div>
 
  <div class="row">
    <div class="col-md-6">
      <div class="form-group{{ $errors->has('livetvicon') ? ' has-error' : '' }} input-file-block">
        {!! Form::label('livetvicon', 'Project LiveTv Icon') !!} - <p class="inline info"></p>
        {!! Form::file('livetvicon', ['class' => 'input-file', 'id'=>'livetvicon']) !!}
        <label for="livetvicon" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Project LiveTvicon">
          <i class="icon fa fa-check"></i>
          <span class="js-fileName">Choose a File</span>
        </label>
        <p class="info">Choose a livetvicon</p>
        <small class="text-danger">{{ $errors->first('livetvicon') }}</small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="image-block">
        <img src="{{asset('images/livetvicon/' . $config->livetvicon)}}" class="img-responsive" alt="">
      </div>
    </div>
  </div>
    <br/>      
  
  <div class="bootstrap-checkbox form-group{{ $errors->has('free_sub') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Free Trial</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('free_sub', 1, ($config->free_sub == '1' ? 1 : 0), ['class' => 'bootswitch free_sub', 'onChange' =>'isfree()', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
  </div>
  <div id="free_days" style="{{ $config->free_sub=='1' ? "" : "display: none" }}"class="bootstrap-checkbox  free_days form-group{{ $errors->has('free_days') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-6">
        <h5 class="bootstrap-switch-label">Enter Days</h5>
      </div>
      <div class="col-md-6 pad-0">
        <div class="input-group">
          {!! Form::text('free_days', null, ['class' => 'form-control']) !!}

        </div>

      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('free_days') }}</small>
    </div>
  </div>
        
  <div class="bootstrap-checkbox form-group{{ $errors->has('age_restriction') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Age Restriction</h5>
        <label>Age Restriction will be taken from Maturity Rating in Movies and TVSeries </label>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('age_restriction', 1, ($config->age_restriction == '1' ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group{{ $errors->has('age_restriction') ? ' has-error' : '' }}">
     <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Donation Link</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('donation', 1, ($config->donation == '1' ? 1 : 0), ['class' => 'bootswitch donate', 'onChange' =>'isdonation()', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
  </div>
  <div id="donation_link"  style="{{ $config->donation=='1' ? "" : "display: none" }}" class="bootstrap-checkbox form-group{{ $errors->has('donation_link') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-6">
        <h5 class="bootstrap-switch-label">Donation Link</h5>
      </div>
      <div class="col-md-6 pad-0">
        <div class="input-group">
          {!! Form::text('donation_link', null, ['class' => 'form-control']) !!}

        </div>
        <span>Register On <a href="https://www.paypal.me">Paypal.me</a> </span>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('withlogin') }}</small>
    </div>
  </div>

  <div class="bootstrap-checkbox form-group{{ $errors->has('prime_genre_slider') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Genre Slider Type</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('prime_genre_slider', 1, ($config->prime_genre_slider == '1' ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Layout 1", "data-off-text"=>"Layout 2", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('prime_genre_slider') }}</small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group{{ $errors->has('prime_movie_single') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Movie Single Type</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('prime_movie_single', 1, ($config->prime_movie_single == '1' ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Layout 1", "data-off-text"=>"Layout 2", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('prime_movie_single') }}</small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group{{ $errors->has('prime_footer') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Footer Type</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('prime_footer', 1, ($config->prime_footer == '1' ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Layout 1", "data-off-text"=>"Layout 2", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('prime_footer') }}</small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group{{ $errors->has('catlog') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Catlog View</h5>
        <label>Allow user to Access website without Subscription, but can not Play Video</label>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('catlog', 1, ($config->catlog == 1 ? 1 : 0), ['class' => 'bootswitch checkk', 'onChange' =>'withoutlogin()', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('catlog') }}</small>
    </div>
  </div>
  <div id="withoutlogin" style="{{ $config->catlog=='1' ? "" : "display: none" }}" class="bootstrap-checkbox form-group{{ $errors->has('withlogin') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Without Login</h5>
          <label>Allow user to Access website without Subscription and Without Login, but can not Play Video</label>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('withlogin', 1, ($config->withlogin == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('withlogin') }}</small>
    </div>
  </div>

  
  <div class="bootstrap-checkbox form-group{{ $errors->has('preloader') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Preloader</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('preloader', 1, ($config->preloader == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('preloader') }}</small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group{{ $errors->has('inspect') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Inspect Disable</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('inspect', 1, ($button->inspect == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('inspect') }}</small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group{{ $errors->has('rightclick') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Rightclick Disable</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('rightclick', 1, ($button->rightclick == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('rightclick') }}</small>
    </div>
  </div>

  <div class="bootstrap-checkbox form-group{{ $errors->has('APP_DEBUG') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Debug Mode</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <input type="checkbox" {{env('APP_DEBUG') == true ? "checked" : ""}} name="APP_DEBUG" class="bootswitch" data-on-text="True" data-off-text="False" data-size="small">
          
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('APP_DEBUG') }}</small>
    </div>
  </div>

  <div class="bootstrap-checkbox form-group{{ $errors->has('uc_browser') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">UC Browser Block</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('uc_browser', 1, ($button->uc_browser == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]) !!}
          
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('uc_browser') }}</small>
    </div>
  </div>

  <div class="bootstrap-checkbox form-group{{ $errors->has('remove_landing_page') ? ' has-error' : '' }}">
    @php
    $mymenu=App\Menu::first();


    @endphp
    @if(isset($mymenu))
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Remove Landing Page</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('remove_landing_page', 1, ($config->remove_landing_page == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Yes", "data-off-text"=>"No", "data-size"=>"small"]) !!}
        </div>
      </div>
    </div>
    @else
    <div class="row">
      <label>You can Remove Landing Page, Once you Create Atleast One Menu.</label>
    </div>
    @endif
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('remove_landing_page') }}</small>
    </div>
  </div>

  <div class="bootstrap-checkbox form-group{{ $errors->has('remove_subscription') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Remove Subscription on Landing Page</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('remove_subscription', 1, ($button->remove_subscription == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]) !!}
          
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('remove_subscription') }}</small>
    </div>
  </div>

  <div class="bootstrap-checkbox form-group{{ $errors->has('protip') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Protip</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          {!! Form::checkbox('protip', 1, ($button->protip == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]) !!}
          
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('protip') }}</small>
    </div>
  </div>

  </div>
  <div class="btn-group col-xs-12">
    <button type="submit" class="btn btn-block btn-success">Save Settings</button>
  </div>
  <div class="clear-both"></div>
</div>
{!! Form::close() !!}
@endif
</div>
@endsection
@section('custom-script')
<script type="text/javascript">
  function sync()
  {
    var n1 = document.getElementById('pr');
    var n2 = document.getElementById('pr2');
    n2.value = n1.value;
  }


</script>


<script type="text/javascript">
  function withoutlogin()
  {
    if($('.checkk').is(":checked"))   
      $("#withoutlogin").show();
    else
      $("#withoutlogin").hide();
  }

</script>
<script type="text/javascript">
  function isdonation()
  {
    if($('.donate').is(":checked"))   
      $("#donation_link").show();
    else
      $("#donation_link").hide();
  }

</script>
<script type="text/javascript">
  function isplaystore()
  {
    if($('.playstore').is(":checked"))   
      $("#playstore_link").show();
    else
      $("#playstore_link").hide();
  }

</script>
<script type="text/javascript">
  function isappstore()
  {
    if($('.appstore').is(":checked"))   
      $("#appstore_link").show();
    else
      $("#appstore_link").hide();
  }

</script>
<script type="text/javascript">
  function isfree()
  {
    if($('.free_sub').is(":checked"))   
      $("#free_days").show();
    else
      $("#free_days").hide();
  }

</script>

<!---------- comming soon --------->
<script type="text/javascript">
  function iscommingsoon()
  {
    if($('.comming_soon').is(":checked"))   
      $("#comming_soon_link").show();
    else
      $("#comming_soon_link").hide();
  }

</script>
<!------------- end comming soon ----->

<!---------- Ip Block --------->
<script type="text/javascript">
  function isipblock()
  {
    if($('.ip_block').is(":checked"))   
      $("#ip_block_link").show();
    else
      $("#ip_block_link").hide();
  }

</script>
<!------------- end ip_block ----->

<!---------- maintenance --------->
<script type="text/javascript">
  function ismaintenance()
  {
    if($('.maintenance').is(":checked"))   
      $("#maintenance_link").show();
    else
      $("#maintenance_link").hide();
  }

</script>
<!------------- end maintenance ----->
@endsection

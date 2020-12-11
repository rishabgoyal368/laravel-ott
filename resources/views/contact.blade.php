@extends('layouts.theme')
@section('title',__('staticwords.contactus'))
@section('main-wrapper')

 <div class="container" style="background-color: #333333;">
 	<br>
 		@if(Session::has('success'))
 		<div class="alert alert-success">
 			{{__('staticwords.success')}} : {{ Session::get('success') }}
 		</div>
 		@endif
 	<h3 class="text-center">{{__('staticwords.contact')}} <span class="us_text">{{__('staticwords.us')}}</span></h3>
 	<br>
 	<h5 class="text-center">{{__('staticwords.contactdetail')}}</h5>
 	<form action="{{ route('send.contactus') }}" method="post">
 		{{ csrf_field() }}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
 	<label style="color: #fff;" for="">{{__('staticwords.name')}}:</label>
 	<input type="text" class="form-control custom-field-contact" name="name">
 	@if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
    @endif
 	</div>

 	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
 	<label style="color: #fff;" for="">{{__('staticwords.email')}}:</label>
 	<input type="email" class="search-input form-control custom-field-contact" name="email">
 	@if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
    @endif
 	</div>

 	<div class="form-group{{ $errors->has('subj') ? ' has-error' : '' }}">
 	<label style="color: #fff;" for="">{{__('staticwords.subject')}}:</label>
 	<select name="subj" id="" class="form-control custom-field-contact">
 		<option value="Billing Issue">{{__('staticwords.billingissue')}}</option>
 		<option value="Streaming Issue">{{__('staticwords.streamingissue')}}</option>
 		<option value="Application Issue">{{__('staticwords.applicationissue')}}</option>
 		<option value="Advertising">{{__('staticwords.advertising')}}</option>
 		<option value="Partnership">{{__('staticwords.partnership')}}</option>
 		<option value="Other">{{__('staticwords.other')}}</option>
 	</select>
 	@if ($errors->has('subj'))
                <span class="help-block">
                  <strong>{{ $errors->first('subj') }}</strong>
                </span>
    @endif
 	</div>

 	<div class="form-group{{ $errors->has('msg') ? ' has-error' : '' }}">
 	<label style="color: #fff;" for="">{{__('staticwords.message')}}:</label>
 	<textarea name="msg" class="form-control custom-field-contact" rows="5" cols="50"></textarea>
 	@if ($errors->has('msg'))
                <span class="help-block">
                  <strong>{{ $errors->first('msg') }}</strong>
                </span>
    @endif
 	</div>

 	<input type="submit" class="btn btn-primary" value="{{__('staticwords.send')}}"> 
 	</form>
 	
 	<br>
 </div>
@endsection
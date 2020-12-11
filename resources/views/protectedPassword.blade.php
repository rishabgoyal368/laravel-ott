@extends('layouts.theme')
@section('title',__('staticwords.protectedpassword'))
@section('main-wrapper')
<section class="main-wrapper">
    <div class="container-fluid">
        <div class="watchlist-section">
	       <div class="container">
	       	
			  <h3>{{__('staticwords.protectedvideopassword')}}</h3>
			  <p>All items which are password protected listed here:</p>
			  
			   <div class="tab-content table-responsive">
			     	<table class="table table-bordered protected">
		       			<thead>
		       				<th>#</th>
		           			<th>{{__('staticwords.thumbnail')}}</th>
		           			
		           			<th colspan='2'>{{__('staticwords.password')}}</th>
		       			</thead>
		       			<tbody>

		       				@if(isset($pusheditems) && count($pusheditems) > 0)
			       				@foreach($pusheditems as $key =>$item)
			       				<tr>
			       					<td>{{$key+1}}</td>
			       					@if($item->type =='M')
			       					<td>
			       						@if(isset($item->thumbnail))
			       						<span><img src="{{url('/images/movies/thumbnails',$item->thumbnail)}}" width="100" height="100" class="img img-fluid img-responsive"></span>
			       						@else
			       						<span><img src="{{url('/images/default-thumbnail.jpg')}}" width="100" height="100" class="img img-fluid img-responsive"></span>
			       						@endif
			       						<p>{{$item->title}}</p></td>
			       					@if(isset($item->password))
			       					<td>
			       						<input type="password" name="password" id="{{$item->title}}" value="{{$item->password}}" class="password protected-feild" disabled="disabled">
			       					</td>
			       					<td>
			       						<span toggle="#{{$item->title}}" data-value="{{$item->title}}" class="fa fa-fw fa-eye field-icon toggle-password" onclick="show({{$item->title}})" id="toggle-password-{{$item->title}}"></span>&emsp;

			       						<span><a href="{{url('movie/detail/'.$item->slug)}}" target="_blank" class="btn btn-primary">{{__('staticwords.view')}}</a></span>

			       					</td>
			       					@else
			       						<td>{{__('staticwords.thismoviehasnotpasswordprotected')}}</td>
			       					@endif
			       					@elseif($item->type == 'S')
			       					<td>
			       					@if(isset($item->thumbnail))
			       						<img src="{{url('/images/tvseries/thumbnails',$item->thumbnail)}}" width="100" height="100" class="img img-fluid img-responsive">
			       					@else
			       						<img src="{{url('/images/default-thumbnail.jpg')}}" width="50" height="50" class="img img-fluid img-responsive">
			       					@endif
			       					{{__('Season')}} {{$item->season_no}}</td>
			       					@if(isset($item->password))
			       					<td>

			       						<input type="password" name="password" id="{{$item->title}}" value="{{$item->password}}" class="password protected-feild" disabled="disabled">
			       					</td>
			       					<td>
			       						<span toggle="#{{$item->title}}" class="fa fa-fw fa-eye field-icon toggle-password" ></span>&emsp;
			       						<span><a href="{{url('show/detail/'.$item->season_slug)}}" target="_blank" class="btn btn-primary">{{__('staticwords.view')}}</a></span>

			       					</td>
			       					@else
			       						<td>{{__('staticwords.thismoviehasnotpasswordprotected')}}</td>
			       					@endif
			       					@endif
			       				</tr>
		       					@endforeach
		       				@else
		       					<tr>
		       						<td colspan=4 class="text-center">No data available</td>
		       					</tr>
		       				@endif
		       			</tbody>
		       		</table>
			 	 </div>
			</div>
			<div class="col-md-12">
                <div align="center">
                   {!! $pusheditems->links() !!}
                </div>
            </div>
       </div>
   </div>
@endsection
@section('script')
<script type="text/javascript">
	$(".toggle-password").on('click',function() {
   
  $(this).toggleClass("fa-eye fa-eye-slash");

  var row = $(this).closest("tr");

  var x = row.find("input.password");

  if (x.attr("type") == "password") {
    x.attr("type", "text");
  } else {
    x.attr("type", "password");
  }
});
</script>
@endsection

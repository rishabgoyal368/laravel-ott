<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ __('Warning !') }}</title>
	<link rel="stylesheet" href="{{ url('installer/css/bootstrap.min.css') }}" crossorigin="anonymous">
   
    <link rel="stylesheet" href="{{ url('installer/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('installer/css/shards.min.css') }}">
	<link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}">
</head>
<body>
<br/>
	<div class="container">
		<div class="card">
           <div class="card-header">
              <h3 class="m-3 text-center text-danger">
                  {{ __('Warning') }}
              </h3>
           </div>
          	<div class="card-body">
          		<div class="card-body" id="stepbox">
               			<strong class="text-black">{{ __('You tried to update the domain which is invalid ! Please contact') }} <a target="_blank" href="https://codecanyon.net/item/next-hour-movie-tv-show-video-subscription-portal-cms/21435489/support">{{ __('Support') }}</a> {{ __('for updation in domain.') }}</strong>
               			<hr>
               			<h4>{{ __('You can use this project only in single domain for multiple domain please check License standard') }} <a target="_blank" href="https://codecanyon.net/licenses/standard">{{ __('here') }}</a>.</h4>
   				</div>
   			</div>
        <p class="text-center m-3 text-white">&copy;{{ date('Y') }} | Next Hour - Movie Tv Show & Video Subscription Portal Cms | <a class="text-white" href="http://mediacity.co.in">{{ __('Media City') }}</a></p>
      </div>
      <div class="corner-ribbon bottom-right sticky green shadow">{{ __('Warning') }} </div>
	
	</div>

</body>
    <script type="text/javascript" src="{{url('installer/js/bootstrap.min.js')}}"></script> <!-- bootstrap js -->
    <script type="text/javascript" src="{{url('installer/js/popper.min.js')}}"></script> 
    <script src="{{ url('installer/js/shards.min.js') }}"></script>
</html>
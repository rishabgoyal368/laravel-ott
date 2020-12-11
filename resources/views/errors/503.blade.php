<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<title>503 Service Unavailable</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">

	<!-- Custom stlylesheet -->
<link href="{{url('css/error.css')}}" rel="stylesheet" type="text/css"/> 



</head>


<body>

	<div id="notfound">
		<div class="notfound">
			@php
				$page = \Button::first();
			@endphp
			<div class="notfound-404">
				<h1>503</h1>
				
				@if(isset($pasge) && $page->comming_soon == 1)
				<h2>{{$page->comming_soon_text}}</h2>
				@else
				<h2>Service Unavailable</h2>
				@endif
			</div>
			@if(isset($pasge) && $page->comming_soon == 1)
			@else
				<a href={{url('/')}}>Homepage</a>
			@endif

		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{__('staticwords.watchmovie')}} - {{ $movie->title }}</title>
</head>
<body>

	@if(isset($movie->video_link->iframeurl) && $movie->video_link->iframeurl != NULL)
		@if(strstr($movie->video_link->iframeurl,'.mp4'))
			<video src="{{$movie->video_link->iframeurl}}" allowfullscreen border="0" width="100%"  height="615px" controls controlsList="nodownload">
			</video>
		@else

			<iframe src="{{$movie->video_link->iframeurl}}" allowfullscreen frameborder="0" width="100%"  height="615px" controls controlsList="nodownload">
			</iframe>
		@endif
	@endif
	
</body>

</html>
	
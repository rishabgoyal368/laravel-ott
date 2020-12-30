<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo e(__('staticwords.watchmovie')); ?> - <?php echo e($movie->title); ?></title>
</head>
<body>

	<?php if(isset($movie->video_link->iframeurl) && $movie->video_link->iframeurl != NULL): ?>
		<?php if(strstr($movie->video_link->iframeurl,'.mp4')): ?>
			<video src="<?php echo e($movie->video_link->iframeurl); ?>" allowfullscreen border="0" width="100%"  height="615px" controls controlsList="nodownload">
			</video>
		<?php else: ?>

			<iframe src="<?php echo e($movie->video_link->iframeurl); ?>" allowfullscreen frameborder="0" width="100%"  height="615px" controls controlsList="nodownload">
			</iframe>
		<?php endif; ?>
	<?php endif; ?>
	
</body>

</html>
	<?php /**PATH /var/www/html/laravel/resources/views/watchMovieiframe.blade.php ENDPATH**/ ?>
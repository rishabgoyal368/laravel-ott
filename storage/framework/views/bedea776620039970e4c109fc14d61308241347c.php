<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo e(__('Warning !')); ?></title>
	<link rel="stylesheet" href="<?php echo e(url('installer/css/bootstrap.min.css')); ?>" crossorigin="anonymous">
   
    <link rel="stylesheet" href="<?php echo e(url('installer/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('installer/css/shards.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(url('css/font-awesome.min.css')); ?>">
</head>
<body>
<br/>
	<div class="container">
		<div class="card">
           <div class="card-header">
              <h3 class="m-3 text-center text-danger">
                  <?php echo e(__('Warning')); ?>

              </h3>
           </div>
          	<div class="card-body">
          		<div class="card-body" id="stepbox">
               			<strong class="text-black"><?php echo e(__('You tried to update the domain which is invalid ! Please contact')); ?> <a target="_blank" href="https://codecanyon.net/item/next-hour-movie-tv-show-video-subscription-portal-cms/21435489/support"><?php echo e(__('Support')); ?></a> <?php echo e(__('for updation in domain.')); ?></strong>
               			<hr>
               			<h4><?php echo e(__('You can use this project only in single domain for multiple domain please check License standard')); ?> <a target="_blank" href="https://codecanyon.net/licenses/standard"><?php echo e(__('here')); ?></a>.</h4>
   				</div>
   			</div>
        <p class="text-center m-3 text-white">&copy;<?php echo e(date('Y')); ?> | Next Hour - Movie Tv Show & Video Subscription Portal Cms | <a class="text-white" href="http://mediacity.co.in"><?php echo e(__('Media City')); ?></a></p>
      </div>
      <div class="corner-ribbon bottom-right sticky green shadow"><?php echo e(__('Warning')); ?> </div>
	
	</div>

</body>
    <script type="text/javascript" src="<?php echo e(url('installer/js/bootstrap.min.js')); ?>"></script> <!-- bootstrap js -->
    <script type="text/javascript" src="<?php echo e(url('installer/js/popper.min.js')); ?>"></script> 
    <script src="<?php echo e(url('installer/js/shards.min.js')); ?>"></script>
</html><?php /**PATH /var/www/html/laravel/resources/views/accessdenied.blade.php ENDPATH**/ ?>
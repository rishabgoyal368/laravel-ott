<?php $__env->startSection('title','Social Icon Setting'); ?>
<?php $__env->startSection('content'); ?>
 <div class="admin-form-main-block mrg-t-40">
   
 <h4 class="admin-form-text"><a href="<?php echo e(url('admin/')); ?>" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a> Social Icon Setting</h4>
<div class="row">
		<div class="col-md-6">
			 <div class="admin-form-block z-depth-1">
			 	<form action="<?php echo e(route('socialic')); ?>" method="POST">
			 		<?php echo e(csrf_field()); ?>

				<label for=""><i class="fa fa-facebook"></i> Facebook URL:</label>
				<input autofocus="" placeholder="http://facebook.com/mediacity" type="text" class="form-control" name="url1" value="<?php echo e($si->url1); ?>">
				<br>
				<label for=""><i class="fa fa-twitter"></i> Twitter URL:</label>
				<input type="text" placeholder="http://twitter.com/mediacity" class="form-control" name="url2" value="<?php echo e($si->url2); ?>">
				<br>
				<label for=""><i class="fa fa-youtube"></i> Youtube URL:</label>
				<input type="text" placeholder="http://youtube.com/mediacity" class="form-control" name="url3" value="<?php echo e($si->url3); ?>">

				<br>
				<button type="submit" class="btn btn-md btn-primary">Save</button>
				</form>


				</div>
			 	
			 	
			 </div>
		</div>
</div>
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/landing-page/si.blade.php ENDPATH**/ ?>
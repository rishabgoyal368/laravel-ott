<?php $__env->startSection('title','Sign in/Sign Up Customization'); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">Sign In / Sign Up Customization</h4>
    <div class="row">
      <div class="col-md-12">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::model($auth_customize, ['method' => 'POST', 'action' => 'AuthCustomizeController@store', 'files' => true]); ?>

            <div class="form-group<?php echo e($errors->has('detail') ? ' has-error' : ''); ?>">
              <?php echo Form::label('detail', 'Heading Text'); ?>

              <?php echo Form::textarea('detail', null, ['id' => 'editor1', 'class' => 'form-control']); ?>

              <small class="text-danger"><?php echo e($errors->first('detail')); ?></small>
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                <?php if($auth_customize->image != null): ?>
                  <img src="<?php echo e(asset('images/login/'.$auth_customize->image)); ?>" class="img-responsive">
                <?php else: ?>
                  <div class="image-block"></div>                    
                <?php endif; ?>
              </div>
            </div>
            <div class="form-group<?php echo e($errors->has('image') ? ' has-error' : ''); ?> input-file-block">
              <?php echo Form::label('image', 'Select a image'); ?>  <p class="inline info"></p>
              <?php echo Form::file('image', ['class' => 'input-file', 'id'=>'image']); ?>

              <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Project image">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">Choose a File</span>
              </label>
              <p class="info">Choose a image</p>
              <small class="text-danger"><?php echo e($errors->first('image')); ?></small>
            </div>
            <div class="">
              <button type="submit" class="btn btn-success btn-block">Save</button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
  <script>
    $(function () {
      CKEDITOR.replace('editor1');
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/auth_customize/index.blade.php ENDPATH**/ ?>
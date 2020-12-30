<?php $__env->startSection('title', 'Privacy Policy'); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">Privacy Policy Text</h4>
    <?php if($config): ?>
      <div class="admin-form-block z-depth-1">
        <?php echo Form::model($config, ['method' => 'PATCH', 'route' => 'pri_pol']); ?>

        <div class="form-group<?php echo e($errors->has('privacy_pol') ? ' has-error' : ''); ?>">
          <?php echo Form::label('privacy_pol', 'Privacy Policy Text'); ?>

          <?php echo Form::textarea('privacy_pol', null, ['id' => 'editor1', 'class' => 'form-control']); ?>

          <small class="text-danger"><?php echo e($errors->first('privacy_pol')); ?></small>
        </div>
        <div class="btn-group pull-right">
          <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Save</button>
        </div>
        <div class="clear-both"></div>
        <?php echo Form::close(); ?>

      </div>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
  <script>
    $(function () {
      CKEDITOR.replace('editor1');
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/pri_pol.blade.php ENDPATH**/ ?>
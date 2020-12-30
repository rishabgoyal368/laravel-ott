<?php $__env->startSection('title', 'Terms & Condition'); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">Terms &amp; Condition Text</h4>
    <?php if($config): ?>
      <div class="admin-form-block z-depth-1">
        <?php echo Form::model($config, ['method' => 'PATCH', 'route' => 'term&con']); ?>

          <div class="form-group<?php echo e($errors->has('terms_condition') ? ' has-error' : ''); ?>">
            <?php echo Form::label('terms_condition', 'Terms & Condition Text'); ?>

            <?php echo Form::textarea('terms_condition', null, ['id' => 'editor1', 'class' => 'form-control']); ?>

            <small class="text-danger"><?php echo e($errors->first('terms_condition')); ?></small>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/term&con.blade.php ENDPATH**/ ?>
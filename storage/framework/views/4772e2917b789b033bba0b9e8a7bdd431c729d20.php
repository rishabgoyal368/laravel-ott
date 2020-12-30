<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin')); ?>" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a> My Profile</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <h5 class="admin-form-heading">Change Email</h5>
          <p class="info">Currnet email: <?php echo e($auth->email); ?></p>
          <?php echo Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']); ?>

            <div class="form-group<?php echo e($errors->has('new_email') ? ' has-error' : ''); ?>">
              <?php echo Form::label('new_email', 'New Email'); ?>

              <?php echo Form::text('new_email', null, ['class' => 'form-control']); ?>

              <small class="text-danger"><?php echo e($errors->first('new_email')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('current_password') ? ' has-error' : ''); ?>">
              <?php echo Form::label('current_password', 'Current Password'); ?>

              <?php echo Form::password('current_password', ['class' => 'form-control']); ?>

              <small class="text-danger"><?php echo e($errors->first('current_password')); ?></small>
            </div>
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Update</button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <h5 class="admin-form-heading">Change Password</h5>
          <p class="info">Do you want to change password ?</p>
          <?php echo Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']); ?>

            <div class="form-group<?php echo e($errors->has('current_password') ? ' has-error' : ''); ?>">
              <?php echo Form::label('current_password', 'Current Password'); ?>

              <?php echo Form::password('current_password', ['class' => 'form-control']); ?>

              <small class="text-danger"><?php echo e($errors->first('current_password')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('new_password') ? ' has-error' : ''); ?>">
              <?php echo Form::label('new_password', 'New Password'); ?>

              <?php echo Form::password('new_password', ['class' => 'form-control']); ?>

              <small class="text-danger"><?php echo e($errors->first('new_password')); ?></small>
            </div>
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Update</button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
    <br/>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <h5 class="admin-form-heading">Change Name</h5>
           <p class="info">Currnet Name: <?php echo e(ucfirst($auth->name)); ?></p>
          <?php echo Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']); ?>

            <div class="form-group<?php echo e($errors->has('current_name') ? ' has-error' : ''); ?>">
              <?php echo Form::label('current_name', 'Current Name'); ?>

              <?php echo Form::text('current_name',$auth->name, ['class' => 'form-control','readonly']); ?>

              <small class="text-danger"><?php echo e($errors->first('current_name')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('new_name') ? ' has-error' : ''); ?>">
              <?php echo Form::label('new_name', 'New Name'); ?>

              <?php echo Form::text('new_name',null, ['class' => 'form-control']); ?>

              <small class="text-danger"><?php echo e($errors->first('new_name')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('current_password') ? ' has-error' : ''); ?>">
              <?php echo Form::label('current_password', 'Current Password'); ?>

              <?php echo Form::password('current_password', ['class' => 'form-control']); ?>

              <small class="text-danger"><?php echo e($errors->first('current_password')); ?></small>
            </div>
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Update</button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/profile.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title','Create User'); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrgn-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/users')); ?>" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a> Create User</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">          
          <?php echo Form::open(['method' => 'POST', 'action' => 'UsersController@store', 'files' => true]); ?>

            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
              <?php echo Form::label('name', 'Enter Name'); ?>

               
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your name"></i>
              <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'autofocus', 'placeholder' => 'Please enter your name' ]); ?>

              <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
              <?php echo Form::label('email', 'Email Address'); ?>

              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your email"></i>
              <?php echo Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Please enter your email']); ?>

              <small class="text-danger"><?php echo e($errors->first('email')); ?></small>
            </div>
            <div class="search form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
              <?php echo Form::label('password', 'Password'); ?>

              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your password"></i>
              <?php echo Form::password('password', ['id' => 'password',' class' => 'form-control', 'required' => 'required', 'placeholder' => 'Please enter your password']); ?>

               <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
              <small class="text-danger"><?php echo e($errors->first('password')); ?></small>
            </div>
            <div class="search form-group<?php echo e($errors->has('confirm_password') ? ' has-error' : ''); ?>">
              <?php echo Form::label('confirm_password', 'Confirm Password'); ?>

              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your password again"></i>
              <?php echo Form::password('confirm_password', ['id' => 'confirm_password','class' => 'form-control', 'required' => 'required', 'placeholder' => 'Please enter your password again']); ?>

               <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password2"></span>

              <small class="text-danger"><?php echo e($errors->first('confirm_password')); ?></small>
            </div>
            <div class="search form-group<?php echo e($errors->has('dob') ? ' has-error' : ''); ?>">
              <?php echo Form::label('dob', 'Date Of Birth'); ?>

              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter date of Birth of User"></i>
             <input type="date" name="dob"  />
            
              <small class="text-danger"><?php echo e($errors->first('dob')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('is_admin') ? ' has-error' : ''); ?> switch-main-block">
              <div class="row">
                <div class="col-xs-4">
                  <?php echo Form::label('is_admin', 'Administrator'); ?>

                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">								
                    <?php echo Form::checkbox('is_admin', 1, 0, ['class' => 'checkbox-switch', 'id' => 'is_admin_cb']); ?>

                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger"><?php echo e($errors->first('is_admin')); ?></small>
              </div>
            </div>

            <div class="form-group<?php echo e($errors->has('is_assistant') ? ' has-error' : ''); ?> switch-main-block">
              <div class="row">
                <div class="col-xs-4">
                  <?php echo Form::label('is_assistant', 'Producer'); ?>

                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">                
                    <?php echo Form::checkbox('is_assistant', 1, 0, ['class' => 'checkbox-switch','id' => 'is_producer_cb']); ?>

                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger"><?php echo e($errors->first('is_admin')); ?></small>
              </div>
            </div>

            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info">Reset</button>
              <button type="submit" class="btn btn-success">Create</button>
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
  $(function(){
    $('form').on('submit', function(event){
      $('.loading-block').addClass('active');
    });
  });

  $(".toggle-password2").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
  });
  
</script>

<script>
    $('#is_admin_cb').on('change',function(){
      $('#is_producer_cb').prop('checked',false);
    })
</script>

<script>
    $('#is_producer_cb').on('change',function(){
      $('#is_admin_cb').prop('checked',false);
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/users/create.blade.php ENDPATH**/ ?>
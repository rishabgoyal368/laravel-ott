<?php $__env->startSection('title','Change Subscription'); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrgn-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/users')); ?>" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a> Change Or Add Subscription</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::open(['method' => 'POST', 'action' => 'UsersController@change_subscription', 'files' => true]); ?>

            <div class="info form-group">
              <h5>User Name: <?php echo e($user->name); ?></h5>
               <?php
               $planname='not exist';
              if (isset($plans)) {
                  if (isset($last_payment->plan->name) && !is_null($last_payment)){
                     $planname=$last_payment->plan->name;
                   }else{
                    if (isset($user_stripe_plan) && !is_null($user_stripe_plan)) {
                     $planname=$user_stripe_plan->name;
                    }
                   }
               
              }else{
                  $planname='not exist';
              }

              ?>
             
                <h5>Last Subscription Plan: <?php echo e($planname); ?></h5>
            </div>
            <input type="hidden" name="user_stripe_plan_id" value="<?php echo e($user_stripe_plan != null ? $user_stripe_plan->id : null); ?>">
            <input type="hidden" name="last_payment_id" value="<?php echo e($last_payment != null ? $last_payment->id : null); ?>">
            <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">


            <?php $__currentLoopData = $user->paypal_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
               $test=0;
               $status =App\Package::select('status')->where('id',$pu->package_id)->get();
                     foreach ($status as $key => $value) {
                      $test=$value->status;
                     }
              ?>

              <?php if($test == 0): ?>
                <div class="alert alert-danger">
                  User Plan is not exist kindly change it
                </div>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                <div>
                  <select name="plan_id" class="select2 form-control">
                    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($plan->delete_status == 1): ?>
                      <option value="<?php echo e($plan->id); ?>"><?php echo e($plan->name); ?></option>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </select>
                </div>

                
                <div class="btn-group pull-right">
                  <button type="submit" class="btn btn-success">Change Subscription</button>
                </div>
                <div class="clear-both"></div>
              <?php echo Form::close(); ?>









        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/users/change_sub.blade.php ENDPATH**/ ?>
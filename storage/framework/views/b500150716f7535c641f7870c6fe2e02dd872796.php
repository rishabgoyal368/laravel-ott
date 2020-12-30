<?php $__env->startSection('title', 'Adsense'); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <div class="row admin-form-block z-depth-1">
      <?php if($ad): ?>
         <?php echo Form::model($ad, ['method' => 'PUT', 'action' => ['AdsenseController@update', $ad->id], 'files' => true]); ?>


          <div class="form-group<?php echo e($errors->has('code') ? ' has-error' : ''); ?>">
              <?php echo Form::label('code', 'Enter Your Adsense Script '); ?>

              <?php echo Form::textarea('code', null, ['placeholder' => 'Enter Your Adsense Script ','id' => 'textarea', 'class' => 'form-control']); ?>

              <small class="text-danger"><?php echo e($errors->first('code')); ?></small>
           </div>
            <div class="bootstrap-checkbox form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-md-7">
                  <h5 class="bootstrap-switch-label">Status</h5>
                </div>
                <div class="col-md-5 pad-0">
                  <div class="make-switch">
                    <?php echo Form::checkbox('status', 1, ($ad->status == '1' ? true : false), ['class' => 'bootswitch', "data-on-text"=>"Active", "data-off-text"=>"Inactive", "data-size"=>"small"]); ?>

                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <small class="text-danger"><?php echo e($errors->first('status')); ?></small>
              </div>
            </div>
            <!-- is Home -->
              <div class="bootstrap-checkbox form-group<?php echo e($errors->has('ishome') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-md-7">
                  <h5 class="bootstrap-switch-label">Visible on Home</h5>
                </div>
                <div class="col-md-5 pad-0">
                  <div class="make-switch">
                    <?php echo Form::checkbox('ishome', 1, ($ad->ishome == '1' ? true : false), ['class' => 'bootswitch', "data-on-text"=>"Active", "data-off-text"=>"Inactive", "data-size"=>"small"]); ?>

                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <small class="text-danger"><?php echo e($errors->first('ishome')); ?></small>
              </div>
            </div>
           
            <!-- is wishlist -->
              <div class="bootstrap-checkbox form-group<?php echo e($errors->has('iswishlist') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-md-7">
                  <h5 class="bootstrap-switch-label">Visible on Wishlist</h5>
                </div>
                <div class="col-md-5 pad-0">
                  <div class="make-switch">
                    <?php echo Form::checkbox('iswishlist', 1, ($ad->iswishlist == '1' ? true : false), ['class' => 'bootswitch', "data-on-text"=>"Active", "data-off-text"=>"Inactive", "data-size"=>"small"]); ?>

                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <small class="text-danger"><?php echo e($errors->first('iswishlist')); ?></small>
              </div>
            </div>
            <!-- is View All -->
              <div class="bootstrap-checkbox form-group<?php echo e($errors->has('isviewall') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-md-7">
                  <h5 class="bootstrap-switch-label">Visible on View All</h5>
                </div>
                <div class="col-md-5 pad-0">
                  <div class="make-switch">
                    <?php echo Form::checkbox('isviewall', 1, ($ad->isviewall == '1' ? true : false), ['class' => 'bootswitch', "data-on-text"=>"Active", "data-off-text"=>"Inactive", "data-size"=>"small"]); ?>

                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <small class="text-danger"><?php echo e($errors->first('isviewall')); ?></small>
              </div>
            </div>
          <div class="btn-group pull-right">
            <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Save</button>
          </div>
          <div class="clear-both"></div>
        <?php echo Form::close(); ?>

      <?php endif; ?>
  </div>
 </div> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/adsense/index.blade.php ENDPATH**/ ?>
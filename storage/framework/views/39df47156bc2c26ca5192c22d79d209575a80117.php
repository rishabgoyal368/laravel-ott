<?php $__env->startSection('title','Pricing Text Setting'); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">Pricing Text Setting</h4>
    <div class="admin-form-block z-depth-1">
      <div class="row">
        <?php echo Form::model($pricingtexts, ['method' => 'POST', 'action' => 'CustomStyleController@pricingTextUpdate']); ?>

         <div class="form-group<?php echo e($errors->has('package_id') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('package_id', 'Select Package'); ?>

                      
                      <select class="form-control select2" id="package_id" name="package_id"
                       onChange="window.location.href=this.value">
                        <?php if(isset($package)): ?>
                        <?php $__currentLoopData = $package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($selectid == $p->id): ?>
                           <option value="<?php echo e($p->id); ?>" selected="true"><?php echo e($p->name); ?></option>
                        <?php else: ?>
                           <option value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option>
                        <?php endif; ?>
                      
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php endif; ?>
                       </select>
                      <small class="text-danger"><?php echo e($errors->first('package_id')); ?></small>
                  </div>
                 <?php
                 $title1=null;$title2=null;$title3=null;
                 $title4=null;$title5=null;$title6=null;
                 if (isset($pricingtexts) && count($pricingtexts)>0) {
                   foreach ($pricingtexts as $key => $value) {
                     $title1=$value->title1;
                      $title2=$value->title2;
                       $title3=$value->title3;
                        $title4=$value->title4;
                         $title5=$value->title5;
                          $title6=$value->title6;
                   }
                 }
                 ?>
                 
                <div class="col-md-4">
                
                  <div class="form-group<?php echo e($errors->has('title1') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('title1', 'title 1'); ?>

                      
                    <?php echo Form::text('title1',$title1, ['class' => 'form-control']); ?>

                      <small class="text-danger"><?php echo e($errors->first('title1')); ?></small>
                  </div>
                </div>

                <div class="col-md-4">
                
                  <div class="form-group<?php echo e($errors->has('title2') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('title2', 'title 2'); ?>

                      
                    <?php echo Form::text('title2',$title2, ['class' => 'form-control']); ?>

                      <small class="text-danger"><?php echo e($errors->first('title2')); ?></small>
                  </div>
                </div>
                <div class="col-md-4">
                
                  <div class="form-group<?php echo e($errors->has('title3') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('title3', 'title 3'); ?>

                      
                    <?php echo Form::text('title3',$title3, ['class' => 'form-control']); ?>

                      <small class="text-danger"><?php echo e($errors->first('title3')); ?></small>
                  </div>
                </div>
                 <div class="col-md-4">
                
                  <div class="form-group<?php echo e($errors->has('title4') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('title4', 'title 4'); ?>

                      
                    <?php echo Form::text('title4',$title4, ['class' => 'form-control']); ?>

                      <small class="text-danger"><?php echo e($errors->first('title4')); ?></small>
                  </div>
                </div>
                <div class="col-md-4">
                
                  <div class="form-group<?php echo e($errors->has('title5') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('title5', 'title 5'); ?>

                      
                    <?php echo Form::text('title5',$title5, ['class' => 'form-control']); ?>

                      <small class="text-danger"><?php echo e($errors->first('title5')); ?></small>
                  </div>
                </div>
                 <div class="col-md-4">
                
                  <div class="form-group<?php echo e($errors->has('title6') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('title6', 'title 6'); ?>

                      
                    <?php echo Form::text('title6',$title6, ['class' => 'form-control']); ?>

                      <small class="text-danger"><?php echo e($errors->first('title6')); ?></small>
                  </div>
                </div>
            
            

          <div class="">
            <button type="submit" class="btn btn-block btn-success">UPDATE</button>
          </div>
         
          <div class="clear-both"></div>
        <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/customstyle/pricingText.blade.php ENDPATH**/ ?>
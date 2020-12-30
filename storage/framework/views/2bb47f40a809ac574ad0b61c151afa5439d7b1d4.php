<?php $__env->startSection('title','Create a Package'); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">  
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin/packages')); ?>" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a> Create Package</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::open(['method' => 'POST', 'action' => 'PackageController@store']); ?>

            <div class="form-group<?php echo e($errors->has('plan_id') ? ' has-error' : ''); ?>">
                <?php echo Form::label('plan_id', 'Your Unique Plan Id'); ?>

                <p class="inline info"> - Please enter your unique plan id for package</p>
                <?php echo Form::text('plan_id', null, ['class' => 'form-control', 'required' => 'required', 'data-toggle' => 'popover','data-content' => 'Create Your Unique Plan ID ex. basic10', 'data-placement' => 'bottom']); ?>

                <small class="text-danger"><?php echo e($errors->first('plan_id')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <?php echo Form::label('name', 'Plan Name'); ?>

                <p class="inline info"> - Please enter your plan name</p>
                <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
            </div>
  			    <?php echo Form::hidden('currency', $currency_code); ?>

    
            <div class="form-group<?php echo e($errors->has('amount') ? ' has-error' : ''); ?>">
                <?php echo Form::label('amount', ' Your Plan Amount'); ?>

                <p class="inline info"> - Please enter your plan amount (Min. Amount should be 1)</p>
                <div class="input-group">
                  <span class="input-group-addon simple-input"><i class="<?php echo e($currency_symbol); ?>"></i></span>
                  <?php echo Form::number('amount', null, ['min' => 1, 'step'=>'0.01', 'class' => 'form-control', 'required' => 'required']); ?>  
                </div>
                <input type="text" name="currency_symbol" id="currency_symbol" value="<?php echo e($currency_symbol); ?>" hidden="true">
                <small class="text-danger"><?php echo e($errors->first('amount')); ?></small>
            </div>

           <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6">
                    <div class="form-group<?php echo e($errors->has('interval_count') ? ' has-error' : ''); ?>">
                        <?php echo Form::label('interval_count', ' Your Plan Duration'); ?>

                        <p class="inline info"> - Please enter plan duration <br>(Min. amount value 1)</p>
                        <?php echo Form::number('interval_count', null, ['min' => 1, 'class' => 'form-control', 'required' => 'required']); ?>

                        <small class="text-danger"><?php echo e($errors->first('interval_count')); ?></small>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group<?php echo e($errors->has('interval') ? ' has-error' : ''); ?>">
                        <?php echo Form::label('interval', 'Plan duration unit'); ?>

                        <p class="inline info"> - Please select plan duration unit / time interval</p>
                        <?php echo Form::select('interval', ['day'=>'Daily', 'week' => 'Weekly', 'month' => 'Monthly', 'year' => 'yearly'], ['month' => 'Monthly'], ['class' => 'form-control select2', 'required' => 'required']); ?>

                        <small class="text-danger"><?php echo e($errors->first('interval')); ?></small>
                     </div>
                </div> 
             </div>   
          </div>
          <div class="menu-block">
              <h6 class="menu-block-heading">Please Select Menu</h6>
              <?php if(isset($menus) && count($menus) > 0): ?>
                <ul>
                     <li>
                      <div class="inline">
                        <input type="checkbox" class="filled-in material-checkbox-input all" name="menu[]" value="100" id="checkbox<?php echo e(100); ?>" >
                        <label for="checkbox<?php echo e(100); ?>" class="material-checkbox"></label>
                      </div>
                      All Menus
                    </li>
                  <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                      <div class="inline">
                        <input type="checkbox" class="filled-in material-checkbox-input one" name="menu[]" value="<?php echo e($menu->id); ?>" id="checkbox<?php echo e($menu->id); ?>">
                        <label for="checkbox<?php echo e($menu->id); ?>" class="material-checkbox"></label>
                      </div>
                      <?php echo e($menu->name); ?>

                    </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              <?php endif; ?>
            </div>
            <div class="form-group<?php echo e($errors->has('trial_period_days') ? ' has-error' : ''); ?>">
                <?php echo Form::label('trial_period_days', ' Your Plan Trail Period Days'); ?>

                <p class="inline info"> - Please enter your plan free trial period days</p>
                <?php echo Form::number('trial_period_days', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('trial_period_days')); ?></small>
            </div>
            
            <div class="form-group<?php echo e($errors->has('screen') ? ' has-error' : ''); ?>">
                <?php echo Form::label('trial_period_days', 'Screens'); ?>

                <p class="inline info"> - Please enter screens for users (max:4)</p>
                <?php echo Form::number('screens', null, ['class' => 'form-control', 'min' => '1', 'max' => '6']); ?>

                <small class="text-danger"><?php echo e($errors->first('screen')); ?></small>
            </div>

            <!-----------  for download limit ------------------>

            <div class="form-group<?php echo e($errors->has('download') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-xs-6">
                  <?php echo Form::label('download', 'Do you want download limit?'); ?>

                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    <?php echo Form::checkbox('download', 1, 0, ['class' => 'checkbox-switch seriescheck','id'=>'download_enable']); ?>

                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger"><?php echo e($errors->first('download')); ?></small>
              </div>
            </div>
            <small class="text-danger"><?php echo e($errors->first('downloadlimit')); ?></small>
            <div id="downloadlimit" class="form-group<?php echo e($errors->has('downloadlimit') ? ' has-error' : ''); ?>" style="display:none">
                <?php echo Form::label('downloadlimit', 'Download Limit'); ?>

                <p class="inline info"> - Please enter download limit for users</p>
                <?php echo Form::number('downloadlimit', null, ['class' => 'form-control']); ?>

                <small class="text-danger">Note :- The download limit you entered will be multiply with given screens.</small>
                
            </div>

            <!--------------- end download limit ------------------->

            <div class="form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
                <?php echo Form::label('status', 'Status'); ?>

                <p class="inline info"> - Please select status</p>
                <?php echo Form::select('status', array('0' => 'Inactive', '1' => 'Active'), null, ['class' => 'form-control select2', 'placeholde' => '']); ?>

                <small class="text-danger"><?php echo e($errors->first('status')); ?></small>
            </div>
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> Reset</button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Create</button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

        </div>  
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
<script type="text/javascript">
    // when click all menu  option all checkbox are checked

    $(".all").click(function(){
      if($(this).is(':checked')){
        $('.one').prop('checked',true);
      }
      else{
        $('.one').prop('checked',false);
      }
    })

</script>
<script>
$('#download_enable').on('change',function(){
  if($('#download_enable').is(':checked')){
    //show
    $('#downloadlimit').show();
  }else{
    //hide
     $('#downloadlimit').hide();
  }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/package/create.blade.php ENDPATH**/ ?>
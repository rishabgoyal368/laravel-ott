   
 
<!-- Modal -->
<div id="ageModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-danger">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo e(__('staticwords.agerestrictedvideo')); ?></h4>
      </div>
       <?php echo Form::open(['method' => 'POST', 'action' => 'UsersController@update_age']); ?>

      <div class="modal-body">
        <h6 style="color: #e74c3c"><?php echo e(__('staticwords.foragerestricttext')); ?></h6><br>
        <div class="search form-group<?php echo e($errors->has('dob') ? ' has-error' : ''); ?>">
          <?php echo Form::label('dob', 'Date Of Birth'); ?>

          <input type="date" class="form-control"  name="dob"  />   
          <small class="text-danger"><?php echo e($errors->first('dob')); ?></small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="pull-right">      
          <button type="submit" class="btn btn-primary"><?php echo e(__('staticwords.update')); ?></button>
        </div>
      </div>
     <?php echo Form::close(); ?>

    </div>

  </div>
</div><?php /**PATH /var/www/html/laravel/resources/views/modal/agemodal.blade.php ENDPATH**/ ?>
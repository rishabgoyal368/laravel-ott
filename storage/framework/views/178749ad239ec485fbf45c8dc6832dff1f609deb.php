<?php $__env->startSection('title','All Coupons'); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="<?php echo e(route('coupons.create')); ?>" class="btn btn-danger btn-md"><i class="material-icons left">add</i> Create Coupon</a>
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> Delete Selected</a>   
      <!-- Modal -->
      <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="delete-icon"></div>
            </div>
            <div class="modal-body text-center">
              <h4 class="modal-heading">Are You Sure ?</h4>
              <p>Do you really want to delete these records? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
              <?php echo Form::open(['method' => 'POST', 'action' => 'CouponController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Yes</button>
              <?php echo Form::close(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body table-responsive">
      <table id="full_detail_table" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              #
            </th>
            <th>Coupon Code</th>
            <th>Percent Off</th>
            <th>Amount Off</th>
            <th>Duration</th>
            <th>Duration In Months</th>
            <th>Max Redm..</th>
            <th>Redeem By</th>
            <th>Delete</th>
          </tr>
        </thead>
        <?php if($coupons): ?>
          <tbody>
            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                  <div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="<?php echo e($coupon->id); ?>" id="checkbox<?php echo e($coupon->id); ?>">
                    <label for="checkbox<?php echo e($coupon->id); ?>" class="material-checkbox"></label>
                  </div>
                  <?php echo e($key+1); ?>

                </td>
                <td><?php echo e($coupon->coupon_code); ?></td>
                <td><?php echo e($coupon->percent_off ? $coupon->percent_off.'%' : '-'); ?></td>
                <td>
                  <?php if($coupon->amount_off): ?>
                    <i class="<?php echo e($currency_symbol); ?> main-curr"></i><?php echo e($coupon->amount_off); ?>

                  <?php endif; ?>
                </td>
                <td><?php echo e($coupon->duration); ?></td>
                <td><?php echo e($coupon->duration_in_months); ?></td>
                <td><?php echo e($coupon->max_redemptions); ?></td>
                <td><?php echo e($coupon->redeem_by->diffForHumans()); ?></td>
                <td>
                  <div class="admin-table-action-block">
                    <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#<?php echo e($coupon->id); ?>deleteModal"><i class="material-icons">delete</i> </button>
                  </div>
                </td>
              </tr>
              <!-- Delete Modal -->
              <div id="<?php echo e($coupon->id); ?>deleteModal" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">Are You Sure ?</h4>
                      <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                      <?php echo Form::open(['method' => 'DELETE', 'action' => ['CouponController@destroy', $coupon->id]]); ?>

                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                          <button type="submit" class="btn btn-danger">Yes</button>
                      <?php echo Form::close(); ?>

                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        <?php endif; ?>
      </table>
    </div>
  </div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('custom-script'); ?>
  <script>
    $(function(){
      $('#checkboxAll').on('change', function(){
        if($(this).prop("checked") == true){
          $('.material-checkbox-input').attr('checked', true);
        }
        else if($(this).prop("checked") == false){
          $('.material-checkbox-input').attr('checked', false);
        }
      });
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/coupon/index.blade.php ENDPATH**/ ?>
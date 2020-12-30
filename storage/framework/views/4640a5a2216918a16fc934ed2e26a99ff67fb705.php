<?php $__env->startSection('title','All FAQs'); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="<?php echo e(route('faqs.create')); ?>" class="btn btn-danger btn-md"><i class="material-icons left">add</i> Create Faq</a>
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
              <?php echo Form::open(['method' => 'POST', 'action' => 'FaqController@bulk_delete', 'id' => 'bulk_delete_form']); ?>

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
            <th>Faq Question</th>
            <th>Faq Answer</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <?php if($faqs): ?>
          <tbody>
            <?php ($no = 1); ?>
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                  <div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="<?php echo e($faq->id); ?>" id="checkbox<?php echo e($faq->id); ?>">
                    <label for="checkbox<?php echo e($faq->id); ?>" class="material-checkbox"></label>
                  </div>
                  <?php echo e($no); ?>

                  <?php ($no++); ?>
                </td>
                <td><?php echo $faq->question; ?></td>
                <td><?php echo $faq->answer; ?></td>
                <td><?php echo e($faq->created_at->diffForHumans()); ?></td>
                <td><?php echo e($faq->updated_at->diffForHumans()); ?></td>
                <td>
                  <div class="admin-table-action-block">
                    <a href="<?php echo e(route('faqs.edit', $faq->id)); ?>" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                    <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#<?php echo e($faq->id); ?>deleteModal"><i class="material-icons">delete</i> </button>
                  </div>
                </td>
              </tr>
              <!-- Delete Modal -->
              <div id="<?php echo e($faq->id); ?>deleteModal" class="delete-modal modal fade" role="dialog">
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
                      <?php echo Form::open(['method' => 'DELETE', 'action' => ['FaqController@destroy', $faq->id]]); ?>

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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/faq/index.blade.php ENDPATH**/ ?>
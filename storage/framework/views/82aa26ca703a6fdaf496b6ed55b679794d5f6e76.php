<!-- Modal -->
<div id="ageWarningModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-danger">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo e(__('staticwords.agerestrictedvideo')); ?></h4>
      </div>
      <div class="modal-body">
        <h5 style="color: #c0392b"><?php echo e(__('staticwords.warringforagerestricttext')); ?></h5>
      </div>
    </div>
    <div class="modal-footer">
     <?php echo Form::close(); ?>

    </div>
  </div>
</div><?php /**PATH /var/www/html/laravel/resources/views/modal/agewarning.blade.php ENDPATH**/ ?>
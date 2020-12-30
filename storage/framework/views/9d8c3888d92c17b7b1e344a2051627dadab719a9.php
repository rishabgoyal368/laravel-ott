<?php $__env->startSection('title','All Revenue Report'); ?>
<?php $__env->startSection('stylesheet'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <h4 class="admin-form-text">All Revenue Reports</h4>
    </div>
   
    <div class="content-block box-body">
       
      
      <div class="col-md-12">
        <?php echo $revenue_chart->container(); ?>

      </div>

      <div class="">
        <table id="full_detail_table" class="table table-hover db" style="width: 100%">
          <thead>
            <tr class="table-heading-row">
              <th>
                #
              </th>
              <th>User Name</th>
              <th>Payment Method</th>
              <th>Paid Amount</th>
              <th>Subscription From</th>
              <th>Subscription To</th>
              <th>Date</th>
            </tr>
          </thead>
          <?php if($revenue_report): ?>

            <tbody>
              <?php $__currentLoopData = $revenue_report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr id="item-<?php echo e($report->id); ?>">
                  <td>
                    <?php echo e($key+1); ?>

                  </td>
                  <td><?php echo e($report->user_name); ?></td>
                  <td><?php echo e($report->method); ?></td>
                  <td><i class="<?php echo e($currency_symbol); ?>" aria-hidden="true"></i><?php echo e($report->price); ?></td>
                  <td><?php echo e($report->subscription_from); ?></td>
                  <td><?php echo e($report->subscription_to); ?></td>
                  <td><?php echo e($report->created_at); ?></td>
                </tr>
            
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          <?php endif; ?>
        </table>
      </div>
   
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
 <?php echo $revenue_chart->script(); ?>

 <script>
  <?php
    $y = date('Y');
  ?>
  var startDate = '<?php echo e(date('m/d/Y',strtotime($y.'-01-01'))); ?>';
  var endDate = '<?php echo e(date('m/d/Y',strtotime($y.'-12-31'))); ?>';
  console.log(startDate);
   $(function(){
       $('#mydate').daterangepicker({
            startDate : startDate,
            endDate : endDate
       });
   })
 </script>
   
  <script type="text/javascript">
    $('#mydate').on('change',function(){
      var k = $(this).val();
      var startDate = k.split('-')[0];
       //alert(startDate);  // return 2018-10-21
      var endDate = k.split('-')[1]; 
      //alert(endDate);
      $.ajax({
          type : 'GET',
          data : {startDate : startDate,
                endDate : endDate
                },
          url  : '<?php echo e(route("ajaxdatefilter")); ?>',
          dataType : 'html',
          success : function(data){
             $('#maindata').html('');
             $('#maindata').append(data);
          }
      });

    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/report/revenue.blade.php ENDPATH**/ ?>
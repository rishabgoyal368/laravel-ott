<?php $__env->startSection('title','Dashboard'); ?>
<?php $__env->startSection('stylesheet'); ?>

<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
    <h4 class="admin-form-text">Dashboard</h4>
    <br/>
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo e(url('admin/users')); ?>" class="small-box z-depth-1 hoverable bg-aqua default-color">
          <div class="inner">
            <h3><?php echo e($users_count); ?></h3>
            <p>Total Users</p>
          </div>
          <div class="icon">
           <i class="fa fa-users" aria-hidden="true"></i>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo e(url('admin/users')); ?>" class="small-box z-depth-1 hoverable bg-olive">
          <div class="inner">
            <h3><?php echo e($activeusers); ?></h3>
            <p>Total Active Users</p>
          </div>
          <div class="icon">
            <i class="fa fa-line-chart" aria-hidden="true"></i>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo e(url('admin/movies')); ?>" class="small-box z-depth-1 hoverable bg-red danger-color">
          <div class="inner">
            <h3><?php echo e($movies_count); ?></h3>
            <p>Total Movies</p>
          </div>
          <div class="icon">
            <i class="fa fa-film" aria-hidden="true"></i>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo e(url('admin/tvseries')); ?>" class="small-box z-depth-1 hoverable bg-green success-color">
          <div class="inner">
            <h3><?php echo e($tvseries_count); ?></h3>
            <p>Total Tv Serieses</p>
          </div>
          <div class="icon">
            <i class="fa fa-file-video-o" aria-hidden="true"></i>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo e(url('admin/livetv')); ?>" class="small-box z-depth-1 hoverable bg-yellow pink darken-4">
          <div class="inner">
            <h3><?php echo e($livetv_count); ?></h3>
            <p>Total LiveTv</p>
          </div>
          <div class="icon">
            <i class="fa fa-tv" aria-hidden="true"></i>
          </div>
        </a>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo e(url('admin/packages')); ?>" class="small-box z-depth-1 hoverable bg-yellow secondary-color">
          <div class="inner">
            <h3><?php echo e($package_count); ?></h3>
            <p>Total Packages</p>
          </div>
          <div class="icon">
            <i class="fa fa-sticky-note" aria-hidden="true"></i>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo e(url('admin/coupons')); ?>" class="small-box z-depth-1 hoverable bg-green warning-color">
          <div class="inner">
            <h3><?php echo e($coupon_count); ?></h3>
            <p>Total Coupons</p>
          </div>
          <div class="icon">
            <i class="fa fa-ticket" aria-hidden="true"></i>
          </div>
        </a>
      </div>
     
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <a href="<?php echo e(url('admin/genres')); ?>" class="small-box z-depth-1 hoverable bg-aqua  grey darken-2">
          <div class="inner">
            <h3><?php echo e($genres_count); ?></h3>
            <p>Total Genres</p>
          </div>
          <div class="icon">
            <i class="fa fa-filter" aria-hidden="true"></i>
          </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7">
        <div class="box box-solid">
          <div class="box-body">
            <?php echo $activesubsriber->container(); ?>

          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="box box-solid">
          <div class="box-body">
            <?php echo $piechart->container(); ?>

          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5">
        <div class="box box-solid">
         <div class="box-body">
          <?php echo $doughnutchart->container(); ?>

         </div>
       </div>
      </div>
      <div class="col-md-7">
       <div class="box box-solid">
         <div class="box-body">
           <?php echo $userchart->container(); ?>

         </div>
       </div>
      </div>
    </div>
    <br>
      <div class="panel panel-default">
       <div class="panel-heading">Recently Registered Users</div>
        <div class="panel-body">
          
          <div class="row">
            <?php $__currentLoopData = App\User::where('is_admin','!=','1')->orderBy('id','DESC')->take(6)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-4">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                  <h3 class="widget-user-username"><?php echo e($user->name); ?></h3>
                  
                </div>
                <div class="widget-user-image">
                  <img class="<?php echo e($user->name); ?>" src="<?php echo e(Avatar::create( $user->name )->toBase64()); ?>" alt="User Avatar">
                </div>
                <div class="box-footer">
                  <div class="row">
                    
                    <div class="col-sm-12 border-right">
                      <div class="description-block">
                        <h5 class="description-header"><?php echo e($user->email); ?></h5>
                        <span class="description-text">Email</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                   
                  </div>
                  <!-- /.row -->
                </div>
              </div>
              <!-- /.widget-user -->
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>

    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<?php echo $userchart->script(); ?>

<?php echo $activesubsriber->script(); ?>

<?php echo $piechart->script(); ?>

<?php echo $doughnutchart->script(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/index.blade.php ENDPATH**/ ?>
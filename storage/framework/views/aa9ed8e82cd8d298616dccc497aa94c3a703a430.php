<?php $__env->startSection('title','View Track'); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-main-block mrg-t-40">
        <div class="content-block box-body">
                <div>

                        <!-- Nav tabs -->
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Movies</a></li>
                          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">TV Shows</a></li>
                          
                        </ul>
                      
                        <!-- Tab panes -->
                        <div class="tab-content">

                          <div role="tabpanel" class="tab-pane fade table-responsive in active" id="home">
                              <br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>Movie Name</th>
                                        <th>Views</th>
                                       
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e($movie->title); ?></td>
                                        <td><i class="fa fa-eye"></i> <?php echo e(views($movie)
                                            ->unique()
                                            ->count()); ?></td>
                                    </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                          </div>
                          <div role="tabpanel" class="tab-pane fade table-responsive" id="profile">
                              <br>
                             <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tv Series Name</th>
                                        <th>Views</th>
                                       
                                    </tr>
                                </thead>

                                <tbody>
                                        <?php $__currentLoopData = $season; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e($s->tvseries['title']); ?> [Season: <?php echo e($s->season_no); ?>]</td>
                                            <td><i class="fa fa-eye"></i> <?php echo e(views($s)
                                                ->unique()
                                                ->count()); ?></td>
                                        </tr>
    
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table> 
                          </div>
                          
                        </div>
                      
                      </div>
        </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
    <script>
        $(document).ready(function(){

            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/viewtracker.blade.php ENDPATH**/ ?>
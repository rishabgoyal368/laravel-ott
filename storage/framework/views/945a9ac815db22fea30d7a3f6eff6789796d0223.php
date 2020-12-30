<?php $__env->startSection('title','Create Notification'); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="<?php echo e(url('admin')); ?>" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a> Create Notification</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          <?php echo Form::open(['method' => 'POST', 'action' => 'NotificationController@store']); ?>

            <div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                <?php echo Form::label('title', 'Notification Title'); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter Notification Title"></i>
                <?php echo Form::text('title', null, ['class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('title')); ?></small>
            </div>
             <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                <?php echo Form::label('description', 'Notification Description'); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter Notification description"></i>
                <?php echo Form::text('description', null, ['class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('description')); ?></small>
            </div>
            <?php
            $movie=App\Movie::orderBy('created_at', 'desc')
              
               ->get();;
            ?>
            <div class="form-group<?php echo e($errors->has('movie_id') ? ' has-error' : ''); ?>">
                <?php echo Form::label('movie_id', 'Select Movies'); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please Select Movie Latest 15 Movies You added are visible"></i>
                
                <select class="form-control select2" name="movie_id" >
                  <option value="">Please Select</option>
                  <?php $__currentLoopData = $movie; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movies): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   
                  <option value="<?php echo e($movies->id); ?>" name="<?php echo e($movies->id); ?>"><?php echo e($movies->title); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              
                <small class="text-danger"><?php echo e($errors->first('movie_id')); ?></small>
            </div>
             <?php
            $livetv=App\Movie::orderBy('created_at', 'desc')->where('live',1)
             
               ->get();;
            ?>
            <div class="form-group<?php echo e($errors->has('livetv') ? ' has-error' : ''); ?>">
                <?php echo Form::label('livetv', 'Select Live Tv'); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please Select Movie Latest 15 Movies You added are visible"></i>
                
                <select class="form-control select2" name="livetv">
                   <option value="">Please Select</option>
                  <?php $__currentLoopData = $livetv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movies): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   
                  <option value="<?php echo e($movies->id); ?>" name="<?php echo e($movies->id); ?>"><?php echo e($movies->title); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              
                <small class="text-danger"><?php echo e($errors->first('livetv')); ?></small>
            </div>

            <?php
            $tv=App\TvSeries::orderBy('created_at', 'desc')
             
               ->get();

           
            ?>
            <div class="form-group<?php echo e($errors->has('tv_id') ? ' has-error' : ''); ?>">
                <?php echo Form::label('tv_id', 'Select Tv Series'); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please Select Tv Series; Latest 15 TvSeries You added are visible"></i>
               
                <select class="form-control select2" name="tv_id">
                   <option value="">Please Select</option>

                     <?php $__currentLoopData = $tv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tvs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php
                      $seasons=App\Season::where('tv_series_id',$tvs->id)->first();
                     ?>
                      <?php if(isset($seasons) ): ?>
                  <option value="<?php echo e($seasons->id); ?>" name="<?php echo e($seasons->id); ?>"><?php echo e($tvs->title); ?></option>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                
                <small class="text-danger"><?php echo e($errors->first('tv_id')); ?></small>
            </div>
            <?php
            $user=App\User::all();
            ?>
             <div class="form-group<?php echo e($errors->has('user_id') ? ' has-error' : ''); ?>">
                <?php echo Form::label('user_id', 'Select Users'); ?>

                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please Select Users; You can Select Multipe Users"></i>
                <select class="form-control select2" name="user_id[]" multiple="true" required="true">
                  <option value="0">All Users</option>
                     <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($users->id); ?>"><?php echo e($users->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <small class="text-danger"><?php echo e($errors->first('user_id')); ?></small>
            </div>
            
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> Reset</button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">near_me</i> Send</button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/notification/create.blade.php ENDPATH**/ ?>
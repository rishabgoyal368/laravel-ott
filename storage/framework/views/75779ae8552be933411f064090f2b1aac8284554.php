<?php $__env->startSection('title','Edit Chat Settings'); ?>
<?php $__env->startSection('content'); ?>
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">Chat Settinges</h4><br/>
    <div class="admin-form-block z-depth-1">
      <div class="row">
        <?php echo Form::model($chat,['method'=>'POST','action'=>'ChatSettingController@update']); ?>


            <?php if(isset($chat) && count($chat) > 0): ?>  
              
              <?php $__currentLoopData = $chat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
              <div class="row">
                <p class="font-700"> Chat Settings For <?php echo e(ucfirst($element->key)); ?></p>
                <br/>
                 <?php echo Form::hidden('ids['.$element->id.']', $element->id); ?>

                <div class="col-md-12">

                  <?php if($element->key != 'whatsapp'): ?>
                   <div class="col-md-8">
                      <div class="form-group<?php echo e($errors->has('script') ? ' has-error' : ''); ?>">
                         <?php echo Form::label('script',' Script' ); ?>

                          
                          <?php echo Form::textarea('script['.$element->id.']', $element->script, ['class' => 'form-control','rows'=>'3']); ?>

                        <small class="text-danger"><?php echo e($errors->first('script')); ?></small>
                      </div>
                    </div>
                  <?php endif; ?>

                  <?php if($element->key != 'whatsapp'): ?>
                  <div class="col-md-4">
                      <div class="form-group<?php echo e($errors->has('enable_messanger') ? ' has-error' : ''); ?>">
                       <div class="col-sm-7">
                            <h5 class="bootstrap-switch-label">Enable</h5>
                          </div>
                          <div class="col-sm-5 pad-0">
                            <div class="make-switch">
                              <?php echo Form::checkbox('enable_messanger', 1, ($element->enable_messanger == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]); ?>

                            </div>
                          </div>
                      <small class="text-danger"><?php echo e($errors->first('enable_messanger')); ?></small>
                    </div>
                  </div>
                  <?php endif; ?>
                 
                 
                  <?php if($element->key != 'messanger'): ?>
                  <div class="col-md-3">
                      <div class="form-group<?php echo e($errors->has('mobile') ? ' has-error' : ''); ?>">
                        <?php echo Form::label('mobile', 'Whatsapp No(without [+] sign)'); ?>

                        
                        <?php echo Form::text('mobile['.$element->id.']', $element->mobile, [ 'class' => 'form-control']); ?>

                        <small class="text-danger"><?php echo e($errors->first('mobile')); ?></small>
                      </div>
                    </div>
                  <?php endif; ?>

                  <?php if($element->key != 'messanger'): ?>
                  <div class="col-md-3">
                      <div class="form-group<?php echo e($errors->has('text') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('text','Welcome Text'); ?> 
                      
                      <?php echo Form::text('text['.$element->id.']', $element->text, ['class' => 'form-control']); ?>

                      <small class="text-danger"><?php echo e($errors->first('text')); ?></small>
                    </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group<?php echo e($errors->has('header') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('header','Chat Header'); ?> 
                      
                      <?php echo Form::text('header['.$element->id.']', $element->header, ['class' => 'form-control']); ?>

                      <small class="text-danger"><?php echo e($errors->first('header')); ?></small>
                    </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group<?php echo e($errors->has('size') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('size','Icon Size'); ?> 
                      
                      <?php echo Form::number('size['.$element->id.']', $element->size, ['class' => 'form-control','min'=>'30']); ?>

                      <small class="text-danger"><?php echo e($errors->first('size')); ?></small>
                    </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group<?php echo e($errors->has('color') ? ' has-error' : ''); ?>">
                      <?php echo Form::label('color','Header Color'); ?> 
                      
                      <?php echo Form::color('color['.$element->id.']', $element->color, ['class' => 'form-control']); ?>

                      <small class="text-danger"><?php echo e($errors->first('color')); ?></small>
                    </div>
                  </div>
                  <div class="col-md-3">
                      
                      <div class="form-group<?php echo e($errors->has('enable_whatsapp') ? ' has-error' : ''); ?>">
                       <div class="col-sm-6">
                            <h5 class="bootstrap-switch-label">Enable</h5>
                        </div>
                        <div class="col-sm-5 pad-0">
                            <div class="make-switch">
                              <?php echo Form::checkbox('enable_whatsapp', 1, ($element->enable_whatsapp == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]); ?>

                            </div>
                        </div>
                      <small class="text-danger"><?php echo e($errors->first('enable_whatsapp')); ?></small>
                    </div>
                  </div>
                  <br/>
                  <div class="col-md-3">
                      <div class="form-group<?php echo e($errors->has('position') ? ' has-error' : ''); ?>">
                       <div class="col-sm-6">
                            <h5 class="bootstrap-switch-label">Position</h5>
                        </div>
                        <div class="col-sm-5 pad-0">
                            <div class="make-switch">
                              <?php echo Form::checkbox('position', 1, ($element->position == 'right' ?'right' :'left'), ['class' => 'bootswitch', "data-on-text"=>"Left", "data-off-text"=>"Right", "data-size"=>"small"]); ?>

                            </div>
                        </div>
                      <small class="text-danger"><?php echo e($errors->first('position')); ?></small>
                    </div>
                  </div>
                  <?php endif; ?>
                 
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             
            <?php endif; ?>
          <div class="">
            <button type="submit" class="btn btn-block btn-success">Update</button>
          </div>
          <div class="clear-both"></div>
        <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/chat_setting/index.blade.php ENDPATH**/ ?>
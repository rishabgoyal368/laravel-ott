<?php $__env->startSection('title','Purchase Plan'); ?>
<?php $__env->startSection('main-wrapper'); ?>
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="container-fluid">
      <h4 class="heading"><?php echo e(__('staticwords.pricingplan')); ?></h4>
      <ul class="bradcump">
        <li><a href="<?php echo e(url('account')); ?>"><?php echo e(__('staticwords.dashboard')); ?></a></li>
        <li>/</li>
        <li><?php echo e(__('staticwords.pricingplan')); ?></li>
      </ul>
      <div class="purchase-plan-main-block main-home-section-plans">
        <div class="panel-setting-main-block panel-purchase">
          <div class="container">
            <div class="plan-block-dtl">
              <h3 class="plan-dtl-heading"><?php echo e(__('staticwords.purchasemembership')); ?></h3>
              <h4 class="plan-dtl-sub-heading"><?php echo e(__('staticwords.membershipline')); ?></h4>
              <ul>
                <li><?php echo e(__('staticwords.membershiplines1')); ?>

                </li>
                <li><?php echo e(__('staticwords.membershiplines2')); ?>

                </li>
              </ul>
            </div>
            
            <div class="snip1404 row">
              <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($plan->delete_status ==1 ): ?>
                <?php if($plan->status == 1): ?>
                  <div class="col-md-4">
                    <div class="main-plan-section">
                      <header>
                        <h4 class="plan-home-title">
                          <?php echo e($plan->name); ?>

                        </h4>
                        <div class="plan-cost"><span class="plan-price"><i class="<?php echo e($plan->currency_symbol); ?>"></i><?php echo e($plan->amount); ?></span><span class="plan-type">
                            <i class="<?php echo e($plan->currency_symbol); ?>"></i> <?php echo e(number_format(($plan->amount) / ($plan->interval_count),2)); ?>

                            <?php if($plan->interval == 'year'): ?>
                              Yearly
                            <?php elseif($plan->interval == 'month'): ?>
                              Monthly
                            <?php elseif($plan->interval == 'week'): ?>
                              Weekly
                            <?php elseif($plan->interval == 'day'): ?>
                              Daily
                            <?php endif; ?>
                        </span></div>
                      </header>
                        
                      <?php
                    $pricingTexts = App\PricingText::where('package_id',$plan->id)->get();
                      ?>
                      <?php $__currentLoopData = $pricingTexts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <ul class="plan-features">
                        <?php if(isset($pricingTexts) && count($pricingTexts) > 0): ?>

                      <?php if(isset($element->title1) && !is_null($element->title1)): ?>
                        <li><i class="fa fa-check"> </i><?php echo e($element->title1); ?></li>
                      <?php endif; ?>
                      <?php if(isset($element->title2) && !is_null($element->title2)): ?>
                        <li><i class="fa fa-check"> </i><?php echo e($element->title2); ?></li>
                      <?php endif; ?>
                      <?php if(isset($element->title3) && !is_null($element->title3)): ?>
                        <li><i class="fa fa-check"> </i><?php echo e($element->title3); ?></li>
                      <?php endif; ?>
                      <?php if(isset($element->title4) && !is_null($element->title4)): ?>
                        <li><i class="fa fa-check"> </i><?php echo e($element->title4); ?></li>
                      <?php endif; ?>
                      <?php if(isset($element->title5) && !is_null($element->title5)): ?>
                        <li><i class="fa fa-check"> </i><?php echo e($element->title5); ?></li>
                      <?php endif; ?>
                      <?php if(isset($element->title6) && !is_null($element->title6)): ?>
                        <li><i class="fa fa-check"> </i><?php echo e($element->title6); ?></li>
                      <?php endif; ?>
                        <?php endif; ?>
                      </ul>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php if(auth()->guard()->check()): ?>
                        <div class="plan-select"><a href="<?php echo e(route('get_payment', $plan->id)); ?>" class="btn btn-prime"><?php echo e(__('staticwords.subscribe')); ?></a></div>
                      <?php else: ?>
                        <div class="plan-select"><a href="<?php echo e(route('register')); ?>"><?php echo e(__('staticwords.registernow')); ?></a></div>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endif; ?>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/user/purchaseplan.blade.php ENDPATH**/ ?>
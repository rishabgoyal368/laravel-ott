<?php $__env->startSection('title', 'Settings'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-form-main-block mrg-t-40">
  <!-- Tab buttons for site settings -->
  <div class="tabsetting">
    <a href="#" style="color: #7f8c8d;" ><button class="tablinks active">Genral Setting</button></a>

    <a href="<?php echo e(url('admin/seo')); ?>" style="color: #7f8c8d;" ><button class="tablinks">SEO Setting</button></a>

    <a href="<?php echo e(url('admin/api-settings')); ?>" style="color: #7f8c8d;"><button class="tablinks">API Setting</button></a>
    <a href="<?php echo e(route('mail.getset')); ?>" style="color: #7f8c8d;"><button class="tablinks">Mail Setting</button></a>
   

  </div>

  <!-- update general settings -->
  <?php if($config): ?>
  <?php echo Form::model($config, ['method' => 'PATCH', 'action' => ['ConfigController@update', $config->id], 'files' => true]); ?>

  <div class="row admin-form-block z-depth-1">
    <div class="col-md-6">

      <div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
        <?php echo Form::label('title', 'Project Title'); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your project title"></i>
        <?php echo Form::text('title', null, ['id' => 'pr', 'onkeyup' => 'sync()', 'class' => 'form-control']); ?>

        <small class="text-danger"><?php echo e($errors->first('title')); ?></small>
      </div>

      <div class="form-group<?php echo e($errors->has('APP_URL') ? ' has-error' : ''); ?>">

        <?php echo Form::label('APP_URL', 'Website URL'); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your website url"></i>
        <input type="text" name="APP_URL" value="<?php echo e($env_files['APP_URL']); ?>" class="form-control"/>
        <small class="text-danger"><?php echo e($errors->first('w_name')); ?></small>


      </div>

      <div class="form-group<?php echo e($errors->has('w_email') ? ' has-error' : ''); ?>">
        <?php echo Form::label('w_email', 'Default Email'); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your default email"></i>
        <?php echo Form::email('w_email', null, ['class' => 'form-control', 'placeholder' => 'eg: foo@bar.com']); ?>

        <small class="text-danger"><?php echo e($errors->first('w_email')); ?></small>
      </div>

      <div class="form-group<?php echo e($errors->has('currency_code') ? ' has-error' : ''); ?>">
        <?php echo Form::label('currency_code', 'Currency Code'); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your curreny code eg:USD"></i>
        <?php echo Form::text('currency_code', null, ['class' => 'form-control']); ?>

        <small class="text-danger"><?php echo e($errors->first('currency_code')); ?></small>
      </div>
      <div class="form-group<?php echo e($errors->has('currency_symbol') ? ' has-error' : ''); ?> currency-symbol-block">
        <?php echo Form::label('currency_symbol', 'Currency Symbol'); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please select your currency symbol"></i>
        <div class="input-group">
          <?php echo Form::text('currency_symbol', null, ['class' => 'form-control currency-icon-picker']); ?>

          <span class="input-group-addon simple-input"><i class="glyphicon glyphicon-user"></i></span>

        </div>
        <small class="text-danger"><?php echo e($errors->first('currency_symbol')); ?></small>
      </div>
      <div class="form-group<?php echo e($errors->has('invoice_add') ? ' has-error' : ''); ?>">
        <?php echo Form::label('invoice_add', 'Invoice Address'); ?>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter your invoice address"></i>
        <?php echo Form::text('invoice_add', null, ['class' => 'form-control']); ?>

        <small class="text-danger"><?php echo e($errors->first('invoice_add')); ?></small>
      </div>
      <div class="bootstrap-checkbox form-group<?php echo e($errors->has('goto') ? ' has-error' : ''); ?>">
        <div class="row">
          <div class="col-md-7">
            <h5 class="bootstrap-switch-label">Go to Top</h5>
          </div>
          <div class="col-md-5 pad-0">
            <div class="make-switch">
              <?php echo Form::checkbox('goto', 1, ($button->goto == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]); ?>

            </div>
          </div>
        </div>
        <div class="col-md-12">
          <small class="text-danger"><?php echo e($errors->first('goto')); ?></small>
        </div>
      </div>
      <div class="bootstrap-checkbox form-group<?php echo e($errors->has('color') ? ' has-error' : ''); ?>">
        <div class="row">
          <div class="col-md-5">
            <h5 class="bootstrap-switch-label">Color Schemes</h5>
          </div>
          <div class="col-md-7 pad-0">
            <select class="form-control select2" name="color">
               <?php if($config->color=='default'): ?>
             <option value="default" selected="">Default</option>
             <?php else: ?>
               <option value="default">Default</option>
             <?php endif; ?>
                 <?php if($config->color=='green'): ?>
             <option value="green" selected="">Green</option>
             <?php else: ?>
              <option value="green">Green</option>
             <?php endif; ?>
                 <?php if($config->color=='orange'): ?>
             <option value="orange" selected="">Orange</option>
             <?php else: ?>
               <option value="orange">Orange</option>
             <?php endif; ?>
                 <?php if($config->color=='yellow'): ?>

             <option value="yellow" selected="">Yellow</option>
             <?php else: ?>
              <option value="yellow">Yellow</option>
             <?php endif; ?>
                 <?php if($config->color=='pink'): ?>
             <option value="pink" selected="">Pink</option>
             <?php else: ?>
              <option value="pink">Pink</option>
             <?php endif; ?>
                 <?php if($config->color=='red'): ?>

             <option value="red" selected="">Red</option>
             <?php else: ?>
             <option value="red">Red</option>
             <?php endif; ?>
           </select>
         </div>
       </div>
       <div class="col-md-12">
        <small class="text-danger"><?php echo e($errors->first('color')); ?></small>
      </div>
    </div>
     <div class="bootstrap-checkbox form-group<?php echo e($errors->has('color_dark') ? ' has-error' : ''); ?>">
      <div class="row">
        <div class="col-md-7">
          <h5 class="bootstrap-switch-label">Color Schemes</h5>
        </div>
        <div class="col-md-5 pad-0">
          <div class="make-switch">
            <?php echo Form::checkbox('color_dark', 1, ($config->color_dark == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Light", "data-off-text"=>"Dark", "data-size"=>"small"]); ?>

          </div>
        </div>
      </div>
      <div class="col-md-12">
        <small class="text-danger"><?php echo e($errors->first('color_dark')); ?></small>
      </div>
    </div>

    <div class="bootstrap-checkbox form-group<?php echo e($errors->has('wel_eml') ? ' has-error' : ''); ?>">
      <?php if(env('MAIL_DRIVER') != NULL && env('MAIL_HOST') != NULL && env('MAIL_PORT')): ?>
      <div class="row">
        <div class="col-md-7">
          <h5 class="bootstrap-switch-label">Welcome email for user</h5>
        </div>
        <div class="col-md-5 pad-0">
          <div class="make-switch">
            <input type="checkbox" name="wel_eml" <?php echo e($config->wel_eml == 1 ? "checked" : ""); ?> class='bootswitch' data-on-text= "Enable" data-off-text= "Disable" data-size="small">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-7">
          <h5 class="bootstrap-switch-label">Verify email for user</h5>
        </div>
        <div class="col-md-5 pad-0">
          <div class="make-switch">
            <input type="checkbox" name="verify_email" <?php echo e($config->verify_email == 1 ? "checked" : ""); ?> class='bootswitch' data-on-text= "Enable" data-off-text= "Disable" data-size="small">
          </div>
        </div>
      </div>
      <div class="col-md-12">
       <small>(If you enable it, a welcome email will be sent to user's register email id, make sure you updated your mail setting in Site Setting >> Mail Settings before enable it.)</small>
       <small class="text-danger"><?php echo e($errors->first('color')); ?></small>
     </div>
     <?php endif; ?>

     <div class="bootstrap-checkbox form-group<?php echo e($errors->has('is_appstore') ? ' has-error' : ''); ?>">
       <div class="row">
        <div class="col-md-7">
          <h5 class="bootstrap-switch-label">App Store Download</h5>
        </div>
        <div class="col-md-5 pad-0">
          <div class="make-switch">
            <?php echo Form::checkbox('is_appstore', 1, ($config->is_appstore == '1' ? 1 : 0), ['class' => 'bootswitch appstore', 'onChange' =>'isappstore()', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]); ?>

          </div>
        </div>
      </div>
    </div>
    <div id="appstore_link" style="<?php echo e($config->is_appstore=='1' ? "" : "display: none"); ?>" class="bootstrap-checkbox form-group<?php echo e($errors->has('appstore') ? ' has-error' : ''); ?>">
      <div class="row">
        <div class="col-md-6">
          <h5 class="bootstrap-switch-label">App Store Link</h5>
        </div>
        <div class="col-md-6 pad-0">
          <div class="input-group">
            <?php echo Form::text('appstore', null, ['class' => 'form-control']); ?>


          </div>
        </div>
      </div>
      <div class="col-md-12">
        <small class="text-danger"><?php echo e($errors->first('appstore')); ?></small>
      </div>
    </div>
    <div class="bootstrap-checkbox form-group<?php echo e($errors->has('is_playstore') ? ' has-error' : ''); ?>">
     <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Play Store Download</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('is_playstore', 1, ($config->is_playstore == '1' ? 1 : 0), ['class' => 'bootswitch playstore', 'onChange' =>'isplaystore()', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
  </div>

  <div id="playstore_link" style="<?php echo e($config->is_playstore=='1' ? "" : "display: none"); ?>"class="bootstrap-checkbox form-group<?php echo e($errors->has('playstore') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-6">
        <h5 class="bootstrap-switch-label">Play Store Link</h5>
      </div>
      <div class="col-md-6 pad-0">
        <div class="input-group">
          <?php echo Form::text('playstore', null, ['class' => 'form-control']); ?>


        </div>

      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('playstore')); ?></small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('user_rating') ? ' has-error' : ''); ?>">
     <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">User Rating</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('user_rating', 1, ($config->user_rating == '1' ? 1 : 0), ['class' => 'bootswitch ', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
  </div>
    <div class="bootstrap-checkbox form-group<?php echo e($errors->has('comments') ? ' has-error' : ''); ?>">
     <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Video Comments</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('comments', 1, ($config->comments == '1' ? 1 : 0), ['class' => 'bootswitch ', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('blog') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Blog</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('blog', null, ($config->blog == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('blog')); ?></small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('comming_soon') ? ' has-error' : ''); ?>">
     <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Coming  Soon</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('comming_soon', 1, ($button->comming_soon == '1' ? 1 : 0), ['class' => 'bootswitch comming_soon', 'onChange' =>'iscommingsoon()', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
  </div>
  <div id="comming_soon_link" style="<?php echo e($button->comming_soon=='1' ? "" : "display: none"); ?>"class="bootstrap-checkbox form-group<?php echo e($errors->has('commingsoon_enabled_ip') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-6">
        <h5 class="bootstrap-switch-label">Coming  Soon Enabled Ips </h5>
      </div>
      <div class="col-md-6">
        <div class="input-group" style="width:100% !important;">
          <select class="form-control select2" name="commingsoon_enabled_ip[]" multiple="multiple">
            <?php if(isset($button->commingsoon_enabled_ip) &&  $button->commingsoon_enabled_ip != NULL): ?>
            <?php $__currentLoopData = $button->commingsoon_enabled_ip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enable_ip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($enable_ip); ?>" <?php if(isset($enable_ip)): ?>selected="" <?php endif; ?>><?php echo e($enable_ip); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </select>

        </div>

      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('commingsoon_enabled_ip')); ?></small>
    </div>
    <br/>
    <div class="row">
      <div class="col-md-6">
        <h5 class="bootstrap-switch-label">Coming Soon Text </h5>
      </div>
      <div class="col-md-6">
        <div class="input-group">
          <input class ="form-control" type="text" name="comming_soon_text" value="">

        </div>

      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('comming_soon_text')); ?></small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('ip_block') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">IP  Block</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
           <?php echo Form::checkbox('ip_block', 1, ($button->ip_block == '1' ? 1 : 0), ['class' => 'bootswitch ip_block', 'onChange' =>'isipblock()', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('ip_block')); ?></small>
    </div>
  </div>
  <div id="ip_block_link" style="<?php echo e($button->ip_block=='1' ? "" : "display: none"); ?>"class="bootstrap-checkbox form-group<?php echo e($errors->has('ipblock_ip') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-6">
        <h5 class="bootstrap-switch-label">Blocked Ips </h5>
      </div>
      <div class="col-md-6 pad-0">
        <div class="input-group" style="width:100% !important;">
         <select class="form-control select2" name="block_ips[]" multiple="multiple">
          <?php if(isset($button->block_ips)): ?>
            <?php $__currentLoopData = $button->block_ips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block_ip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($block_ip); ?>" <?php if(isset($block_ip)): ?>selected="" <?php endif; ?>><?php echo e($block_ip); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          </select>
        </div>

      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('block_ips')); ?></small>
    </div>
  </div>


</div>
</div>
<div class="col-md-6">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has('logo') ? ' has-error' : ''); ?> input-file-block">
        <?php echo Form::label('logo', 'Project Logo'); ?> - <p class="inline info">Size: 200x63</p>
        <?php echo Form::file('logo', ['class' => 'input-file', 'id'=>'logo']); ?>

        <label for="logo" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Project Logo">
          <i class="icon fa fa-check"></i>
          <span class="js-fileName">Choose a File</span>
        </label>
        <p class="info">Choose a logo</p>
        <small class="text-danger"><?php echo e($errors->first('logo')); ?></small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="image-block">
        <img src="<?php echo e(asset('images/logo/' . $config->logo)); ?>" class="img-responsive" alt="">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has('favicon') ? ' has-error' : ''); ?> input-file-block">
        <?php echo Form::label('favicon', 'Project Favicon Icon'); ?> - <p class="inline info"></p>
        <?php echo Form::file('favicon', ['class' => 'input-file', 'id'=>'favicon']); ?>

        <label for="favicon" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Project Favicon">
          <i class="icon fa fa-check"></i>
          <span class="js-fileName">Choose a File</span>
        </label>
        <p class="info">Choose a favicon</p>
        <small class="text-danger"><?php echo e($errors->first('favicon')); ?></small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="image-block">
        <img src="<?php echo e(asset('images/favicon/' . $config->favicon)); ?>" class="img-responsive" alt="">
      </div>
    </div>
  </div>
 
  <div class="row">
    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has('livetvicon') ? ' has-error' : ''); ?> input-file-block">
        <?php echo Form::label('livetvicon', 'Project LiveTv Icon'); ?> - <p class="inline info"></p>
        <?php echo Form::file('livetvicon', ['class' => 'input-file', 'id'=>'livetvicon']); ?>

        <label for="livetvicon" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Project LiveTvicon">
          <i class="icon fa fa-check"></i>
          <span class="js-fileName">Choose a File</span>
        </label>
        <p class="info">Choose a livetvicon</p>
        <small class="text-danger"><?php echo e($errors->first('livetvicon')); ?></small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="image-block">
        <img src="<?php echo e(asset('images/livetvicon/' . $config->livetvicon)); ?>" class="img-responsive" alt="">
      </div>
    </div>
  </div>
    <br/>      
  
  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('free_sub') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Free Trial</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('free_sub', 1, ($config->free_sub == '1' ? 1 : 0), ['class' => 'bootswitch free_sub', 'onChange' =>'isfree()', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
  </div>
  <div id="free_days" style="<?php echo e($config->free_sub=='1' ? "" : "display: none"); ?>"class="bootstrap-checkbox  free_days form-group<?php echo e($errors->has('free_days') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-6">
        <h5 class="bootstrap-switch-label">Enter Days</h5>
      </div>
      <div class="col-md-6 pad-0">
        <div class="input-group">
          <?php echo Form::text('free_days', null, ['class' => 'form-control']); ?>


        </div>

      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('free_days')); ?></small>
    </div>
  </div>
        
  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('age_restriction') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Age Restriction</h5>
        <label>Age Restriction will be taken from Maturity Rating in Movies and TVSeries </label>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('age_restriction', 1, ($config->age_restriction == '1' ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('age_restriction') ? ' has-error' : ''); ?>">
     <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Donation Link</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('donation', 1, ($config->donation == '1' ? 1 : 0), ['class' => 'bootswitch donate', 'onChange' =>'isdonation()', "data-on-text"=>"On", "data-off-text"=>"Off", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
  </div>
  <div id="donation_link"  style="<?php echo e($config->donation=='1' ? "" : "display: none"); ?>" class="bootstrap-checkbox form-group<?php echo e($errors->has('donation_link') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-6">
        <h5 class="bootstrap-switch-label">Donation Link</h5>
      </div>
      <div class="col-md-6 pad-0">
        <div class="input-group">
          <?php echo Form::text('donation_link', null, ['class' => 'form-control']); ?>


        </div>
        <span>Register On <a href="https://www.paypal.me">Paypal.me</a> </span>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('withlogin')); ?></small>
    </div>
  </div>

  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('prime_genre_slider') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Genre Slider Type</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('prime_genre_slider', 1, ($config->prime_genre_slider == '1' ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Layout 1", "data-off-text"=>"Layout 2", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('prime_genre_slider')); ?></small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('prime_movie_single') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Movie Single Type</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('prime_movie_single', 1, ($config->prime_movie_single == '1' ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Layout 1", "data-off-text"=>"Layout 2", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('prime_movie_single')); ?></small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('prime_footer') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Footer Type</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('prime_footer', 1, ($config->prime_footer == '1' ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Layout 1", "data-off-text"=>"Layout 2", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('prime_footer')); ?></small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('catlog') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Catlog View</h5>
        <label>Allow user to Access website without Subscription, but can not Play Video</label>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('catlog', 1, ($config->catlog == 1 ? 1 : 0), ['class' => 'bootswitch checkk', 'onChange' =>'withoutlogin()', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('catlog')); ?></small>
    </div>
  </div>
  <div id="withoutlogin" style="<?php echo e($config->catlog=='1' ? "" : "display: none"); ?>" class="bootstrap-checkbox form-group<?php echo e($errors->has('withlogin') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Without Login</h5>
          <label>Allow user to Access website without Subscription and Without Login, but can not Play Video</label>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('withlogin', 1, ($config->withlogin == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('withlogin')); ?></small>
    </div>
  </div>

  
  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('preloader') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Preloader</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('preloader', 1, ($config->preloader == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('preloader')); ?></small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('inspect') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Inspect Disable</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('inspect', 1, ($button->inspect == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('inspect')); ?></small>
    </div>
  </div>
  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('rightclick') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Rightclick Disable</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('rightclick', 1, ($button->rightclick == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('rightclick')); ?></small>
    </div>
  </div>

  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('APP_DEBUG') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Debug Mode</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <input type="checkbox" <?php echo e(env('APP_DEBUG') == true ? "checked" : ""); ?> name="APP_DEBUG" class="bootswitch" data-on-text="True" data-off-text="False" data-size="small">
          
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('APP_DEBUG')); ?></small>
    </div>
  </div>

  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('uc_browser') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">UC Browser Block</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('uc_browser', 1, ($button->uc_browser == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]); ?>

          
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('uc_browser')); ?></small>
    </div>
  </div>

  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('remove_landing_page') ? ' has-error' : ''); ?>">
    <?php
    $mymenu=App\Menu::first();


    ?>
    <?php if(isset($mymenu)): ?>
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Remove Landing Page</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('remove_landing_page', 1, ($config->remove_landing_page == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Yes", "data-off-text"=>"No", "data-size"=>"small"]); ?>

        </div>
      </div>
    </div>
    <?php else: ?>
    <div class="row">
      <label>You can Remove Landing Page, Once you Create Atleast One Menu.</label>
    </div>
    <?php endif; ?>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('remove_landing_page')); ?></small>
    </div>
  </div>

  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('remove_subscription') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Remove Subscription on Landing Page</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('remove_subscription', 1, ($button->remove_subscription == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]); ?>

          
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('remove_subscription')); ?></small>
    </div>
  </div>

  <div class="bootstrap-checkbox form-group<?php echo e($errors->has('protip') ? ' has-error' : ''); ?>">
    <div class="row">
      <div class="col-md-7">
        <h5 class="bootstrap-switch-label">Protip</h5>
      </div>
      <div class="col-md-5 pad-0">
        <div class="make-switch">
          <?php echo Form::checkbox('protip', 1, ($button->protip == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"On", "data-off-text"=>"OFF", "data-size"=>"small"]); ?>

          
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <small class="text-danger"><?php echo e($errors->first('protip')); ?></small>
    </div>
  </div>

  </div>
  <div class="btn-group col-xs-12">
    <button type="submit" class="btn btn-block btn-success">Save Settings</button>
  </div>
  <div class="clear-both"></div>
</div>
<?php echo Form::close(); ?>

<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
<script type="text/javascript">
  function sync()
  {
    var n1 = document.getElementById('pr');
    var n2 = document.getElementById('pr2');
    n2.value = n1.value;
  }


</script>


<script type="text/javascript">
  function withoutlogin()
  {
    if($('.checkk').is(":checked"))   
      $("#withoutlogin").show();
    else
      $("#withoutlogin").hide();
  }

</script>
<script type="text/javascript">
  function isdonation()
  {
    if($('.donate').is(":checked"))   
      $("#donation_link").show();
    else
      $("#donation_link").hide();
  }

</script>
<script type="text/javascript">
  function isplaystore()
  {
    if($('.playstore').is(":checked"))   
      $("#playstore_link").show();
    else
      $("#playstore_link").hide();
  }

</script>
<script type="text/javascript">
  function isappstore()
  {
    if($('.appstore').is(":checked"))   
      $("#appstore_link").show();
    else
      $("#appstore_link").hide();
  }

</script>
<script type="text/javascript">
  function isfree()
  {
    if($('.free_sub').is(":checked"))   
      $("#free_days").show();
    else
      $("#free_days").hide();
  }

</script>

<!---------- comming soon --------->
<script type="text/javascript">
  function iscommingsoon()
  {
    if($('.comming_soon').is(":checked"))   
      $("#comming_soon_link").show();
    else
      $("#comming_soon_link").hide();
  }

</script>
<!------------- end comming soon ----->

<!---------- Ip Block --------->
<script type="text/javascript">
  function isipblock()
  {
    if($('.ip_block').is(":checked"))   
      $("#ip_block_link").show();
    else
      $("#ip_block_link").hide();
  }

</script>
<!------------- end ip_block ----->

<!---------- maintenance --------->
<script type="text/javascript">
  function ismaintenance()
  {
    if($('.maintenance').is(":checked"))   
      $("#maintenance_link").show();
    else
      $("#maintenance_link").hide();
  }

</script>
<!------------- end maintenance ----->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/config/settings.blade.php ENDPATH**/ ?>
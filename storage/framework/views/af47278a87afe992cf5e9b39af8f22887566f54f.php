<!DOCTYPE html>
<html>
<head>
  <title><?php echo e($w_title); ?></title>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="Description" content="<?php echo e($description); ?>" />
  <meta name="keyword" content="<?php echo e($w_title); ?>, <?php echo e($keyword); ?>">
  <meta name="MobileOptimized" content="320" />
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <link rel="icon" type="image/icon" href="<?php echo e(asset('images/favicon/favicon.png')); ?>"> <!-- favicon-icon -->
  <!-- theme style -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> <!-- google font -->
  <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css"/> <!-- bootstrap css -->
  <link href="https://vjs.zencdn.net/6.6.0/video-js.css" rel="stylesheet"> <!-- videojs css -->
  <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css"/> <!-- fontawsome css -->
  <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet" type="text/css"/> <!-- custom css -->
  <link href="<?php echo e(asset('css/custom-style.css')); ?>" rel="stylesheet" type="text/css"/>
</head>
<body class="bg-black">
  <div class="signup__container container sign-in-main-block">
    <div class="row"> 
      <div class="col-sm-6 col-md-offset-2 col-md-4 pad-0">
        <div class="container__child signup__thumbnail" style="background-image: url(<?php echo e(asset('images/login/'.$auth_customize->image)); ?>);">
          <div class="thumbnail__logo">
            <?php if($logo != null): ?>
              <a href="<?php echo e(url('/')); ?>" title="<?php echo e($w_title); ?>"><img src="<?php echo e(asset('images/logo/'.$logo)); ?>" class="img-responsive" alt="<?php echo e($w_title); ?>"></a>
            <?php endif; ?>
          </div>
          <div class="thumbnail__content text-center">
            <?php echo $auth_customize->detail; ?>

          </div>          
          <div class="signup__overlay"></div>
        </div>
         <div class="signup-thumbnail">
          <?php if($logo != null): ?>
              <a href="<?php echo e(url('/')); ?>" title="<?php echo e($w_title); ?>"><img src="<?php echo e(asset('images/logo/'.$logo)); ?>" class="img-responsive" alt="<?php echo e($w_title); ?>"></a>
            <?php endif; ?>  
        </div>
      </div>
      <div class="col-sm-6 col-md-4 pad-0">
        <div class="container__child signup__form">
          <?php if(session('status')): ?>
              <div class="alert alert-success">
                  <?php echo e(session('status')); ?>

              </div>
          <?php endif; ?>
          <form method="POST" action="<?php echo e(route('password.email')); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
              <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                <label for="email"><?php echo e(__('staticwords.email')); ?></label>
                <input id="email" type="text" class="form-control" name="email" placeholder="<?php echo e(__('staticwords.enteryouremail')); ?>" value="<?php echo e(old('email')); ?>" required autofocus>
                <?php if($errors->has('email')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                  </span>
                <?php endif; ?>
              </div>
            </div>
            <div class="m-t-lg">
              <input class="btn btn--form btn--form-login" type="submit" value="<?php echo e(__('staticwords.sendpasswordresetlink')); ?>" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Scripts -->
  <script type="text/javascript" src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script> <!-- bootstrap js -->
  <script type="text/javascript" src="<?php echo e(asset('js/jquery.popover.js')); ?>"></script> <!-- bootstrap popover js -->
  <script type="text/javascript" src="<?php echo e(asset('js/jquery.curtail.min.js')); ?>"></script> <!-- menumaker js -->
  <script type="text/javascript" src="<?php echo e(asset('js/jquery.scrollSpeed.js')); ?>"></script> <!-- owl carousel js -->
  <script type="text/javascript" src="<?php echo e(asset('js/custom-js.js')); ?>"></script>
</body>
</html>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(__('staticwords.resetpassword')); ?></div>

                <div class="panel-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('password.email')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label"><?php echo e(__('staticwords.emailaddress')); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('staticwords.sendpasswordresetlink')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/laravel/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>
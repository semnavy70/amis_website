<?php $__env->startSection('page-title', trans('Login')); ?>

<?php $__env->startSection('content'); ?>

    <div class="col-md-8 col-lg-6 col-xl-5 mx-auto my-10p" id="login">
        <div class="card mt-5">
            <div class="card-body">
                <div class="text-center">
                    <h2 class="text-header-color">CAMAGRIMARKET</h2>
                </div>
                <div class="p-2">
                    <?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <form role="form" action="<?= url('login') ?>" method="POST" id="login-form" autocomplete="off"
                          class="mt-3">

                        <input type="hidden" value="<?= csrf_token() ?>" name="_token">

                        <?php if(Request::has('to')): ?>
                            <input type="hidden" value="<?php echo e(Request::get('to')); ?>" name="to">
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="username" class="sr-only"><?php echo app('translator')->get('Email or Username'); ?></label>
                            <input type="text"
                                   name="username"
                                   id="username"
                                   class="form-control input-solid"
                                   placeholder="<?php echo app('translator')->get('Email or Username'); ?>"
                                   value="<?php echo e(old('username')); ?>">
                        </div>

                        <div class="form-group password-field">
                            <label for="password" class="sr-only"><?php echo app('translator')->get('Password'); ?></label>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="form-control input-solid"
                                   placeholder="<?php echo app('translator')->get('Password'); ?>">
                        </div>


                        <?php if(setting('remember_me')): ?>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" id="remember"
                                       value="1"/>
                                <label class="custom-control-label font-weight-normal" for="remember">
                                    <?php echo app('translator')->get('Remember me?'); ?>
                                </label>
                            </div>
                        <?php endif; ?>


                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-login">
                                <?php echo app('translator')->get('Login'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo HTML::script('assets/js/as/login.js'); ?>

    <?php echo JsValidator::formRequest('Vanguard\Http\Requests\Auth\LoginRequest', '#login-form'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/auth/login.blade.php ENDPATH**/ ?>
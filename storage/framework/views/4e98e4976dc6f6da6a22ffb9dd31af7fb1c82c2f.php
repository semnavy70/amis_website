<?php $__env->startSection('page-title', __('General Settings')); ?>
<?php $__env->startSection('page-heading', __('General Settings')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item text-muted">
        <?php echo app('translator')->get('Settings'); ?>
    </li>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('General'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo Form::open(['route' => 'settings.general.update', 'id' => 'general-settings-form']); ?>


    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><?php echo app('translator')->get('Name'); ?></label>
                        <input type="text" class="form-control input-solid" id="app_name"
                               name="app_name" value="<?php echo e(setting('app_name')); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        <?php echo app('translator')->get('Update'); ?>
    </button>

    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/settings/general.blade.php ENDPATH**/ ?>
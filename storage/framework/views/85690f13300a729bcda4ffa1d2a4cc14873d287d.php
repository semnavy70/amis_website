<?php $__env->startSection('page-title', __('Permissions')); ?>
<?php $__env->startSection('page-heading', $edit ? $permission->name : __('Create New Permission')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('permissions.index')); ?>"><?php echo app('translator')->get('Permissions'); ?></a>
    </li>
    <li class="breadcrumb-item active">
        <?php echo e(__($edit ? 'Edit' : 'Create')); ?>

    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if($edit): ?>
        <?php echo Form::open(['route' => ['permissions.update', $permission], 'method' => 'PUT', 'id' => 'permission-form']); ?>

    <?php else: ?>
        <?php echo Form::open(['route' => 'permissions.store', 'id' => 'permission-form']); ?>

    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        <?php echo app('translator')->get('Permission Details'); ?>
                    </h5>
                    <p class="text-muted font-weight-light">
                        <?php echo app('translator')->get('A general permission information.'); ?>
                    </p>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="name"><?php echo app('translator')->get('Name'); ?></label>
                        <input type="text"
                               class="form-control input-solid"
                               id="name"
                               name="name"
                               placeholder="<?php echo app('translator')->get('Permission Name'); ?>"
                               value="<?php echo e($edit ? $permission->name : old('name')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="display_name"><?php echo app('translator')->get('Display Name'); ?></label>
                        <input type="text"
                               class="form-control input-solid"
                               id="display_name"
                               name="display_name"
                               placeholder="<?php echo app('translator')->get('Display Name'); ?>"
                               value="<?php echo e($edit ? $permission->display_name : old('display_name')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="description"><?php echo app('translator')->get('About Permission'); ?></label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control input-solid"><?php echo e($edit ? $permission->description : old('description')); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">
                <?php echo e(__($edit ? "Update Permission" : "Create Permission")); ?>

            </button>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php if($edit): ?>
        <?php echo JsValidator::formRequest('Vanguard\Http\Requests\Permission\UpdatePermissionRequest', '#permission-form'); ?>

    <?php else: ?>
        <?php echo JsValidator::formRequest('Vanguard\Http\Requests\Permission\CreatePermissionRequest', '#permission-form'); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/permission/add-edit.blade.php ENDPATH**/ ?>
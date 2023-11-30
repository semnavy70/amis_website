<?php $__env->startSection('page-title', __('Create Slide')); ?>
<?php $__env->startSection('page-heading', __('Manage Slide')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('slide.index')); ?>" class="text-muted">
            <?php echo app('translator')->get('Slide'); ?>
        </a>
    </li>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('Create Slide'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <form action="<?php echo e(route("slide.store")); ?>" method="POST" id="slide-form" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="name"><?php echo app('translator')->get('Name'); ?></label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old("name")); ?>">
        </div>
        <div class="form-group text-center mt-4 d-none">
            <img id="image_preview" class="image_preview" src="#" alt="image" width="300">
        </div>
        <div class="form-group">
            <label for="image"><?php echo app('translator')->get('Image'); ?>*</label>
            <div class="custom-file">
                <input name="image" type="file" class="custom-file-input" id="image" lang="km" value="<?php echo e(old('image')); ?>" accept="image/*">
                <label class="custom-file-label" for="photo"></label>
            </div>
        </div>
        <div class="form-group">
            <label for="order"><?php echo app('translator')->get('Order'); ?></label>
            <input type="number" class="form-control" id="order" name="order"
                   value="<?php echo e(old("order")); ?>">
        </div>
        <div class="row mb-3">
            <div class="col-8"></div>
            <div class="col-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-100"><?php echo app('translator')->get('Save'); ?></button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo JsValidator::formRequest('Vanguard\Http\Requests\Slide\CreateSlideRequest','#slide-form'); ?>

    <script>
        $("#image").change(function () {
            displayPreviewImage(this, "#image_preview");
        });
    </script>
    <style>
        .image_preview {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .image_preview:hover {
            opacity: 0.7;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/slide/create.blade.php ENDPATH**/ ?>
<?php $__env->startSection('page-title', __('Create advertise')); ?>
<?php $__env->startSection('page-heading', __('Manage advertise')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('advertise.index')); ?>" class="text-muted">
            <?php echo app('translator')->get('Advertise'); ?>
        </a>
    </li>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('Create advertise'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <form action="<?php echo e(route('advertise.store')); ?>" method="POST" enctype="multipart/form-data" id="advertise-form">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="name"><?php echo app('translator')->get('Name*'); ?></label>
            <input name="name" type="text" class="form-control" id="name" value="<?php echo e(old('name')); ?>">
        </div>
        <div class="form-group">
            <label for="link"><?php echo app('translator')->get('Link*'); ?></label>
            <input name="link" type="url" class="form-control" id="link" value="<?php echo e(old('link')); ?>">
        </div>
        <div class="form-group">
            <label for="page"><?php echo app('translator')->get('Page*'); ?></label>
            <select name="page" class="form-control" id="page">
                <option>--ជ្រើសរើស--</option>
                <?php $__currentLoopData = $advertisePage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($page->slug); ?>"><?php echo e($page->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="blog"><?php echo app('translator')->get('Blog*'); ?></label>
            <select name="blog" class="form-control" id="blog">
                <option>--ជ្រើសរើស--</option>
                <?php $__currentLoopData = $advertiseBlog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($blog->slug); ?>"><?php echo e($blog->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="is_active"><?php echo app('translator')->get('Status*'); ?></label>
            <select name="is_active" class="form-control" id="is_active">
                <option value="1">បង្ហាញ</option>
                <option value="0">មិនបង្ហាញ</option>
            </select>
        </div>
        <div class="form-group">
            <label for="order"><?php echo app('translator')->get('Order'); ?></label>
            <input name="order" type="number" class="form-control" id="order" value="<?php echo e(old('order')); ?>">
        </div>
        <div class="form-group text-center mt-4 d-none">
            <img id="image_preview" src="#" alt="image" width="600">
        </div>
        <div class="form-group">
            <label for="image"><?php echo app('translator')->get('PC advertise picture'); ?></label>
            <div class="custom-file">
                <input name="image" type="file" class="custom-file-input" id="image" lang="km" accept="image/*"
                       value="<?php echo e(old('image')); ?>">
                <label class="custom-file-label" for="image"></label>
            </div>
        </div>
        <div class="form-group text-center mt-4 d-none">
            <img id="image_tablet_preview" src="#" alt="image_tablet" width="600">
        </div>
        <div class="form-group">
            <label for="image_tablet"><?php echo app('translator')->get('Tablet advertise picture'); ?></label>
            <div class="custom-file">
                <input name="image_tablet" type="file" class="custom-file-input" id="image_tablet" lang="km"
                       accept="image/*" value="<?php echo e(old('image_tablet')); ?>">
                <label class="custom-file-label" for="image_tablet"></label>
            </div>
        </div>
        <div class="form-group text-center mt-4 d-none">
            <img id="image_mobile_preview" src="#" alt="image_mobile" width="600">
        </div>
        <div class="form-group">
            <label for="image_mobile"><?php echo app('translator')->get('Mobile advertise picture'); ?></label>
            <div class="custom-file">
                <input name="image_mobile" type="file" class="custom-file-input" id="image_mobile" lang="km"
                       accept="image/*" value="<?php echo e(old('image_mobile')); ?>">
                <label class="custom-file-label" for="image_mobile"></label>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-8"></div>
            <div class="col-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-100">
                    <?php echo app('translator')->get('Save'); ?>
                </button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo JsValidator::formRequest('Vanguard\Http\Requests\Advertise\Advertise\CreateAdvertiseRequest','#advertise-form'); ?>


    <script>
        $("#image").change(function () {
            displayPreviewImage(this, "#image_preview");
        });
        $("#image_tablet").change(function () {
            displayPreviewImage(this, "#image_tablet_preview");
        });
        $("#image_mobile").change(function () {
            displayPreviewImage(this, "#image_mobile_preview");
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/advertise/advertise/create.blade.php ENDPATH**/ ?>
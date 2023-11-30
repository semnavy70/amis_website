<?php $__env->startSection('document-title', __('Edit document category')); ?>
<?php $__env->startSection('document-heading', __('Manage document')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('document-category.index')); ?>" class="text-muted">
            <?php echo app('translator')->get('Document category'); ?>
        </a>
    </li>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('Edit document category'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <form action="<?php echo e(route("document-category.update")); ?>" method="POST" id="document-category-form">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" value="<?php echo e($documentCategory->id); ?>">
        <div class="form-group">
            <label for="name"><?php echo app('translator')->get('Name*'); ?></label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old("name")??$documentCategory->name); ?>">
        </div>
        <div class="form-group">
            <label for="categorySlug"><?php echo app('translator')->get('Slug*'); ?></label>
            <input type="text" class="form-control" id="slug" name="slug" disabled
                   value="<?php echo e(old("slug")??$documentCategory->slug); ?>">
        </div>
        <div class="form-group">
            <label for="order"><?php echo app('translator')->get('Description'); ?></label>
            <textarea class="form-control" id="description" name="description" rows="4">
                <?php echo e(old("description")??$documentCategory->description); ?>

            </textarea>
        </div>
        <div class="form-group">
            <label for="order"><?php echo app('translator')->get('Order'); ?></label>
            <input type="number" class="form-control" id="order" name="order"
                   value="<?php echo e(old("order")??$documentCategory->order); ?>">
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
    <?php echo JsValidator::formRequest('Vanguard\Http\Requests\Document\DocumentCategory\UpdateDocumentCategoryRequest','#document-category-form'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/document/category/edit.blade.php ENDPATH**/ ?>
<?php if(isset($dataTypeContent->{$row->field})): ?>
    <?php if(json_decode($dataTypeContent->{$row->field})): ?>
        <?php $__currentLoopData = json_decode($dataTypeContent->{$row->field}); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <br/><a class="fileType" target="_blank" href="<?php echo e(Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: ''); ?>"> <?php echo e($file->original_name ?: ''); ?> </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <a class="fileType" target="_blank" href="<?php echo e(Storage::disk(config('voyager.storage.disk'))->url($dataTypeContent->{$row->field})); ?>"> Download </a>
    <?php endif; ?>
<?php endif; ?>
<input <?php if($row->required == 1 && !isset($dataTypeContent->{$row->field})): ?> required <?php endif; ?> type="file"  data-name="<?php echo e($row->display_name); ?>"  name="<?php echo e($row->field); ?>[]" multiple="multiple">

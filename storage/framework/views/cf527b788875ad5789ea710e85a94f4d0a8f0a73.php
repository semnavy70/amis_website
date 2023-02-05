<div class="alerts">
    <?php $__currentLoopData = $alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-<?php echo e($alert->type); ?> alert-name-<?php echo e($alert->name); ?>">
            <?php $__currentLoopData = $alert->components; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $component): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $component->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<<<<<<< HEAD
<?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/vendor/tcg/voyager/src/../resources/views/alerts.blade.php ENDPATH**/ ?>
=======
>>>>>>> 788376cdde7e4b98b71125068fe2bc61e5a26670

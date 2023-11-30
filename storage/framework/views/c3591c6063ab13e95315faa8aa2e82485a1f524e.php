<div class="card overflow-hidden">
    <h6 class="card-header d-flex align-items-center justify-content-between" onclick="gotoPage('<?php echo e(route('activity.index')); ?>')">
        <?php echo app('translator')->get('User Activity'); ?>

        <?php if(count($latestActive)): ?>
            <small class="float-right">
                <a href="<?php echo e(route('activity.index')); ?>" class="text-secondary"><?php echo app('translator')->get('View All'); ?></a>
            </small>
        <?php endif; ?>
    </h6>
    <div class="card-body p-0">
        <?php if(count($latestActive)): ?>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $latestActive; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item list-group-item-action px-4 py-3">
                        <a href="<?php echo e(route('activity.user',  $activity->user)); ?>" class="d-flex text-dark no-decoration">
                            <img class="rounded-circle" width="40" height="40"
                                 src="<?php echo e($activity->user->profile_cover); ?>">
                            <div class="ml-2" style="line-height: 1.2;">
                                <span class="d-block p-0"><?php echo e($activity->user->full_name); ?></span>
                                <small class="text-muted"><?php echo e($activity->description); ?> <span class="text-gray-500"><?php echo e(calculateMinutes($activity->created_at)); ?></span></small>
                            </div>
                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <p class="text-muted text-center"><?php echo app('translator')->get('No records found.'); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/plugins/dashboard/widgets/latest-active.blade.php ENDPATH**/ ?>
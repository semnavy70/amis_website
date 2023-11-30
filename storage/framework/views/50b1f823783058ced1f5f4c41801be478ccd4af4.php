<?php if($item && $item->authorize(auth()->user())): ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is($item->getActivePath()) ? 'active' : ''); ?>"
           href="<?php echo e($item->getHref()); ?>"
           <?php if($item->isDropdown()): ?>
           data-toggle="collapse"
           aria-expanded="<?php echo e(Request::is($item->getExpandedPath()) ? 'true' : 'false'); ?>"
            <?php endif; ?>
            target="<?php echo e($item->getTarget()); ?>"
        >
            <?php if($item->getIcon()): ?>
                <i class="<?php echo e($item->getIcon()); ?>"></i>
            <?php endif; ?>

            <span><?php echo e($item->getTitle()); ?></span>
        </a>

        <?php if($item->isDropdown()): ?>
            <ul class="<?php echo e(Request::is($item->getExpandedPath()) ? '' : 'collapse'); ?> list-unstyled sub-menu"
                id="<?php echo e(str_replace('#', '', $item->getHref())); ?>">
                <?php $__currentLoopData = $item->children(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('partials.sidebar.items', ['item' => $child], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </li>
<?php endif; ?>
<?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/partials/sidebar/items.blade.php ENDPATH**/ ?>
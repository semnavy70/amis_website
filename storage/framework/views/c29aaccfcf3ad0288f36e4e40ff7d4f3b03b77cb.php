<?php if(count($breadcrumbs)): ?>

    <ol class="breadcrumb hidden-xs">
        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
            <?php if($loop->first): ?>
                <li class="breadcrumb-item completed"><a href="<?php echo e($breadcrumb->url); ?>"><?php echo e($breadcrumb->title); ?></a></li>
            <?php elseif($loop->index  == 1): ?>
				<li class="breadcrumb-item active"><a href="<?php echo e($breadcrumb->url); ?>"><?php echo e($breadcrumb->title); ?></a></li>
            <?php else: ?>
                <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo e($breadcrumb->title); ?></a></li>
            <?php endif; ?>
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>

<?php endif; ?>

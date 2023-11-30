<?php if($pagination->lastPage() > 1): ?>
    <nav aria-label="Blog pagination">
        <ul class="pagination justify-content-end">
            <li class="page-item <?php echo e(($pagination->currentPage() == 1) ? ' disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e(getPaginateUrl($pagination->currentPage() - 1)); ?>"><?php echo app('translator')->get('Previous'); ?></a>
            </li>
            <?php
                $interval = isset($interval) ? abs(intval($interval)) : 3 ;
                $from = $pagination->currentPage() - $interval;
                if($from < 1){
                    $from = 1;
                }

                $to = $pagination->currentPage() + $interval;
                if($to > $pagination->lastPage()){
                    $to = $pagination->lastPage();
                }
                $ranges = range($from, $to);
            ?>
            <?php $__currentLoopData = $ranges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="page-item <?php echo e(($pagination->currentPage() == $i) ? ' active' : ''); ?>">
                    <a class="page-link" href="<?php echo e(getPaginateUrl($i)); ?>"><?php echo e($i); ?></a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <li class="page-item <?php echo e(($pagination->currentPage() == $pagination->lastPage()) ? ' disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e(getPaginateUrl($pagination->currentPage()+1)); ?>"><?php echo app('translator')->get('Next'); ?></a>
            </li>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/components/cb-pagination.blade.php ENDPATH**/ ?>
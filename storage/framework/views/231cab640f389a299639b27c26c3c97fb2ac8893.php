<div class="grid-container">
    <nav class="col-md-2 sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <?php $__currentLoopData = \Vanguard\Plugins\Vanguard::availablePlugins(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plugin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('partials.sidebar.items', ['item' => $plugin->sidebar()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </nav>
</div>

<?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/partials/sidebar/main.blade.php ENDPATH**/ ?>
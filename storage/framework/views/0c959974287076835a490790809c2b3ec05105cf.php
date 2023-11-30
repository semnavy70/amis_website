<div class="card widget" onclick="gotoPage('<?php echo e(route('post.index')); ?>')">
    <div class="card-body">
        <div class="row">
            <div class="p-3 text-info flex-1">
                <i class="far fa-newspaper fa-3x"></i>
            </div>

            <div class="pr-3">
                <h2 class="text-right"><?php echo e(number_format($count)); ?></h2>
                <div class="text-muted"><?php echo app('translator')->get('Post'); ?></div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/plugins/dashboard/widgets/total-posts.blade.php ENDPATH**/ ?>
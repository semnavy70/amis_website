<footer class="app-footer">
    <div class="site-footer-right">
        <?php if(rand(1,100) == 100): ?>
            <i class="voyager-rum-1"></i> <?php echo e(__('voyager.theme.footer_copyright2')); ?>

        <?php else: ?>
            <?php echo __('voyager.theme.footer_copyright'); ?> <a href="https://kravanh.com" target="_blank"><?php echo e(setting('admin.title')); ?></a>
        <?php endif; ?>
        <?php $version = Voyager::getVersion(); ?>
        <?php if(!empty($version)): ?>
            - <?php echo e($version); ?>

        <?php endif; ?>
    </div>
</footer>

<script>
    let posts = <?php echo json_encode(array_values($postsPerMonth), 15, 512) ?>;
    let months = <?php echo json_encode(array_keys($postsPerMonth), 15, 512) ?>;
    let trans = {
        chartLabel: "<?php echo e(__('Post History')); ?>",
        new: "<?php echo e(__('ថ្មី')); ?>",
        post: "<?php echo e(__('បង្ហោះ')); ?>",
        posts: "<?php echo e(__('បង្ហោះ')); ?>"
    };
</script>

<?php echo HTML::script('assets/js/chart.min.js'); ?>

<?php echo HTML::script('assets/js/as/dashboard-post.js'); ?>

<?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/plugins/dashboard/widgets/post-history-scripts.blade.php ENDPATH**/ ?>
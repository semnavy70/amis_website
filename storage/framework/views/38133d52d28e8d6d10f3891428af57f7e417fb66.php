<?php $__env->startSection('content'); ?>
	<div class="container text-center">
		<h2 class="text-danger"><?php echo e($exception->getMessage()); ?></h2>
		<h2 class="text-danger">404 Not Found</h2>
		<a href="http://cms.mptc.gov.kh/"><h1 class="text-danger">Return to Home</h1></a>
	</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
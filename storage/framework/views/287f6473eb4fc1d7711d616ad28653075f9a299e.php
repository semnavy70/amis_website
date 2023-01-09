

<?php $__env->startSection('site-title', $title); ?>
<?php $__env->startSection('content'); ?>
	
	<div class="inner-intro event-bg">
		<div class="container">
			<div class="title">
				<?php $category = $category->translate(App::getLocale()); ?>
				<h1><?php echo e($category->name); ?></h1>
			</div>
		</div>
	</div>
	<div class="container">
		<?php echo Breadcrumbs::render('topic', $category); ?>

		<section class="page-news">
			<div class="content-news inside">
				<div class="row">
					<?php $__currentLoopData = $list_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php $item = $item->translate(App::getLocale()); ?>
					<div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
						<div class="card">
							<div class="card-img position-relative">
							<?php if($item->image == ""): ?>
								<img class="card-img-top rounded-0" src="<?php echo e(url('assets/img/no-photo.png')); ?>" style="min-height: 233px;object-fit: cover;" class="img-fluid" alt="">
							<?php else: ?>
								<img class="card-img-top rounded-0" src="<?php echo e(gcpUrl($item->image)); ?>" style="min-height: 233px;object-fit: cover;" class="img-fluid" alt="">
                                <?php if($item->category_id==22 || $item->category_id==1): ?>
								<div class="video-icon">
								<i class="fab fa-youtube fa-3x shadow"><div class="bgicon" style="height: 20px;width: 20px;background-color: #fff;margin-top: -34px;margin-left: 17px;"></div></i></div>
                                <?php endif; ?>
							<?php endif; ?>
							</div>
							<div class="card-body">
								<h6><?php echo e($item->title); ?></h6>
								<div class="line"></div>
								<p class="meta" style="font-size: 13px; padding-top: 5px;">
										<span>
											<i class="fas fa-user"></i>
										</span>
									​ <?php echo e($item->author->name); ?>​​ | <?php echo e(daykhmer($item->created_at)); ?>

								</p>
								<p><?php echo e($item->excerpt); ?></p>

								<a href="<?php echo e(getLink($item)); ?>"><?php echo app('translator')->getFromJson('translator.read_more'); ?>
									<span>
										<i class="fas fa-angle-double-right"></i>
									</span>
								</a>
							</div>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				<div class="row">
					<div class="col-12">
						<?php echo e($list_news->links()); ?>

					</div>
				</div>
			</div>
		</section>
	</div>
	<?php echo e(Counter::count('')); ?>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('page-title', __('Advertise log')); ?>
<?php $__env->startSection('page-heading', __('Manage advertise')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('Advertise log'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="form hide-on-print">
        <form action="<?php echo e(route('advertise-log.index')); ?>" method="GET">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="advertise_id"><?php echo app('translator')->get('Advertise'); ?></label>
                        <select name="advertise_id" class="form-control" id="advertise_id">
                            <?php $__currentLoopData = $advertises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    <?php echo e($advertise->id == $adsId ? 'selected' : ''); ?> value="<?php echo e($advertise->id); ?>"><?php echo e($advertise->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="start_date"><?php echo app('translator')->get('From'); ?></label>
                        <input name="start_date" type="date" class="form-control" id="start_date"
                               value="<?php echo e($startDate); ?>">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="end_date"><?php echo app('translator')->get('To'); ?></label>
                        <input name="end_date" type="date" class="form-control" id="end_date" value="<?php echo e($endDate); ?>">
                    </div>
                </div>
                <div class="col-2 align-self-center mt-1 w-100">
                    <button type="submit" class="btn btn-primary">
                        <?php echo app('translator')->get('Search'); ?>
                    </button>
                </div>
                <?php if(count($list) > 0): ?>
                    <div class="col-3 d-flex justify-content-end align-self-center mt-1">
                        <div class="row">
                            <a onclick="print();" class="btn btn-primary"><i class="fas fa-print"></i>
                                <?php echo app('translator')->get('Print'); ?>
                            </a>
                            <a href="<?php echo e(route('advertise-log.export').'?advertise_id='.$adsId.'&start_date='.$startDate.'&end_date='.$endDate); ?>"
                               class="btn btn-primary ml-3">
                                <i class="fas fa-download"></i>
                                <?php echo app('translator')->get('Download'); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <table class="table table-hover advertise-log-table">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col"><?php echo app('translator')->get('Datetime'); ?></th>
            <th scope="col"><?php echo app('translator')->get('Total click'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($loop->iteration); ?></th>
                <td><?php echo e(dmYDate($item['date'])); ?></td>
                <td><?php echo e($item['count_advertise']); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="hide-on-print">
        <?php if (isset($component)) { $__componentOriginal78a437efc1c96d4182ea60f012cba0d960e1646c = $component; } ?>
<?php $component = $__env->getContainer()->make(Vanguard\View\Components\CbPagination::class, ['pagination' => $list]); ?>
<?php $component->withName('cb-pagination'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal78a437efc1c96d4182ea60f012cba0d960e1646c)): ?>
<?php $component = $__componentOriginal78a437efc1c96d4182ea60f012cba0d960e1646c; ?>
<?php unset($__componentOriginal78a437efc1c96d4182ea60f012cba0d960e1646c); ?>
<?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/advertise/log/index.blade.php ENDPATH**/ ?>
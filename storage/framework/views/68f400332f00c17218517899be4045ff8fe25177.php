<?php $__env->startSection('page-title', __('Advertise')); ?>
<?php $__env->startSection('page-heading', __('Manage advertise')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('Advertise'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-6">
            <form class="form-inline" action="<?php echo e(route('advertise.index')); ?>" method="GET">
                <input name="search" class="form-control mr-sm-2 w-75" type="search" placeholder="<?php echo app('translator')->get('Search'); ?>"
                       aria-label="Search" value="<?php echo e(request()->search); ?>">
                <button class="btn btn-primary my-2 my-sm-0" type="submit"><?php echo app('translator')->get('Search'); ?></button>
            </form>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a role="button" class="btn btn-primary" href="<?php echo e(route('advertise.create')); ?>">
                <i class="fas fa-plus mr-1"></i><?php echo app('translator')->get('Create new'); ?></a>
        </div>
    </div>
    <table class="table table-hover advertise-table">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col"><?php echo app('translator')->get('Name'); ?></th>
            <th scope="col"><?php echo app('translator')->get('Photo'); ?></th>
            <th scope="col"><?php echo app('translator')->get('Page'); ?></th>
            <th scope="col"><?php echo app('translator')->get('Blog'); ?></th>
            <th scope="col"><?php echo app('translator')->get('Order'); ?></th>
            <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
            <th scope="col"><?php echo app('translator')->get('Total click'); ?></th>
            <th scope="col"><?php echo app('translator')->get('Activity'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($loop->iteration); ?></th>
                <td><?php echo e($item->name); ?></td>
                <td><img src="<?php echo e(getFileCDN($item->image)); ?>" width="140" alt=""></td>
                <td><?php echo e($item->page_name); ?></td>
                <td><?php echo e($item->blog_name); ?></td>
                <td><?php echo e($item->order); ?></td>
                <td class="text-gray-500"><?php echo e($item->is_active ? 'បង្ហាញ' : 'មិនបង្ហាញ'); ?></td>
                <td><?php echo e($item->click_count); ?></td>
                <td>
                    <a href="<?php echo e(route('advertise.edit', ["id"=>$item->id])); ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="<?php echo e(route('advertise.delete', ["id"=>$item->id])); ?>"
                       class="btn btn-sm btn-danger ml-1"
                       title="<?php echo app('translator')->get('លុបទំព័រ'); ?>"
                       data-toggle="tooltip"
                       data-placement="top"
                       data-method="DELETE"
                       data-confirm-title="<?php echo app('translator')->get('ផ្ទៀងផ្ទាត់'); ?>"
                       data-confirm-text="<?php echo app('translator')->get('តើអ្នកពិតជាចង់លុបមែនទេ?'); ?>"
                       data-confirm-delete="<?php echo app('translator')->get('យល់ព្រម'); ?>"
                    >
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/advertise/advertise/index.blade.php ENDPATH**/ ?>
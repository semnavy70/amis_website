<?php $__env->startSection('page-title', __('Partner')); ?>
<?php $__env->startSection('page-heading', __('Manage Partner')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('Partner'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-6">
            <form class="form-inline" method="GET" action="<?php echo e(route("partner.index")); ?>">
                <input class="form-control mr-sm-2 w-75" type="search" placeholder="<?php echo app('translator')->get('Search'); ?>" aria-label="Search"
                       name="search" value="<?php echo e(request()->search); ?>">
                <button class="btn btn-primary my-2 my-sm-0" type="submit"><?php echo app('translator')->get('Search'); ?></button>
            </form>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a role="button" class="btn btn-primary" href="<?php echo e(route('partner.create')); ?>"><i
                    class="fas fa-plus mr-1"></i><?php echo app('translator')->get('Create new'); ?></a>
        </div>
    </div>
    <table class="table table-hover category-table">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col"><?php echo app('translator')->get('Name'); ?></th>
            <th scope="col"><?php echo app('translator')->get('Image'); ?></th>
            <th scope="col"><?php echo app('translator')->get('Order'); ?></th>
            <th scope="col"><?php echo app('translator')->get('Activity'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($loop->iteration); ?></th>
                <td><?php echo e($item->name); ?></td>
                <td>
                    <img src="<?php echo e(getFileCDN($item->image)); ?>" width="100">
                </td>
                <td><?php echo e($item->order??""); ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="<?php echo e(route("partner.edit",["id"=>$item->id])); ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="<?php echo e(route('partner.delete', ["id"=>$item->id])); ?>"
                       class="btn btn-sm btn-danger ml-1 <?php echo e($item->count_post > 0 ? 'disabled' : ''); ?>"
                       title="<?php echo app('translator')->get('លុប Slide'); ?>"
                       data-toggle="tooltip"
                       data-placement="top"
                       data-method="DELETE"
                       data-confirm-title="<?php echo app('translator')->get('ផ្ទៀងផ្ទាត់'); ?>"
                       data-confirm-text="<?php echo app('translator')->get('តើអ្នកពិតជាចង់លុបមែនទេ?'); ?>"
                       data-confirm-delete="<?php echo app('translator')->get('យល់ព្រម'); ?>">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php if (isset($component)) { $__componentOriginal78a437efc1c96d4182ea60f012cba0d960e1646c = $component; } ?>
<?php $component = $__env->getContainer()->make(Vanguard\View\Components\CbPagination::class, ['pagination' => $data]); ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/partner/index.blade.php ENDPATH**/ ?>
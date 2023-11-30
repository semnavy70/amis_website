<?php $__env->startSection('page-title', __('Pages')); ?>
<?php $__env->startSection('page-heading', __('Manage Pages')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('Pages'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-6">
            <form class="form-inline" action="<?php echo e(route('page.index')); ?>" method="GET">
                <input name="search" class="form-control mr-sm-2 w-75" type="search" placeholder="<?php echo app('translator')->get('Search'); ?>"
                       aria-label="Search" value="<?php echo e(request()->search); ?>">
                <button class="btn btn-primary my-2 my-sm-0" type="submit"><?php echo app('translator')->get('Search'); ?></button>
            </form>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a role="button" class="btn btn-primary ml-3" href="<?php echo e(route('page.create')); ?>"><i
                    class="fas fa-plus mr-1"></i><?php echo app('translator')->get('Create new'); ?></a>
            <a role="button" id="delete-many-btn" class="btn btn-danger ml-3 disabled"
               href="" data-toggle="tooltip" data-placement="top" data-method="DELETE"
               data-confirm-title="<?php echo app('translator')->get('ផ្ទៀងផ្ទាត់'); ?>" data-confirm-text="<?php echo app('translator')->get('តើអ្នកពិតជាចង់លុបបង្ហោះទាំងនេះមែនទេ?'); ?>"
               data-confirm-delete="<?php echo app('translator')->get('យល់ព្រម'); ?>">
                <i class="fas fa-trash mr-1"></i>
                <?php echo app('translator')->get('Delete'); ?>
            </a>
        </div>
    </div>
    <table class="table table-hover post-table">
        <thead class="thead-light">
        <tr>
            <th scope="col">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="check_all">
                    <label class="custom-control-label" for="check_all"></label>
                </div>
            </th>
            <th scope="col"><?php echo app('translator')->get('Title'); ?></th>


            <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
            <th scope="col"><?php echo app('translator')->get('Create'); ?></th>
            <th scope="col" class="text-center"><?php echo app('translator')->get('Activity'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input check-item"
                               id="check-item-<?php echo e($item->id); ?>" value="<?php echo e($item->id); ?>">
                        <label class="custom-control-label" for="check-item-<?php echo e($item->id); ?>"></label>
                    </div>
                </th>
                <td class="w-25"><?php echo e($item->title); ?></td>




                <td class="text-gray-500 justify-content-center"><?php echo e($item->status_name); ?></td>
                <td><?php echo e(dmYDate($item->created_at)); ?></td>
                <td class="text-center">
                    <div class="row">
                        <a href="<?php echo e(route('page.edit', ['id' => $item->id])); ?>" class="btn btn-sm btn-primary"
                           title="<?php echo app('translator')->get('កែទំព័រ'); ?>" data-toggle="tooltip"><i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-sm btn-danger ml-1"
                           title="<?php echo app('translator')->get('លុបទំព័រ'); ?>"
                           href="<?php echo e(route('page.delete', ['id' => $item->id])); ?>"
                           data-toggle="tooltip"
                           data-placement="top"
                           data-method="DELETE"
                           data-confirm-title="<?php echo app('translator')->get('ផ្ទៀងផ្ទាត់'); ?>"
                           data-confirm-text="<?php echo app('translator')->get('តើអ្នកពិតជាចង់លុបមែនទេ?'); ?>"
                           data-confirm-delete="<?php echo app('translator')->get('យល់ព្រម'); ?>"
                        >
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
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

<?php $__env->startSection('scripts'); ?>
    <script>
        let allCheck = $("#check_all");
        let checkItem = $("input.check-item");
        let deleteBtn = $("#delete-many-btn");

        allCheck.on("change", function() {
            const isChecked = $(this)[0]['checked'];
            checkItem.prop("checked", isChecked);
            itemOnChange();
        });

        checkItem.on("change", function() {
            itemOnChange();
        });

        function itemOnChange() {
            let checkedItem = $("input.check-item:checked");
            const isCheckAll = checkedItem.length === Number("<?php echo e(count($list)); ?>");
            allCheck.prop("checked", isCheckAll);

            let checkIds = [];
            checkedItem.map((e) => {
                checkIds[e] = Number(`${checkedItem[e].value}`);
            });

            deleteBtn.data("data-body", checkIds);
            checkDeleteBtn(checkIds);
        }

        function checkDeleteBtn(checkIds) {
            if (!checkIds || checkIds.length === 0) {
                deleteBtn.addClass('disabled');
            } else {
                deleteBtn.removeClass('disabled');
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/semnavy/Desktop/Data/Amis/SourceCode/amis_website/resources/views/page/page/index.blade.php ENDPATH**/ ?>
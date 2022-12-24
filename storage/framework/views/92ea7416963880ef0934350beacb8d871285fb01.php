<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>តារាង-មន្ដ្រីឥណទាន</strong></div>
            <div class="col">
                <a class="float-right btn btn-md btn-info" href="<?php echo e(route('master-data.staff.create')); ?>">
                     <strong>បញ្ចូលថ្មី</strong>
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="table">
                <thead>
                    <tr>
                        <th ></th>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">សភាព</th>
                        <th class="text-center text-nowrap">សាខា</th>
                        <th class="text-center text-nowrap">ឈ្មោះជាភាសាខ្មែរ</th>
                        <th class="text-center text-nowrap">ឈ្មោះជាឡាតាំង</th>
                        <th class="text-center text-nowrap">ភេទ</th>
                        <th class="text-center text-nowrap">ថ្ងៃខែឆ្នាំកំណើត</th>
                        <th class="text-center text-nowrap">លេខទំនាក់ទំនង</th>
                        <th class="text-center text-nowrap">ថ្ងៃខែឆ្នាំចូលបម្រើការងារ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                         <td class="text-center text-nowrap">
                            <a class="btn btn-sm btn-primary" href="<?php echo e(route('master-data.staff.edit',['id' => $staff->id])); ?>" type="button">
                                <span class="material-icons-outlined">edit</span>
                            </a>

                            <button class="btn btn-sm btn-danger btn-delete" data-id="<?php echo e($staff->id); ?>">
                                <span class="material-icons-outlined">delete_outline</span>
                            </button>
                        </td>
                        <td class="text-right text-nowrap"><?php echo e($loop->index + 1); ?></td>
                        <td class="text-center text-nowrap"><span class="<?php echo e($staff->_status->css); ?>"><?php echo e($staff->_status->name); ?></span></td>
                        <td class="text-left text-nowrap"><?php echo e($staff->branch->name??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($staff->name_kh??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($staff->name_en??''); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($staff->_sex->name??''); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($staff->date_of_birth??''); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($staff->phone_number??''); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($staff->start_work_date??''); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="text-center"><?php echo e($staffs->appends($_GET)->links()); ?></div>            
        </div>        
    </div>
</div><?php /**PATH /home2/kunpheap/public_html/resources/views/master-data/staffs/list.blade.php ENDPATH**/ ?>
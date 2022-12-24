<div class="card">
    <div class="card-header">
        <strong>មន្ដ្រីឥណទាន-ចំណេញសេវារដ្ឋបាល</strong>            
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">សាខា</th>
                        <th class="text-center text-nowrap">មន្ត្រីឥណទាន</th>
                        <th class="text-center text-nowrap">ប្រតិបត្តិការ</th>
                        <th class="text-center text-nowrap">ប្រាក់ដើម</th>
                        <th class="text-center text-nowrap">សេវារដ្ឋបាល</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalTransaction = 0;
                        $totalPrincipalAmount = 0;
                        $totalAdminAmount = 0;
                        $totalInterestAmount = 0;
                    ?>
                    
                    <?php
                        $i = 1;
                    ?>
                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $totalTransaction = $totalTransaction + $staff->transaction;
                        $totalPrincipalAmount = $totalPrincipalAmount + $staff->total_principal_amount;
                        $totalAdminAmount = $totalAdminAmount + $staff->total_admin_amount;
                    ?>
                    <tr> 
                        <td class="text-right text-nowrap"><?php echo e($i++); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($staff->branch->name??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($staff->name_kh??''); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($staff->transaction)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($staff->total_principal_amount)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($staff->total_admin_amount)); ?></td>                        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td colspan="3" class="text-right text-nowrap">សរុប</td>
                        <td class="text-right text-font-bold"><strong><?php echo e(number_format($totalTransaction)); ?></strong> </td>
                        <td class="text-right text-font-bold"><strong><?php echo e(number_format($totalPrincipalAmount)); ?></strong> </td>
                        <td class="text-right text-font-bold"><strong><?php echo e(number_format($totalAdminAmount)); ?></strong></td>
                    </tr>                    
                </tbody>
            </table>
        </div>          
    </div>
</div><?php /**PATH D:\OneDrive - Cyber Grow Solution Co., Ltd\Desktop\Loan\Source Code\resources\views/report-staffs/revenue-admin-fees/list.blade.php ENDPATH**/ ?>
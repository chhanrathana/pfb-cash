<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>ចំនូលសេវារដ្ឋបាលប្រចាំថ្ងៃ</strong></div>            
        </div>
    </div>
    <div class="card-body">        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">សាខា</th>
                        <th class="text-center text-nowrap">ថ្ងៃខ្ចី</th>
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
                    <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $totalTransaction = $totalTransaction + $loan->transaction;
                        $totalPrincipalAmount = $totalPrincipalAmount + $loan->total_principal_amount;
                        $totalAdminAmount = $totalAdminAmount + $loan->total_admin_amount;
                    ?>
                    <tr>           
                                  
                        <td class="text-right text-nowrap"><?php echo e($i++); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($loan->branch->name??''); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($loan->registration_date); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($loan->transaction)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($loan->total_principal_amount)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($loan->total_admin_amount)); ?></td>                        
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
</div><?php /**PATH /home2/kunpheap/public_html/resources/views/report-financials/revenue-admin-fees/list.blade.php ENDPATH**/ ?>
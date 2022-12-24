
<div class="card">
    <div class="card-header"><strong>តារាង-ចំនូលលម្អិតតាមថ្ងៃ</strong></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                     <tr>                        
                         <th class="text-center text-nowrap  align-middle" rowspan="2">ល.រ</th>
                         <th class="text-center text-nowrap align-middle" rowspan="2">សាខា</th>
                        <th class="text-center text-nowrap align-middle" rowspan="2">ថ្ងៃ</th>
                        <th class="text-center text-nowrap align-middle text-primary" colspan="4">ចំនូល</th>
                        <th class="text-center text-nowrap align-middle text-danger" rowspan="2">ចំណាយ</th>                        
                        <th class="text-center text-nowrap align-middle text-success" rowspan="2">ចំណេញ</th>                        
                    </tr>
                    <tr>                        
                        <th class="text-center text-nowrap text-primary">រដ្ឋបាល</th>                                                
                        <th class="text-center text-nowrap text-primary">ប្រាក់ការ</th>
                        <th class="text-center text-nowrap text-primary">ប្រាក់ប្រតិបត្តិការ</th>
                        <th class="text-center text-nowrap text-primary font-weight-bold">សរុប</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalAdminFeeAmount = 0;
                        $totalInterestAmount = 0;
                        $totalCommissionAmount = 0;
                        $totalRevenue = 0;
                        $totalExpense = 0;
                        $totalnetIncome = 0;
                    ?>
                    
                    <?php
                        $i = 1;
                    ?>
                    <?php $__currentLoopData = $revenues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $revenues): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $totalAdminFeeAmount = $totalAdminFeeAmount + $revenues->admin_fee_amount;
                        $totalInterestAmount = $totalInterestAmount + $revenues->interest_amount;
                        $totalCommissionAmount = $totalCommissionAmount + $revenues->commission_amount;
                        
                        $renvenue = ($revenues->admin_fee_amount + $revenues->interest_amount +  $revenues->commission_amount);

                        $totalRevenue = $totalRevenue + $renvenue;


                        $totalExpense = ($totalExpense + $revenues->expense_amount);
                        
                        $netIncome = ($renvenue - $revenues->expense_amount);
                        $totalnetIncome = $totalnetIncome + $netIncome;
                    ?>
                    <tr>           
                                  
                        <td class="text-right text-nowrap"><?php echo e($i++); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($revenues->branch->name??''); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($revenues->transaction_date); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($revenues->admin_fee_amount)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($revenues->interest_amount)); ?></td>                        
                        <td class="text-right text-nowrap"><?php echo e(number_format($revenues->commission_amount)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($renvenue)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($revenues->expense_amount)); ?></td>

                        <td class="text-right text-nowrap"><?php echo e(number_format($netIncome)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td colspan="3" class="text-right text-nowrap">សរុប</td>
                        <td class="text-right text-font-bold"><strong><?php echo e(number_format($totalAdminFeeAmount)); ?></strong> </td>
                        <td class="text-right text-font-bold"><strong><?php echo e(number_format($totalInterestAmount)); ?></strong> </td>
                        <td class="text-right text-font-bold"><strong><?php echo e(number_format($totalCommissionAmount)); ?></strong> </td>
                        <td class="text-right text-font-bold"><strong><?php echo e(number_format($totalRevenue)); ?></strong> </td>
                        <td class="text-right text-font-bold"><strong><?php echo e(number_format($totalExpense)); ?></strong> </td>
                        <td class="text-right text-font-bold"><strong><?php echo e(number_format($totalnetIncome)); ?></strong></td>
                    </tr>                    
                </tbody>
            </table>
        </div>
    </div> 
</div><?php /**PATH D:\OneDrive - Cyber Grow Solution Co., Ltd\Desktop\Loan\Source Code\resources\views/report-financials/revenue-dividends/list.blade.php ENDPATH**/ ?>
<div class="card">
    <div class="card-header"><strong>ចំនូលសង្ខេប <span class="text-primary"><?php echo e($branch->name??''); ?></span> </strong>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ចំនូលសរុប</label>
                <label class="col-sm-8 col-form-label font-weight-bold"><?php echo e(number_format($income->total_revenue)); ?></label>
            </div>

            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ចំណាយសរុប</label>
                <label class="col-sm-8 col-form-label font-weight-bold"><?php echo e(number_format($income->sum_total_expense)); ?></label>
            </div>
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ចំណេញសរុប </label>
                <label class="col-sm-8 col-form-label font-weight-bold text-success"><?php echo e(number_format($income->net_income)); ?></label>
            </div>
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">អត្រាបែងចែក (%)</label>
                <label class="col-sm-8 col-form-label font-weight-bold"> <?php echo e(number_format($rate,2)); ?> %</label>
            </div>          
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>                     
                    <tr>
                        <th class="text-center text-nowrap">ល.រ</th>                                                                        
                        <th class="text-center text-nowrap">ម្ចាស់ភាគហ៊ុន</th>                                                
                        <th class="text-center text-nowrap">ដើមទុនសរុប</th>                        
                        <th class="text-center text-nowrap">ភាគលាភ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                        
                        $totalIncentiveAmount = 0;
                        $totalDeposit = 0;
                        $i = 1;
                    ?>                    
                    
                    <?php $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php                        
                    
                        $totalDeposit = $totalDeposit + $deposit->deposit_amount;
                        $depositAmount = $deposit->deposit_amount;
                        $incentiveAmount = $depositAmount * ($rate/100);

                        $totalIncentiveAmount = $totalIncentiveAmount + $incentiveAmount;
                    ?>
                    <tr>
                        <td class="text-right text-nowrap"><?php echo e($i++); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($deposit->shareholder->name_kh); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($depositAmount)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($incentiveAmount )); ?></td>                        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-right" colspan="2"><strong>សរុប</strong></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($totalDeposit)); ?></td>                                
                        <td class="text-right  font-weight-bold" colspan="2"><?php echo e(number_format($totalIncentiveAmount)); ?></td>               
                    </tr>                   
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH D:\OneDrive - Cyber Grow Solution Co., Ltd\Desktop\Loan\Source Code\resources\views/report-financials/revenue-dividends/dividend-info.blade.php ENDPATH**/ ?>
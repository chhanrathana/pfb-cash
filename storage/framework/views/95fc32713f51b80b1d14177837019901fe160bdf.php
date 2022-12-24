<div class="card">
    <div class="card-header"><strong>មន្ដ្រីឥណទាន-ចំណេញ</strong></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead>
                <tr>
                    <th class="text-center text-nowrap">ល.រ</th>
                    <th class="text-center text-nowrap">សាខា</th>
                    <th class="text-center text-nowrap">មន្ត្រីឥណទាន</th>
                    
                    <th class="text-center text-nowrap">ប្រាក់ការសរុប</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $totalPrincipal = 0;
                        $totalRevenue = 0;
                        $i = 0;
                    ?>
                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php                            
                        // $totalPrincipal = $totalPrincipal + $principal;
                        $totalRevenue = $totalRevenue + $staff->total_revenue_amount;
                        
                    ?>
                    <tr>
                        <td class="text-right text-nowrap"><?php echo e(++$i); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($staff->branch->name??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($staff->name_kh??''); ?></td>

                        
                        <td class="text-right text-nowrap"><?php echo e(number_format($staff->total_revenue_amount??0)); ?></td>                
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                       
                <tr>
                    <td colspan="3" class="text-right">សរុប</td>
                    
                    <td class="text-right font-weight-bold"><?php echo e(number_format( $totalRevenue )); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div><?php /**PATH /home2/kunpheap/public_html/resources/views/report-staffs/revenue-interests/list.blade.php ENDPATH**/ ?>
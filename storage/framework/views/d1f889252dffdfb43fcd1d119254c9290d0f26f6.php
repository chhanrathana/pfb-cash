<div class="card">
    
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>តារាង-ចំណាយ</strong></div>           
        </div>
    </div>    
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">ប្រភេទចំណាយ</th>
                        <th class="text-center text-nowrap">ទឹកប្រាក់ចំណាយ</th>
                        <th class="text-center text-nowrap">ថ្ងៃចំណាយ</th>
                        <th class="text-center text-nowrap">ពណ៍នាចំណាយ</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalExpense = 0;
                    ?>
                    <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $totalExpense = $totalExpense + $expense->expense_amount;
                    ?>
                    <tr>                        
                        <td class="text-right"><?php echo e($loop->index + 1); ?></td>
                        <td><?php echo e($expense->type->name_kh??''); ?></td>            
                        <td class="text-right text-nowrap"><?php echo e(number_format($expense->expense_amount)); ?></td>
                        <td><?php echo e($expense->expense_datetime); ?></td>
                        <td><?php echo e($expense->description); ?></td>                        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-right text-nowrap" colspan="2" >សរុប</td>
                        <td class="text-center text-font-bold" colspan="3"><strong><?php echo e(number_format($totalExpense)); ?></strong> </td>                        
                    </tr>   
                </tbody>
            </table>
        </div>
    </div>
</div><?php /**PATH /home2/kunpheap/public_html/resources/views/report-financials/expenses/list.blade.php ENDPATH**/ ?>
<div class="card">
    
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>តារាង-ភាគហ៊ុន</strong></div>
            <div class="col">
                <a class="float-right btn btn-md btn-info" href="<?php echo e(route('master-data.deposit.create')); ?>">
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
                        <th class="text-center text-nowrap"></th>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">សាខា</th>
                        <th class="text-center text-nowrap">ម្ចាស់ភាគហ៊ុន</th>
                        <th class="text-center text-nowrap">ទឹកប្រាក់</th>
                        <th class="text-center text-nowrap">ថ្ងៃដាក់ប្រាក់</th>                                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalDeposit = 0;
                    ?>
                    <?php $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $totalDeposit = $totalDeposit + $deposit->deposit_amount;
                    ?>
                    <tr>
                        <td class="text-center text-nowrap">
                            <a class="btn btn-sm btn-primary" href="<?php echo e(route('master-data.deposit.edit',['id' => $deposit->id])); ?>" type="button">
                                <span class="material-icons-outlined">edit</span>
                            </a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="<?php echo e($deposit->id); ?>">
                                <span class="material-icons-outlined">delete_outline</span>
                            </button>
                        </td>
                        <td class="text-right text-nowrap"><?php echo e($loop->index + 1); ?></td>
                        <td class="text-nowrap"><?php echo e($deposit->branch->name??''); ?></td>
                        <td class="text-nowrap"><?php echo e($deposit->shareholder->name_kh??''); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($deposit->deposit_amount)); ?></td>
                        <td class="text-nowrap"><?php echo e($deposit->deposit_datetime); ?></td>                                      
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td class="text-right text-nowrap" colspan="3" >សរុប</td>
                        <td class="text-center text-font-bold" colspan="3"><strong><?php echo e(number_format($totalDeposit)); ?></strong> </td>                        
                    </tr>   
                </tbody>
            </table>
        </div>
    </div>
</div><?php /**PATH /home2/kunpheap/public_html/resources/views/master-data/deposits/list.blade.php ENDPATH**/ ?>
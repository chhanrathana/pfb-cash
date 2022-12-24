<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>តារាង-មន្ដ្រីឥណទាន</strong></div>
            <div class="col">
                <a
                href="<?php echo e(route('report-operation.loan-export',$_GET)); ?>"
                class="btn btn-sm btn-info float-right mb-2">
                <span class="material-icons-outlined">file_download</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">សភាព</th>
                        <th class="text-center text-nowrap">កូដអតិថិជន</th>
                        <th class="text-center text-nowrap">ឈ្មោះអតិថិជន</th>
                        <th class="text-center text-nowrap">ប្រភេទកម្ចី</th>
                        <th class="text-center text-nowrap">ថ្ងៃខ្ចី</th>
                        <th class="text-center text-nowrap">ចំនួនកម្ចី</th>
                        <th class="text-center text-nowrap">ប្រាក់ដើមនៅសល់</th>
                        <th class="text-center text-nowrap">ការបរិច្ឆេទបង់ផ្តាច់</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-right text-nowrap"><?php echo e($loans->firstItem() + $key); ?></td>
                        <td class="text-center text-nowrap"><span class="<?php echo e($loan->_status->css); ?>"><?php echo e($loan->_status->name); ?></span></td>
                        <td class="text-left text-nowrap"><?php echo e($loan->client->code??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($loan->client->name_kh??''); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($loan->interest->name??''); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($loan->registration_date??''); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($loan->principal_amount)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($loan->pending_amount)); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($loan->last_payment_date??''); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="text-center"><?php echo e($loans->appends($_GET)->links()); ?></div>
        </div>        
    </div>
</div><?php /**PATH /home2/kunpheap/public_html/resources/views/report-operations/loans/list.blade.php ENDPATH**/ ?>
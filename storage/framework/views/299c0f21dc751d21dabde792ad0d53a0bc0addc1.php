<div class="card">
    <div class="card-header"><strong>តារាងកម្ចី</strong></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-nowrap"></th>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">សភាព</th>
                        <th class="text-center text-nowrap">សាខា</th>
                        <th class="text-center text-nowrap">កូដអតិថិជន</th>
                        <th class="text-center text-nowrap">កូដកិច្ចសន្យា</th>
                        <th class="text-center text-nowrap">ឈ្មោះអតិថិជន</th>
                        <th class="text-center text-nowrap">មន្រ្តីឥណទាន</th>
                        <th class="text-center text-nowrap">ប្រភេទកម្ចី</th>
                        <th class="text-center text-nowrap">រយះពេល</th>
                        <th class="text-center text-nowrap">ចំនួនប្រាក់កម្ចី</th>
                        <th class="text-center text-nowrap">ថ្ងៃខ្ចី</th>
                        <th class="text-center text-nowrap">ប្រាក់រដ្ឋបាល</th>
                        <th class="text-center text-nowrap">ប្រាក់ការ</th>
                        <th class="text-center text-nowrap">ប្រាក់សេវា</th>
                        <th class="text-center text-nowrap">ប្រាក់ដើមនៅសល់</th>
                        <th class="text-center text-nowrap">ថ្ងៃត្រូវបង់ផ្តាច់</th>
                    </tr>
                </thead>
                <tbody>

                <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center text-nowrap">
                            <a href="<?php echo e(route('loan.export',['id' => $loan->id])); ?>"
                                class="btn btn-sm btn-info">
                                <span class="material-icons-outlined">file_download</span>
                            </a>
                            <a class="btn btn-sm btn-warning" target="_blank" href="<?php echo e(route('loan.download',['id' => $loan->id ])); ?>">
                                <span class="material-icons-outlined">print</span>
                            </a>

                            <a class="btn btn-sm btn-success" href="<?php echo e(route('loan.list.show',['id' => $loan->id ])); ?>">
                                <span class="material-icons-outlined">visibility</span>
                            </a>

                            <a class="btn btn-sm btn-primary <?php echo e($loan->status <> 'pending'?'disabled':''); ?>"
                                href="<?php echo e($loan->editUrl()); ?>" type="button">
                                <span class="material-icons-outlined">edit</span>
                            </a>

                            <button <?php echo e($loan->status <> 'pending'?'disabled':''); ?> class="btn btn-sm btn-danger btn-delete" data-id="<?php echo e($loan->id); ?>">
                                <span class="material-icons-outlined">delete_outline</span>
                            </button>
                        </td>
                        <td class="text-right text-nowrap"><?php echo e($loop->index + 1); ?></td>
                        <td class="text-center text-nowrap"><span class="<?php echo e($loan->_status->css); ?>"><?php echo e($loan->_status->name); ?></span></td>
                        <td class="text-left text-nowrap"><?php echo e($loan->branch->name??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($loan->client->code??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($loan->code??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($loan->client->name_kh??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($loan->staff->name_kh??''); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($loan->interest->name??''); ?></td>
                        <td class="text-right text-nowrap"><?php echo e($loan->term??''); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($loan->principal_amount)); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($loan->registration_date??''); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($loan->admin_rate,2)); ?> %</td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($loan->rate,2)); ?> %</td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($loan->commission_rate,2)); ?> %</td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($loan->pending_amount)); ?></td>
                        <td class="text-center text-nowrap"><?php echo e($loan->last_payment_date??''); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="text-center"><?php echo e($loans->appends($_GET)->links()); ?></div>
        </div>
    </div>
</div>
<?php /**PATH E:\Project\SDT\PFB CASH\Source Code\resources\views/loans/list.blade.php ENDPATH**/ ?>

<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/style.css" rel="stylesheet">
    <table class="table table-bordered table-striped table-hover" id ="table">
        <thead>
            <tr>
                <th class="text-center text-nowrap">ល.រ</th>
                <th class="text-center text-nowrap">សភាព</th>
                <th class="text-center text-nowrap">ថ្ងៃត្រូវបង់</th>
                <th class="text-center text-nowrap">កូដអតិថិជន</th>
                <th class="text-center text-nowrap">កូដកិច្ចសន្យា</th>
                <th class="text-center text-nowrap">ឈ្មោះអតិថិជន</th>
                <th class="text-center text-nowrap">ទំនាក់ទំនង</th>
                <th class="text-center text-nowrap">យឺត</th>
                <th class="text-center text-nowrap">ភាគរយ</th>
                <th class="text-center text-nowrap">ប្រាក់ដើមនៅសល់</th>
                <th class="text-center text-nowrap">ប្រាក់ត្រូវបង់សរុប</th>
                <th class="text-center text-nowrap">ប្រាក់បានបង់សរុប</th>
                <th class="text-center text-nowrap">ប្រាក់មិនទាន់បង់សរុប</th>
                <th class="text-center text-nowrap">អាសយដ្ឋាន</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $totalPending = 0;
                $totalAmount = 0;
                $totalPaidAmount = 0;
                $totalUnPaidAmount = 0;
                $i = 1;
            ?>
            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($payment->status <> 'late'): ?>
                    <?php
                        $totalPending = $totalPending + $payment->loan->pending_amount??0;
                        $totalAmount = $totalAmount + $payment->total_amount;
                        $totalPaidAmount = $totalPaidAmount + $payment->total_paid_amount;
                        $unPaidAmount = $payment->total_amount - $payment->total_paid_amount;
                        $totalUnPaidAmount = $totalUnPaidAmount + $unPaidAmount;
                    ?>
                    <tr>
                        <td class="text-right text-nowrap"><?php echo e($i++); ?></td>
                        <td class="text-center text-nowrap"><span class="<?php echo e($payment->_status->css??''); ?>"><?php echo e($payment->_status->name??''); ?></span></td>
                        <td class="text-center text-nowrap"><?php echo e($payment->payment_date??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($payment->loan->client->code??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($payment->loan->code??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($payment->loan->client->name_kh??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($payment->loan->client->phone_number??''); ?></td>
                        <td><?php echo e($payment->countLateDay()); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format(($payment->loan->pending_amount??0/($payment->loan->principal_amount??0)) * 100)); ?>%</td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($payment->loan->pending_amount??0)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($payment->total_amount??0)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($payment->total_paid_amount??0)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($unPaidAmount)); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($payment->loan->client->address??''); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-right" colspan="9">សរុប</td>
                <td class="text-right text-nowrap"><?php echo e(number_format($totalPending)); ?></td>
                <td class="text-right text-nowrap"><?php echo e(number_format($totalAmount)); ?></td>
                <td class="text-right text-nowrap"><?php echo e(number_format($totalPaidAmount)); ?></td>
                <td class="text-right text-nowrap"><?php echo e(number_format($totalUnPaidAmount)); ?></td>
                <td></td>
            </tr>
            <tr>
                <td class="text-left" colspan="12">យឺត</td>
            </tr>
            <?php
                $totalLatePending = 0;
                $totalLateAmount = 0;
                $totalLatePaidAmount = 0;
                $totalLateUnPaidAmount = 0;
                $i = 1;
            ?>
            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($payment->status == 'late'): ?>
                    <?php
                        $totalLatePending = $totalLatePending + $payment->loan->pending_amount;
                        $totalLateAmount = $totalLateAmount + $payment->total_amount;
                        $totalLatePaidAmount = $totalLatePaidAmount + $payment->total_paid_amount;
                        $unPaidLateAmount = $payment->total_amount - $payment->total_paid_amount;
                        $totalLateUnPaidAmount = $totalLateUnPaidAmount + $unPaidLateAmount;
                    ?>
                    <tr>
                        <td class="text-right text-nowrap"><?php echo e($i++); ?></td>
                        <td class="text-center text-nowrap"><span class="<?php echo e($payment->_status->css??''); ?>"><?php echo e($payment->_status->name??''); ?></span></td>
                        <td class="text-center text-nowrap"><?php echo e($payment->payment_date??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($payment->loan->client->code??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($payment->loan->code??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($payment->loan->client->name_kh??''); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($payment->loan->client->phone_number??''); ?></td>
                        <td><?php echo e($payment->countLateDay()); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format(($payment->loan->pending_amount??0/($payment->loan->principal_amount??0)) * 100)); ?>%</td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($payment->loan->pending_amount??0)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($payment->total_amount??0)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($payment->total_paid_amount??0)); ?></td>
                        <td class="text-right text-nowrap"><?php echo e(number_format($unPaidLateAmount)); ?></td>
                        <td class="text-left text-nowrap"><?php echo e($payment->loan->client->address??''); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-right" colspan="9">សរុបយឺត</td>
                <td class="text-right text-nowrap"><?php echo e(number_format($totalLatePending)); ?></td>
                <td class="text-right text-nowrap"><?php echo e(number_format($totalLateAmount)); ?></td>
                <td class="text-right text-nowrap"><?php echo e(number_format($totalLatePaidAmount)); ?></td>
                <td class="text-right text-nowrap"><?php echo e(number_format($totalLateUnPaidAmount)); ?></td>
                <td></td>
            </tr>

        </tbody>
    </table>
</html>
<?php /**PATH /home2/kunpheap/public_html/resources/views/exports/payments/index.blade.php ENDPATH**/ ?>
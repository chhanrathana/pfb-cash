
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/style.css" rel="stylesheet">
    <table class="table table-bordered table-striped table-hover" id ="table">
        <thead>
            <tr>
                <th>ល.រ</th>
                <th>សភាព</th>
                <th>កូដអតិថិជន</th>
                <th>ឈ្មោះអតិថិជន</th>
                <th>លេខទូរសព្ទ</th>
                <th>ប្រភេទកម្ចី</th>
                <th>ការប្រាក់</th>
                <th>សេវា</th>
                <th>រដ្ឋបាល</th>
                <th>ថ្ងៃខ្ចី</th>
                <th>ចំនួនកម្ចី</th>
                <th>ប្រាក់ដើមនៅសល់</th>
                <th>ប្រាក់ដើមក្នុងដៃអតិថិជន</th>
                <th>ប្រាក់ដើមយឺត</th>
                <th>ប្រាក់ដើមនៅសល់</th>
                <th>ការបរិច្ឆេទបង់ផ្តាច់</th>បង់លើកទី
                <th>អាសយដ្ឋាន</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $totalPrincipleAmount = 0;
                $totalPendingAmount = 0;
                $totalLateAmount = 0;
                $totalInhandAmount = 0;
                $totalPendingAmount = 0;

            ?>
            <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $totalPrincipleAmount = $totalPrincipleAmount + $loan->principal_amount;
                $totalPendingAmount = $totalPendingAmount + $loan->pending_amount;
                $totalLateAmount = $totalLateAmount+ $loan->sum_late_deduction;
                $inhandAmount = ($loan->pending_amount >= $loan->sum_late_deduction)? ($loan->pending_amount - $loan->sum_late_deduction):0;
                $totalInhandAmount = $totalInhandAmount + $inhandAmount;
            ?>
            <tr>
                <td><?php echo e($loop->index+1); ?></td>
                <td><?php echo e($loan->_status->name); ?></td>
                <td><?php echo e($loan->client->code??''); ?></td>
                <td><?php echo e($loan->client->name_kh??''); ?></td>
                <td><?php echo e($loan->client->phone_number??''); ?></td>
                <td><?php echo e($loan->interest->name??''); ?></td>
                <td><?php echo e(number_format($loan->rate)); ?> %</td>
                <td><?php echo e(number_format($loan->commission_rate)); ?> %</td>
                <td><?php echo e(number_format($loan->admin_rate)); ?> %</td>
                <td><?php echo e($loan->registration_date??''); ?></td>
                <td><?php echo e(number_format($loan->principal_amount)); ?></td>
                <td><?php echo e(number_format($loan->pending_amount)); ?></td>
                <td><?php echo e(number_format($inhandAmount)); ?></td>
                <td><?php echo e(number_format($loan->sum_late_deduction)); ?></td>

                <td><?php echo e($loan->last_payment_date??''); ?></td>
                <td><?php echo e($loan->client->address??''); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="10"></td>
                <td><?php echo e(number_format($totalPrincipleAmount)); ?></td>
                <td><?php echo e(number_format($totalPendingAmount)); ?></td>
                <td><?php echo e(number_format($totalInhandAmount)); ?></td>
                <td><?php echo e(number_format($totalLateAmount)); ?></td>
            </tr>
        </tbody>
    </table>
</html>
<?php /**PATH /home2/kunpheap/public_html/resources/views/exports/staffs/client.blade.php ENDPATH**/ ?>
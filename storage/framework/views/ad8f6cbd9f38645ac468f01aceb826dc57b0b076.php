
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/style.css" rel="stylesheet">
    <table>
        <thead>
            <tr>
                <th class="text-center text-nowrap">បង់លើកទី</th>
                <th class="text-center text-nowrap">សភាព</th>
                <th class="text-center text-nowrap">ថ្ងៃបង់ប្រាក់</th>
                <th class="text-center text-nowrap">ប្រាក់ដើម</th>
                <th class="text-center text-nowrap">ការប្រាក់</th>
                <th class="text-center text-nowrap">សេវាប្រតិបត្តិការ</th>
                <th class="text-center text-nowrap">ប្រាក់ត្រូវបង់សរុប</th>
                <th class="text-center text-nowrap">ប្រាក់ដើមនៅសល់</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $loan->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-right text-nowrap"><?php echo e($payment->sort); ?></td>
                <td class="text-center text-nowrap"><span class="<?php echo e($payment->_status->css); ?>"><?php echo e($payment->_status->name); ?></span></td>
                <td><?php echo e(convertDaytoKhmer(date('D',strtotime($payment->getRawOriginal('payment_date')))).' '.$payment->payment_date); ?></td>
                <td class="text-right text-nowrap"><?php echo e(number_format($payment->deduct_amount)); ?></td>
                <td class="text-right text-nowrap"><?php echo e(number_format($payment->interest_amount)); ?> </td>
                <td class="text-right text-nowrap"><?php echo e(number_format($payment->commission_amount)); ?> </td>
                <td class="text-right text-nowrap"><?php echo e(number_format($payment->total_amount)); ?> </td>
                <td class="text-right text-nowrap"><?php echo e(number_format($payment->pending_amount)); ?> </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</html>
<?php /**PATH D:\OneDrive - Cyber Grow Solution Co., Ltd\Desktop\Loan\Source Code\resources\views/exports/loans/show.blade.php ENDPATH**/ ?>
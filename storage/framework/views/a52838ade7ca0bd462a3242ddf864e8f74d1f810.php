
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/style.css" rel="stylesheet">
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>ល.រ</th>
            <th>សភាព</th>
            <th>កូដអតិថិជន</th>
            <th>ឈ្មោះអតិថិជន</th>
            <th>ប្រភេទកម្ចី</th>
            <th>ថ្ងៃខ្ចី</th>
            <th>ចំនួនកម្ចី</th>
            <th>ប្រាក់ដើមនៅសល់</th>
            <th>ការបរិច្ឆេទបង់ផ្តាច់</th>
        </tr>
    </thead>
    <tbody>
         <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loop->index+1); ?></td>
            <td><span class="<?php echo e($loan->_status->css); ?>"><?php echo e($loan->_status->name); ?></span></td>
            <td><?php echo e($loan->client->code??''); ?></td>
            <td><?php echo e($loan->client->name_kh??''); ?></td>
            <td><?php echo e($loan->interest->name??''); ?></td>
            <td><?php echo e($loan->registration_date??''); ?></td>
            <td><?php echo e(number_format($loan->principal_amount)); ?></td>
            <td><?php echo e(number_format($loan->pending_amount)); ?></td>
            <td><?php echo e($loan->last_payment_date??''); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</html>
<?php /**PATH /home2/kunpheap/public_html/resources/views/exports/operation-reports/loans/index.blade.php ENDPATH**/ ?>
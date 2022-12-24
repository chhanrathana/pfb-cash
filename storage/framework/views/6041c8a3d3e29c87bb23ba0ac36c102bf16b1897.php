
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/style.css" rel="stylesheet">
    <table>
        <thead>
            <tr>
                <th>ល.រ</th>                
                <th>កូដអតិថិជន</th>
                <th>កូដកិច្ចសន្យា</th>
                <th>ឈ្មោះអតិថិជន</th>
                <th>ថ្ងៃត្រូវបង់</th>                
                <th>ថ្ងៃបានបង់</th>
                <th>ប្រាក់បានបង់</th>
                <th>កាត់ប្រាក់ដើម</th>
                <th>ការប្រាក់</th>
                <th>សេវាប្រតិបត្តិការ</th>
                <th>សរុបការប្រាក់</th>                                
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                $totalRevneueAmount = 0;
            ?>
            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $totalRevneueAmount = $totalRevneueAmount + $payment->revenue_amount;
                ?>
                <tr>
                    <td><?php echo e($i++); ?></td>
                    <td><?php echo e($payment->payment->loan->client->code??''); ?></td>
                    <td><?php echo e($payment->payment->loan->code??''); ?></td>
                    <td><?php echo e($payment->payment->loan->client->name_kh??''); ?></td>
                    <td><?php echo e($payment->payment->payment_date??''); ?></td>   
                    <td><?php echo e($payment->transaction_datetime??''); ?></td>   
                    <td><?php echo e(number_format($payment->transaction_amount??0,2)); ?></td>              
                    <td><?php echo e(number_format($payment->deduct_amount??0,2)); ?></td>
                    <td><?php echo e(number_format($payment->interest_amount??0,2)); ?></td>
                    <td><?php echo e(number_format($payment->commission_amount??0,2)); ?></td>
                    <td><?php echo e(number_format($payment->revenue_amount??0,2)); ?></td>                                                            
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            <tr>     
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo e(number_format($totalRevneueAmount??0,2)); ?></td>
            </tr>    
        </tbody>
    </table>
</html>
<?php /**PATH /home2/kunpheap/public_html/resources/views/exports/financial-reports/revenue-interests/index.blade.php ENDPATH**/ ?>
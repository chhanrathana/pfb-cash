
<?php $__env->startSection('html'); ?>
    <h2 class="text-center heading-title-center">
         តារាងកាលវិភាគសងប្រាក់សងប្រាក់
    </h2>
    <div class="row">
        <table style="width: 100%; font-size:10px; margin-top:20px" class="table-non-border td-border-non line-height-2">
            <tr>
                <td>កូដអតិថិជន</td>
                <td><?php echo e($loan->client->code); ?></td>
                <td>ភ្នាក់ងារ</td>
                <td> <?php echo e($loan->staff->name_kh??''); ?> </td>
            </tr>
            <tr>
                <td>កូដសាខា</td>
                <td><?php echo e($loan->branch->code??''); ?></td>
                <td>ឈ្មោះសាខា</td>
                <td> <?php echo e($loan->branch->name??''); ?></td>
            </tr>
            <tr>
                <td>លេខកូដកិច្ចសន្យា</td>
                <td><?php echo e($loan->code); ?></td>

                <td>លេខទំនាក់ទំនងភ្នាក់ងារ</td>
                <td><?php echo e($loan->staff->phone_number??''); ?> </td>
            </tr>
            <tr>
                <td >ឈ្មោះអតិថិជន(មេក្រុម)</td>
                <td><?php echo e($loan->client->name_kh); ?></td>

                <td>ប្រភេទកម្ចី</td>
                <td><?php echo e($loan->interest->name??''); ?> (<?php echo e($loan -> type -> name_kh); ?>)</td>
            </tr>
            <tr>
                <td>អាស័យដ្ឋាន</td>
                <td><?php echo e($loan->client->address); ?></td>

                <td>ចំនួនកាលវិភាគ</td>
                <td><?php echo e(count($loan->payments)); ?> </td>
            </tr>
            <tr>
                <td>លេខទំនាក់ទំនង</td>
                <td><?php echo e($loan->client->phone_number); ?></td>

                <td>ចំនួនទឹកប្រាក់</td>
                <td><?php echo e(number_format($loan->principal_amount)); ?></td>
            </tr>
            <tr>
                <td>ជំហាន</td>
                <td><?php echo e($loan->client->loans->count()); ?></td>
                <td>រូបិយប័ណ្ណ</td>
                <td>រៀល </td>
            </tr>
            <tr>
                <td>ថ្ងៃសងដំបូង</td>
                <td><?php echo e($loan->started_payment_date); ?></td>

                <td>ថ្ងៃផុតកំណត់</td>
                <td><?php echo e($loan->last_payment_date); ?> </td>
            </tr>
        </table>
    </div>

    <div class="text-right">
        <small class="print-date"><i>printed at <?php echo e(\Carbon\Carbon::now()); ?></i></small>
    </div>
    <div class="report" id="report">

        <table class="th-color">
            <tr>
                <th style="width: 5%; font-size: smaller; padding: 4px;">ល.រ</th>
                <th colspan="2" style="width: 15%; font-size: smaller; padding: 4px;">កាលបរិច្ឆេទសងប្រាក់</th>
                <th style="width: 10%; font-size: smaller; padding: 4px;"><?php echo e($loan -> client -> name_kh ?? '- - -'); ?></th>
                <?php $__currentLoopData = $loan -> members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th style="width: 10%; font-size: smaller; padding: 4px;"><?php echo e($member -> name_kh ?? '- - -'); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <th style="width: 10%; font-size: smaller; padding: 4px;">សម្គាល់ផ្សេងៗ</th>
            </tr>

            <?php $__currentLoopData = $loan->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="font-size: smaller; padding: 4px" class="text-center text-nowrap"><?php echo e($loop->index + 1); ?></td>
                    <td style="font-size: smaller; padding: 4px" class="text-center" ><?php echo e($payment->payment_date??''); ?> </td>
                    <td style="font-size: smaller; padding: 4px" class="text-center" nowrap="nowrap"><?php echo e(convertDaytoKhmer(date('D',strtotime($payment->getRawOriginal('payment_date'))))); ?></td>
                    <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap"><?php echo e(number_format($payment->total_amount/($loan -> totalMembers()))); ?></td>
                    <?php for($i=1; $i<5; $i++): ?>
                        <?php if($i > count($loan -> validMembers())): ?>
                            <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap">0</td>
                        <?php else: ?>
                            <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap"><?php echo e(number_format($payment->total_amount/4)); ?></td>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap"></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        <p style="  text-indent: 30px; font-size:12px">ក្រោយពីបានពិនិត្យកិច្ចសន្យានិងតារាងបង់ប្រាក់ខាងលើ ខ្ញុំបាទ/នាងខ្ញុំបានយល់ព្រមបង់សងប្រាក់បងស្ថាប័នវិញទាំងប្រាក់ដើមនិងការប្រាក់ទៅតាមតារាងបង់ប្រាក់តាមការកំណត់ខាងលើជាកំហិត។</p>
    </div>
    <table style="width: 100%; font-size:10px" class="table-non-border td-border-non line-height-2">
        <tr>
            <td>ហត្ថលេខាបុគ្គលិក</td>
            <td>ស្នាមមេដៃអ្នករួមធានា</td>
            <td>ស្នាមមេដៃអ្នកធានា</td>
            <td>ស្នាមមេដៃអ្នករួមខ្ចី</td>
            <td>ស្នាមមេដៃអ្នកខ្ចី</td>
        </tr>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pdf-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\SDT\PFB CASH\Source Code\resources\views/loans/print-loan-group.blade.php ENDPATH**/ ?>
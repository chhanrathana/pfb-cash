
<?php $__env->startSection('html'); ?>
    <h2 class="text-center heading-title-center">
         តារាងកាលវិភាគសងប្រាក់សងប្រាក់
    </h2>
    <div class="row">
        <table style="width: 100%; font-size:10px" class="table-non-border td-border-non line-height-2">
            <tr>
                <td>ឈ្មោះភ្នាក់ងារ</td>
                <td colspan="3"><?php echo e($loan->client->code); ?></td>
                <td>លេខទូរស័ព្ទភ្នាក់ងារ</td>
                <td> <?php echo e($loan->staff->name_kh??''); ?> </td>
            </tr>
            <tr>
                <td>ឈ្មោះអតិថិជន</td>
                <td><?php echo e($loan->branch->code??''); ?></td>
                <td>អ្នករួមកម្ចី</td>
                <td>..........</td>
                <td>លេខទូរស័ព្ទ</td>
                <td> <?php echo e($loan->branch->name??''); ?></td>
            </tr>
            <tr>
                <td>លេខកូដកម្ចី</td>
                <td><?php echo e($loan->code); ?></td>
                <td>ប្រភេទសងប្រាក់</td>
                <td><?php echo e($loan->code); ?></td>

                <td>អាសយដ្ឋាន</td>
                <td><?php echo e($loan->staff->phone_number??''); ?> </td>
            </tr>
        </table>
        <hr>
        <table style="width: 100%; font-size:10px" class="table-non-border td-border-non line-height-2">
            <tr>
                <td >ចំនួនទឹកប្រាក់ខ្ចី</td>
                <td><?php echo e($loan->client->name_kh); ?></td>
                <td >ទឹកប្រាក់ជាអក្សរ</td>
                <td><?php echo e($loan->client->name_kh); ?></td>
                <td >សេវារដ្ឋបាល</td>
                <td><?php echo e($loan->client->name_kh); ?></td>
            </tr>
            <tr>
                <td >រយះពេលខ្ចី</td>
                <td><?php echo e($loan->client->name_kh); ?></td>
                <td >កាលបរិច្ឆេទខ្ចី</td>
                <td><?php echo e($loan->client->name_kh); ?></td>
                <td >កាលបរិច្ឆេទសងលើកដំបូង</td>
                <td><?php echo e($loan->client->name_kh); ?></td>
            </tr>
        </table>
    </div>

    <div class="text-right">
        <small class="print-date"><i>printed at <?php echo e(\Carbon\Carbon::now()); ?></i></small>
    </div>
    <div class="report" id="report">

        <table class="th-color">
            <tr>
                <th style="width: 10%; font-size: smaller; padding: 4px;">ល.រ</th>
                <th colspan="2" style="width: 30%; font-size: smaller; padding: 4px;">កាលបរិច្ឆេទសងប្រាក់</th>
                <th style="width: 30%; font-size: smaller; padding: 4px;">ចំនួនទឹកប្រាក់សងមួយលើកៗ</th>
                <th style="width: 220px; font-size: smaller; padding: 4px;">សម្គាល់ផ្សេងៗ</th>
            </tr>

            <?php $__currentLoopData = $loan->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="font-size: smaller; padding: 4px" class="text-center text-nowrap"><?php echo e($loop->index + 1); ?></td>
                    <td style="font-size: smaller; padding: 4px" class="text-center" ><?php echo e($payment->payment_date??''); ?> </td>
                    <td style="font-size: smaller; padding: 4px" class="text-center" nowrap="nowrap"><?php echo e(convertDaytoKhmer(date('D',strtotime($payment->getRawOriginal('payment_date'))))); ?></td>
                    <td style="font-size: smaller; padding: 4px" class="text-right text-nowrap"></td>
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

<?php echo $__env->make('layouts.pdf-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\SDT\PFB CASH\Source Code\resources\views/loans/print-loan-individual.blade.php ENDPATH**/ ?>
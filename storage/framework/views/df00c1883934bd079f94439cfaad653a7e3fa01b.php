<?php $__env->startSection('html'); ?>
    <div class="text-center heading-title-center khmer-moul">
         កាលវិភាគសងប្រាក់
    </div>
    <br>
    <br>
    
    <div class="row">
        <table style="width: 100%; font-size:12px" class="table-non-border td-border-non line-height-2">
            <tr>
                <td>កូដអតិថិជន</td>
                <td><?php echo e($loan->client->code); ?></td>
                <td>ភ្នាក់ងារ</td>
                <td> <?php echo e($loan->staff->name_kh??''); ?> </td>
            </tr>
            <tr>
                <td>លេខកូដកិច្ចសន្យា</td>
                <td><?php echo e($loan->code); ?></td>

                <td>លេខទំនាក់ទំនងភ្នាក់ងារ</td>
                <td><?php echo e($loan->staff->phone_number??''); ?> </td>
            </tr>
            <tr>
                <td >ឈ្មោះអតិថិជន</td>
                <td><?php echo e($loan->client->name_kh); ?></td>

                <td>ប្រភេទកម្ចី</td>
                <td><?php echo e($loan->interest->name??''); ?> </td>
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
                <th style="width: 50px;">ល.រ</th>
                <th colspan="2" style="width: 180px;">ថ្ងៃ</th>
                <th style="width: 100px;">ប្រាក់ដេីម</th>
                <th style="width: 80px;">ការប្រាក់</th>
                <th style="width: 120px;">សេវាប្រតិបត្តិការ</th>
                <th style="width: 80px;">សរុប</th>
                <th style="width: 120px;">ប្រាក់ដេីមនៅសល់</th>
                <th style="width: 120px;">ពិន័យបងផ្តាច់</th>
                <th style="width: 60px;">ផ្សេងៗ</th>
            </tr>

            <?php $__currentLoopData = $loan->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                
                <tr>
                    <td class="text-right text-nowrap"><?php echo e($loop->index + 1); ?></td>
                    <td class="text-center" ><?php echo e($payment->payment_date??''); ?> </td>
                    <td class="text-center" nowrap="nowrap"><?php echo e(convertDaytoKhmer(date('D',strtotime($payment->getRawOriginal('payment_date'))))); ?></td>
                    <td class="text-right text-nowrap"><?php echo e(number_format($payment->deduct_amount)); ?></td>
                    <td class="text-right" ><?php echo e(number_format($payment->interest_amount)); ?> </td>
                    <td class="text-right text-nowrap"><?php echo e(number_format($payment->commission_amount)); ?> </td>
                    <td class="text-right text-nowrap"><?php echo e(number_format($payment->total_amount)); ?> </td>
                    <td class="text-right text-nowrap"><?php echo e(number_format($payment->pending_amount)); ?> </td>
                    <td class="text-right text-nowrap"><?php echo e(number_format($payment->penalty_amount)); ?></td>
                    <td class="text-right text-nowrap"></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
            
    </div>

    <table style="width:100%; line-height: 3; border: 0px solid rgba(255, 255, 255, 0) !important;">
        <tr style="border: 0px solid rgba(255, 255, 255, 0) !important;">
            <th style="text-align:center; border: 0px solid rgba(255, 255, 255, 0) !important;">
                <div class="caption-left">
                <div class="text-center">
                    <br>
                    <div class="text-left">
                        <p class="p">ថ្ងៃ............. ខែ............. ឆ្នាំ <?php echo e(\Carbon\Carbon::now()->format('Y')); ?></p>
                    </div>
                    <div class="khmer-moul" style="pandding-left:20px;">ហត្ថលេខា និងត្រាភាគីអោយខ្ចី </div>
                    <br>
                    <br>
                    <div class="text-left">
                        <div style="margin-left:100px;" >
                            ឈ្មោះ :...............................
                        </div>
                    </div>
                </div>
                </div>
            </th>

            <th style="width: 250px; border: 0px solid rgba(255, 255, 255, 0) !important;">

            </th>

            <th style="text-align: center; border: 0px solid rgba(255, 255, 255, 0) !important;">
                <div class="caption-right">
                    <div class="text-right">
                    <br>
                        <div class="text-left">
                            <p class="p">ថ្ងៃ............. ខែ............. ឆ្នាំ <?php echo e(\Carbon\Carbon::now()->format('Y')); ?></p>
                        </div>
                        <div class="khmer-moul" style="pandding-left:20px;">ស្នាមមេដៃ ស្តាំកូនបំណុល</div>
                        <br>
                        <br>
                        <div class="text-right">
                            <div style="margin-left:100px;" >
                                ឈ្មោះ :...............................
                            </div>
                        </div>
                    </div>
                </div>
            </th>
        </tr>
    </table>    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pdf-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/kunpheap/public_html/resources/views/loans/print-loan.blade.php ENDPATH**/ ?>
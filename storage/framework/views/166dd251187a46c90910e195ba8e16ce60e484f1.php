<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>តារាង-បង់ការប្រាក់</strong></div>
        </div>
    </div>
    <div class="card-body">
           <div class="table-responsive">
               <table class="table table-bordered table-striped table-hover" id ="table">
                   <thead>
                       <tr>
                           <th class="text-center text-nowrap"></th>
                           <th class="text-center text-nowrap">ល.រ</th>
                           <th class="text-center text-nowrap">សភាព</th>
                           <th class="text-center text-nowrap">សាខា</th>
                           <th class="text-center text-nowrap">មន្រ្តីឥណទាន</th>
                           <th class="text-center text-nowrap">ថ្ងៃត្រូវបង់</th>
                           <th class="text-center text-nowrap">កូដអតិថិជន</th>
                           <th class="text-center text-nowrap">កូដកិច្ចសន្យា</th>
                           <th class="text-center text-nowrap">ឈ្មោះអតិថិជន</th>
                           <th class="text-center text-nowrap">ប្រាក់ត្រូវបង់សរុប</th>
                           <th class="text-center text-nowrap">ប្រាក់បានបង់សរុប</th>
                           <th class="text-center text-nowrap">ប្រាក់មិនទាន់បង់សរុប</th>
                           <th class="text-center text-nowrap">ប្រាក់ដើមនៅសល់</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php
                           $unPaidAmount = $payment->total_amount - $payment->total_paid_amount;
                       ?>
   
                       <tr class="<?php echo e($payment->isOverDate()?'table-danger':''); ?>">
                           <td class="text-center text-nowrap">
                                <a class="btn btn-sm btn-primary" <?php echo e($payment->status <> 'pending'?'disabled':''); ?>  href="<?php echo e(route('payment.interest.edit',['id' => $payment->id ])); ?>">
                                   <span class="material-icons-outlined">edit</span>
                               </a>
                           </td>
                           <td class="text-right text-nowrap"><?php echo e($loop->index + 1); ?></td>
                           <td class="text-center text-nowrap"><span class="<?php echo e($payment->_status->css); ?>"><?php echo e($payment->_status->name); ?></span></td>
                           <td class="text-left text-nowrap"><?php echo e($payment->loan->branch->name??''); ?></td>
                           <td class="text-left text-nowrap"><?php echo e($payment->loan->staff->name_kh??''); ?></td>
                           <td class="text-center text-nowrap"><?php echo e($payment->payment_date??''); ?></td>
                           <td class="text-center text-nowrap"><?php echo e($payment->loan->client->code??''); ?></td>
                           <td class="text-center text-nowrap"><?php echo e($payment->loan->code??''); ?></td>
                           <td class="text-left text-nowrap"><?php echo e($payment->loan->client->name_kh??''); ?></td>
                           <td class="text-right text-nowrap"><?php echo e(number_format($payment->total_amount??'')); ?></td>
                           <td class="text-right text-nowrap"><?php echo e(number_format($payment->total_paid_amount??0)); ?></td>
                           <td class="text-right text-nowrap"><?php echo e(number_format($unPaidAmount)); ?></td>
                           <td class="text-right text-nowrap"><?php echo e(number_format($payment->loan->pending_amount??0)); ?></td>
                       </tr>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </tbody>
               </table>
               <div class="text-center"><?php echo e($payments->appends($_GET)->links()); ?></div>            
           </div>
           
       </div>
   </div><?php /**PATH /home2/kunpheap/public_html/resources/views/payments/interest/list.blade.php ENDPATH**/ ?>
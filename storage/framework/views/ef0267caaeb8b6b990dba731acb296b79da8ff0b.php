<?php $__env->startSection('title', 'តារាង-កម្ចី'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('includes.read-client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('includes.read-loan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   

    <div class="card">
        <div class="card-header">
            <div class="float-right">
                  <a href="<?php echo e(route('loan.export',['id' => $loan->id])); ?>"
                class="btn btn-sm btn-info ">
                <span class="material-icons-outlined">file_download</span>
            </a>

            <a class="btn btn-sm btn-warning " target="_blank" href="<?php echo e(route('loan.download',['id' => $loan->id ])); ?>">
                <span class="material-icons-outlined">print</span>
            </a>
            </div>
        </div>
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">តារាងបង់ប្រាក់</a>
                  <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">ប្រវត្តិបង់ប្រាក់</a>                  
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id ="table">
                            <thead>
                                <tr>
                                    <th class="text-center text-nowrap"></th>
                                    <th class="text-center text-nowrap">បង់លើកទី</th>
                                    <th class="text-center text-nowrap">សភាព</th>
                                    <th class="text-center text-nowrap">ថ្ងៃបង់ប្រាក់</th>
                                    <th class="text-center text-nowrap">ប្រាក់ដើម</th>
                                    <th class="text-center text-nowrap">ការប្រាក់</th>
                                    <th class="text-center text-nowrap">សេវាប្រតិបត្តិការ</th>
                                    <th class="text-center text-nowrap">ប្រាក់ត្រូវបង់សរុប</th>
                                    <th class="text-center text-nowrap">ប្រាក់ដើមនៅសល់</th>
                                    <th class="text-center text-nowrap">ពិន័យបង់ផ្តាច់</th>
                                    <th class="text-center text-nowrap">ផ្សេងៗ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $loan->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center text-nowrap">
                                        <a class="btn btn-sm btn-primary <?php echo e($loan->status <> 'pending'?'disabled':''); ?>" href="<?php echo e(route('loan.list.edit',['id' => $payment->id ])); ?>">
                                            <span class="material-icons-outlined">edit_calendar</span>
                                        </a>
                                    </td>
                                    <td class="text-right text-nowrap"><?php echo e($payment->sort); ?></td>
                                    <td class="text-center text-nowrap"><span class="<?php echo e($payment->_status->css); ?>"><?php echo e($payment->_status->name); ?></span></td>
                                    <td><?php echo e(convertDaytoKhmer(date('D',strtotime($payment->getRawOriginal('payment_date')))).' '.$payment->payment_date); ?></td>
                                    <td class="text-right text-nowrap"><?php echo e(number_format($payment->deduct_amount)); ?></td>
                                    <td class="text-right text-nowrap"><?php echo e(number_format($payment->interest_amount)); ?></td>
                                    <td class="text-right text-nowrap"><?php echo e(number_format($payment->commission_amount)); ?></td>
                                    <td class="text-right text-nowrap"><?php echo e(number_format($payment->total_amount)); ?> </td>
                                    <td class="text-right text-nowrap"><?php echo e(number_format($payment->pending_amount)); ?></td>
                                    <td class="text-right text-nowrap"><?php echo e(number_format($payment->penalty_amount)); ?></td>
                                    <td class="text-right text-nowrap"></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id ="table">
                            <thead>
                                <tr>
                                    <th class="text-center text-nowrap"></th>
                                    <th class="text-center text-nowrap">បង់លើកទី</th>
                                    <th class="text-center text-nowrap">ថ្ងៃត្រូវបង់ប្រាក់</th>
                                    <th class="text-center text-nowrap">ប្រាក់ត្រូវបង់សរុប</th>
                                    <th class="text-center text-nowrap">ថ្ងៃបានបង់ប្រាក់</th>
                                    <th class="text-center text-nowrap">ទឹកប្រាក់បានបង់</th>                                    
                                    <th class="text-center text-nowrap">ប្រភេទ</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>                                    
                                    <td class="text-right text-nowrap"><?php echo e($loop->index + 1); ?></td>                                    
                                    <td class="text-right text-nowrap"><?php echo e($log->payment->sort??''); ?></td>
                                    <td class="text-left text-nowrap"><?php echo e($log->payment->payment_date??''); ?></td>
                                    <td class="text-right text-nowrap"><?php echo e(number_format($log->payment->total_amount)); ?> </td>
                                    <td class="text-left text-nowrap"><?php echo e($log->transaction_datetime); ?></td>
                                    <td class="text-right text-nowrap"><?php echo e(number_format($log->transaction_amount)); ?></td>
                                    <td class="text-left text-nowrap"><?php echo e($log->type); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div> 
                </div>
              </div>            
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OneDrive - Cyber Grow Solution Co., Ltd\Desktop\Loan\Source Code\resources\views/loans/show.blade.php ENDPATH**/ ?>
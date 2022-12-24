<?php $__env->startSection('title','កែប្រែ-ថ្ងៃបង់ការប្រាក់​'); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('includes.alert-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('includes.read-client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <form action="<?php echo e(route('loan.list.update',['id' => $payment->id])); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>

        <div class="card">
            <div class="card-header"> <strong>កែប្រែ-ថ្ងៃបង់ការប្រាក់​</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>ចំនួនប្រាក់កម្ចី</label>
                        <input
                            class="form-control <?php echo e($errors->first('principal_amount') ? 'is-invalid':''); ?>"
                            name="principal_amount"
                            type="text"
                            readonly
                            placeholder="10000000"
                            value="<?php echo e(number_format(($payment->loan->principal_amount??0))); ?>"
                            >
                        <div class="invalid-feedback"><?php echo e($errors->first('principal_amount')); ?></div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>ប្រាក់ការ​ (%)</label>
                        <input
                            class="form-control number <?php echo e($errors->first('rate') ? 'is-invalid':''); ?>"
                            name="rate"
                            type="text"
                            readonly
                            placeholder="0.7"
                            value="<?php echo e($payment->loan->rate); ?>"
                            >
                        <div class="invalid-feedback"><?php echo e($errors->first('rate')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ថ្ងៃបង់ការ</label>
                        <input
                            class="form-control <?php echo e($errors->first('payment_date') ? 'is-invalid':''); ?>"
                            name="payment_date"
                            type="text"
                            maxlength="10"
                            data-inputmask-alias="dd/mm/yyyy"
                            data-val="true"
                            placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                            value="<?php echo e($payment->payment_date); ?>"
                            >
                        <div class="invalid-feedback"><?php echo e($errors->first('payment_date')); ?></div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                            <a class="btn btn-sm btn-warning float-left" href="<?php echo e(route('loan.list.show',['id' => $payment->loan_id ])); ?>">
                                <span class="material-icons-outlined">chevron_left</span>
                            </a>

                            <button class="btn btn-sm btn-success float-right" type="submit">
                                <span class="material-icons-outlined">save</span>
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('/js/geolocation.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OneDrive - Cyber Grow Solution Co., Ltd\Desktop\Loan\Source Code\resources\views/loans/edit.blade.php ENDPATH**/ ?>
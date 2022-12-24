<?php $__env->startSection('title','បញ្ចូល-កម្ចីប្រចាំថ្ងៃ'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('includes.search-client', ['url' => route('loan.daily.create')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <form action="<?php echo e(route('loan.daily.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('includes.create-client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card">
            <div class="card-header bg-custom"> <strong>ព័ត៌មានប្រាក់កម្ចីប្រចាំថ្ងៃ</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>មន្រ្តីឥណទាន <span class="text-danger">*</span></label>
                        <select class="form-control select2 <?php echo e($errors->first('staff_id') ? 'is-invalid':''); ?>" name="staff_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($staff->id); ?>" <?php echo e(old('staff_id') == $staff->id ? 'selected' :  ''); ?>><?php echo e($staff->name_kh); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback"><?php echo e($errors->first('staff_id')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ចំនួនប្រាក់កម្ចី <span class="text-danger">*</span></label>
                        <input
                            class="form-control number <?php echo e($errors->first('principal_amount') ? 'is-invalid':''); ?>"
                            name="principal_amount"
                            type="text"
                            placeholder="10000000"
                            value="<?php echo e($loan->principal_amount??old('principal_amount')); ?>"
                            >
                        <div class="invalid-feedback"><?php echo e($errors->first('principal_amount')); ?></div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>សេវារដ្ឋបាល(%) <span class="text-danger">*</span></label>
                        <input
                            class="form-control number <?php echo e($errors->first('admin_rate') ? 'is-invalid':''); ?>"
                            name="admin_rate"
                            type="text"
                            placeholder="2.3"
                            required
                            value="<?php echo e($loan->admin_rate??old('admin_rate')); ?>"
                            >
                        <div class="invalid-feedback"><?php echo e($errors->first('admin_rate')); ?></div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>ប្រាក់ការ(%) <span class="text-danger">*</span></label>
                        <input
                            class="form-control number <?php echo e($errors->first('rate') ? 'is-invalid':''); ?>"
                            name="rate"
                            type="text"
                            placeholder="0.7"
                            maxlength="6"
                            value="<?php echo e($loan->rate??$interest->rate); ?>"
                            >
                        <div class="invalid-feedback"><?php echo e($errors->first('rate')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ថ្ងៃខ្ចី <span class="text-danger">*</span></label>
                        <input
                            class="form-control <?php echo e($errors->first('registration_date') ? 'is-invalid':''); ?>"
                            name="registration_date"
                            type="text"
                            maxlength="10"
                            data-inputmask-alias="dd/mm/yyyy"
                            data-val="true"
                            placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                            value="<?php echo e(old('registration_date')); ?>"
                            >
                        <div class="invalid-feedback"><?php echo e($errors->first('registration_date')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ថ្ងៃបង់ការដំបូង <span class="text-danger">*</span></label>
                        <input
                            class="form-control <?php echo e($errors->first('started_payment_date') ? 'is-invalid':''); ?>"
                            name="started_payment_date"
                            type="text"
                            maxlength="10"
                            data-inputmask-alias="dd/mm/yyyy"
                            data-val="true"
                            placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                            value="<?php echo e(old('started_payment_date')); ?>"
                            >
                        <div class="invalid-feedback"><?php echo e($errors->first('started_payment_date')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>រយះពេល(ដង) <span class="text-danger">*</span></label>
                        <input
                            class="form-control term <?php echo e($errors->first('term') ? 'is-invalid':''); ?>"
                            name="term"
                            type="text"
                            placeholder="12"
                            value="<?php echo e($loan->term??old('term')); ?>"
                            maxlength="2">
                        <div class="invalid-feedback"><?php echo e($errors->first('term')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>សាខា <span class="text-danger">*</span></label>
                        <select class="form-control select2 <?php echo e($errors->first('branch_id') ? 'is-invalid':''); ?>" name="branch_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>" <?php echo e(old('branch_id') == $branch->id ? 'selected' :  ''); ?>><?php echo e($branch->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback"><?php echo e($errors->first('branch_id')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>គោលបំណងខ្ចី <span class="text-danger">*</span></label>
                        <input
                                class="form-control <?php echo e($errors->first('loan_purpose') ? 'is-invalid':''); ?>"
                                name="loan_purpose"
                                type="text"
                                value="<?php echo e($loan->purpose??old('loan_purpose')); ?>">
                        <div class="invalid-feedback"><?php echo e($errors->first('loan_purpose')); ?></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
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
    <?php echo $__env->make('includes.alert-info-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $('#document_type').on('change',function(e) {
            let text = $("#document_type option:selected").text();
            // change title
            $('#document_number_title').html(`លេខ${text} <span class="text-danger">*</span>`);
            // enable input
            $('#input_document_number').prop("disabled",false);
            $('#input_document_number').prop("placeholder",`បញ្ចូលលេខ${text}`);
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\SDT\PFB CASH\Source Code\resources\views/loans/daily/create.blade.php ENDPATH**/ ?>
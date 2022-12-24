<?php $__env->startSection('title','កែប្រែ-ម្ចាស់ភាគហ៊ុន'); ?>
    
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('includes.alert-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card">
        <div class="card-header"><strong>កែប្រែ-ម្ចាស់ភាគហ៊ុន</strong></div>

        <form action="<?php echo e(route('master-data.deposit.update',['id' => $deposit->id])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <input type="hidden" name="shareholder_id" value="<?php echo e($deposit->shareholder_id); ?>">
            <div class="card-body">
                <div class="row">

                    <div class="form-group col-sm-4">
                        <label>សាខា <span class="text-danger">*</span></label>
                        <select class="form-control select2 <?php echo e($errors->first('branch_id') ? 'is-invalid':''); ?>" name="branch_id" id="branch_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>" <?php echo e((old('branch_id')??$deposit->branch_id) == $branch->id ? 'selected' :  ''); ?>><?php echo e($branch->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback"><?php echo e($errors->first('branch_id')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះជាភាសាខ្មែរ <span class="text-danger">*</span></label>
                        <input
                            class="form-control <?php echo e($errors->first('name_kh') ? 'is-invalid':''); ?>"
                            name="name_kh"
                            type="text"
                            placeholder="មាន ចិត្ត"
                            value="<?php echo e(old('name_kh')??$deposit->shareholder->name_kh); ?>"
                            maxlength="50" >
                        <div class="invalid-feedback"><?php echo e($errors->first('name_kh')); ?></div>
                    </div>
    
                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះជាឡាតាំង <span class="text-danger">*</span></label>
                        <input
                            class="form-control <?php echo e($errors->first('name_en') ? 'is-invalid':''); ?>"
                            name="name_en"
                            type="text"
                            placeholder="MEAN CHET"
                            value="<?php echo e(old('name_en')??$deposit->shareholder->name_en); ?>"
                            maxlength="50">
                        <div class="invalid-feedback"><?php echo e($errors->first('name_en')); ?></div>
                    </div> 
                    
                    <div class="form-group col-sm-4">
                        <label>ទឹកប្រាក់ <span class="text-danger">*</span></label>
                        <input
                            class="form-control number <?php echo e($errors->first('deposit_amount') ? 'is-invalid':''); ?>"
                            name="deposit_amount"
                            type="text"
                            placeholder="10000000"
                            value="<?php echo e($deposit->deposit_amount??old('deposit_amount')); ?>"
                            >
                        <div class="invalid-feedback"><?php echo e($errors->first('deposit_amount')); ?></div>
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
        </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OneDrive - Cyber Grow Solution Co., Ltd\Desktop\Loan\Source Code\resources\views/master-data/deposits/edit.blade.php ENDPATH**/ ?>
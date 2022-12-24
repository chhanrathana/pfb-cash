<?php $__env->startSection('title','បញ្ចូល-ប្រភេទចំណាយ'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('includes.alert-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card">
        <div class="card-header">
            <strong>បញ្ចូល-ប្រភេទចំណាយ</strong>
        </div>
        <form action="<?php echo e(route('master-data.expense-type.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="row">                                       

                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះ</label>
                        <input
                            class="form-control <?php echo e($errors->first('name_kh') ? 'is-invalid':''); ?>"
                            name="name_kh"
                            type="text"
                            placeholder="ប្រាក់ខែ"
                            autocomplete="false"
                            maxlength="250"
                            value="<?php echo e(old('name_kh')); ?>"
                            maxlength="50" >
                        <div class="invalid-feedback"><?php echo e($errors->first('name_kh')); ?></div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OneDrive - Cyber Grow Solution Co., Ltd\Desktop\Loan\Source Code\resources\views/master-data/expense-types//create.blade.php ENDPATH**/ ?>
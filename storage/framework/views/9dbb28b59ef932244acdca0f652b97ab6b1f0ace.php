<?php $__env->startSection('title'); ?>
    បង្កើតសាខា
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('includes.alert-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card">
        <div class="card-header">
            <strong>បង្កើតសាខា</strong>
        </div>
        <form action="<?php echo e(route('master-data.branch.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="row">                   
                    <div class="form-group col-sm-3">
                        <label>កូដ</label>
                        <input
                            class="form-control <?php echo e($errors->first('code') ? 'is-invalid':''); ?>"
                            name="code"
                            type="text"
                            autocomplete="false"
                            placeholder="B001"
                            maxlength="10"
                            value="<?php echo e(old('code')); ?>"
                            maxlength="50" >
                        <div class="invalid-feedback"><?php echo e($errors->first('code')); ?></div>
                    </div>
                    
                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះ</label>
                        <input
                            class="form-control <?php echo e($errors->first('name') ? 'is-invalid':''); ?>"
                            name="name"
                            type="text"
                            placeholder="សាខាទី២"
                            autocomplete="false"
                            maxlength="250"
                            value="<?php echo e(old('name')); ?>"
                            maxlength="50" >
                        <div class="invalid-feedback"><?php echo e($errors->first('name')); ?></div>
                    </div>
                  
                    <div class="form-group col-sm-5">
                        <label>ពិពណ៍នា</label>
                        <input
                            class="form-control <?php echo e($errors->first('description') ? 'is-invalid':''); ?>"
                            name="description"
                            type="text"
                            autocomplete="false"
                            placeholder="ភូមិ.....ឃុំ...."
                            maxlength="500"
                            value="<?php echo e(old('description')); ?>"
                            maxlength="50" >
                        <div class="invalid-feedback"><?php echo e($errors->first('description')); ?></div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/kunpheap/public_html/resources/views/master-data/branches/create.blade.php ENDPATH**/ ?>
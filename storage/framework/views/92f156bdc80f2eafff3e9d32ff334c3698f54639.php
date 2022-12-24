<?php $__env->startSection('title','កែប្រែ-ចំណាយ'); ?>
    
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('includes.alert-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card">
        <div class="card-header"><strong>កែប្រែ-ចំណាយ</strong></div>

        <form action="<?php echo e(route('expense.item.update',['id' => $expense->id])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <div class="card-body">
                <div class="row">

                    <div class="form-group col-sm-4">
                        <label>សាខា</label>
                        <select class="form-control select2 <?php echo e($errors->first('branch_id') ? 'is-invalid':''); ?>" name="branch_id" id="branch_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>" <?php echo e((old('branch_id')??$expense->branch_id) == $branch->id ? 'selected' :  ''); ?>><?php echo e($branch->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback"><?php echo e($errors->first('branch_id')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ប្រភេទចំណាយ <span class="text-danger">*</span></label>
                        <select class="form-control select2 <?php echo e($errors->first('expense_type_id') ? 'is-invalid':''); ?>" name="expense_type_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(old('expense_type_id')): ?>
                                    <option value="<?php echo e($type->id); ?>" <?php echo e(old('expense_type_id') == $type->id ? 'selected' :  ''); ?>><?php echo e($type->name_kh); ?></option>
                                <?php else: ?>
                                    <option value="<?php echo e($type->id); ?>" <?php echo e($expense->expense_type_id == $type->id ? 'selected' :  ''); ?>><?php echo e($type->name_kh); ?></option>
                                <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback"><?php echo e($errors->first('expense_type_id')); ?></div>
                    </div>


                    <div class="form-group col-sm-4">
                        <label>ទឹកប្រាក់ចំណាយ <span class="text-danger">*</span></label>
                        <input
                            class="form-control number <?php echo e($errors->first('expense_amount') ? 'is-invalid':''); ?>"
                            name="expense_amount"
                            type="text"
                            placeholder="10000000"
                            value="<?php echo e($expense->expense_amount??old('expense_amount')); ?>"
                            >
                        <div class="invalid-feedback"><?php echo e($errors->first('expense_amount')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ពណ៍នាចំណាយ</label>
                        <input
                            class="form-control <?php echo e($errors->first('description') ? 'is-invalid':''); ?>"
                            name="description"
                            type="text"
                            placeholder="ទិញសម្ភារ"
                            value="<?php echo e($expense->description??old('description')); ?>"
                            maxlength="250" >
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/kunpheap/public_html/resources/views/expenses/expense-items/edit.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title'); ?>
    អ្នកប្រើប្រាស់
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('includes.alert-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card">
        <div class="card-header">
            <strong>បង្កើតអ្នកប្រើប្រាស់</strong>
        </div>
        <form action="<?php echo e(route('user.update',['id' => $user->id])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>ប្រភេទ</label>
                        <select class="form-control select2  <?php echo e($errors->first('user_type_id') ? 'is-invalid':''); ?>"  name="user_type_id" id="user_type_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($type->id); ?>" <?php echo e((old('user_type_id')??$user->user_type_id) == $type->id ? 'selected' :  ''); ?>><?php echo e($type->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback"><?php echo e($errors->first('user_type_id')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>សាខា</label>
                        <select class="form-control select2 <?php echo e($errors->first('branch_id') ? 'is-invalid':''); ?>" name="branch_id" id="branch_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>" <?php echo e((old('branch_id')??$user->branch_id) == $branch->id ? 'selected' :  ''); ?>><?php echo e($branch->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback"><?php echo e($errors->first('branch_id')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះ</label>
                        <input
                            class="form-control <?php echo e($errors->first('name') ? 'is-invalid':''); ?>"
                            name="name"
                            type="text"
                            placeholder="Men"
                            autocomplete="false"
                            value="<?php echo e($user->name); ?>"
                            maxlength="50" >
                        <div class="invalid-feedback"><?php echo e($errors->first('name')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>គណនី</label>
                        <input
                            class="form-control <?php echo e($errors->first('email') ? 'is-invalid':''); ?>"
                            name="email"
                            type="text"
                            autocomplete="false"
                            placeholder="BigMen"
                            value="<?php echo e($user->email); ?>"
                            maxlength="50" >
                        <div class="invalid-feedback"><?php echo e($errors->first('email')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>លេខសំងាត់</label>
                        <input
                            class="form-control <?php echo e($errors->first('password') ? 'is-invalid':''); ?>"
                            name="password"
                            type="password"
                            autocomplete="false"
                            placeholder="********"
                            value="<?php echo e(old('password')); ?>"
                            maxlength="50" >
                        <div class="invalid-feedback"><?php echo e($errors->first('password')); ?></div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Developer\Documents\PFB CASH\Source Code\resources\views/users/edit.blade.php ENDPATH**/ ?>
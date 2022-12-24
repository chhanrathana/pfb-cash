<?php $__env->startSection('title'); ?>
គណនី
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
    <form action="<?php echo e(route('profile.update',['id' => auth()->user()->id])); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>
        <div class="card-header"> <strong>ប្តូរលេខសម្ងាត់</strong></div>

        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>គណនី</label>
                    <input
                        class="form-control <?php echo e($errors->first('email') ? 'is-invalid':''); ?>"
                        name="email"
                        type="email"
                        value="<?php echo e($user->email); ?>"
                        disabled
                        maxlength="50" >
                    <div class="invalid-feedback"><?php echo e($errors->first('email')); ?></div>
                </div>
                <div class="form-group col-sm-6">
                    <label>ឈ្មោះ</label>
                    <input
                        class="form-control <?php echo e($errors->first('name') ? 'is-invalid':''); ?>"
                        name="name"
                        type="text"
                        placeholder="YIN BUNNA"
                        value="<?php echo e(old('name')??$user->name); ?>"
                        maxlength="50">
                    <div class="invalid-feedback"><?php echo e($errors->first('name')); ?></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-6">
                    <label>លេខសម្ងាត់</label>
                    <input
                        class="form-control <?php echo e($errors->first('password') ? 'is-invalid':''); ?>"
                        name="password"
                        type="password"
                        value="<?php echo e(old('password')??$user->password); ?>"
                        maxlength="50" >
                    <div class="invalid-feedback"><?php echo e($errors->first('password')); ?></div>
                </div>

                <div class="form-group col-sm-6">
                    <label>បញ្ជាក់លេខសម្ងាត់</label>
                    <input
                        class="form-control <?php echo e($errors->first('password_confirmation') ? 'is-invalid':''); ?>"
                        name="password_confirmation"
                        type="password"
                        value="<?php echo e(old('password_confirmation')??$user->password); ?>"
                        maxlength="50">
                    <div class="invalid-feedback"><?php echo e($errors->first('password_confirmation')); ?></div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-sm btn-success float-right" type="submit">
                <svg class="c-icon"><use xlink:href="/icons/svg/free.svg#cil-save"></use></svg>
            </button>
        </div>
</form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OneDrive - Cyber Grow Solution Co., Ltd\Desktop\Loan\Source Code\resources\views/auth/profiles/edit.blade.php ENDPATH**/ ?>
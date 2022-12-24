<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="font-weight-bold text-center margin-top">ប្រព័ន្ធគ្រប់គ្រងប្រាក់កម្ចី</h3>
                    
                    <br/>
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="material-icons-outlined">account_circle</span>
                            </span>
                            </div>
                            <input class="form-control" type="text" name="email" value=""  required autofocus>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="material-icons-outlined">lock</span>
                            </span>
                            </div>
                            <input class="form-control" type="password" name="password" required value="">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary text-center" type="submit">ចូលប្រព័ន្ធ</button>
                            </div>
                    </form>
                </div>
                  <?php if($errors->any()): ?>
                    <div class="text-danger text-center"><strong><?php echo e($errors->first()); ?></strong></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card text-white bg-secondary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
                <img class="img-fluid max-height" src="<?php echo e(asset('img/brand.png')); ?>" alt="">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="span"><b>Developed by S D T Development</b></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.auth-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Developer\Documents\PFB CASH\Source Code\resources\views/auth/login.blade.php ENDPATH**/ ?>
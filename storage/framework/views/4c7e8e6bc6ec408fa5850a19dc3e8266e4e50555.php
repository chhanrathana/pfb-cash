<div class="card">
        
    <div class="card-body">
        <form action="<?php echo e(route('master-data.staff.index')); ?>" class="mt-2" id="frmSearch" method="GET">
            <div class="form-row">

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <select class="form-control select2" name="branch_id" >
                        <option value="" disabled selected>[-- សាខា --]</option>
                        <option value="all" <?php echo e(request('branch_id') == 'all'?'selected':''); ?>>ទាំងអស់</option>
                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($branch->id); ?>" <?php echo e(request('branch_id') == $branch->id?'selected':''); ?>><?php echo e($branch->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <select class="form-control select2" name="status" >
                        <option value="" disabled selected>[-- សភាព --]</option>
                        <option value="all" <?php echo e(request('status') == 'all'?'selected':''); ?>>ទាំងអស់</option>
                        <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($st->id); ?>"   <?php echo e(request('status') == $st->id ? 'selected' :  ''); ?>><?php echo e($st->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        class="form-control"
                        name="name_kh"
                        maxlength="50"
                        value="<?php echo e(request('name_kh')); ?>"
                        placeholder="ឈ្មោះជាភាសាខ្មែរ">
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        class="form-control"
                        name="name_en"
                        maxlength="50"
                        value="<?php echo e(request('name_en')); ?>"
                        placeholder="ឈ្មោះជាឡាតាំង">
                </div>

                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                    <a href="<?php echo e(route('master-data.staff.index')); ?>" class="btn btn-warning mb-2">សំអាត</a>
                </div>
            </div>
        </form>
    </div>
</div><?php /**PATH E:\Project\SDT\PFB CASH\Source Code\resources\views/master-data/staffs/search.blade.php ENDPATH**/ ?>
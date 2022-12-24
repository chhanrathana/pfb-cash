<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>ស្វែងរក</strong></div>            
        </div>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('master-data.deposit.index')); ?>" method="GET">
            <?php echo csrf_field(); ?>
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
                    <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                    <a href="<?php echo e(route('master-data.deposit.index')); ?>" class="btn btn-warning mb-2">សំអាត</a>                    
                </div>
            </div>
        </form>
    </div>
</div><?php /**PATH /home2/kunpheap/public_html/resources/views/master-data/deposits/search.blade.php ENDPATH**/ ?>
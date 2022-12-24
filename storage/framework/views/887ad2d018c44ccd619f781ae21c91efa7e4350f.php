<?php $__env->startSection('content'); ?>  
    <div class="card">
        <div class="card-header">            
            <form action="<?php echo e(route('dashboard')); ?>" class="mt-2" id="frmSearch" method="GET">
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
                                                
                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                        <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-warning mb-2">សំអាត</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
        $totalClients = 0;
        $totalPrincipal = 0;
    ?>
    <div class="row">
        <?php $__currentLoopData = $interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $totalClients = $totalClients + $interest->count;
                $totalPrincipal = $totalPrincipal + $interest->principal_amount;
            ?>
            <div class="col-sm-6 col-lg-6">
                <div class="card">
                    <div class="card-header <?php echo e($interest->css); ?> content-center">
                        <svg class="c-icon c-icon-3xl text-white my-4">
                        </svg>
                        <h4 class="text-font-bold text-primary big"><?php echo e($interest->name); ?></h4>
    
                    </div>
                    <div class="card-body row text-center">
                        <div class="col">
                            <div class="text-value-xl"><?php echo e(number_format($interest->count)); ?></div>
                            <div class="text-uppercase text-muted small text-font-bold">អតិថិជន</div>
                        </div>
                        <div class="c-vr"></div>
                        <div class="col">
                            <div class="text-value-xl"><?php echo e(number_format($interest->principal_amount)); ?></div>
                            <div class="text-uppercase text-muted small text-font-bold">កម្ចី</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header bg-default content-center">
                    <svg class="c-icon c-icon-3xl text-white my-4">
                    </svg>
                    <h4 class="text-font-bold text-primary big">សរុបទាំងអស់</h4>

                </div>
                <div class="card-body row text-center">
                    <div class="col">
                        <div class="text-value-xl"><?php echo e(number_format($totalClients)); ?></div>
                        <div class="text-uppercase text-muted small text-font-bold">អតិថិជន</div>
                    </div>
                    <div class="c-vr"></div>
                    <div class="col">
                        <div class="text-value-xl"><?php echo e(number_format($totalPrincipal)); ?></div>
                        <div class="text-uppercase text-muted small text-font-bold">កម្ចី</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/kunpheap/public_html/resources/views/dashboards/index.blade.php ENDPATH**/ ?>
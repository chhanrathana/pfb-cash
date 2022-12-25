<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <form action="<?php echo e(route('dashboard')); ?>" class="mt-2" id="frmSearch" method="GET">
                <div class="form-row">
                    <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                        <select class="form-control select2" name="branch_id">
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
    <div class="card">
        <table class="table table-hover">
            <thead class="bg-custom">
            <tr>
                <th scope="col">ប្រភេទកម្ចី</th>
                <th scope="col">ចំនួនទឹកប្រាក់</th>
                <th scope="col">អតិថិជន</th>
            </tr>
            </thead>
            <tbody>

            <?php
                $totalClients = 0;
                $totalPrincipal = 0;
            ?>
            <?php $__currentLoopData = $interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $totalClients = $totalClients + $interest->count;
                    $totalPrincipal = $totalPrincipal + $interest->principal_amount;
                ?>
                <tr>
                    <td><?php echo e($interest->name); ?></td>
                    <td><?php echo e(number_format($interest->principal_amount)); ?> រៀល</td>
                    <td><?php echo e(number_format($interest->count)); ?> នាក់</td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><strong>សរុបកម្ចីទាំងអស់</strong></td>
                <td><strong><?php echo e(number_format($totalPrincipal)); ?> រៀល</strong></td>
                <td><strong><?php echo e(number_format($totalClients)); ?> នាក់</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/chhanrathana/ITProject/ITClass/pfb-cash/resources/views/dashboards/index.blade.php ENDPATH**/ ?>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>បញ្ជីសាខា</strong></div>
            <div class="col">
                <a class="float-right btn btn-md btn-info" href="<?php echo e(route('master-data.branch.create')); ?>">
                     <strong>បញ្ចូលថ្មី</strong>
                </a>
            </div>
        </div>
    </div>    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">កូដ</th>
                        <th class="text-center text-nowrap">ឈ្មោះ</th>
                        <th class="text-center text-nowrap">ពិពណ៍នា</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center text-nowrap">
                            <a class="btn btn-sm btn-primary" href="<?php echo e(route('master-data.branch.edit',['id' => $branch->id])); ?>" type="button">
                                <span class="material-icons-outlined">edit</span>
                            </a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="<?php echo e($branch->id); ?>">
                                <span class="material-icons-outlined">delete_outline</span>
                            </button>
                        </td>
                        <td class="text-right"><?php echo e($loop->index + 1); ?></td>
                        <td><?php echo e($branch->code); ?></td>
                        <td><?php echo e($branch->name); ?></td>
                        <td><?php echo e($branch->description); ?></td>                      
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div><?php /**PATH D:\OneDrive - Cyber Grow Solution Co., Ltd\Desktop\Loan\Source Code\resources\views/master-data/branches/list.blade.php ENDPATH**/ ?>
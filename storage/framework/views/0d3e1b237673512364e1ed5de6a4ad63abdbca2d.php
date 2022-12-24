<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>តារាង-ចំណាយ</strong></div>
            <div class="col">
                <a class="float-right btn btn-md btn-info" href="<?php echo e(route('master-data.expense-type.create')); ?>">
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
                        <th class="text-center text-nowrap"></th>
                        
                        <th class="text-center text-nowrap">ប្រភេទចំណាយ</th>                                             
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center text-nowrap">
                            <a class="btn btn-sm btn-primary" href="<?php echo e(route('master-data.expense-type.edit',['id' => $expense->id])); ?>" type="button">
                                <span class="material-icons-outlined">edit</span>
                            </a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="<?php echo e($expense->id); ?>">
                                <span class="material-icons-outlined">delete_outline</span>
                            </button>
                        </td>
                        
                        
                        <td><?php echo e($expense->name_kh); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div><?php /**PATH C:\Users\Developer\Documents\PFB CASH\Source Code\resources\views/master-data/expense-types/list.blade.php ENDPATH**/ ?>
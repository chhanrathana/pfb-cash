<div class="card">
    <div class="card-header"><strong>តារាង-អ្នកប្រើប្រាស់</strong></div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover" id ="table">
            <thead>
                <tr>
                    <th class="text-center text-nowrap"></th>
                    <th class="text-center text-nowrap">ល.រ</th>
                    <th class="text-center text-nowrap">សភាព</th>      
                    <th class="text-center text-nowrap">សិទ្ធិ</th>                        
                    <th class="text-center text-nowrap">សាខា</th>
                    <th class="text-center text-nowrap">គណនី</th>
                    <th class="text-center text-nowrap">ឈ្មោះ</th>                    
                                      
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-center text-nowrap">
                        <a class="btn btn-sm btn-primary" href="<?php echo e(route('user.edit',['id' => $user->id])); ?>" type="button">
                            <span class="material-icons-outlined">edit</span>
                        </a>

                        <button class="btn btn-sm btn-danger btn-delete" data-id="<?php echo e($user->id); ?>">
                            <span class="material-icons-outlined">delete_outline</span>
                        </button>
                    </td>
                    <td class="text-right"><?php echo e($loop->index + 1); ?></td>
                    <td><span class="badge <?php echo e($user->status? 'badge-success':'badge-danger'); ?>"><?php echo e($user->status?'active':'inactive'); ?></span></td>                        
                    <td><?php echo e($user->type->name??''); ?></td>                        
                    <td><?php echo e($user->branch->name??''); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->name); ?></td>                    
                    
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div><?php /**PATH C:\Users\Developer\Documents\PFB CASH\Source Code\resources\views/users/list.blade.php ENDPATH**/ ?>
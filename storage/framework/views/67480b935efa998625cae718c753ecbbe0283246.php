<div class="card">
    <div class="card-header"><strong>ស្វែងរក</strong></div>
    <div class="card-body">
        <form action="<?php echo e(route('report-operation.loan')); ?>" method="GET">
            <?php echo csrf_field(); ?>
            <div class="form-row">
                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <select class="form-control select2" name="branch_id" >
                        <option value="" disabled selected>[-- សាខា --]</option>
                        <option value="all" <?php echo e(request('branch_id') == 'all'?'selected':''); ?>>ទាំងអស់</option>
                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($branch->id); ?>" <?php echo e(request('branch_id') == $branch->id?'selected':''); ?>><?php echo e($branch->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <select class="form-control select2" name="staff_id" >
                        <option value="" disabled selected>[-- មន្រ្តីឥណទាន	 --]</option>
                        <option value="all" <?php echo e(request('staff_id') == 'all'?'selected':''); ?>>ទាំងអស់</option>
                        <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($staff->id); ?>" <?php echo e(request('staff_id') == $staff->id?'selected':''); ?>><?php echo e($staff->name_kh); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                 <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <select class="form-control select2" name="interest_rate_id" >
                        <option value="" disabled selected>[-- ប្រភេទកម្ចី --]</option>
                        <option value="all" <?php echo e(request('interest_rate_id') == 'all'?'selected':''); ?>>ទាំងអស់</option>
                        <?php $__currentLoopData = $interests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($interest->id); ?>" <?php echo e(request('interest_rate_id') == $interest->id?'selected':''); ?>><?php echo e($interest->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                 <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                     <select class="form-control select2" name="status" >
                        <option value="" disabled selected>[-- សភាព --]</option>
                        <option value="all" <?php echo e(request('status') == 'all'?'selected':''); ?>>ទាំងអស់</option>
                        <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($st->id); ?>" <?php echo e(request('status') == $st->id?'selected':''); ?>><?php echo e($st->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <input
                        type="text"
                        class="form-control"
                        name="​client_code"
                        maxlength="50"
                        value="<?php echo e(request('​client_code')); ?>"
                        placeholder="កូដអតិថិជន">
                </div>

                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        maxlength="50"
                        value="<?php echo e(request('name')); ?>"
                        placeholder="ឈ្មោះ">
                </div>

                 <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <input
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        class="form-control"
                        name="from_date"
                        value="<?php echo e(request('from_date')); ?>"
                        placeholder="ចាប់ពីថ្ងៃខ្ចី">
                </div>

                 <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <input
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        class="form-control"
                        name="to_date"
                        value="<?php echo e(request('to_date')); ?>"
                        placeholder="ដល់ថ្ងៃខ្ចី">
                </div>


                 <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                    <a href="<?php echo e(route('report-operation.loan')); ?>" class="btn btn-warning mb-2">សំអាត</a>                 
                </div>
            </div>
        </form>
    </div>
</div><?php /**PATH /home2/kunpheap/public_html/resources/views/report-operations/loans/search.blade.php ENDPATH**/ ?>
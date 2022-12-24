<div class="card">
    <div class="card-body">
       <form action="<?php echo e(route('report-staff.statistic')); ?>" class="mt-2" id="frmSearch" method="GET">
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
                <input
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        class="form-control"
                        name="from_date"
                        value="<?php echo e(request('from_date')); ?>"
                        placeholder="ចាប់ពីថ្ងៃបង់ប្រាក់">
            </div>

            <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                <input
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        class="form-control"
                        name="to_date"
                        value="<?php echo e(request('to_date')); ?>"
                        placeholder="ដល់ថ្ងៃបង់ប្រាក់">
            </div>


               <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                   <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                   <a href="<?php echo e(route('report-staff.statistic')); ?>" class="btn btn-warning mb-2">សំអាត</a>
               </div>
           </div>
       </form>
   </div>    
</div><?php /**PATH /home2/kunpheap/public_html/resources/views/report-staffs/statistics/search.blade.php ENDPATH**/ ?>
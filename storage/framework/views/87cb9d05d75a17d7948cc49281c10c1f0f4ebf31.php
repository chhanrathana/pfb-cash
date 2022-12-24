<?php $__env->startSection('title','កែប្រែ-មន្រ្តីឥណទាន'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('includes.alert-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="card">
    <form action="<?php echo e(route('master-data.staff.update',['id' => $staff->id])); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>
        <div class="card-header"> <strong>កែប្រែ-មន្រ្តីឥណទាន</strong></div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-4">
                    <label>ឈ្មោះជាភាសាខ្មែរ</label>
                    <input
                        class="form-control <?php echo e($errors->first('name_kh') ? 'is-invalid':''); ?>"
                        name="name_kh"
                        type="text"
                        placeholder="មាន ចិត្ត"
                        value="<?php echo e(old('name_kh')??$staff->name_kh); ?>"
                        maxlength="50" >
                    <div class="invalid-feedback"><?php echo e($errors->first('name_kh')); ?></div>
                </div>

                <div class="form-group col-sm-4">
                    <label>ឈ្មោះជាឡាតាំង</label>
                    <input
                        class="form-control <?php echo e($errors->first('name_en') ? 'is-invalid':''); ?>"
                        name="name_en"
                        type="text"
                        placeholder="MEAN CHET"
                        value="<?php echo e(old('name_en')??$staff->name_en); ?>"
                        maxlength="50">
                    <div class="invalid-feedback"><?php echo e($errors->first('name_en')); ?></div>
                </div>

                <div class="form-group col-sm-4">
                    <label>ភេទ</label>
                    <select class="form-control select2  <?php echo e($errors->first('sex') ? 'is-invalid':''); ?>"  name="sex" id="sex">
                        <option value="" selected>[-- ជ្រើសរើស --]</option>
                        <?php $__currentLoopData = $sexes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sex->id); ?>" <?php echo e($staff->sex == $sex->id ? 'selected' :  ''); ?>><?php echo e($sex->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="invalid-feedback"><?php echo e($errors->first('sex')); ?></div>
                </div>

                <div class="form-group col-sm-4">
                    <label >ថ្ងៃខែឆ្នាំកំណើត</label>
                    <input
                        class="form-control <?php echo e($errors->first('date_of_birth') ? 'is-invalid':''); ?>"
                        name="date_of_birth"
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                        value="<?php echo e(old('date_of_birth')??$staff->date_of_birth); ?>"
                        >
                    <div class="invalid-feedback"><?php echo e($errors->first('date_of_birth')); ?></div>
                </div>
                <div class="form-group col-sm-4">
                    <label for="phone_number">លេខទំនាក់ទំនង</label>
                    <input
                        class="form-control <?php echo e($errors->first('phone_number') ? 'is-invalid':''); ?>"
                        name="phone_number"
                        type="text"
                        placeholder="0967623XX"
                        value="<?php echo e(old('phone_number')??$staff->phone_number); ?>"
                        maxlength="50"
                        >
                    <div class="invalid-feedback"><?php echo e($errors->first('phone_number')); ?></div>
                </div>
                <div class="form-group col-sm-4">
                    <label >ថ្ងៃខែឆ្នាំចូលបម្រើការងារ</label>
                    <input
                        class="form-control <?php echo e($errors->first('start_work_date') ? 'is-invalid':''); ?>"
                        name="start_work_date"
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                        value="<?php echo e(old('start_work_date')??$staff->start_work_date); ?>"
                        >
                    <div class="invalid-feedback"><?php echo e($errors->first('start_work_date')); ?></div>
                </div>

                 <div class="form-group col-sm-4">
                    <label>សភាព</label>
                    <select class="form-control select2 <?php echo e($errors->first('status') ? 'is-invalid':''); ?>"  name="status" id="status">
                        <option value="" selected>[-- ជ្រើសរើស --]</option>
                        <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($st->id); ?>" <?php echo e($staff->status == $st->id ? 'selected' :  ''); ?>><?php echo e($st->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="invalid-feedback"><?php echo e($errors->first('status')); ?></div>
                </div>

                <div class="form-group col-sm-4">
                    <label>សាខា</label>
                    <select class="form-control select2 <?php echo e($errors->first('is_admin') ? 'is-invalid':''); ?>" name="branch_id" id="branch_id">
                        <option value="" selected>[-- ជ្រើសរើស --]</option>
                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($branch->id); ?>" <?php echo e((old('branch_id')??$staff->branch_id) == $branch->id ? 'selected' :  ''); ?>><?php echo e($branch->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="invalid-feedback"><?php echo e($errors->first('branch_id')); ?></div>
                </div>

            </div>
        </div>
        <div class="card-footer">
           <div class="row">
                <div class="col">
                    <a class="btn btn-sm btn-warning float-left" href="<?php echo e(route('master-data.staff.index')); ?>">
                        <span class="material-icons-outlined">arrow_back</span>
                    </a>
                    <button class="btn btn-sm btn-success float-right" type="submit">
                        <span class="material-icons-outlined">save</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/kunpheap/public_html/resources/views/master-data/staffs/edit.blade.php ENDPATH**/ ?>
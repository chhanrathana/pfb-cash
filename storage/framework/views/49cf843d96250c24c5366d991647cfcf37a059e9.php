<?php $__env->startSection('title','កែប្រែ-មន្រ្តីឥណទាន'); ?>

<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('master-data.staff.update',['id' => $staff->id])); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>
        <div class="card">
            <div class="card-header bg-custom">
                ព័ត៌មានផ្ទាល់ខ្លួន <span class="text-danger">*</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះជាភាសាខ្មែរ <span class="text-danger">*</span></label>
                        <input
                                class="form-control <?php echo e($errors->first('name_kh') ? 'is-invalid':''); ?>"
                                name="name_kh"
                                type="text"
                                placeholder="មានចិត្ត"
                                value="<?php echo e(old('name_kh') ?? $staff -> name_kh); ?>"
                                maxlength="50">
                        <div class="invalid-feedback"><?php echo e($errors->first('name_kh')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះជាឡាតាំង <span class="text-danger">*</span></label>
                        <input
                                class="form-control <?php echo e($errors->first('name_en') ? 'is-invalid':''); ?>"
                                name="name_en"
                                type="text"
                                placeholder="MEAN CHET"
                                value="<?php echo e(old('name_en') ?? $staff -> name_en); ?>"
                                maxlength="50">
                        <div class="invalid-feedback"><?php echo e($errors->first('name_en')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ភេទ <span class="text-danger">*</span></label>
                        <select class="form-control select2  <?php echo e($errors->first('sex') ? 'is-invalid':''); ?>" name="sex"
                                id="sex">
                            <option value="" selected disabled>[-- ជ្រើសរើស --]</option>
                            <?php $__currentLoopData = $sexes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sex->id); ?>" <?php echo e($staff -> sex == $sex -> id ? 'selected' : ''); ?>><?php echo e($sex->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback"><?php echo e($errors->first('sex')); ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>ថ្ងៃខែឆ្នាំកំណើត <span class="text-danger">*</span></label>
                        <input
                                class="form-control <?php echo e($errors->first('date_of_birth') ? 'is-invalid':''); ?>"
                                name="date_of_birth"
                                type="text"
                                maxlength="10"
                                data-inputmask-alias="dd/mm/yyyy"
                                data-val="true"
                                data-val-required="Required"
                                placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                                value="<?php echo e(old('date_of_birth') ?? $staff->date_of_birth); ?>"
                        >
                        <div class="invalid-feedback"><?php echo e($errors->first('date_of_birth')); ?></div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>ទីកន្លែងកំណើត <span class="text-danger">*</span></label>
                        <input
                                class="form-control <?php echo e($errors->first('born_place') ? 'is-invalid':''); ?>"
                                name="born_place"
                                type="text"
                                placeholder="ភូមិ......,ឃុំ/សង្កាត់......,ស្រុក/ខណ្ឌ......,ខេត្ត/ក្រុង......"
                                value="<?php echo e(old('born_place') ?? $staff -> born_place); ?>"
                                maxlength="250">
                        <div class="invalid-feedback"><?php echo e($errors->first('born_place')); ?></div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>ឯកសារសម្គាល់ខ្លួន <span class="text-danger">*</span></label>
                        <select class="form-control select2 <?php echo e($errors->first('document_type') ? 'is-invalid':''); ?>"
                                name="document_type" id="document_type">
                            <option value="" selected disabled>[-- ជ្រើសរើស --]</option>
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($document->id); ?>" <?php echo e($staff -> document_type == $document->id ? 'selected' :  ''); ?>><?php echo e($document->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback"><?php echo e($errors->first('document_type')); ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="document_number" id="document_number_title">លេខសំគាល់<?php echo e($staff->documentTypeName ? $staff -> documentTypeName -> name_kh : 'ឯកសារ'); ?> <span class="text-danger">*</span></label>
                        <input
                                class="form-control <?php echo e($errors->first('document_number') ? 'is-invalid':''); ?>"
                                name="document_number"
                                id="input_document_number"
                                type="text"
                                placeholder="សូមជ្រើសរើសប្រភេទឯកសារសម្គាល់ខ្លួនមុនសិន"
                                value="<?php echo e(old('document_number') ?? $staff -> document_number); ?>"
                                maxlength="50"
                        >
                        <div class="invalid-feedback"><?php echo e($errors->first('document_number')); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-custom">
                ទំនាក់ទំនង <span class="text-danger">*</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="phone_number">លេខផ្ទាល់ខ្លួន <span class="text-danger">*</span></label>
                        <input
                                class="form-control <?php echo e($errors->first('phone_number') ? 'is-invalid':''); ?>"
                                name="phone_number"
                                type="text"
                                placeholder="0967623XX"
                                value="<?php echo e(old('phone_number') ?? $staff -> phone_number); ?>"
                                maxlength="50"
                        >
                        <div class="invalid-feedback"><?php echo e($errors->first('phone_number')); ?></div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="emergency_number">លេខទាក់ទងបន្ទាន់ <span class="text-danger">*</span></label>
                        <input
                                class="form-control <?php echo e($errors->first('emergency_number') ? 'is-invalid':''); ?>"
                                name="emergency_number"
                                type="text"
                                id="emergency_number"
                                placeholder="0967623XX"
                                value="<?php echo e(old('emergency_number') ?? $staff -> emergency_number); ?>"
                                maxlength="50"
                        >
                        <div class="invalid-feedback"><?php echo e($errors->first('emergency_number')); ?></div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>ទីលំនៅបច្ចុប្បន្ន <span class="text-danger">*</span></label>
                        <input
                                class="form-control <?php echo e($errors->first('current_place') ? 'is-invalid':''); ?>"
                                name="current_place"
                                type="text"
                                placeholder="ផ្ទះលេខ......,ផ្លូវ......,ភូមិ......,ឃុំ/សង្កាត់......,ស្រុក/ខណ្ឌ......,ខេត្ត/ក្រុង......"
                                value="<?php echo e(old('current_place') ?? $staff -> current_place); ?>"
                                maxlength="250">
                        <div class="invalid-feedback"><?php echo e($errors->first('current_place')); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-custom">
                ព័ត៌មានការងារ <span class="text-danger">*</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>ថ្ងៃខែឆ្នាំចូលបម្រើការងារ <span class="text-danger">*</span></label>
                        <input
                                class="form-control <?php echo e($errors->first('start_work_date') ? 'is-invalid':''); ?>"
                                name="start_work_date"
                                type="text"
                                maxlength="10"
                                data-inputmask-alias="dd/mm/yyyy"
                                data-val="true"
                                data-val-required="Required"
                                placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                                value="<?php echo e(old('start_work_date') ?? $staff -> start_work_date); ?>"
                        >
                        <div class="invalid-feedback"><?php echo e($errors->first('start_work_date')); ?></div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>សាខា <span class="text-danger">*</span></label>
                        <select class="form-control select2 <?php echo e($errors->first('is_admin') ? 'is-invalid':''); ?>"
                                name="branch_id" id="branch_id">
                            <option  selected disabled>[-- ជ្រើសរើស --]</option>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>" <?php echo e($staff -> branch_id == $branch->id ? 'selected' :  ''); ?>><?php echo e($branch->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback"><?php echo e($errors->first('branch_id')); ?></div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>សភាព <span class="text-danger">*</span></label>
                        <select class="form-control select2 <?php echo e($errors->first('status') ? 'is-invalid':''); ?>" name="status"
                                id="status">
                            <option value="" selected disabled>[-- ជ្រើសរើស --]</option>
                            <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($st->id); ?>" <?php echo e($staff -> status == $st->id ? 'selected' :  ''); ?>><?php echo e($st->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback"><?php echo e($errors->first('status')); ?></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <a class="btn btn-sm btn-warning float-left" href="<?php echo e(route('master-data.staff.index')); ?>" title="ថយក្រោយ">
                            <span class="material-icons-outlined">arrow_back</span>
                        </a>
                        <button class="btn btn-sm btn-success float-right" title="រក្សាទុក" type="submit">
                            <span class="material-icons-outlined">save</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('includes.alert-info-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $('#document_type').on('change',function(e) {
            let text = $("#document_type option:selected").text();
            // change title
            $('#document_number_title').html(`លេខ${text} <span class="text-danger">*</span>`);
            // enable input
            $('#input_document_number').prop("disabled",false);
            $('#input_document_number').prop("placeholder",`បញ្ចូលលេខ${text}`);
        })
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\SDT\PFB CASH\Source Code\resources\views/master-data/staffs/edit.blade.php ENDPATH**/ ?>
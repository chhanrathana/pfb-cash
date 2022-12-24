<div class="card">
    <div class="card-header"><strong>ព័ត៌មានអ្នកខ្ចីប្រាក់</strong></div>
    <div class="card-body">
        <div class="row">
            <input type="hidden" value="<?php echo e($client->id??''); ?>" name="client_id">
            <div class="form-group col-sm-4">
                <label>ឈ្មោះជាភាសាខ្មែរ <span class="text-danger">*</span></label>
                <input
                    class="form-control <?php echo e($errors->first('name_kh') ? 'is-invalid':''); ?>"
                    name="name_kh"
                    type="text"
                    placeholder="យិន ប៊ុនណា"
                    value="<?php echo e($client->name_kh??old('name_kh')); ?>"
                    maxlength="50" >
                <div class="invalid-feedback"><?php echo e($errors->first('name_kh')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label>ឈ្មោះជាឡាតាំង <span class="text-danger">*</span></label>
                <input
                    class="form-control <?php echo e($errors->first('name_en') ? 'is-invalid':''); ?>"
                    name="name_en"
                    type="text"
                    placeholder="YIN BUNNA"
                    value="<?php echo e($client->name_en??old('name_en')); ?>"
                    maxlength="50">
                <div class="invalid-feedback"><?php echo e($errors->first('name_en')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label >ភេទ <span class="text-danger">*</span></label>
                <select class="form-control select2  <?php echo e($errors->first('sex') ? 'is-invalid':''); ?>"  name="sex" id="sex">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    <?php $__currentLoopData = $sexes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($client): ?>
                            <option value="<?php echo e($sex->id); ?>" <?php echo e($client->sex == $sex->id ? 'selected' :  ''); ?> ><?php echo e($sex->name); ?></option>
                        <?php else: ?>
                            <option value="<?php echo e($sex->id); ?>" <?php echo e(old('sex') == $sex->id ? 'selected' :  ''); ?> ><?php echo e($sex->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback"><?php echo e($errors->first('sex')); ?></div>
            </div>

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
                    value="<?php echo e($client->date_of_birth??old('date_of_birth')); ?>"
                    >
                <div class="invalid-feedback"><?php echo e($errors->first('date_of_birth')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label for="phone_number">លេខទំនាក់ទំនង <span class="text-danger">*</span></label>
                <input
                    class="form-control <?php echo e($errors->first('phone_number') ? 'is-invalid':''); ?>"
                    name="phone_number"
                    type="text"
                    placeholder="0817623XX"
                    value="<?php echo e($client->phone_number??old('phone_number')); ?>"
                    maxlength="50"
                    >
                <div class="invalid-feedback"><?php echo e($errors->first('phone_number')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label >ខេត្ត <span class="text-danger">*</span></label>
                <select class="form-control select2 <?php echo e($errors->first('province_id') ? 'is-invalid':''); ?>" name="province_id" id="province_id">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($client): ?>
                            <option value="<?php echo e($province->id); ?>" <?php echo e($client->village->commune->district->province->id == $province->id ? 'selected' :  ''); ?>><?php echo e($province->name_kh); ?></option>
                        <?php else: ?>
                            <option value="<?php echo e($province->id); ?>" <?php echo e(old('province_id') == $province->id ? 'selected' :  ''); ?>><?php echo e($province->name_kh); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback"><?php echo e($errors->first('province_id')); ?></div>
            </div>

            <div class="form-group col-sm-4">
                <label>ស្រុក <span class="text-danger">*</span></label>
                <select class="form-control select2 <?php echo e($errors->first('district_id') ? 'is-invalid':''); ?>" name="district_id" id="district_id">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                        <?php if($client): ?>
                            <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($district->id); ?>" <?php echo e($client->village->commune->district->id == $district->id ? 'selected' :  ''); ?>><?php echo e($district->name_kh); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                </select>
                <div class="invalid-feedback"><?php echo e($errors->first('district_id')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label>ឃុំ <span class="text-danger">*</span></label>
                <select class="form-control select2 <?php echo e($errors->first('commune_id') ? 'is-invalid':''); ?>" name="commune_id" id="commune_id">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                        <?php if($client): ?>
                            <?php $__currentLoopData = $communes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commune): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($commune->id); ?>" <?php echo e($client->village->commune->id == $commune->id ? 'selected' :  ''); ?>><?php echo e($commune->name_kh); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                </select>
                <div class="invalid-feedback"><?php echo e($errors->first('commune_id')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label>ភូមិ <span class="text-danger">*</span></label>
                <select class="form-control select2 <?php echo e($errors->first('village_id') ? 'is-invalid':''); ?>" name="village_id" id="village_id">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    <?php if($client): ?>
                        <?php $__currentLoopData = $villages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $village): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($village->id); ?>" <?php echo e($client->village->id == $village->id ? 'selected' :  ''); ?>><?php echo e($village->name_kh); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </select>
                <div class="invalid-feedback"><?php echo e($errors->first('village_id')); ?></div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home2/kunpheap/public_html/resources/views/includes/create-client.blade.php ENDPATH**/ ?>
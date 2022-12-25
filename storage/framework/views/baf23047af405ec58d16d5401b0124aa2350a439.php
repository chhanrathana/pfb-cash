<div class="card">
    <div class="card-header bg-custom"><strong>ជ្រើសរើសប្រភេទកម្ចី <span class="text-danger">*</span></strong></div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-sm-12 d-inline">
                <?php $__currentLoopData = $loanTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-check mt-3">
                        <?php if($loan): ?>
                            <input onclick="location.href=`/loan/daily/create?type=<?php echo e($type->id); ?>`" class="form-check-input" type="radio" name="loan_type" id="<?php echo e($type -> id); ?>"
                                   value="<?php echo e($type -> id); ?>" <?php echo e($loan -> loan_type_id == $type -> id ? 'checked' : ''); ?>>
                        <?php else: ?>
                            <input onclick="location.href=`/loan/daily/create?type=<?php echo e($type->id); ?>`" class="form-check-input" type="radio" name="loan_type" id="<?php echo e($type -> id); ?>"
                                   value="<?php echo e($type -> id); ?>" <?php echo e($loan -> loan_type_id == $type -> id ? 'checked' : ''); ?>>
                        <?php endif; ?>
                        <label class="form-check-label cursor-pointer <?php echo e(request('type') == $type -> id ? 'text-primary' : ''); ?>"
                               for="<?php echo e($type -> id); ?>">
                            <?php echo e($type -> name_kh); ?> / <?php echo e($type -> name_en); ?>

                        </label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-custom"><strong>ព័ត៌មានអ្នកខ្ចីប្រាក់ <?php echo e(request('type') == 'group' ? '(មេក្រុម)' : ''); ?>

            <span class="text-danger">*</span></strong></div>
    <div class="card-body">
        <div class="row">
            <input type="hidden" value="<?php echo e($client->id??''); ?>" name="client_id">
            <div class="form-group col-sm-4">
                <label>ឈ្មោះជាភាសាខ្មែរ <span class="text-danger">*</span></label>
                <input
                        class="form-control <?php echo e($errors->first('loaner_name_kh') ? 'is-invalid':''); ?>"
                        name="loaner_name_kh"
                        type="text"
                        placeholder="យិនប៊ុនណា"
                        value="<?php echo e($client->name_kh??old('loaner_name_kh')); ?>"
                        maxlength="50">
                <div class="invalid-feedback"><?php echo e($errors->first('loaner_name_kh')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label>ឈ្មោះជាឡាតាំង <span class="text-danger">*</span></label>
                <input
                        class="form-control <?php echo e($errors->first('loaner_name_en') ? 'is-invalid':''); ?>"
                        name="loaner_name_en"
                        type="text"
                        placeholder="YIN BUNNA"
                        value="<?php echo e($client->name_en??old('loaner_name_en')); ?>"
                        maxlength="50">
                <div class="invalid-feedback"><?php echo e($errors->first('loaner_name_en')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label>ភេទ <span class="text-danger">*</span></label>
                <select class="form-control select2  <?php echo e($errors->first('loaner_sex') ? 'is-invalid':''); ?>"
                        name="loaner_sex" id="sex">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    <?php $__currentLoopData = $sexes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($client): ?>
                            <option value="<?php echo e($sex->id); ?>" <?php echo e($client->sex == $sex->id ? 'selected' :  ''); ?> ><?php echo e($sex->name); ?></option>
                        <?php else: ?>
                            <option value="<?php echo e($sex->id); ?>" <?php echo e(old('sex') == $sex->id ? 'selected' :  ''); ?> ><?php echo e($sex->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback"><?php echo e($errors->first('loaner_sex')); ?></div>
            </div>

            <div class="form-group col-sm-4">
                <label>ថ្ងៃខែឆ្នាំកំណើត <span class="text-danger">*</span></label>
                <input
                        class="form-control <?php echo e($errors->first('loaner_date_of_birth') ? 'is-invalid':''); ?>"
                        name="loaner_date_of_birth"
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                        value="<?php echo e($client->date_of_birth??old('loaner_date_of_birth')); ?>"
                >
                <div class="invalid-feedback"><?php echo e($errors->first('loaner_date_of_birth')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label for="phone_number">លេខទំនាក់ទំនង <span class="text-danger">*</span></label>
                <input
                        class="form-control <?php echo e($errors->first('loaner_phone_number') ? 'is-invalid':''); ?>"
                        name="loaner_phone_number"
                        type="text"
                        placeholder="0817623XX"
                        value="<?php echo e($client->phone_number??old('loaner_phone_number')); ?>"
                        maxlength="50"
                >
                <div class="invalid-feedback"><?php echo e($errors->first('loaner_phone_number')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label>ឯកសារសម្គាល់ខ្លួន <span class="text-danger">*</span></label>
                <select class="form-control select2 <?php echo e($errors->first('loaner_document_type') ? 'is-invalid':''); ?>"
                        name="loaner_document_type" id="document_type_1">
                    <option value="" selected disabled>[-- ជ្រើសរើស --]</option>
                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($client): ?>
                            <option value="<?php echo e($document->id); ?>" <?php echo e($client -> document_type_id == $document->id ? 'selected' :  ''); ?>><?php echo e($document->name); ?></option>
                        <?php else: ?>
                            <option value="<?php echo e($document->id); ?>" <?php echo e(old('loaner_document_type') == $document->id ? 'selected' :  ''); ?>><?php echo e($document->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback"><?php echo e($errors->first('loaner_document_type')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label for="input_document_number_1" id="document_number_title_1">លេខសំគាល់ឯកសារ <span
                            class="text-danger">*</span></label>
                <input
                        class="form-control <?php echo e($errors->first('loaner_document_number') ? 'is-invalid':''); ?>"
                        name="loaner_document_number"
                        id="input_document_number_1"
                        type="text"
                        placeholder="សូមជ្រើសរើសប្រភេទឯកសារសម្គាល់ខ្លួនមុនសិន"
                        value="<?php echo e($client -> document_number ?? old('loaner_document_number')); ?>"
                        maxlength="50"
                >
                <div class="invalid-feedback"><?php echo e($errors->first('loaner_document_number')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label>ខេត្ត <span class="text-danger">*</span></label>
                <select class="form-control select2 <?php echo e($errors->first('loaner_province_id') ? 'is-invalid':''); ?>"
                        name="loaner_province_id" id="province_id">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($client): ?>
                            <option value="<?php echo e($province->id); ?>" <?php echo e($client->village->commune->district->province->id == $province->id ? 'selected' :  ''); ?>><?php echo e($province->name_kh); ?></option>
                        <?php else: ?>
                            <option value="<?php echo e($province->id); ?>" <?php echo e(old('loaner_province_id') == $province->id ? 'selected' :  ''); ?>><?php echo e($province->name_kh); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback"><?php echo e($errors->first('loaner_province_id')); ?></div>
            </div>

            <div class="form-group col-sm-4">
                <label>ស្រុក <span class="text-danger">*</span></label>
                <select class="form-control select2 <?php echo e($errors->first('district_id') ? 'is-invalid':''); ?>"
                        name="loaner_district_id" id="district_id">
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
                <select class="form-control select2 <?php echo e($errors->first('commune_id') ? 'is-invalid':''); ?>"
                        name="loaner_commune_id" id="commune_id">
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
                <select class="form-control select2 <?php echo e($errors->first('village_id') ? 'is-invalid':''); ?>"
                        name="loaner_village_id" id="village_id">
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
<?php if(request('type') == 'group' || ($loan -> loan_type_id == 'group')): ?>
    
    <div class="card">
        <div class="card-header bg-custom"><strong>ព័ត៌មានសមាជិកខ្ចីប្រាក់ <span class="text-danger">*</span></strong>
        </div>
        <div class="card-body">
            <?php if($loan -> members ): ?>
                <?php $__currentLoopData = $loan -> members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>សមាជិកទី <?php echo e($key + 1); ?> -ឈ្មោះជាភាសាខ្មែរ <?php if($key==0): ?>
                                    <span class="text-danger">*</span>
                                <?php endif; ?></label>
                            <input
                                    class="form-control <?php echo e($errors->first('member_name_kh') ? 'is-invalid':''); ?>"
                                    name="member_name_kh[]"
                                    type="text"
                                    placeholder=""
                                    value="<?php echo e($member->name_kh??old('member_name_kh')); ?>"
                                    maxlength="50">
                            <div class="invalid-feedback"><?php echo e($errors->first('member_name_kh')); ?></div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>សមាជិកទី <?php echo e($key + 1); ?> -ឈ្មោះជាឡាតាំង <?php if($key==0): ?>
                                    <span class="text-danger">*</span>
                                <?php endif; ?></label>
                            <input
                                    class="form-control <?php echo e($errors->first('member_name_en') ? 'is-invalid':''); ?>"
                                    name="member_name_en[]"
                                    type="text"
                                    placeholder=""
                                    value="<?php echo e($member->name_en??old('member_name_en')); ?>"
                                    maxlength="50">
                            <div class="invalid-feedback"><?php echo e($errors->first('member_name_en')); ?></div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php for($i=1; $i<5; $i++): ?>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>សមាជិកទី <?php echo e($i); ?> -ឈ្មោះជាភាសាខ្មែរ <?php if($i==1): ?>
                                    <span class="text-danger">*</span>
                                <?php endif; ?></label>
                            <input
                                    class="form-control <?php echo e($errors->first('member_name_kh') ? 'is-invalid':''); ?>"
                                    name="member_name_kh[]"
                                    type="text"
                                    placeholder=""
                                    value="<?php echo e($client->name_kh??old('member_name_kh')); ?>"
                                    maxlength="50">
                            <div class="invalid-feedback"><?php echo e($errors->first('member_name_kh')); ?></div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>សមាជិកទី <?php echo e($i); ?> -ឈ្មោះជាឡាតាំង <?php if($i==1): ?>
                                    <span class="text-danger">*</span>
                                <?php endif; ?></label>
                            <input
                                    class="form-control <?php echo e($errors->first('member_name_en') ? 'is-invalid':''); ?>"
                                    name="member_name_en[]"
                                    type="text"
                                    placeholder=""
                                    value="<?php echo e($client->name_kh??old('member_name_en')); ?>"
                                    maxlength="50">
                            <div class="invalid-feedback"><?php echo e($errors->first('member_name_en')); ?></div>
                        </div>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header bg-custom"><strong>ព័ត៌មានអ្នកធានា</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-4">
                <label>ឈ្មោះអ្នកធានាទី១</label>
                <input
                        class="form-control <?php echo e($errors->first('first_guarantor_name') ? 'is-invalid':''); ?>"
                        name="first_guarantor_name"
                        type="text"
                        placeholder="យិនប៊ុនណា"
                        value="<?php echo e($first_guarantor->full_name??old('first_guarantor_name')); ?>"
                        maxlength="50">
                <div class="invalid-feedback"><?php echo e($errors->first('first_guarantor_name')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label>ភេទ</label>
                <select class="form-control select2  <?php echo e($errors->first('first_guarantor_sex') ? 'is-invalid':''); ?>"
                        name="first_guarantor_sex" id="sex">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    <?php $__currentLoopData = $sexes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($first_guarantor): ?>
                            <option value="<?php echo e($sex->id); ?>" <?php echo e($first_guarantor->sex == $sex->id ? 'selected' :  ''); ?> ><?php echo e($sex->name); ?></option>
                        <?php else: ?>
                            <option value="<?php echo e($sex->id); ?>" <?php echo e(old('first_guarantor_sex') == $sex->id ? 'selected' :  ''); ?> ><?php echo e($sex->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback"><?php echo e($errors->first('first_guarantor_sex')); ?></div>
            </div>

            <div class="form-group col-sm-4">
                <label>ថ្ងៃខែឆ្នាំកំណើត</label>
                <input
                        class="form-control <?php echo e($errors->first('first_guarantor_date_of_birth') ? 'is-invalid':''); ?>"
                        name="first_guarantor_date_of_birth"
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                        value="<?php echo e($first_guarantor->date_of_birth??old('first_guarantor_date_of_birth')); ?>"
                >
                <div class="invalid-feedback"><?php echo e($errors->first('first_guarantor_date_of_birth')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label for="phone_number">លេខទំនាក់ទំនង</label>
                <input
                        class="form-control <?php echo e($errors->first('first_guarantor_date_of_phone_number') ? 'is-invalid':''); ?>"
                        name="first_guarantor_date_of_phone_number"
                        type="text"
                        placeholder="0817623XX"
                        value="<?php echo e($first_guarantor->phone_number??old('first_guarantor_date_of_phone_number')); ?>"
                        maxlength="50"
                >
                <div class="invalid-feedback"><?php echo e($errors->first('first_guarantor_date_of_phone_number')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label>ឯកសារសម្គាល់ខ្លួន</label>
                <select class="form-control select2 <?php echo e($errors->first('first_guarantor_document_type') ? 'is-invalid':''); ?>"
                        name="first_guarantor_document_type" id="document_type_2">
                    <option value="" selected disabled>[-- ជ្រើសរើស --]</option>
                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($first_guarantor): ?>
                            <option value="<?php echo e($document->id); ?>" <?php echo e($first_guarantor -> document_type == $document->id ? 'selected' :  ''); ?>><?php echo e($document->name); ?></option>
                        <?php else: ?>
                            <option value="<?php echo e($document->id); ?>" <?php echo e(old('first_guarantor_document_type') == $document->id ? 'selected' :  ''); ?>><?php echo e($document->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback"><?php echo e($errors->first('first_guarantor_document_type')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label for="document_number" id="document_number_title_2">លេខសំគាល់ឯកសារ </label>
                <input
                        class="form-control <?php echo e($errors->first('first_guarantor_document_number') ? 'is-invalid':''); ?>"
                        name="first_guarantor_document_number"
                        id="input_document_number_2"
                        type="text"
                        placeholder="សូមជ្រើសរើសប្រភេទឯកសារសម្គាល់ខ្លួនមុនសិន"
                        value="<?php echo e($first_guarantor -> document_number ?? old('first_guarantor_document_number')); ?>"
                        maxlength="50"
                >
                <div class="invalid-feedback"><?php echo e($errors->first('first_guarantor_document_number')); ?></div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            
            <div class="form-group col-sm-4">
                <label>ឈ្មោះអ្នកធានាទី២</label>
                <input
                        class="form-control <?php echo e($errors->first('second_guarantor_name') ? 'is-invalid':''); ?>"
                        name="second_guarantor_name"
                        type="text"
                        placeholder="យិនប៊ុនណា"
                        value="<?php echo e($second_guarantor->full_name??old('second_guarantor_name')); ?>"
                        maxlength="50">
                <div class="invalid-feedback"><?php echo e($errors->first('second_guarantor_name')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label>ភេទ</label>
                <select class="form-control select2  <?php echo e($errors->first('second_guarantor_sex') ? 'is-invalid':''); ?>"
                        name="second_guarantor_sex" id="sex">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    <?php $__currentLoopData = $sexes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($second_guarantor): ?>
                            <option value="<?php echo e($sex->id); ?>" <?php echo e($second_guarantor->sex == $sex->id ? 'selected' :  ''); ?> ><?php echo e($sex->name); ?></option>
                        <?php else: ?>
                            <option value="<?php echo e($sex->id); ?>" <?php echo e(old('second_guarantor_sex') == $sex->id ? 'selected' :  ''); ?> ><?php echo e($sex->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback"><?php echo e($errors->first('second_guarantor_sex')); ?></div>
            </div>

            <div class="form-group col-sm-4">
                <label>ថ្ងៃខែឆ្នាំកំណើត</label>
                <input
                        class="form-control <?php echo e($errors->first('second_guarantor_date_of_birth') ? 'is-invalid':''); ?>"
                        name="second_guarantor_date_of_birth"
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                        value="<?php echo e($second_guarantor->date_of_birth??old('second_guarantor_date_of_birth')); ?>"
                >
                <div class="invalid-feedback"><?php echo e($errors->first('second_guarantor_date_of_birth')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label for="phone_number">លេខទំនាក់ទំនង</label>
                <input
                        class="form-control <?php echo e($errors->first('second_guarantor_phone_number') ? 'is-invalid':''); ?>"
                        name="second_guarantor_phone_number"
                        type="text"
                        placeholder="0817623XX"
                        value="<?php echo e($second_guarantor->phone_number??old('second_guarantor_phone_number')); ?>"
                        maxlength="50"
                >
                <div class="invalid-feedback"><?php echo e($errors->first('second_guarantor_phone_number')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label>ឯកសារសម្គាល់ខ្លួន</label>
                <select class="form-control select2 <?php echo e($errors->first('second_guarantor_document_type') ? 'is-invalid':''); ?>"
                        name="second_guarantor_document_type" id="document_type_2">
                    <option value="" selected disabled>[-- ជ្រើសរើស --]</option>
                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($second_guarantor): ?>
                            <option value="<?php echo e($document->id); ?>" <?php echo e($second_guarantor -> document_type == $document->id ? 'selected' :  ''); ?>><?php echo e($document->name); ?></option>
                        <?php else: ?>
                            <option value="<?php echo e($document->id); ?>" <?php echo e(old('second_guarantor_document_type') == $document->id ? 'selected' :  ''); ?>><?php echo e($document->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="invalid-feedback"><?php echo e($errors->first('second_guarantor_document_type')); ?></div>
            </div>
            <div class="form-group col-sm-4">
                <label for="document_number" id="document_number_title_2">លេខសំគាល់ឯកសារ </label>
                <input
                        class="form-control <?php echo e($errors->first('second_guarantor_document_number') ? 'is-invalid':''); ?>"
                        name="second_guarantor_document_number"
                        id="input_document_number_2"
                        type="text"
                        placeholder="សូមជ្រើសរើសប្រភេទឯកសារសម្គាល់ខ្លួនមុនសិន"
                        value="<?php echo e($second_guarantor -> document_number ?? old('second_guarantor_document_number')); ?>"
                        maxlength="50"
                >
                <div class="invalid-feedback"><?php echo e($errors->first('second_guarantor_document_number')); ?></div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('includes.alert-info-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $('#document_type_1').on('change', function (e) {
            let text = $("#document_type_1 option:selected").text();
            // change title
            $('#document_number_title_1').html(`លេខ${text} <span class="text-danger">*</span>`);
            // enable input
            $('#input_document_number_1').prop("disabled", false);
            $('#input_document_number_1').prop("placeholder", `បញ្ចូលលេខ${text}`);
        });
        $('#document_type_2').on('change', function (e) {
            let text = $("#document_type_2 option:selected").text();
            // change title
            $('#document_number_title_2').html(`លេខ${text} <span class="text-danger">*</span>`);
            // enable input
            $('#input_document_number_2').prop("disabled", false);
            $('#input_document_number_2').prop("placeholder", `បញ្ចូលលេខ${text}`);
        })
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH E:\Project\SDT\PFB CASH\Source Code\resources\views/includes/create-client.blade.php ENDPATH**/ ?>
<div class="card">
    <div class="card-header"><strong>ព័ត៌មានអ្នកខ្ចីប្រាក់</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">កូដអតិថិជន</label>
                <label class="col-sm-8 col-form-label font-weight-bold"><?php echo e($client->code); ?></label>
            </div>
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ឈ្មោះជាភាសាខ្មែរ</label>
                <label class="col-sm-8 col-form-label font-weight-bold"><?php echo e($client->name_kh); ?></label>
            </div>
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ឈ្មោះជាឡាតាំង</label>
                <label class="col-sm-8 col-form-label font-weight-bold"><?php echo e($client->name_en); ?></label>
            </div>

            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ភេទ</label>
                <label class="col-sm-8 col-form-label font-weight-bold"><?php echo e($client->_sex->name); ?></label>
            </div>

            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ថ្ងៃខែឆ្នាំកំណើត</label>
                <label class="col-sm-8 col-form-label font-weight-bold"><?php echo e($client->date_of_birth); ?></label>
            </div>

            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">លេខទំនាក់ទំនង</label>
                <label class="col-sm-8 col-form-label font-weight-bold"><?php echo e($client->phone_number); ?></label>
            </div>
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">អាស័យដ្ឋាន</label>
                <label class="col-sm-8 col-form-label font-weight-bold">
                    <?php echo e($client->address); ?>

                </label>
            </div>
            
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">បង់លើកទី</label>
                <label class="col-sm-8 col-form-label font-weight-bold">
                    <?php if(isset($payment)): ?>
                        <?php echo e(($payment->sort??'')); ?>/<?php echo e(($payment->loan->term??'')); ?>

                    <?php endif; ?>
                    <?php if(isset($loan)): ?>
                        <?php echo e(($loan->payments->where('status','paid')->count())); ?>/<?php echo e(($loan->term??'')); ?>

                    <?php endif; ?>
                </label>
            </div>
        </div>
    </div>
</div>


<?php /**PATH /home2/kunpheap/public_html/resources/views/includes/read-client.blade.php ENDPATH**/ ?>
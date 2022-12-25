<?php $__env->startSection('title' , 'តារាង-ប្រាក់កម្ចី'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('payments.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('payments.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/chhanrathana/ITProject/ITClass/pfb-cash/resources/views/payments/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title','ប្រតិបត្តិការកម្ចី'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report-operations.loans.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('report-operations.loans.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/kunpheap/public_html/resources/views/report-operations/loans/index.blade.php ENDPATH**/ ?>
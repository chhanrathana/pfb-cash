<?php $__env->startSection('title','របាយការណ៍-ចែងភាគលាភ'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report-financials.revenue-dividends.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('report-financials.revenue-dividends.dividend-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('report-financials.revenue-dividends.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/kunpheap/public_html/resources/views/report-financials/revenue-dividends/index.blade.php ENDPATH**/ ?>
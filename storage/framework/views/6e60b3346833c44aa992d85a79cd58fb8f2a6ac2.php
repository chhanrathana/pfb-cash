<?php $__env->startSection('title','មន្ដ្រីឥណទាន-ស្ថិតិ'); ?>
<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('report-staffs.statistics.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('report-staffs.statistics.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/kunpheap/public_html/resources/views/report-staffs/statistics/index.blade.php ENDPATH**/ ?>
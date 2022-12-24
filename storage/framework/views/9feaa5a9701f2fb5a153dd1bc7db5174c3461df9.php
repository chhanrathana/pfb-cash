 <?php if($message = session()->get('error')): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Error !</strong> <?php echo e($message); ?>

		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?>
<?php if( $message = session()->get('success')): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Success !</strong> <?php echo e($message); ?>

		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif; ?><?php /**PATH D:\OneDrive - Cyber Grow Solution Co., Ltd\Desktop\Loan\Source Code\resources\views/includes/alert-info.blade.php ENDPATH**/ ?>
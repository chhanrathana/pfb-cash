 <?php if($message = session()->get('error')): ?>
	 <script>
		 // play sound
		 document.getElementById('error-notification').play();
		 $.Toast("បរាជ័យ!","<?php echo e($message); ?>","error",{
			 position_class: "toast-top-right",
			 has_progress : true,
			 timeout : 10000 // millisecond
		 });
	 </script>
<?php endif; ?>
<?php if( $message = session()->get('success')): ?>
	<script>
		// play sound
		document.getElementById('success-notification').play();
		$.Toast("រួចរាល់","<?php echo e($message); ?>","success",{
			position_class: "toast-top-right",
			has_progress : true,
			timeout : 6000 // millisecond
		});
	</script>
<?php endif; ?>
<?php /**PATH /Users/chhanrathana/ITProject/ITClass/pfb-cash/resources/views/includes/alert-info-script.blade.php ENDPATH**/ ?>
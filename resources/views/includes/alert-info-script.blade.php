 @if ($message = session()->get('error'))
	 <script>
		 // play sound
		 document.getElementById('error-notification').play();
		 $.Toast("បរាជ័យ!","{{ $message }}","error",{
			 position_class: "toast-top-right",
			 has_progress : true,
			 timeout : 10000 // millisecond
		 });
	 </script>
@endif
@if( $message = session()->get('success'))
	<script>
		// play sound
		document.getElementById('success-notification').play();
		$.Toast("រួចរាល់","{{ $message }}","success",{
			position_class: "toast-top-right",
			has_progress : true,
			timeout : 6000 // millisecond
		});
	</script>
@endif

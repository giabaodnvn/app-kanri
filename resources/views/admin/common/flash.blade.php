@if($message = Session::get('success-store'))
<script type="text/javascript">
const Toast = Swal.mixin({
  	toast: true,
  	position: 'bottom-end',
  	showConfirmButton: false,
  	timer: 3000,
  	timerProgressBar: true,
  	didOpen: (toast) => {
    	toast.addEventListener('mouseenter', Swal.stopTimer)
    	toast.addEventListener('mouseleave', Swal.resumeTimer)
  	}
});
Toast.fire({
	icon: 'success',
	title: '{{$message}}'
});	
</script>
@endif

@if($message = Session::get('success-update'))
<script type="text/javascript">
const Toast = Swal.mixin({
  	toast: true,
  	position: 'bottom-end',
  	showConfirmButton: false,
  	timer: 3000,
  	timerProgressBar: true,
  	didOpen: (toast) => {
    	toast.addEventListener('mouseenter', Swal.stopTimer)
    	toast.addEventListener('mouseleave', Swal.resumeTimer)
  	}
});
Toast.fire({
	icon: 'success',
	title: '{{$message}}'
});	
</script>
@endif
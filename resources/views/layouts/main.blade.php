<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Accounting System - Stock, Purchase and Ledger Management</title>

    <link href="{{ asset('/public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/css/font-awesome-animation.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/css/uni_animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/css/uni_checkbox.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/css/sweetalert.css') }}" rel="stylesheet">
	<link href="{{ asset('/public/css/uni_style.css') }}" rel="stylesheet">
	<link href="{{ asset('/public/css/nepali.datepicker.v2.min.css') }}" rel="stylesheet">
	<style type="text/css">
		*[data-appear-animation] {
			opacity: 0;
		}
		*[data-appear-animation].animated {
			opacity: 1;
		}
	</style>

	@yield('headerContent')
</head>
<body>
	<div class="fakeloader"></div>

	<input type="hidden" value="{{route('home')}}" name="homePath" id="homePath" />

	@yield('mainContent')

	<!-- Scripts -->
	<script src="{{asset('/public/js/jquery.min.js')}}"></script>
	<script src="{{asset('/public/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/public/js/sweet-alert.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('/public/js/jquery.appear.js')}}" type="text/javascript"></script>
	<script src="{{asset('/public/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('/public/js/nepali.datepicker.v2.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('/public/js/nicescroll.js')}}" type="text/javascript"></script>
	<script src="{{asset('/public/js/myjava.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
        $(document).ready(function(){			
			@if(isset($delete_success_info))
				delete_success_info(<?php echo $delete_success_info; ?>);
			@endif

            @if(isset($update_success_info))
				update_success_info(<?php echo $update_success_info; ?>);
			@endif

            @if(isset($store_success_info))
				store_success_info(<?php echo $store_success_info; ?>);
			@endif

			@if(isset($delete_file_success_info))
				delete_file_success_info(<?php echo $delete_file_success_info; ?>);
			@endif

			@if(isset($redirect_to))
				redirect_to(<?php echo $redirect_to; ?>);
			@endif

			@if(isset($page_linker))
				page_linker(<?php echo $page_linker; ?>);
			@endif
			
        });
		//datatable
		$('.datatable').dataTable({
			"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-12'i><'col-md-12 center-block'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			}
		});
		$(document).ready(function(){
			$('.datatable').on('click','.confirmButton',function(e){
				var $form_id = $(this).attr('data-form-id');
				e.preventDefault();
				swal({
						title: "Confirm Delete?",
						text: "Are your sure you want to delete this data?",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: '#d9534f',
						confirmButtonText: 'Yes, Delete!',
						cancelButtonText: "Don't Delete!",
						closeOnConfirm: false,
						closeOnCancel: false
					},
					function(isConfirm){
						if (isConfirm){
							$("#"+$form_id).trigger('submit');
							//swal("Deleted!", "Your data has been deleted!", "success");
						} else {
							swal("Cancelled", "Your data is safe!", "error");
						}
					}
				);
			});
		});
	</script>
	@yield('footerContent')
</body>
</html>

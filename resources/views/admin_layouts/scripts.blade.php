
			<!-- Vendor -->
			<script src="../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
			<script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
			<script src="../assets/vendor/nanoscroller/nanoscroller.js"></script>

			<script src="../assets/vendor/magnific-popup/magnific-popup.js"></script>
			<script src="../assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

			
			
			<!-- Specific Page Vendor -->
			<script src="../assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
			<script src="../assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="../assets/vendor/select2/select2.js"></script>
		<script src="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="../assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="../assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="../assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="../assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="../assets/vendor/fuelux/js/spinner.js"></script>
		<script src="../assets/vendor/dropzone/dropzone.js"></script>
		<script src="../assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="../assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="../assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="../assets/vendor/codemirror/lib/codemirror.js"></script>
		<script src="../assets/vendor/codemirror/addon/selection/active-line.js"></script>
		<script src="../assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
		<script src="../assets/vendor/codemirror/mode/javascript/javascript.js"></script>
		<script src="../assets/vendor/codemirror/mode/xml/xml.js"></script>
		<script src="../assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="../assets/vendor/codemirror/mode/css/css.js"></script>
		<script src="../assets/vendor/summernote/summernote.js"></script>
		<script src="../assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="../assets/vendor/ios7-switch/ios7-switch.js"></script>
		<script src="../assets/vendor/pnotify/pnotify.custom.js"></script>



			<!-- Theme Base, Components and Settings -->
			<script src="../assets/javascripts/theme.js"></script>
			
			<!-- Theme Custom -->
			<script src="../assets/javascripts/theme.custom.js"></script>
			
			<!-- Theme Initialization Files -->
			<script src="../assets/javascripts/theme.init.js"></script>

			<script src="../assets/vendor/spop/spop.min.js"></script>

			<script>
			 $('.modal-with-move-anim').magnificPopup({
		type: 'inline',

		fixedContentPos: false,
		fixedBgPos: true,

		overflowY: 'auto',

		closeBtnInside: true,
		preloader: false,
		
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-slide-bottom',
		modal: true
    });
    
    /*
    Modal Dismiss
	*/
	$(document).on('click', '.modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
    });
			</script>

<!--obd credit-->
<script>
	$(document).ready(function(){
		$(".tab-content").on('click','a#obdpulse',function(){
			let modalid=$(this).attr('data-target');
			$(modalid).modal();
		});
	});
	</script>
<!--obd credit-->

<!--sms credit-->
	<script>
	$(document).ready(function(){
		$(".tab-content").on('click','a#smscredit',function(){
			let modalid=$(this).attr('data-target');
			$(modalid).modal();
		});
	});
	</script>
<!--sms credit-->
<!--add validity-->
	<script>
	$(document).ready(function(){
		$(".tab-content").on('click','a#addvalidity',function(){
			let modalid=$(this).attr('data-target');
			$(modalid).modal();
		});
	});
	</script>
<!--add validity-->
<!--hold user account-->
	<script>
	$(document).ready(function(){
		$("#holdaccount").click(function(){
			$("#holdaccountModal").modal();
		});
	});
	</script>
<!--hold user account-->
<!--hold user account-->
	<script>
	$(document).ready(function(){
		$("#holdaccount1").click(function(){
			$("#holdaccountModal").modal();
		});
	});
	</script>
<!--hold user account-->
<!--add credit-->
	<script>
	$(document).ready(function(){
		$("#append").on('click','a#credit',function(e){
			e.preventDefault();
			let modalid=$(this).attr('data-target');
			$(modalid).modal();
		});
	});
	</script>
<!--add credit-->
<!--add validity in list did-->
	<script>
	$(document).ready(function(){
		$("#append").on('click','a#validity',function(e){
			e.preventDefault();
			let modalid=$(this).attr('data-target');
			$(modalid).modal();
		});
	});
	</script>
<!--add validity in list did-->
	
		<!--renew plan-->
	<script>
	$(document).ready(function(){
		$("#append").on('click','a#renewplan',function(e){
			e.preventDefault();
			let modalid=$(this).attr('data-target');
			$(modalid).modal();
		});
	});
	</script>
<!--renew plan-->

<!--hold user account-->
	<script>
	$(document).ready(function(){
		$("#append").on('click','a#didhold',function(e){
			e.preventDefault();
			let modalid=$(this).attr('data-target');
			$(modalid).modal();
		});
	});
	</script>
<!--hold user account-->

<!-- tooltip -->
<script>
	$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
	});
</script>

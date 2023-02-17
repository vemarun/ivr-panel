

			<!-- Vendor -->
			<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
			<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
			<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>

			<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
			<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>



			<!-- Specific Page Vendor -->
			<script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script>
			<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		<script src="assets/vendor/dropzone/dropzone.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="assets/vendor/codemirror/lib/codemirror.js"></script>
		<script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>
		<script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
		<script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>
		<script src="assets/vendor/codemirror/mode/xml/xml.js"></script>
		<script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="assets/vendor/codemirror/mode/css/css.js"></script>
		<script src="assets/vendor/summernote/summernote.js"></script>
		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>



			<!-- Theme Base, Components and Settings -->
			<script src="assets/javascripts/theme.js"></script>

			<!-- Theme Custom -->
			<script src="assets/javascripts/theme.custom.js"></script>

			<!-- Theme Initialization Files -->
			<script src="assets/javascripts/theme.init.js"></script>

			<script src="assets/vendor/spop/spop.min.js"></script>

	<script>
	$(document).on('click','button.edit_session_source_number',function(){
		$(".div_session_source_number").hide();
		$("select[name=session_source_number]").show();
	});

	$("select[name=session_source_number]").on('change',function(){
		var session_source_number=$(this).val();
		$.ajax({
                url:'/changeSessionSourceNumber',
                type:'post',
                headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                data:'session_source_number='+session_source_number,
                success:function(result) {
					$("select[name=session_source_number]").hide();
					$(".div_session_source_number").load(location.href+" .div_session_source_number>*","");


						$(".div_session_source_number").show();
                                spop({
                                    template: result.message,
                                    autoclose: 5000,
                                    style: 'success'
                                });

						location.reload();
                        },

                         error: function(xhr, status, error) {

                            var err=$.parseJSON(xhr.responseText);
                            console.log(err);
                            if(err.errors !== undefined){
                                $.each(err.errors, function(index, element) {
                                spop({
                                    template: element,
                                    autoclose: 5000,
                                    style: 'error'
                                });

                           });
                        }
                            else {
                                $.each(err, function(index, element) {
                                spop({
                                    template: err.message,
                                    autoclose: 5000,
                                    style: 'error'
                                });

                                });
                            }
                        }



                    });
    });

    $.ajax({
        type: "post",
        url: "/getSourceNumbers",
        headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
        success: function (response) {
            $.each(response,function(index,element){
                $("select[name=session_source_number]").append(`<option>${element.source_number}</option>`);
            });

        }
    });
    /*
	Modal Dismiss
	*/
	$(document).on('click', '.modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});


    </script>

    <script>
    $.ajax({
                url:'/manage-agents',
                type:'post',
                headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    								},
                success:function(response){
                    $.each(response.data,function(index,element){
                        $("select[name=c2c_agent]").append(`<option value='${element.agent_destination}'>${element.agent_name}</option>`)
                    });
                    $("select[name=c2c_agent]").select2();

                }
    })
    </script>

    <script>
    $(".c2c_button").on('click',clickToCallUi);

    function clickToCallUi(){

        var caller_number=$("#c2c_mobile").val();
        var agent_destination=$("select[name=c2c_agent]").val();
        if(!caller_number || !agent_destination){
            $(".keypad").append(`<br><br><h4 style="color:red">Select Agent/Caller</h4>`);
        }
        else{
        clickToCall(agent_destination,caller_number)
        $(".keypad").html(`<center>
        <h4 style='color:#0095EA'>Call Initiated..<br><br>
        ${agent_destination} <i class='fa fa-phone'></i> ${caller_number}
        </h4>
        </center>`);
        // $(this).attr('disabled','disabled');
    }
    }

    function clickToCall(agent_number,caller_number){
        $.ajax({
            type: "post",
            url: "/click-to-call",
            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    								},
            data: "agent_number="+agent_number+"&caller_number="+caller_number,
            success: function (response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                            $(".keypad").load(location.href+" .keypad>*","");
                            vm.$forceUpdate();
                            var err=$.parseJSON(xhr.responseText);
                            console.log(err);
                            if(err.errors !== undefined){
                                $.each(err.errors, function(index, element) {
                                spop({
                                    template: element,
                                    autoclose: 5000,
                                    style: 'error'
                                });

                           });
                        }
                            else {
                                $.each(err, function(index, element) {
                                spop({
                                    template: err.message,
                                    autoclose: 5000,
                                    style: 'error'
                                });

                                });
                            }
                        }
        });
    }
    </script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Admin | Change Password</title>
        @include('admin.layouts.header')
        <!-- START SIDEBAR-->
        @include('admin.layouts.side-header')
        <!-- END SIDEBAR-->
        <div class="wrapper content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
			     <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 align="center" class="page-title" style="color:#dd6a39;">Change Password</h1>
                
            </div>
			<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form class="form-horizontal form_change_password" method="post">
				@csrf
				<div class="form-group">
				  <label class="control-label col-sm-4" for="current_password"> Current Password:</label>
				  <div class="col-sm-5">
					<input type="password" class="form-control" id="current_pwd" placeholder="Enter Current Password" name="current_password" required>
				  </div>
				</div>
				
				<div class="form-group">
				  <label class="control-label col-sm-4" for="password">New Password:</label>
				  <div class="col-sm-5">
					  <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Enter New Password" required>
					
				  </div>
				</div>
				
				<div class="form-group">
				  <label class="control-label col-sm-4" for="password_confirmation">Confirm Password:</label>
				  <div class="col-sm-5">
					  <input type="password" id="confirmPasswordInput" name="password_confirmation" class="form-control" placeholder="Confirm Your Password" required>
					
				  </div>
				  	
				</div>
				
				<div class="" id="passwordStrength"></div>
				
				<div class="form-group">        
				  <div class="col-md-offset-5 col-md-7">
					<button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air change_password_submit" type="submit"><i class="fa fa-paper-plane" id="newuser-icon" title="Submit"></i></button>
                                    
                           <!-- <button class="btn btn-primary mr-2" type="button">Submit</button>-->
                             <button class="btn btn-danger btn-icon-only btn-circle btn-lg btn-air" type="reset"><i class="fa fa-remove" title="Cancel"></i></button><br>
							 
				  </div>
				  
				</div>
			  </form>
			  </div>
			  
                <div class="col-md-2"></div>
			
			</div>
			  
			  
			    @include('resellerivr.layouts.footer')	

            

            <script>
                $(function() {
                    
                    $('.change_password_submit').click(function(e) {
                        $('#newuser-icon').removeClass('fa-paper-plane');
                        $('#newuser-icon').addClass('fa-spinner fa-spin');
                        
                        e.preventDefault();
                        var data = $('.form_change_password').serialize();
                      
                        $.ajax({
                            url: '/changePassword',
                            type: 'post',   
							
							headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                            data: data,

                            success: function(result) {
                                $.each(result, function(index, element) {
                                    spop({
                                        template: element,
                                        autoclose: 10000,
                                        style: 'success'
                                    });
                                });
                            },
                            error: function(xhr, status, error) {
                                    
                                var err=$.parseJSON(xhr.responseText);
                                console.log(err);
                                if(err.errors !== undefined){
                                    $.each(err.errors, function(index, element) {
                                    spop({
                                        template: element,
                                        autoclose: 10000,
                                        style: 'error'
                                    });
                                   
                               });
                            }
                                else {
                                    $.each(err, function(index, element) {
                                    spop({
                                        template: err.message,
                                        autoclose: 10000,
                                        style: 'error'
                                    });
                                   
                                    });
                                }
                                    
                            }
                                           
                        }).always(function(){
                                  $('#newuser-icon').removeClass('fa-spinner fa-spin');
                                    $('#newuser-icon').addClass('fa-paper-plane');
                                  });
                        return false;
                    });
                });
                </script>
                
</body>


</html>
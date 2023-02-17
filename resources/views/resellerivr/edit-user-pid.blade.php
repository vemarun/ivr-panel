<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Admin | Edit User Profile ID</title>
	  <style>
  .modal-header, .close {
      color:white;
      font-size: 30px;
  }
  .modal-content{
	        background-color:white;

  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  </style>
    @include('resellerivr.layouts.header')
        <!-- START SIDEBAR-->
    @include('resellerivr.layouts.side-header')
        <!-- END SIDEBAR-->
        <div class="wrapper content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
			     <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title" style="display:inline-block;"><span >Edit PID: <?= $_GET['user_id'] ?></span></h1>
				<a href="/admin/list-user" style="color:#dd6a39;display:inline-block;"><i class="fa fa-hand-o-left" style="padding:5px 0px 5px 25px;font-size:20px;"></i></a>
			

                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/resellerivr"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">User List</li>
                    <li class="breadcrumb-item">Edit PID</li>
                </ol>
            </div><br>

            

			
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home" style="color:#dd6a39;">Account Details</a></li>
    <li><a data-toggle="tab" href="#menu1" style="color:#dd6a39;">Personal Details</a></li>
  </ul>

  <center><img src="/images/loader.gif" id="loader">  </center> 

  <div class="tab-content" style="display:none">
  <!--account details-->
    <div id="home" class="tab-pane fade in active">
	
	
				<!--when client type="client"-->
			 <div class="ibox" name="client_form" id="client_form">
				
							<form method="post" id='edit_pid_form'>
                       @csrf
                       <input value="<?= $_GET['user_id'] ?>" type="hidden" name="user_id">
                        <div class="ibox-body" >
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>User Name:</label>
                                        <input class="form-control" type="text" name="uname" readonly>
                                    </div>
									</div>
									<div class="col-md-4">
                                    <div class="form-group mb-4">
									<div id="selected_form_code">
                                        <label>Client Type: <span id="client_type" style="color:#dd6a39"></span></label>
										 <select class="form-control" style="height: 35px;" name="clientselect"  id="select_btn">
                                            <option value="" selected disabled>-- Change Client Type -- </option>
                                            <option value="client">Client</option>
                                            <option value="seller">Seller</option>
                                            <option value="reseller">Reseller</option>
										  </select>
										  </div>
                                    </div>
									</div>
									<div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Validity(Days):</label>
                                        <input class="form-control" type="text" name="validity" value="20">
                                    </div>
									</div>
									
                                </div>
								
								<div class="row">
								<div class="col-md-4">
									<div class="form-group mb-4">
                                        <label>Pulse (secs)</label>
                                        <input class="form-control" type="text" name="obd_pulse" value="0" disabled>
                                    </div>
									</div>
								
									<div class="col-md-4">
									<div class="form-group mb-4">
                                        <label>SMS Rate:</label>
                                        <input class="form-control" type="text" name="sms_rate" value="0" disabled>
                                    </div>
									</div>
									
									
									<div class="col-md-4">
									<div class="form-group mb-4">
                                        <label>IVR Rate:</label>
                                        <input class="form-control" type="text" name="ivr_rate" value="0" disabled>
                                    </div>
									</div>
									
									
                                </div>

                                <!--  ivr plan and credit duction basis  -->

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label>Current Plan : <span id="plan_title" style="color:#dd6a39"></span></label>
                                            <select name="plan" class="form-control">
                                                <option value='' selected disabled>-- Change Plan --</option>
                                            </select>
                                        </div>
                                        </div>
                                    
                                        <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label>Credit Deduction basis: <span id="credit_deduction_basis" style="color:#dd6a39"></label>
                                                <select name="credit_deduction_basis" class="form-control">
                                                <option value="" selected disabled>-- Change credit deduction basis --</option>
                                                <option value="duration">Duration</option>
                                                <option value="conv_duration">Conversation duration</option>
                                                </select>
                                        </div>
                                        </div>
                                        
                                        
                                       
                                        
                                        
                                </div>
								{{-- <div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-4">
								 <div class="check-list ">
                                                <label class="checkbox checkbox-grey checkbox-primary " style="display:inline-block;">
                                                    <input type="checkbox">
                                                    <span class="input-span"></span>IP Login</label>
                                                
												<label class="checkbox checkbox-grey checkbox-primary" style="display:inline-block;">
                                                    <input type="checkbox">
                                                    <span class="input-span"></span>Multiple Login</label>
													<label class="checkbox checkbox-grey checkbox-primary" style="display:inline-block;">
                                                    <input type="checkbox">
                                                    <span class="input-span"></span>Login Email</label>
                                            </div>
								 
								</div>
								<div class="col-md-4"></div>
								</div> --}}
								
							
								
								<div class="ibox-footer">
						        <center>
                                    <button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air edit-pid-submit" type="submit"><i class="fa fa-paper-plane" title="Submit"></i></button>
                                    <button class="btn btn-warning btn-icon-only btn-circle btn-lg btn-air" type="button"  id="holdaccount"><i class="fa fa-pause hold_account_icon"  title="Hold Account"></i></button>
                                    <button class="btn btn-danger btn-icon-only btn-circle btn-lg btn-air"><i class="fa fa-remove" title="Cancel"></i></button>
						        </center>
                                </div>
								</div>
								</form>
                        
                </div>
		 </div>
		
	
	
	
	<!--personal details-->
    <div id="menu1" class="tab-pane fade">
	
				
				<div class="ibox">
				<div class="heading" >
				</div>
                        <div class="ibox-body">
							<form method="post" class="edit_pid2_form">
                            @csrf
                            <input value="<?= $_GET['user_id'] ?>" type="hidden" name="user_id">
                             <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Name:</label>
                                        <input class="form-control" type="text" name="name" value="">
                                    </div>
									</div>
									 <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Email:</label>
                                        <input class="form-control" type="email" name="email" value="">
                                    </div>
									</div>
									 <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Contact:</label>
                                        <input class="form-control" type="text" name="mobile" value="" maxlength="10">
                                    </div>
									</div>
                                </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Std Code:</label>
                                        <input class="form-control" type="text" name="std_code" placeholder="Enter Std Code">
                                    </div>
									</div>
									 <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Land Line:</label>
                                        <input class="form-control" type="text" name="landline" placeholder="Enter Land Line">
                                    </div>
									</div>
									 <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Company Name:</label>
                                        <input class="form-control" type="text" name="cname" placeholder="Enter Company Name">
                                    </div>
									</div>
                            </div>
								{{-- <div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-4">
								<div class="check-list">
                                                <label class="checkbox checkbox-grey checkbox-primary">
                                                    <input type="checkbox">
                                                    <span class="input-span"></span>NDNC Filter</label>
                                                
                                            </div>
								
								<!--<label class="checkbox-inline">
									  <input type="checkbox" name="ip" value="ip"> IP Login<br>
									</label>-->
									</div>
								<div class="col-md-4"></div>
								</div> --}}
								<div class="ibox-footer">
						        <center>
                                    <button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air edit-pid2-submit" type="submit"><i class="fa fa-paper-plane"  title="Submit"></i></button>
									<button class="btn btn-warning btn-icon-only btn-circle btn-lg btn-air" type="button" id="holdaccount1"><i class="fa fa-pause hold_account_icon"  title="Hold Account"></i></button>
                                    <button class="btn btn-danger btn-icon-only btn-circle btn-lg btn-air" type="reset"><i class="fa fa-remove" title="Cancel"></i></button>
						        </center>
                                </div>
                        </form>
						</div>
                        
                        
					</div>
               
				</div>
    
  </div>
                                            <!-- Modal -->
                                                   <div class="modal fade" id="holdaccountModal" role="dialog">
                                                        <div class="modal-dialog">
                                                        
                                                          <!-- Modal content-->
                                                          <div class="modal-content">
                                                          
                                                                 <div class="modal-header" style="background-color:#f37335;" >
                                                                 
                                    <h3 style="color:#ffffff;"  class="modal-title">Confirmation</h3>
                                    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true" >×</span></button>
                                    </div>
                                            <div class="modal-body" >
                                                                  <div class="row">
                                                                   
                                                                    <div class="col-sm-12">
                                                                     
                                                                    <form id="hold_form" method="post" name="hold_form" >
                                                                        @csrf
                                                                        <input value="<?= $_GET['user_id'] ?>" type="hidden" name="user_id">
                                                                    <div class="row">
                                                                    <div class="col-md-2"></div>
                                                                    <div class="col-md-8">
                                                                    {{-- <img src="account.png" alt="account_hold_image"> --}}
                                                                        <h5 id="hold_account_text" style="color:#dd6a39;">Are You Sure To Hold The Service Of This Account?</h5>
                                                                    
                                                                    </div>
                                                                    <div class="col-md-2"></div>
                                                                    </div>
                                                        
                                                                        <div class="row">
                                                                        
                                                                        <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                                                                        <center>
                                                                        <button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air banaccount" type="submit"><i class="fa fa-paper-plane" title="Submit"></i></button>
                                                                        
                                                                 <button class="btn btn-danger btn-icon-only btn-circle btn-lg btn-air" type="reset"><i class="fa fa-remove" title="Cancel"></i></button>
                                                                        </center>
                                                                        </div>
                                                                        </div>
                                                                        
                                                                        </div>
                                                                        </form>
                                                                     </div>
                                                                     
                                                                    </div>
                                                                  </div>
                                                                
                                                              <br>
                                                          </div>
                                                          
                                                        </div>	
                                    
                                                                        <!--hold account modal-->
                                    
                                                    </div>
                                                    </div>                                                                      
                                                                        
                                                        
           

            @include('resellerivr.layouts.footer')
            
			
			<script>
                function loadPlans(){
                $.ajax({
                        type:'post',
                        url:'/getPlans',
                        headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                        success:function(response){
                            $.each(response,function(index,element){
                                $("select[name=plan]").append(`
                                <option value="${element.id}">${element.title} | Pulse: ${element.obd_pulse} sec | SMS Rate: ${element.sms_rate}p | IVR Rate: ${element.ivr_rate}p</option>
                                `);
                            });
                        }

                    });
                }
                loadPlans();
				
                $(function() {
                    
                    //Account_details edit/update
                    $('.edit-pid-submit').click(function(e) {
                        e.preventDefault;
                        var data = $('#edit_pid_form').serialize();
                        
                        
                        $.ajax({
                            url: '/editpid/accountDetails',
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
                                           
                        });
                        return false;
                    });
                    
                    /* Person Details Edit PID */
                    //Account_details edit/update
                    $('.edit-pid2-submit').click(function(e) {
                        e.preventDefault;
                        var data = $('.edit_pid2_form').serialize();
                        
                        
                        $.ajax({
                            url: '/editpid/personalDetails',
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
                                           
                        });
                        return false;
                    });
                    
                    //get user details via api and inject into page
                    var url_string = window.location.href;
                    var url = new URL(url_string);
                    var user_id = url.searchParams.get("user_id");
                    
                    $.ajax({
                        type:'post',
                        url:'/getUserDetails/'+user_id,
                        headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    							},
                        success:function(response){
            $('input[name=uname]').attr('value',response.username);
            $('#client_type').html(response.client_type);
            $('input[name=validity]').attr('value',response.validity);
            $('input[name=sms_rate]').attr('value',response.sms_rate);
            $('input[name=obd_pulse]').attr('value',response.obd_pulse);
            $('input[name=ivr_rate]').attr('value',response.ivr_rate);
            $('input[name=name]').attr('value',response.name);
            $('input[name=email]').attr('value',response.email);
            $('input[name=mobile]').attr('value',response.contact);
            $('input[name=std_code]').attr('value',response.stdcode);
            $('input[name=landline]').attr('value',response.landline);
            $('input[name=cname]').attr('value',response.companyname);
             $('#type_client').html(response.client_type); 
             $("#credit_deduction_basis").html(response.credit_deduction_basis);
             $("#plan_title").html(response.plan_title);
             if(response.is_active==0){
                $("#holdaccount1").html(`<i class="fa fa-play hold_account_icon"  title="Hold Account"></i>`);
                $("#holdaccount").html(`<i class="fa fa-play hold_account_icon"  title="Hold Account"></i>`);

                $("#hold_account_text").html("Are You Sure To remove the hold of This Account?")
             }
                        }
                    }).always(function(){
                        $("#loader").hide();
                        $(".tab-content").show();
                    });
                });
                </script>
                
                {{-- <script>
        $('li').click(function() { 
             $(this).parent().children('li').removeClass('active'); 
            $(this).addClass('active'); 
        });
                </script> --}}

                <script>
                $(".banaccount").on('click',function(e){
                    var user_id=$("input[name=user_id]").val();

                    e.preventDefault();
                    $.ajax({
                        'url':'/holdaccount',
                        'type':'post',
                        'data':'user_id='+user_id,
                        headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    							},
                        success:function(result){
                            
                            $('.modal').modal('toggle');
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
                        
                    });
                });
                </script>
               

</body>


</html>
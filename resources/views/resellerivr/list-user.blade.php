<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Reseller | List User</title>
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
	
	body.modal-open {
    overflow: visible;
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
                {{-- <h1 class="page-title">User List</h1> --}}
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/resellerivr"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">User List</li>
                </ol>
            </div><br>
			
			
             <form method="post">
			 <div class="ibox">
                        <div class="ibox-body">
                            <div class="row">
                            
                            <div class="col-md-4 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Client Type:</label>
                                       <select class="form-control" name="client_type" style="height:34px;">
											<option value=''>All</option>
											<option value="client">Client</option>
											<option value="reseller">Reseller</option>
											<option value="seller">Seller</option>
								        </select>
                                    </div>
				            </div>
							<div class="col-md-4 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Account Status:</label>
                                       <select class="form-control" name="account_status" style="height:34px;">
											<option value=''>All</option>
											<option value="0">Inactive</option>
											<option value="1">Active</option>
											
								        </select>
                            </div>
				            </div>
									<div class="col-md-4 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Search Profile:</label>
                                        <label>ID/Username</label>
                                        <input class="form-control" type="text" name="profile_search" placeholder="Search Profile">
                                    </div>
									</div>
							
							</div>
									
                                {{-- </div>
								 <div class="ibox-footer">
						<center> <button class="btn btn-danger btn-icon-only btn-circle btn-lg btn-air"><i class="fa fa-search" title="Search"></i></button>
						</center>
                        </div>
								
                        </div> --}}
                    </form>
					
					               

<ul class="nav nav-tabs">
<li class="active"><a data-toggle="tab" href="#client" style="color:#dd6a39;"><strong>Users</strong></a></li>
  </ul>

	 <div class="tab-content">
	 <div id="client">
	 
	 			  <div class="row">
                    <div class="col-xl-12">
                        <div class="ibox">
                            <div class="ibox-body">
							<div class="table-responsive">
								<table class="table table-head-purple mb-5">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Created By</th>
                                            <th>Client Type</th>
                                            <th>Registered at</th>
                                            <th>IVR Credit</th>
											<th>Pulse (sec)</th>
                                            <th>SMS Credit</th>
                                            <th>Validity</th>
                                            <th>Permissions</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="users_list">

                                        <!-- list here-->
                                    </tbody>
                                </table>
                                <center><img src="/images/loader.gif" id="loader">  </center> 

                                </div>
                            </div>
                        </div>
                    </div>
					</div>

				
	 
	 </div>
	
	 
	 
                               
                        
	 
	 </div>
           
                
            </div>
             <div class="sms_credit_modal">
                
				  </div>						
											
					
					
					<div class="obd_modal">
					    					
				  
					  
					</div>
									
											
											
					
					<div class="validity_modal">
					 
				 
				  </div>					
											
											
											
											
											
											
								
	</div>

			
    @include('resellerivr.layouts.footer')
    
    <script>
    
    $("select[name=client_type]").on("change",function(){
        var client_type=$("select[name=client_type]").val();
        var account_status=$("select[name=account_status").val();
        var profile_search=$("input[name=profile_search]").val();
        
       loadUsers(client_type,account_status,profile_search);
    });
    $("select[name=account_status]").on("change",function(){
        var client_type=$("select[name=client_type]").val();
        var account_status=$("select[name=account_status").val();
        var profile_search=$("input[name=profile_search]").val();
        
        loadUsers(client_type,account_status,profile_search);
    });
    $("input[name=profile_search]").on("keyup",function(){
        var client_type=$("select[name=client_type]").val();
        var account_status=$("select[name=account_status").val();
        var profile_search=$("input[name=profile_search]").val();
        
        loadUsers(client_type,account_status,profile_search);
    });
        
     
     $(function(){
         loadUsers();  
     });
     
      
    function loadUsers(client_type='',account_status='',profile_search=''){
        var data='client_type='+client_type+'&account_status='+account_status+'&profile_search='+profile_search;
        $('#loader').show();
        $.ajax({
            type:'post',
            url:'/reseller/listUsers',
            data:data,
            headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
            error:function(){
                $(".users_list").empty();
            },
            success:function(response){
				$(".users_list").empty();
                $.each(response,function(index,element){
				
                    $('.users_list').append(`
                    <tr>
                        <td>${element.id}<br></td>
                        <td>${element.username}<br></td>
                        <td>${element.created_by}</td>
                        <td>${element.client_type}</td>
                        <td>${element.created_at}</td>
                        <td><a href='#myobdpulseModal${element.id}' id='obdpulse' style='color:#dd6a39;' data-target='#myobdpulseModal${element.id}'>${element.ivr_credit}</a></td> 
                        <td>15</td> 
                        <td><a href='#mysmscreditModal${element.id}' id='smscredit' style='color:#dd6a39;' data-target='#mysmscreditModal${element.id}'>${element.sms_credit}</a></td>
                        <td><a href='#addvalidityModal${element.id}' id='addvalidity' style='color:#dd6a39;' data-target='#addvalidityModal${element.id}'>${element.validity}</a></td>
                        <td><a href='/user-permissions/${element.id}' style='color:#dd6a39;'><i class='fa fa-edit' title='Edit Profile'></i></a>&nbsp;&nbsp;</td>

                        <td><a href='/resellerivr/edit-user-pid?user_id=${element.id}' style='color:#dd6a39;'><i class='fa fa-edit' title='Edit Profile'></i></a>&nbsp;&nbsp;
                            <a href='/resellerivr/did-list?user_id=${element.id}' style='color:#dd6a39;'>
                                <i class='fa fa-file-text-o' title='DID List' ></i></a>&nbsp;&nbsp;
                            
                        </td>
                    </tr>`);
					
                    $('.sms_credit_modal').append(`
                    <div class='modal fade' id='mysmscreditModal${element.id}' role='dialog'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                 <div class='modal-header'>
                                     <h4 style='color:#f37335;' class='modal-title'>
                                        Add SMS Credit to User Account
                                    </h4>
                                    <button aria-label='Close' data-dismiss='modal' class='close' type='button'>
                                    <span aria-hidden='true'>×</span>
                                    </button>
                                </div> 
                            <div class='modal-body' > 
                                <div class='row'> 
                                    <div class='col-sm-12'> 
                                        <form id='sms_credit_form${element.id}' method='post' name='form_submit'> 
                                            <div class='row'>
                                                <div class='col-md-4'> 
                                                    <div class='form-group mb-4'> 
                                                        <label>User Name:</label> 
                                                        <input class='form-control' type='text' name='uname' value='${element.username}' readonly> 
                                                    </div>
                                                </div> 
                                            <div class='col-md-4'>
                                    <div class='form-group mb-4'> 
                                        <label>Profile ID:</label> 
                                        <input class='form-control' type='text' name='pid' value='${element.id}' readonly> 
                                        </div>
                                    </div>
                                    <div class='col-md-4'> 
                                        <div class='form-group mb-4'> 
                                            <label>Name:</label> 
                                            <input class='form-control' type='text' name='name' value='${element.name}' disabled> 
                                        </div>
                                    </div>
                                    <div class='col-md-6'> 
                                        <div class='form-group mb-4'> 
                                            <label>User Type:</label> 
                                            <input class='form-control' type='text' name='client_type' value='${element.client_type}' disabled> 
                                        </div>
                                    </div>
                                    <div class='col-md-6'> 
                                        <div class='form-group mb-4'> 
                                            <label>Add SMS Credit:</label> 
                                            <input class='form-control' type='number' name='add_sms_credit' value='0'> 
                                        </div>
                                    </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-offset-4 col-md-4 col-md-offset-4'>
                                            <center>
                                                <button class='btn btn-info btn-icon-only btn-circle btn-lg btn-air sms_credit_submit' type='submit' data-target='#sms_credit_form${element.id}'>
                                                    <i class='fa fa-check' title='Update'></i>
                                                </button> 
                                                <button class='btn btn-danger btn-icon-only btn-circle btn-lg btn-air' type='reset'>
                                                    <i class='fa fa-remove' title='Cancel'></i>
                                                </button>
                                            </center>
                                        </div>
                                    </div> 
                                    </form>
                                    </div> 
                                    </div> 
                                    </div> 
                                    </div> 
                                    <br> 
                                    </div>
                                     </div>`);
					
                    $('.obd_modal').append(`
                    
                    

<div class='modal fade' id='myobdpulseModal${element.id}' role='dialog'>

<div class='modal-dialog'> 
<!-- Modal content--> 

<div class='modal-content'> 

<div class='modal-header'> <h4 style='color:#f37335;' class='modal-title'>Add IVR Credit to User Account</h4><button aria-label='Close' data-dismiss='modal' class='close' type='button'>

<span aria-hidden='true'>×
</span></button>
</div> 

<div class='modal-body' > 

<div class='row'> 

<div class='col-sm-12'> 

<form id='obd_credit_form${element.id}' method='post' name='form_submit' > 

<div class='row'>

<div class='col-md-4'> 

<div class='form-group mb-4'> 
<label>User Name:
</label> 
<input class='form-control' type='text' name='uname' value='${element.username}' readonly> 
</div>
</div> 

<div class='col-md-4'> 

<div class='form-group mb-4'> 
<label>Profile ID:
</label> 
<input class='form-control' type='text' name='pid' value='${element.id}' readonly> 
</div>
</div>

<div class='col-md-4'> 

<div class='form-group mb-4'> 
<label>Name:
</label> 
<input class='form-control' type='text' name='name' value='${element.name}' disabled> 
</div>
</div>

<div class='col-md-6'> 

<div class='form-group mb-4'> 
<label>User Type:
</label> 
<input class='form-control' type='text' name='user_type' value='${element.client_type}' disabled> 
</div>
</div>

<div class='col-md-6'> 

<div class='form-group mb-4'> 
<label>Add IVR Credit:
</label> 
<input class='form-control' type='number' name='add_obd_credit' value='0'> 
</div>
</div>
</div>

<div class='row'>

<div class='col-md-offset-4 col-md-4 col-md-offset-4'><center><button class='btn btn-info btn-icon-only btn-circle btn-lg btn-air obd_credit_submit' type='submit'  data-target='#obd_credit_form${element.id}'><i class='fa fa-check' title='Update'></i></button> <button class='btn btn-danger btn-icon-only btn-circle btn-lg btn-air' type='reset'><i class='fa fa-remove' title='Cancel'></i></button></center>
</div>
</div>
</form>
</div> 
</div> 
</div> 
</div> 
<br> 
</div>
                    
`);
					
                    $('.validity_modal').append(`
                    

<div class='modal fade' id='addvalidityModal${element.id}' role='dialog'>

<div class='modal-dialog'> 
<!-- Modal content--> 
<div class='modal-content'> 

<div class='modal-header'> <h4 style='color:#f37335;' class='modal-title'>Enhance Validity to User Account</h4><button aria-label='Close' data-dismiss='modal' class='close' type='button'>

<span aria-hidden='true'>×
</span></button>
</div> 

<div class='modal-body' > 

<div class='row'> 

<div class='col-sm-12'> 

<form id='form_validity${element.id}' method='post' name='form_submit' > 

<div class='row'>

<div class='col-md-4'> 

<div class='form-group mb-4'> 
<label>User Name:
</label> 
<input class='form-control' type='text' name='uname' value='${element.username}' readonly> 
</div>
</div> 

<div class='col-md-4'> 

<div class='form-group mb-4'> 
<label>Profile ID:
</label> 
<input class='form-control' type='text' name='pid' value='${element.id}' readonly> 
</div>
</div>

<div class='col-md-4'> 

<div class='form-group mb-4'> 
<label>Name:
</label> 
<input class='form-control' type='text' name='name' value='${element.name}' disabled> 
</div>
</div>

<div class='col-md-6'> 

<div class='form-group mb-4'> 
<label>User Type:
</label> 
<input class='form-control' type='text' name='user_type' value='${element.client_type}' disabled> 
</div>
</div>

<div class='col-md-6'> 

<div class='form-group mb-4'> 
<label>Add Validity Days:
</label> 
<input class='form-control' type='number' name='add_validity' value='0'> 
</div>
</div>
</div>

<div class='row'>

<div class='col-md-offset-4 col-md-4 col-md-offset-4'><center><button class='btn btn-info btn-icon-only btn-circle btn-lg btn-air add_validity_submit' type='submit' data-target='#form_validity${element.id}'><i class='fa fa-check' title='Update'></i></button> <button class='btn btn-danger btn-icon-only btn-circle btn-lg btn-air' type='reset'><i class='fa fa-remove' title='Cancel'></i></button></center>
</div>
</div>
</form>
</div> 
</div> 
</div> 
</div> 
<br> 
</div> 
</div>
                    `);
				});
				
				
           
            }
            
        }).always(function(){
			$('#loader').hide();
		});
		
		 /* sms-credit modal submit */
                    $('.sms_credit_modal').on('click','button.sms_credit_submit',function(e) {
                        e.preventDefault();
                        var formid=$(this).attr('data-target');
                        console.log(formid);
                        var data = $(formid).serialize();
                        console.log(data);
                        
                        $.ajax({
                            url: '/UpdateSmsCredit',
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
                                $('.modal').modal('hide');
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
                    /* Update Validity modal submit */
                    $('.validity_modal').on('click','button.add_validity_submit',function(e) {
                        e.preventDefault();
                        var formid=$(this).attr('data-target');
                        var data = $(formid).serialize();
                        
                        
                        $.ajax({
                            url: '/UpdateValidity',
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
                                $('.modal').modal('hide');
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
	

    $('.obd_modal').on('click','button.obd_credit_submit',function(e) {
                        e.preventDefault();
                        var formid=$(this).attr('data-target');
                        console.log(formid);
                        var data = $(formid).serialize();
                        console.log(data);
                        
                        $.ajax({
                            url: '/UpdateIVRCredit',
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
                                $('.modal').modal('hide');
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
                }

    </script>
    
    
</body>


</html>
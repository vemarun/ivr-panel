@extends('admin_layouts.app')


@section('title')
    DID List
@endsection

@section('menu')
Source Number List For User ID <?=$_GET['user_id']; ?>
@endsection

@section('content')
        
<section class="panel panel-primary">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>

        <h2 class="panel-title">DID List</h2>
        <p class="panel-subtitle"><a class="mb-xs mt-xs mr-xs modal-with-move-anim btn btn-default" href="#modalAnim">Add DID</a></p>
    </header>
    <div class="panel-body">

								<table class="table table-head-purple mb-5">
                                    <thead>
                                        <tr>
                                            <th>Source Number</th>
                                            
                                            <th>Enabled</th>
                                            <th>Service Type</th>
                                            <th>Dialing Strategy</th>
                                            <th>Ring Time out</th>
                                            <th>Call Time Out</th>
                                            <th>Registered at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="append">
                                        <!-- Here api response will be injected -->
                                      
                                    </tbody>
                                </table>		
                                    <center><img src="/images/loader.gif" id="loader">  </center>	
    </div>
</section>
					<!--credit Modal starts	-->					
												 <!-- Modal -->
<div id="credit_modals"></div>
				 						
											
					<!--credit Modal ends	-->						
											
					
				
						<!--add validity Modal starts	-->	
<div id="validity_modals"></div>						
															
			
						<!--add validity Modal ends	-->							
											
											
					<!--renew plan Modal starts	-->							
											
<div id="renew_modals"></div>				
					<!--renew plan Modal ends	-->							
											
											
											
						<!--did hold modal-->
<div id="hold_modals"></div>

<div id="source_modal">

        <div class='modal fade' id='sourceModal' role='dialog'>
                <div class='modal-dialog'> 
                <!-- Modal content--> 
                <div class='modal-content'> 
                <div class='modal-header'  style="background:#140F6D;color:white !important"> 
                <h4 class='modal-title'>Forward Source Number To Application</h4> 
                <button aria-label='Close' data-dismiss='modal' class='close' type='button'>
                <span aria-hidden='true'>×</span></button> </div> <div class='modal-body'> 
                <div class='row'> <div class='col-sm-12'> 
                <!--form forward source number to application--> 
                <form id='source_form' action="post">
                <div class='row'> <div class='col-md-6'> 
                <div class='form-group mb-4'> 
                <label>Source Number:</label> 
                <input class='form-control' type='text' name='source_number' id='source_number' value="" readonly> 
                </div> </div> 
                <div class='col-md-6'> 
                <div class='form-group mb-4'> 
                <label>Service:<span style='color:#F98F33' id="service"></span></label> 
                <select class='form-control' name='service_type' id='service_type' style='height:34px;'>
                        <option value='' selected disabled>Change Service Type</option>
                        <option value='agent'>Agent</option>
                        <option value='misscall'>Miss Call</option>
                </select> 
                </div> </div> 
                <div class='col-md-6'> 
                <div class='form-group mb-4'> 
                <label>Dialing Strategy: <span style='color:#F98F33' id="dialing"></span></label>
               <select class='form-control' name='dialing_strategy' id='dialing-strategy' style='height:34px;'>
               <option value='' selected disabled>Change Strategy</option>
               <option value='parallel'>Parallel</option>
               <option value='sequence'>Sequence</option>
               <option value='round_robin'>Round Robin</option> </select> 
               </div> </div> 
               <div class='col-md-6'> <div class='form-group mb-4'> 
               <label>Enabled: <span style='color:#F98F33' id="enabled"></span></label> 
               <select class='form-control account_status' name='account_status' style='height:34px;'>
               <option value='' disabled selected>Enable/Disable</option>
               <option value='1'>True (1)</option><option value='0'>False (0)</option>
               </select> </div> </div> </div> 

               <div class="row">
               <div class='col-md-6'> <div class='form-group mb-4'>
               <label>Ring Time out: <span style='color:#F98F33' id="ring"></span></label>
               <select class='form-control' name='ring_time_out' id='ring_time_out' style='height:34px;'>
               <option value='' selected disabled>Change Ring Timeout</option>
               <option value='20'>20</option>
               <option value='25'>25</option>
               <option value='30'>30</option>
               </select>
               </div>
               </div>

               
               <div class='col-md-6'> <div class='form-group mb-4'>
               <label>Call Time out: <span style='color:#F98F33' id="call"></span></label>
               <select class='form-control' name='call_time_out' id='call_time_out' style='height:34px;'>
               <option value='' selected disabled>Change Call timeout</option>
               <option value='0'>Indefinite</option>
               <option value='30'>30</option>
               <option value='60'>60</option>
               <option value='90'>90</option>
               <option value='120'>120</option>
               </select>
               </div>
               </div>



               </div>  



               <div class='row'> <div class='col-md-offset-4 col-md-4 col-md-offset-4'> 
               <center> 
               <button class='btn btn-info btn-icon-only btn-circle btn-lg btn-air' id='source-no-form-submit' data-target='#source_form}'>
               <i class='fa fa-paper-plane' title='Save'></i></button> 
               <button class='btn btn-danger btn-icon-only btn-circle btn-lg btn-air' type='reset'><i class='fa fa-remove' title='Cancel'></i></button> </center> 
               </div> </div> </div> 
               </form> </div> </div> </div> <br> </div> </div> <!--modal for configuring sms ends-->


</div>
						<!--did hold modal-->
								
<!-- add did modal -->

<div id="modalAnim" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Add DID</h2>
        </header>
        <form id="basicform">
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-icon">
                    <i class="fa fa-phone"></i>
                </div>
                <div class="modal-text">
                    <div class="input-group mb-md">
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="button">DID</button>
                        </span>
                        <input type="text" class="form-control" name="contact">
                    </div>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary modal-confirm">Add</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </form>
    </section>
</div>

@endsection

     @section('scripts')
         
     <script>
    /*
	Modal Confirm
	*/
	$(document).on('click', '.modal-confirm', function (e) {
        e.preventDefault();
        var data=$('#basicform').serialize();
        var url_string = window.location.href;
                    var url = new URL(url_string);
                    var user_id = url.searchParams.get("user_id");
        $.ajax({
                            type:'post',
                            url:'/addDID',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                            data:data+'&user_id='+user_id,
                            success:function(result){

                                $.each(result, function(index, element) {
                                    
                                    new PNotify({
                                        title: 'Success!',
                                        text: element,
                                        type: 'success'
		                                });
                                            });
                                        },
                        
                            error: function(xhr, status, error) {
                                    
                                var err=$.parseJSON(xhr.responseText);
                                if(err.errors !== undefined){
                                    $.each(err.errors, function(index, element) {

                                        new PNotify({
                                        title: 'Error!',
                                        text: element,
                                        type: 'error'
		                                });
                                   
                               });
                            }
                                else {
                                    $.each(err, function(index, element) {
                                        
                                        new PNotify({
                                        title: 'Error!',
                                        text: element,
                                        type: 'error'
		                                });
                                   
                                    });
                                }
                                    
                            }
                        });
		$.magnificPopup.close();

		
	});
     </script>
     
			   
            

            <script>
            $("#append").on('click','button.source_edit',function(e){
                e.preventDefault();
                var source_number=$(this).attr("data-source_number");
                var title=$(this).attr("data-title");
                var dialing_strategy=$(this).attr("data-dialing_strategy");
                var account_status=$(this).attr("data-account_status");
                var ring_time_out=$(this).attr("data-ring_time_out");
                var call_time_out=$(this).attr("data-call_time_out");
                var service_type=$(this).attr("data-service_type");

                $("#sourceModal").find("input[name=source_number]").val(source_number);
                $("#sourceModal").find("input[name=pid]").val(title);
                $("#sourceModal").find("#dialing").html(dialing_strategy);
                $("#sourceModal").find("#enabled").html(account_status);
                $("#sourceModal").find("#ring").html(ring_time_out);
                $("#sourceModal").find("#call").html(call_time_out);
                $("#sourceModal").find("#service").html(service_type);
                $("#sourceModal").modal('show');
                
            })
            </script>

            <script>
             $('#source_modal').on('click','button#source-no-form-submit',function(e) {
                       e.preventDefault();
                        var data=$("#source_form").serialize();
                      
                         $.ajax({
                            url: '/forward-source-number',
                            type: 'post',   
							
							headers: {
        								
                                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                            data: data,

                            success: function(result) {
                                
                                    spop({
                                        template: result.message,
                                        autoclose: 5000,
                                        style: 'success'
                                    });
                                
                              
                            },
                             //////////////////////// reload div after ajax success
                             complete:function(){
                                 $('.modal').modal('hide');
                             },
                             ////////////////////////////////////
                             
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
                        return false;
                    });
            </script>


            <script>
                $(function() {
					
                    var user_id=<?= $_GET['user_id']; ?>;
                    var csrf_token = $('meta[name="csrf-token"]').attr('content');
                    
                    $.ajax({
                        type:'post',
                        url:'/getSourceNumberDetails/'+user_id,
                        headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
						error:function(xhr, status, error){
							var err=$.parseJSON(xhr.responseText);
										$('#append').append("<tr><td>"+err.message+"</td></tr>");
							
						},
                        success:function(response){
							
               					
                                $.each(response ,function (index,element){

                                    var showhold='Hold';
                                    if(element.status=='inactive'){
                                        showhold='Unhold'
                                    }
                                    
                                    
                                    $('#append').append(`
                                    <tr>
                                    <td>${element.source_number}</td>
                                    <!-- <td>${element.title}</td> -->
                                    <td>${element.enabled}</td>
                                    <td>${element.service_type}</td>
                                    <td>${element.dialing_strategy}</td>
                                    <td>${element.ring_time_out}</td>
                                    <td>${element.call_time_out}</td>
                                    <td>${element.created_at}</td>
                                    <td><button class='btn source_edit' data-source_number='${element.source_number}' data-title='${element.title}' data-account_status='${element.enabled}' data-service_type='${element.service_type}' data-dialing_strategy='${element.dialing_strategy}' data-ring_time_out='${element.ring_time_out}' data-call_time_out='${element.call_time_out}'><i class='fa fa-edit'></i></button></td>
                                    </tr>
                                    `);
                                    
                                });
                
                        }
                    }).always(function(){
                        $('#loader').hide();
                    });

                });
                    
                 
                        
                      
                   
                </script>
@endsection
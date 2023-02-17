<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <link href="../assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />

    <title>Reseller | Credit Transaction</title>
    
    @include('resellerivr.layouts.header')
        <!-- START SIDEBAR-->
    
    @include('resellerivr.layouts.side-header')
        <!-- END SIDEBAR-->
        <div class="wrapper content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
			     <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Credit Transaction Details</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/resellerivr"><i class="la la-home font-20"></i></a>
                    </li>
					 <li class="breadcrumb-item">
                        <a href="#">Reports</a>
                    </li>
                    <li class="breadcrumb-item">Credit Transaction Details</li>
                </ol>
            </div><br>
			
			 <div class="row">
				  
               
                    <div class="col-xl-12">
                        <div class="ibox">
						 
                            <div class="ibox-body">
							<div class="table-responsive">
								<table class="table table-head-purple mb-5">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>From</th>
                                            <th>To</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
										<form action="post" class="search_form">
                                         <td>
										 <select class="form-control" name="user_id" style="height: 35px;">
										 <option value=''>All</option>
											<!-- ajax data here -->
										  </select>
											
											</td>
                                            <td>
											<input class="form-control" type="date" name="from" >
											</td>
                                            <td>
											<input class="form-control" type="date" name="to" >
											</td>
                                            <td></td>
											<td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
											</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
					</div>
					
					
					
			 <div class="row">
				  
               
                    <div class="col-xl-12">
                        <div class="ibox">
						 
                            <div class="ibox-body">
							<div class="table-responsive">
								<table class="table table-head-purple mb-5">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>User</th>
                                            <th>Service</th>
                                            <th>Transaction Credit</th>
                                            <th>Transaction Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="trans">
                                     
                                    </tbody>
                                </table>
                                <center><img src="/images/loader.gif" id="loader">  </center>
                                </div>
                                
                            </div>
                        </div>
                    </div>
					</div>
               
					
					
					
               
                @include('resellerivr.layouts.footer')
                <script src="../assets/vendors/select2/dist/js/select2.full.min.js"></script>

				<script>
                
                $(document).ready(function() {
                        $('select[name=user_id]').select2();
                    });
                    
                $.ajax({
                    type:'post',
                    url:'/reseller/listUsers',
                    headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                    success:function(response){
                        
                        $.each(response,function(index,element){
                        $('select[name=user_id]').append(`
                        <option value='${element.id}'>${element.username}</option>`);
                        });
                        
                    }
                });
                
                function getdata(user_id='',from='',to=''){
                var sno=[];
                $('.trans').empty();
                $('#loader').show();  
                var data="user_id="+user_id+"&from="+from+"&to="+to;
                $.ajax({
                    type:'post',
                    url:'/admin/getTransactionDetails',
                    data:data,
                    headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                    success:function(response){
                        
                        
                        $.each(response,function(index,element){
                            $('.trans').append(`
                            <tr>
                            <td>${element.id}</td>
                            <td>${element.username}</td>
                            <td>${element.service}</td>
                            <td>${element.transaction_credit}</td>
                            <td>${element.created_at}</td>
                            
                            </tr>`);
                            
                            
                            
                        });
                        if(!response){
                            $('.trans').append("<tr><td>No results found.</td></tr>");
                        }
                    },
                    
                }).always(function(){
                  $('#loader').hide();  
                });
                }
                    
                getdata();
                
                $('select[name=user_id]').on('change',function(){
                    
                    var user_id=$('select[name=user_id]').val();
                    var from=$('input[name=from]').val();
                    var to=$('input[name=to]').val();
                    
                    getdata(user_id,from,to);
                });
                $('input[name=from]').on('change',function(){
                    
                    var user_id=$('select[name=user_id]').val();
                    var from=$('input[name=from]').val();
                    var to=$('input[name=to]').val();
                    
                    getdata(user_id,from,to);
                });
                $('input[name=to]').on('change',function(){
                    
                    var user_id=$('select[name=user_id]').val();
                    var from=$('input[name=from]').val();
                    var to=$('input[name=to]').val();
                    
                    getdata(user_id,from,to);
                });
                    
                </script>
</body>


</html>
@extends('admin_layouts.app')


@section('title')
    Credit Transactions
@endsection

@section('menu')
    Credit Transactions
@endsection

@section('content')
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>

        <h2 class="panel-title">Credit Transactions</h2>
        <p class="panel-subtitle"></p>
    </header>
    <div class="panel-body">

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
                                
					
					
					
			
								<table class="table table-head-purple mb-5">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>User</th>
                                            <th>Service</th>
                                            <th>Transaction Credit</th>
                                            <th>Transaction Date</th>
                                            <th>Transaction ID</th>
                                        </tr>
                                    </thead>
                                    <tbody class="trans">
                                     
                                    </tbody>
                                </table>
                                <center><img src="/images/loader.gif" id="loader">  </center>
                                
    </div>
</section>
    
                    @endsection					
					
					
               
@section('scripts')

				<script>
                 $(document).ready(function() {
                        $('select[name=user_id]').select2();
                    });
                
                $.ajax({
                    type:'post',
                    url:'/admin/listUsers',
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
                            <td>${element.transaction_id}</td>
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
    
    @endsection

@extends('layouts.app')


@section('title')
 Email Logs
@endsection

@section('menu')
Email Logs
@endsection

@section('content')
                           
                            <form method="post" class="form-generate-report" action="/sms-report">
                               @csrf
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>To:</label>
                                            <input type="email" class="form-control" name="email">
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-xs-12">
                                        <div class="form-group mb-4">
                                            <label>From:</label>
                                            <input type="date" class="form-control" name="from_date">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-xs-12">
                                        <div class="form-group mb-4">
                                            <label>To:</label>
                                            <input type="date" class="form-control" name="to_date">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>Status:</label>
                                            <select class="form-control" name="status" style="height:34px;">
											<option value="">All</option>
											<option value="answered">Delivered</option>
											<option value="no answer">Failed</option>
										  </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    

                                    

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>Records:</label>
                                            <select class="form-control" name="no_of_records" style="height:34px;">
											<option value="10">10</option>
											<option value="15">15</option>
											<option value="20">20</option>
											<option value="25">25</option>
											<option value="50">50</option>
											<option value="100">100</option>
										  </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air report-search" type="submit" name="search" value="search"><i class="fa fa-search" title="Search"></i></button>

                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div style="float:right;">
                                            <button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air download-data" type="submit" name="download" value="download"><i class="fa fa-download"></i></button> 
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </form>
                            
                            <!--form search report ends -->
                       

                            <section class="panel panel-featured panel-featured-primary">
                                    <header class="panel-heading">
                                        <div class="panel-actions">
                                            <a href="#" class="fa fa-caret-down"></a>
                                            <a href="#" class="fa fa-times"></a>
                                        </div>
                                
                                        <h2 class="panel-title">Email Logs</h2>
                                    </header>
                                    <div class="panel-body">
                        <table class="table table-head-purple mb-5">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>To</th>
                                    <th>Email Type</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                   </tr>
                            </thead>
                            @isset($reports)
                            <tbody class='reports_body'>
                                
                                @foreach ($reports as $report)
                                <tr>
                               <td>{{$report->id}}</td>
                               <td>{{$report->source_number}}</td>
                               <td>{{$report->senderid}}</td>
                               <td>{{$report->mobile}}</td>
                               <td>{{$report->message}}</td>
                               <td>{{$report->status}}</td>
                               <td>{{$report->delivered_time}}</td>
                               <td>{{$report->circle}}</td>
                                <td>{{$report->operator}}</td>
                               </tr>
                               @endforeach
                               

                            </tbody>
                           
                            
                            
                        </table>
                       {{$reports->links()}}
                       @endisset
                    </div>

                </section>
@endsection
                        
@section('scripts')

            <script>
            
                    $.ajax({
                        type:'post',
                        url:'/getClientSourceNumberDetail',
                        headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                        success:function(response){
                            $.each(response,function(index,element){
                                if(element.source_number!==undefined){
                            $(".source_number").append(`
                            <option value='${element.source_number}'>${element.source_number}</option>
                            `);
                            
                            }      
                                
                                else{
                                    $('.source_number').append("<option readonly selected>No Source Numbers found</option>");
                                }
                  
                            }); 
                        }     
                    });
                    
            
            </script>


@endsection

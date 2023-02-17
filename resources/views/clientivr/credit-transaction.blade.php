@extends('layouts.app')

@section('title')
   Billing 
@endsection

@section('menu')
    Billing | Credit Transactions
@endsection

@section('content')
    


           


                <div class="col-xl-12">
                    
                            <form method="post" name="dial_strategy" action="/credit-transaction">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        
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
                                    
                                </div>
                               

                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <center><button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air" type="submit"><i class="fa fa-search" title="Search"></i></button>
                                        </center>
                                    </div>
                                    <div class="col-md-4"></div>


                                </div>

                            </form>
                        </div>
                   

            <section class="panel panel-primary">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                            <a href="#" class="fa fa-times"></a>
                        </div>
                
                        <h2 class="panel-title">Credit Transactions</h2>
                    </header>
                    <div class="panel-body">
                        <table class="table mb-none source_table" id="datatable-default">
                        
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Service</th>
                                    <th>Transaction Date</th>
                                    <th>Transaction Time</th>
                                    <th>Transaction Credit</th>
                                </tr>
                            </thead>
                            @foreach($credits as $credit)
                            <tbody>
                                <tr>
                                   <?php $dt=Carbon::parse($credit->dateTime);?>
                                    <td>{{$credit->id}}</td>
                                    <td>{{$credit->service}}</td>
                                    <td>{{$dt->format('d.m.Y')}}</td>
                                    <td>{{$dt->format('H:m:s')}}</td>
                                    <td>{{$credit->transaction_credit}}</td>
                                </tr>

                            </tbody>
                            @endforeach
                        </table>
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

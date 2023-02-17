@extends('layouts.app')

@section('title')
    CRM
@endsection

@section('menu')
    CRM
@endsection
            
@section('content')
        
                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-default addnewcontact_btn" data-target="#addnewcontact"><i class="fa fa-plus"> Add New</i></button>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                    
                <input type="text" class="form-control mb-5" name="search" placeholder="Search">
                    
                    </div>
                </div>

                 <!-- Modal -->
                 <div class="modal fade" id="addnewcontact" tabindex="-1" role="dialog" aria-labelledby="phonebookModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:#140F6D;color:white !important">
                        <h5 class="modal-title">Save Caller or blacklist caller</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    <form class="form phonebook_form" id="addnewcontact_form">
                        <div class="modal-body">
                           
                                @csrf
                                <input type='hidden' value='${element.id}' name='id'>
                        <div class="row">
                            <div class="col-md-6">
                            <input type="text" class="form-control" name="caller_number" placeholder="Caller Mobile (optional)">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="caller_name" placeholder="Caller Name (optional)">
                            </div>
                            
                        </div>
                        <div class="row">
                                <div class="col-md-6 mt-2">
                                    <input type="text" class="form-control" name="caller_email" placeholder="Caller Email (optional)">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <input type="text" class="form-control" name="caller_address" placeholder="Caller Address (optional)">
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-md-4 mt-4" style="margin: 0 auto; text-align:center">
                                    Blacklist Caller : <input type="checkbox" class="form-control" name="caller_blacklist"></span> 
                                </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button class="btn btn-default add-contact" data-id="#addnewcontact_form" type="submit">Save</button>
                        </div>
                    </form>
                    </div>
                    </div>
                </div>
                
            
            <div class="row source_table">


                
                            <div class="table-responsive source_body">
                             
                            </div>

                            <center><img src="../images/loader.gif" id="loader">  </center>	
                            <!-- pagination -->
                                      
                            
            </div>
            <nav aria-label="..." class="navigaton">
                    <ul class="pagination pagination-lg">
                      
                    </ul>
                  </nav>
                <div class="edit-modal"></div>    

    @endsection               


@section('scripts')
               
            <script>
                $(".source_body").on('click','button.showmodal',function(e){
                    e.preventDefault();
                    var modal= $(this).attr('data-target');
                    $(modal).modal('show');
                });
                $(".addnewcontact_btn").on('click',function(e){
                    e.preventDefault();
                    var modal= $(this).attr('data-target');
                    $(modal).modal('show');
                });
                
                </script>
            
            <script>
                function refreshDiv(div){
                        $(div).load(location.href+ " "+div+">*","");
                        }
            function loadDiv(search='',page=''){
            $.ajax({
                url:'/getPhonebook',
                type:'post',
                headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                data:'search_term='+search+'&page='+page,
                success:function(response){
                    $('#loader').hide();
                    $(".source_body").empty();
                    $(".pagination").html("");
                    $.each(response.data,function(index,element){
                        if(element.blacklisted==1){
                            var blacklisted='Yes';
                            var checkbox='checked';
                            var trclass='table-danger';
                            var bg='bg-danger';
                        }
                        else{
                            var blacklisted='No';
                            var trclass='';
                            var checkbox='';
                            var bg='bg-tertiary';
                        }
                    $(".source_body").append(`
                    <div class="col-md-4 col-xl-4">
                                            <section class="panel">
                                                <header class="panel-heading ${bg}">
                                                    <div class="panel-heading-profile-picture">
                                                        <img src="assets/images/user.png">
                                                    </div>
                                                </header>
                                                <div class="panel-body" style="text-align:center">
                                                    <h4 class="text-semibold mt-sm">${element.caller_name}</h4>
                                                    <h6 class="text-semibold mt-sm">${element.caller_number} <a href="tel:${element.caller_number}"> <i class="fa fa-phone"></i></a></h6>
                                                    <h6 class="text-semibold mt-sm">Email: ${element.email}</h6>
                                                    <h6 class="text-semibold mt-sm">Company name and address: ${element.address}</h6>
                                                    <h6 class="text-semibold mt-sm">Remarks: ${element.remarks}</h6>
                                                    <hr class="solid short">
                                                    <p><a href="#"><i class="fa fa-calendar-o mr-xs"></i> Follow-up-calls</a>  |   Blacklisted: ${blacklisted}  |  Added: ${element.created_at}</p>
                                                    <button class='btn edit-contact showmodal' data-target="#phonebookModal${element.id}"><i class="fa fa-edit"></i></button>
                                                    <button class='btn delete-contact' data-id='${element.id}'><i class="fa fa-trash"></i></button>
                                                </div>
                                            </section>
                                        </div>
                        
                        
                    `);
                    $(".edit-modal").append(`
                    <!-- Modal -->
                               <div class="modal fade" id="phonebookModal${element.id}" tabindex="-1" role="dialog" aria-labelledby="phonebookModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background:#140F6D;color:white !important">
                                        <h5 class="modal-title">Save Caller or blacklist caller</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                    <form class="form phonebook_form" id="phonebook_form${element.id}">
                                        <div class="modal-body">
                                           
                                                @csrf
                                                <input type='hidden' value='${element.id}' name='id'>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="text" class="form-control" name="caller_number" placeholder="Caller Mobile (optional)" value="${element.caller_number}">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="caller_name" placeholder="Caller Name (optional)" value="${element.caller_name}">
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                                <div class="col-md-6 mt-2">
                                                    <input type="text" class="form-control" name="caller_email" placeholder="Caller Email (optional)" value="${element.caller_email}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <input type="text" class="form-control" name="caller_address" placeholder="Caller Address (optional)" value="${element.caller_address}">
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-4 mt-4" style="margin: 0 auto; text-align:center">
                                                    Blacklist Caller : <input type="checkbox" class="form-control" name="caller_blacklist" ${checkbox}></span> 
                                                </div>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button class="btn btn-default save-caller" type="submit" data-id="#phonebook_form${element.id}">Save</button>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                    `);


                    });
                    for(var i=1;i<=response.last_page;i++){
                    if(i==response.current_page){
                       $(".pagination").append(`<li class="page-item"><button class='btn btn-default' data-page='${i}' disabled>${i}</button></li>`);
                    }
                    else{
                        $(".pagination").append(`<li class="page-item"><button class='btn btn-default btn-pagination' data-page='${i}'>${i}</button></li>`);   
                    }
                        
                    }
                }
            });
            }
            loadDiv();

            $(".pagination").on('click','button.btn-pagination',function(){
                var search=$('input[name=search]').val();
                var page=$(this).attr('data-page');
                loadDiv(search,page);
            });

            $(".source_table").on('click','button.delete-contact',function(e){
                e.preventDefault();
                var id=$(this).attr('data-id');
            $.ajax({
                url:'/deleteContact',
                type:'post',
                headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                data:'id='+id,
                success:
                    function(result) {
                                
                                spop({
                                    template: result.message,
                                    autoclose: 5000,
                                    style: 'success'
                                });
                            
                          
                        },
                         //////////////////////// reload div after ajax success
                         complete:function(){
                             
                             refreshDiv('.source_body');
                             loadDiv();
                            
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
                
            });

          

            $('input[name=search]').on('keyup paste',function(){
                var search=$(this).val();
                
                loadDiv(search);
            });
            
            </script>

<script>
    $(".source_table").on('click','button.save-caller',function(e){
        e.preventDefault();
        var formid=$(this).attr('data-id');
        var data=$(formid).serialize();
        $.ajax({
            'url':'/editContact',
            'type':'post',
            'data':data,
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
            'success':function(result){
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
    </script>

    
    <script>
    $(".add-contact").on('click',function(e){
        e.preventDefault();
        var formid=$(this).attr('data-id');
        var data=$(formid).serialize();
        $.ajax({
            'url':'/saveCaller',
            'type':'post',
            'data':data,
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                },
            'success':function(result){
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
    </script>
    
            
 @endsection    

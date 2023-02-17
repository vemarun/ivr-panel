<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width initial-scale=1.0">
    

    <title>Reseller IVR | User Permissions</title>
    
    @include('admin.layouts.header')
    <!-- START SIDEBAR-->
    @include('admin.layouts.side-header')
    <!-- END SIDEBAR-->
    <!-- END SIDEBAR-->
    <div class="wrapper content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <!-- START PAGE CONTENT-->
            <div class="page-heading" style="display:inline-block">
                <h1 class="page-title" style="display:inline-block;">User Permissions @isset($permission) for user {{$permission->user->username}}@endisset</h1>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/admin"><i class="la la-home font-20"></i></a>
                    </li>
                <li class="breadcrumb-item">Permissions </li>
                </ol>

            </div><br>

            <div class="ibox">
                <div class="ibox-body">
                   
                    <div class="table-responsive widget">
                        <table class="table table-head-purple mb-5">
                            <thead>
                                <tr>
                                    <th>Permissions</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class='permissions_body'>
                               @isset($permission)
                            <input type="hidden" name="user_id" value="{{$permission->user->id}}">
                               
                               <tr>
                                    <td>Can add source number</td>
                                    <td><input type="checkbox" name="can_add_source_number" class="form-control" @if($permission->can_add_source_number==1)checked @endif></td>
                               </tr>
                               <tr>
                                    <td>Can change dialing strategy</td>
                                    <td><input type="checkbox" name="can_change_dialing_strategy" class="form-control" @if($permission->can_change_dialing_strategy==1)checked @endif></td>
                               </tr>
                               <tr>
                                    <td>Can see call answer time</td>
                                    <td><input type="checkbox" name="can_see_call_answer_time" class="form-control" @if($permission->can_see_call_answer_time==1)checked @endif></td>

                               </tr>
                               <tr>
                                    <td>Can see Conversation duration</td>
                                    <td><input type="checkbox" name="can_see_conv_duration" class="form-control" @if($permission->can_see_conv_duration==1)checked @endif></td>

                               </tr>
                               <tr>
                                    <td>Can see caller circle</td>
                                    <td><input type="checkbox" name="can_see_caller_circle" class="form-control" @if($permission->can_see_caller_circle==1)checked @endif></td>

                               </tr>
                               <tr>
                                    <td>Can see caller operator</td>
                                    <td><input type="checkbox" name="can_see_caller_operator" class="form-control" @if($permission->can_see_caller_operator==1)checked @endif></td>

                               </tr>
                               <tr>
                                    <td>Can see caller mobile</td>
                                    <td><input type="checkbox" name="can_see_caller_mobile" class="form-control" @if($permission->can_see_caller_mobile==1)checked @endif></td>

                               </tr>
                               <tr>
                                    <td>Can receive call report email</td>
                                    <td><input type="checkbox" name="can_receive_call_report_email" class="form-control" @if($permission->can_receive_call_report_email==1)checked @endif></td>

                               </tr>
                               <tr>
                                    <td>Can listen recording</td>
                                    <td><input type="checkbox" name="can_listen_recording" class="form-control" @if($permission->can_listen_recording==1)checked @endif></td>

                               </tr>
                                   
                               
                                   
                               @endisset
                               
                               
                              
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            
            @include('admin.layouts.footer')
            
            </body>
            <script>
            $("input[type=checkbox]").on('click',function(){
                var data=$(this).attr("name");
                if($(this).is(":checked")){
                    var status=1;
                }
                else{
                    var status=0;
                }
                var user_id=$("input[name=user_id]").val();
                $.ajax({
                    'url':'/edit-permission',
                    'type':'post',
                    headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                    'data':data+'='+status+"&user_id="+user_id,
                    'success':function(result) {
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
           
</html>

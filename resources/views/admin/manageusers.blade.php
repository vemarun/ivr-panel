<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <link href="../assets/vendors/dataTables/datatables.min.css" rel="stylesheet" />
    <link href="../assets/vendors/dataTables/Responsive-2.2.2/css/dataTables.responsive.min.css" rel="stylesheet">
    <link href="../assets/vendors/dataTables/Buttons-1.5.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="../assets/vendors/dataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="../assets/vendors/dataTables/Scroller-1.5.0/css/scroller.dataTables.min.css" rel="stylesheet">
   
    <title>root@admin | Manage Api Keys</title>
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
        .showonhover{
             color:transparent;
        }
        .showonhover:hover{
             color:black;
        }

  </style>
    @include('admin.layouts.header')
        <!-- START SIDEBAR-->
    @include('admin.layouts.side-header')
        <!-- END SIDEBAR-->
        <div class="wrapper content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
            
            <table id="ajaxlogs" class="display table table-bordered table-striped table-hover">
                <thead>
            <tr>
               <th>Id</th>
                <th>Username</th>
                <th>client_type</th>
                <th>is_active</th>
                <th>Last Activity</th>
                <th>IP Address</th>
                <th>Browser</th>
                <th>API token</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
            </table>
            <div class="showbuttons"></div>
            </div>
    </div>
    
   		@include('admin.layouts.footer')
  	@include('admin.layouts.footer')
    <script src="../assets/vendors/dataTables/datatables.min.js"></script>
           <script src="../assets/vendors/dataTables/Responsive-2.2.2/js/dataTables.responsive.min.js"></script>
            <script src="../assets/vendors/dataTables/Buttons-1.5.2/js/dataTables.buttons.min.js"></script>
            <script src="../assets/vendors/dataTables/Buttons-1.5.2/js/buttons.html5.min.js"></script>
            <script src="../assets/vendors/dataTables/Buttons-1.5.2/js/buttons.print.min.js"></script>
            <script src="../assets/vendors/dataTables/Select-1.2.6/js/dataTables.select.min.js"></script>
            <script src="../assets/vendors/dataTables/Scroller-1.5.0/js/dataTables.scroller.min.js"></script>

            <script>
            
                
    $('#ajaxlogs').DataTable({
      
        dom: 'Bflrtip',
        processing: true,
        serverSide: true,
        "responsive": true,
            "ajax": '{!! route('datatables.data') !!}',
                "columns": [
                { "data": "id" },
                { "data": "username" },
                { "data": "client_type"},
                { "data": "is_active"},
                {'data':"updated_at"},
                {"data": "ip_address"},
                {"data":"user_agent"},
                { "data": "api_token",
                    "className": "showonhover"},
                { "data": "created_at" },
                {"title":"Action","data":null}
                
              
              ],
        "columnDefs":[
    {
        "searchable": false,
        "orderable": false,
        "targets": 0
    },
    { 
      width: '3%', 
      targets: 0  
    },
    {  targets: -1, 
        data: null,
      
        defaultContent: '<div class="btn-group"> <button type="button" class="btn btn-info btn-xs user-ban" style="margin-right:16px;" title="Ban user" data-toggle="tooltip"><span class="glyphicon glyphicon-ban-circle glyphicon-info-sign" aria-hidden="true"></span></button>  <button type="button" class="btn btn-danger btn-xs user-revoke-api" title="Revoke / Reassign API Token" data-toggle="tooltip" style="margin-right:16px;"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></button></div>'
    },
    { orderable: false, searchable: false, targets: -1 } 
],
 
        select:true,
            buttons: [
            'copy', 'csv','print'
        ],
        });
                
    
        
      $(function(){
        $('#ajaxlogs').on('click','button.user-ban',function(){
            var user_id=$(this).closest('tr').find('td:first').html();
            var whichone= $(this);
            $(this).addClass('fa-spin');
            console.log(user_id);
           $.ajax({
                url:'/admin/ban/'+user_id,
                type:'post',
                headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                complete:function(){
                  whichone.removeClass('fa-spin'); 
               },
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
            });
          
          
          $('#ajaxlogs').on('click','button.user-revoke-api',function(){
            var user_id=$(this).closest('tr').find('td:first').html();
            var whichone= $(this);
            $(this).addClass('fa-spin');
            console.log(user_id);
           $.ajax({
                url:'/admin/revokeApiToken/'+user_id,
                type:'post',
                headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                complete:function(){
                  whichone.removeClass('fa-spin'); 
               },
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
            });
        });
        
             
    </script>
    
</body>


</html>
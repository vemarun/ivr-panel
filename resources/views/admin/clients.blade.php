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
   
    <title>Admin | List User</title>
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
                <th>user_id</th>
                <th>username</th>
                <th>client_type</th>
                <th>name</th>
                <th>email</th>
                <th>contact</th>
                <th>stdcode</th>
                <th>landline</th>
                <th>companyname</th>
                <th>created_by</th>
                <th>validity</th>
                <th>industry_type</th>
                <th>product_type</th>
                <th>price_slab</th>
                <th>sms_credit</th>
                <th>sms_plan</th>
                <th>call_rate</th>
                <th>sms_rate</th>
                <th>ivr_rate</th>
                <th>created_at</th>
            </tr>
        </thead>
            </table>
            <div class="showbuttons"></div>
            </div>
    </div>
    
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
        "responsive": true,
            "ajax": {
                "url": '/admin/listUsers',
                "type":'post',
                headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                "dataSrc":'',
                
            },
                "columns": [
                { "data": "user_id" },
                { "data": "username" },
                { "data": "client_type" },
                { "data": "name" },
                { "data": "email" },
                { "data": "contact" },
                { "data": "stdcode" },
                { "data": "landline" },
                { "data": "companyname" },
                { "data": "created_by" },
                { "data": "validity" },
                { "data": "industry_type" },
                { "data": "product_type" },
                { "data": "price_slab" },
                { "data": "sms_credit" },
                { "data": "sms_plan" },
                { "data": "call_rate" },
                { "data": "sms_rate" },
                { "data": "ivr_rate" },
                { "data": "created_at" }
              ],
        select:true,
        
            buttons: [
            'copy', 'csv','print'
        ]
       
        });
        
             
    </script>
</body>


</html>
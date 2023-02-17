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
   
    <title>root@admin | View Logs</title>
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
                <th>id</th>
                <th>user</th>
                <th>log</th>
                <th>url</th>
                <th>referer</th>
                <th>ip_address</th>
                <th>updated_at</th>
            </tr>
        </thead>
            </table>
            <div class="showbuttons">
                
            </div>
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
        processing: true,
        serverSide: true,
        "responsive": true,
            "ajax": '{!! route('admin.logs') !!}',
                "columns": [
                { "data": "id" },
                { "data": "user" },
                { "data": "log" },
                { "data": "url" },
                { "data": "referer" },
                { "data": "ip_address" },
                { "data": "created_at" },
                
              ],
            buttons: [
            'copy', 'csv','print'
        ]
       
        });


        
             
    </script>
</body>


</html>
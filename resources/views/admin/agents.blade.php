@extends('admin_layouts.app')
  

@section('title')
    Agents
@endsection

@section('header')
<link rel="stylesheet" href="../assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection

@section('menu')
    Agent List
@endsection
            
@section('content')

<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>

        <h2 class="panel-title">Basic</h2>
    </header>
    <div class="panel-body">
        <table id="ajaxlogs" class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
            <tr>
                <th>id</th>
                <th>Username</th>
                <th>source_number</th>
                <th>agent_name</th>
                <th>agent_destination</th>
                <th>is_active</th>
                <th>Total Calls</th>
                <th>created_at</th>
            </tr>
        </thead>
        
            </table>
            <div class="showbuttons"></div>
              
@endsection
    
@section('scripts')
<script src="../assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="../assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="../assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
            
            <script>
            
                
    $('#ajaxlogs').DataTable({
        
        processing: true,
        serverSide: true,
        
            "ajax": '{!! route('admin.agents') !!}',
                "columns": [
                { "data": "id" },
                { "data": "users.username" },
                { "data": "source_number" },
                { "data": "agent_name" },
                { "data": "agent_destination" },
                { "data": "is_active" },
                { "data": "total_calls" },
                { "data": "created_at" },
              ],
        
       
        });
        
             
    </script>
@endsection
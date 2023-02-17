<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use Response;

use App\logs;

class LogsController extends Controller
{
    
    public function index(logs $logs,Datatables $datatables)
    {
        //return Response::json($logs->getLogs(),200);
        return $datatables->collection($logs->get())->make(true);
    }
}

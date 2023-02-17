<?php

namespace App\Http\Controllers;

use App\smsReports;

use Auth;

use Response;

use Illuminate\Http\Request;

class SmsReportsController extends Controller
{
    /*generate report */
    public function generatereport(Request $request){
        
        
        $smsreport=new smsReports;
        
        $details=$request->all();

        $query=$smsreport->where('user_id',Auth::user()->id);

        if($request->filled('source_number'))
        {
            $query=$query->where('source_number','like','%'.$request->source_number.'%');
        }

        if($request->filled('mobile')){
            $query=$query->where('mobile','like','%'.$request->mobile.'%');
        }

        if($request->filled('senderid')){
            $query=$query->where('senderid','like','%'.$request->senderid.'%');
        }

        if($request->filled('from_date')){
            $query=$query->where('created_at','>=',$request->from_date.' 00:00:00');
        }

        if($request->filled('to_date')){
            $query=$query->where('created_at','<=',$request->to_date.' 00:00:00');
        }

        if($request->filled('status')){
            $query=$query->where('status','like','%'.$request->status.'%');
        }

        if($request->filled('no_of_records')){
            $reports=$query->paginate($request->no_of_records);
        }

        else
        {
            $reports=$query->orderBy('id','desc')->paginate(20);
        }
        
        if($request->has('search'))
        {
            return view('clientivr.sms-report',compact('reports'));
        }

        if($request->has('download')){
            $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=report.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];
    
        
        $list = $query->get()->toArray();
    
        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));
    
       $callback = function() use ($list) 
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, $row);
            }
            fclose($FH);
        };
    
        return Response::stream($callback, 200, $headers);
        }
        
        
        
        
        
        return view('clientivr.sms-report',compact('reports'));
		 
		 
        
    }
}

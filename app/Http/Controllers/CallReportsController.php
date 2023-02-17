<?php

namespace App\Http\Controllers;

use App\callReports;
use App\clientDetail;
use App\clientManageSources;
use App\Jobs\ReportDonloadLink;
use App\manageAgents;
use Auth;
use DB;
use Illuminate\Http\Request;
use Response;
use Session;

class CallReportsController extends Controller
{

    #[dmin panel get call report]
    public function getCallReports(Request $request, callReports $callreport)
    {

        if (!$request->filled('user_id')) {
            $user_id = '';
            $query = $callreport->where('user_id', 'like', '%' . $user_id . '%');

        } else {
            $user_id = $request->user_id;
            $query = $callreport->where('user_id', $user_id);

        }

        $details = $request->all();

        $query = $callreport->where('user_id', 'like', '%' . $user_id . '%');

        if ($request->filled('duration')) {
            $query = $query->where('duration', '>=', $details['duration']);
        }

        if ($request->filled('source_number')) {
            $query = $query->where('source_number', 'like', '%' . $request->source_number . '%');
        }

        if ($request->filled('mobile')) {
            $query = $query->where('caller_number', 'like', '%' . $request->mobile . '%');
            // ->orWhere('agent_number','like','%'.$request->mobile.'%');
        }

        if ($request->filled('from_date')) {
            $query = $query->where('start_time', '>=', $request->from_date . ' 00:00:00');
        }

        if ($request->filled('to_date')) {
            $query = $query->where('start_time', '<=', $request->to_date . ' 23:59:59');
        }

        if ($request->filled('status')) {
            $query = $query->where('call_status', 'like', '%' . $request->status . '%');
        }

        if ($request->filled('industry')) {
            $users = clientDetail::where('industry_type', $request->industry)->pluck('user_id')->toArray();
            $query->whereIn('user_id', $users);
        }

        if ($request->filled('product')) {
            $users = clientDetail::where('product_type', $request->product)->pluck('user_id')->toArray();
            $query->whereIn('user_id', $users);
        }

        if ($request->filled('price')) {
            $users = clientDetail::where('price_slab', $request->price)->pluck('user_id')->toArray();
            $query->whereIn('user_id', $users);
        }
        if ($request->filled('city')) {
            $users = clientDetail::where('city', $request->product)->pluck('city')->toArray();
            $query->whereIn('city', $users);
        }

        if ($request->has('download')) {
            $headers = [
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0'
                , 'Content-type' => 'text/csv'
                , 'Content-Disposition' => 'attachment; filename=report.csv'
                , 'Expires' => '0'
                , 'Pragma' => 'public',
            ];

            $list = $query->get()->toArray();

            # add headers for each column in the CSV download
            array_unshift($list, array_keys($list[0]));

            $callback = function () use ($list) {
                $FH = fopen('php://output', 'w');
                foreach ($list as $row) {
                    fputcsv($FH, $row);
                }
                fclose($FH);
            };

            return Response::stream($callback, 200, $headers);
        }

        if ($request->filled('no_of_records')) {
            $reports = $query->paginate($request->no_of_records);
        } else {
            $reports = $query->paginate(20);
        }

        return view('admin.call-reports', compact('reports'));

    }

    #[resellerivr report]
    public function getCallReports_reseller(Request $request, callReports $callreport)
    {

        if (!$request->filled('user_id')) {
            $user_id = '';
            $query = $callreport->where('user_id', 'like', '%' . $user_id . '%');

        } else {
            $user_id = $request->user_id;
            $query = $callreport->where('user_id', $user_id);

        }

        $details = $request->all();

        $query = $callreport->where('user_id', 'like', '%' . $user_id . '%');

        if ($request->filled('duration')) {
            $query = $query->where('duration', '>=', $details['duration']);
        }

        if ($request->filled('source_number')) {
            $query = $query->where('source_number', 'like', '%' . $request->source_number . '%');
        }

        if ($request->filled('mobile')) {
            $query = $query->where('caller_number', 'like', '%' . $request->mobile . '%')
                ->orWhere('agent_number', 'like', '%' . $request->mobile . '%');
        }

        if ($request->filled('from_date')) {
            $query = $query->where('start_time', '>=', $request->from_date . ' 00:00:00');
        }

        if ($request->filled('to_date')) {
            $query = $query->where('start_time', '<=', $request->to_date . ' 23:59:59');
        }

        if ($request->filled('status')) {
            $query = $query->where('call_status', 'like', '%' . $request->status . '%');
        }

        if ($request->has('download')) {
            $headers = [
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0'
                , 'Content-type' => 'text/csv'
                , 'Content-Disposition' => 'attachment; filename=report.csv'
                , 'Expires' => '0'
                , 'Pragma' => 'public',
            ];

            $list = $query->get()->toArray();

            # add headers for each column in the CSV download
            array_unshift($list, array_keys($list[0]));

            $callback = function () use ($list) {
                $FH = fopen('php://output', 'w');
                foreach ($list as $row) {
                    fputcsv($FH, $row);
                }
                fclose($FH);
            };

            return Response::stream($callback, 200, $headers);
        }

        if ($request->filled('no_of_records')) {
            $reports = $query->paginate($request->no_of_records);
        } else {
            $reports = $query->paginate(20);
        }

        return view('resellerivr.call-reports', compact('reports'));

    }

    /* download call report function csv format*/
    public function downloadcsv()
    {

        $headers = [
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0'
            , 'Content-type' => 'text/csv'
            , 'Content-Disposition' => 'attachment; filename=report.csv'
            , 'Expires' => '0'
            , 'Pragma' => 'public',
        ];

        $list = callReports::where('user_id', Auth::user()->id)->get()->toArray();

        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

        $callback = function () use ($list) {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers);

    }

/*generate report */
    public function generatereport(Request $request, callReports $callreport)
    {

        $details = $request->all();

        $source_number = Session::get('source_number');

        $query = $callreport->where('user_id', Auth::user()->id)->where('call_type', 'Inbound');

        if ($request->filled('duration')) {
            $query = $query->where('duration', '>=', $details['duration']);
        }

        if ($request->filled('source_number')) {
            $query = $query->where('source_number', 'like', '%' . $source_number . '%');
        }

        if ($request->filled('mobile')) {
            $query = $query->where('caller_number', 'like', '%' . $request->mobile . '%');
        }

        if ($request->filled('agent_number')) {
            $query = $query->where('agent_number', 'like', '%' . $request->agent_number . '%');
        }

        if ($request->filled('from_date')) {
            $query = $query->where('start_time', '>=', $request->from_date . ' 00:00:00');
        }

        if ($request->filled('to_date')) {
            $query = $query->where('start_time', '<=', $request->to_date . ' 23:59:59');
        }

        if ($request->filled('status')) {
            $query = $query->where('call_status', 'like', '%' . $request->status . '%');
        }

        if ($request->has('download')) {
            $headers = [
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0'
                , 'Content-type' => 'text/csv'
                , 'Content-Disposition' => 'attachment; filename=report.csv'
                , 'Expires' => '0'
                , 'Pragma' => 'public',
            ];

            $lists = $query->with('agent')->get();

            foreach ($lists as $list) {
                if (!empty($list->agent)) {
                    $agent_name = $list->agent->agent_name;
                } else {
                    $agent_name = '';
                }
                if (Auth::user()->permission->can_see_caller_mobile == 1) {
                    $caller_number = $list->caller_number;
                } else {
                    $caller_number = substr($list->caller_number, 0, -4) . 'xxxx';
                }
                $datas[] = [
                    'call_id' => $list->id,
                    'caller_number' => $caller_number,
                    'source_number' => $list->source_number,
                    'agent_number' => $list->agent_number,
                    'agent_name' => $agent_name,
                    'start_time' => $list->start_time,
                    'answer_time' => $list->answer_time,
                    'duration' => $list->duration,
                    'keypress' => $list->keypress,
                    'call_status' => $list->call_status,
                    'credit_deducted' => $list->credit_deducted,
                    'add_remark' => $list->add_remark,
                    'priority' => $list->priority,
                    'circle' => $list->circle,
                    'operator' => $list->operator,
                ];
            }
            # add headers for each column in the CSV download
            array_unshift($datas, array_keys($datas[0]));

            if (Auth::user()->permission->can_receive_call_report_email) {
                $uniqid = \uniqid();
                $path = public_path() . "/download/{$uniqid}";
                mkdir($path);
                $fp = fopen("{$path}/report.csv", "a+");
                foreach ($datas as $row) {
                    fputcsv($fp, $row);
                }
                fclose($fp);
                $detail = new \stdClass();
                $detail->link = "download/{$uniqid}/report.csv";
                $detail->name = Auth::user()->username;
                $detail->email = Auth::user()->clientDetail->email;

                dispatch(new ReportDonloadLink($detail));

            }

            $callback = function () use ($datas) {
                $FH = fopen('php://output', 'w');
                foreach ($datas as $row) {
                    fputcsv($FH, $row);
                }
                fclose($FH);
            };

            return Response::stream($callback, 200, $headers);
        }

        $count_results = $query->count();

        if ($request->filled('no_of_records')) {
            $reports = $query->orderBy('id', 'desc')->paginate($request->no_of_records);
        } else {
            $reports = $query->orderBy('id', 'desc')->paginate(10);
        }

        return view('clientivr.in-call-report', compact('reports', 'count_results'));

    }

    # [ admin ]
    protected function admin_CallReports(callReports $callreport)
    {
        if (Auth::user()->client_type != 'admin') {
            return Response::json(['message' => "Not allowed"], 404);
        } else {
            return Response::json($callreport->getalldata(), 201);
        }
    }

    public static function liveCallStream(Request $request)
    {

        $caller_number = $request->caller_number;

        header('Cache-Control: no-cache');
        header("Content-Type: text/event-stream");

        echo 'data: Caller Number ' . $caller_number . "\n\n";

        ob_end_flush();
        flush();

    }

    public function obdLogs(Request $request, callReports $callreport)
    {
        $details = $request->all();

        $source_number = Session::get('source_number');

        $query = $callreport->where('user_id', Auth::user()->id)->where('call_type', 'Outbound');

        if ($request->filled('duration')) {
            $query = $query->where('duration', '>=', $details['duration']);
        }

        if ($request->filled('source_number')) {
            $query = $query->where('source_number', 'like', '%' . $source_number . '%');
        }

        if ($request->filled('mobile')) {
            $query = $query->where('caller_number', 'like', '%' . $request->mobile . '%');
        }

        if ($request->filled('agent_number')) {
            $query = $query->where('agent_number', 'like', '%' . $request->agent_number . '%');
        }

        if ($request->filled('from_date')) {
            $query = $query->where('start_time', '>=', $request->from_date . ' 00:00:00');
        }

        if ($request->filled('to_date')) {
            $query = $query->where('start_time', '<=', $request->to_date . ' 23:59:59');
        }

        if ($request->filled('status')) {
            $query = $query->where('call_status', 'like', '%' . $request->status . '%');
        }

        if ($request->has('download')) {
            $headers = [
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0', 'Content-type' => 'text/csv', 'Content-Disposition' => 'attachment; filename=report.csv', 'Expires' => '0', 'Pragma' => 'public',
            ];

            $lists = $query->with('agent')->get();

            foreach ($lists as $list) {
                if (!empty($list->agent)) {
                    $agent_name = $list->agent->agent_name;
                } else {
                    $agent_name = '';
                }
                if (Auth::user()->permission->can_see_caller_mobile == 1) {
                    $caller_number = $list->caller_number;
                } else {
                    $caller_number = substr($list->caller_number, 0, -4) . 'xxxx';
                }
                $datas[] = [
                    'call_id' => $list->id,
                    'caller_number' => $caller_number,
                    'source_number' => $list->source_number,
                    'agent_number' => $list->agent_number,
                    'agent_name' => $agent_name,
                    'start_time' => $list->start_time,
                    'answer_time' => $list->answer_time,
                    'duration' => $list->duration,
                    'keypress' => $list->keypress,
                    'call_status' => $list->call_status,
                    'credit_deducted' => $list->credit_deducted,
                    'add_remark' => $list->add_remark,
                    'priority' => $list->priority,
                    'circle' => $list->circle,
                    'operator' => $list->operator,
                ];
            }
            # add headers for each column in the CSV download
            array_unshift($datas, array_keys($datas[0]));

            if (Auth::user()->permission->can_receive_call_report_email) {
                $uniqid = \uniqid();
                $path = public_path() . "/download/{$uniqid}";
                mkdir($path);
                $fp = fopen("{$path}/report.csv", "a+");
                foreach ($datas as $row) {
                    fputcsv($fp, $row);
                }
                fclose($fp);
                $detail = new \stdClass();
                $detail->link = "download/{$uniqid}/report.csv";
                $detail->name = Auth::user()->username;
                $detail->email = Auth::user()->clientDetail->email;

                dispatch(new ReportDonloadLink($detail));
            }

            $callback = function () use ($datas) {
                $FH = fopen('php://output', 'w');
                foreach ($datas as $row) {
                    fputcsv($FH, $row);
                }
                fclose($FH);
            };

            return Response::stream($callback, 200, $headers);
        }

        $count_results = $query->count();

        if ($request->filled('no_of_records')) {
            $reports = $query->orderBy('id', 'desc')->paginate($request->no_of_records);
        } else {
            $reports = $query->orderBy('id', 'desc')->paginate(10);
        }

        return view('clientivr.obd-logs', compact('reports', 'count_results'));
    }

    public function emailLogs()
    {
        //$reports="";
        return
        view('clientivr.email-logs');
    }

    /*****************************************
     *
     *     Client Dashboard data
     *
     **********************************************/
    public function CallSummaryReport(Request $request, clientManageSources $clientmanagesources, manageAgents $manageagents, callReports $callreports)
    {

        $data = $request->all();
        if ($request->filled('start_date')) {
            $start_date = $request->start_date;
            $year = date('Y', strtotime($start_date));
        } else {
            $start_date = date('Y-m-d');
            $year = date('Y');
        }
        if ($request->filled('end_date')) {
            $end_date = $request->end_date;
        } else {
            $end_date = date('Y-m-d');
        }

        $session_source_number = Session::get('source_number');
        $source_number = DB::table('client_manage_sources')->where('source_number', $session_source_number)->first();

        if (empty($source_number)) {
            $source_number_detail = [];
            return $source_number_detail;
        }

        $total_calls = $callreports->where('source_number', $source_number->source_number)
            ->whereDate('start_time', '>=', $start_date)
            ->whereDate('start_time', '<=', $end_date)
            ->count();

        $received_calls = $callreports->where('source_number', $source_number->source_number)
            ->whereDate('start_time', '>=', $start_date)
            ->whereDate('start_time', '<=', $end_date)
            ->where('conv_duration', '>', '0')
            ->count();

        // $missed_calls = $callreports->where('source_number', $source_number->source_number)
        //     ->whereDate('start_time', '>=', $start_date)
        //     ->whereDate('start_time', '<=', $end_date)
        //     ->where('conv_duration', '=', '0')
        //     ->count();

        $unique_calls = $callreports->where('source_number', $source_number->source_number)
            ->whereDate('start_time', '>=', $start_date)
            ->whereDate('start_time', '<=', $end_date)
            ->distinct('caller_number')
            ->count('caller_number');

        $monthWiseData = DB::select("select count(*) as count,
                                            DATE_FORMAT(`start_time`,'%M') as month from call_reports
                                            where source_number=$source_number->source_number
                                            and YEAR(start_time) =$year  group by month(start_time)");

        $regionWiseCall = DB::select("select count(operator) as data,
                                    circle as label from call_reports
                                    where date(start_time) >= '$start_date' and date(start_time)<='$end_date'
                                    group by circle");

        $operatorWiseCall = DB::select("select count(operator) as data,
                                        operator as label from call_reports
                                        where date(start_time) >= '$start_date' and date(start_time)<= '$end_date'
                                        group by operator ");

        $durationWiseCall = DB::select("select count(if(conv_duration<30,1,NULL)) '<30 secs',
                                               count(if(conv_duration>30 and conv_duration<60,1,NULL)) '30-60',
                                               count(if(conv_duration>60 and conv_duration<90,1,NULL)) '60-90',
                                               count(if(conv_duration>90 and conv_duration<120,1,NULL)) '90-120',
                                               count(if(conv_duration>120 and conv_duration<150,1,NULL)) '120-150',
                                               count(if(conv_duration>150 and conv_duration<180,1,NULL)) '150-180',
                                               count(if(conv_duration>180 and conv_duration<210,1,NULL)) '180-210',
                                               count(if(conv_duration>210 and conv_duration<240,1,NULL)) '210-240',
                                               count(if(conv_duration>240 and conv_duration<270,1,NULL)) '240-270',
                                               count(if(conv_duration>270 and conv_duration<300,1,NULL)) '270-300',
                                               count(if(conv_duration>300,1,NULL)) '>5 mins'
                                               from call_reports
                                               where date(start_time) >= '$start_date' and date(start_time)<='$end_date'
        ");

        $source_number_detail[] = [
            'source_number' => $source_number->source_number,
            'total_calls' => $total_calls,
            'received_calls' => $received_calls,
            // 'missed_calls' => $missed_calls,
            'region_wise_calls' => $regionWiseCall,
            'operator_wise_calls' => $operatorWiseCall,
            'unique_calls' => $unique_calls,
            'month_wise_data' => $monthWiseData,
            'duration_wise_calls' => $durationWiseCall,
        ];

        return $source_number_detail;
    }
}

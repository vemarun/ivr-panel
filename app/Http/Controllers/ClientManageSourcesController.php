<?php

namespace App\Http\Controllers;

use App\callReports;
use App\clientLogin;
use App\clientManageSources;
use App\group;
use App\logs;
use App\manageAgents;
use App\smstemplate;
use Auth;
use DB;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Response;
use Session;
use Yajra\Datatables\Datatables;

class ClientManageSourcesController extends Controller
{
    //get client's all did numbers
    public function index()
    {
        $source = DB::table('client_manage_sources')
            ->where('user_id', Auth::user()->id)
            ->get();

        if (!array_filter((array)$source)) {
            return Response::json([
                'message' => "This user doesn't have any source number registered"
            ], 200);
        } else {
            return Response::json(
                $source,
                200
            );
        }
    }

    public function forward_source_number(Request $request)
    {

        /** fetch all form data except _token field**/
        $detail = $request->all();

        /* Validate  */
        if (Auth::user()->client_type == 'client') {
            $this->validate(
                request(),
                ['source_number' => 'required|numeric|digits:10|exists:client_manage_sources,source_number,user_id,' . Auth::user()->id],
                ['source_number.exists' => 'Recheck entered source number']
            );
        }

        #find the source_number
        $source_number = clientManageSources::find($detail['source_number']);

        if ($request->filled('dialing_strategy')) {
            $source_number->dialing_strategy = $request->dialing_strategy;
        }
        if ($request->filled('pid')) {
            $source_number->title = $request->pid;
        }
        if ($request->filled('account_status')) {
            $source_number->enabled = $request->account_status;
        }
        if ($request->filled('ring_time_out')) {
            $source_number->ring_time_out = $request->ring_time_out;
        }
        if ($request->filled('call_time_out')) {
            $source_number->call_time_out = $request->call_time_out;
        }
        if ($request->filled('service_type')) {
            $source_number->service_type = $request->service_type;
        }

        $query = $source_number->save();

        /** api response if ok**/
        if ($query) {
            return Response::json([
                'message' => "Message Strategy has been Updated Successfully"
            ], 201);
        }

        /** in case error **/
        return Response::json([
            'message' => "Please Check submitted data"
        ], 422);
    }

    public function add_ring_group(Request $request)
    {

        /* Validate form data  */
        $this->validate(request(), [
            'ring_group_name' => 'required|max:20',
        ]);

        /** fetch all form data except _token field**/
        $detail = $request->except(['_token']);

        /* 2. if exists then update */
        $query = clientManageSources::where('user_id', Auth::user()->user_id)->where('source_number', $detail['source_number'])->update(['title' => $detail['ring_group_name'], 'dialing_strategy' => $detail['dialing_strategy']]);

        /** api response if ok**/
        if ($query) {
            return Response::json([
                'message' => "Dailing Strategy | Ring group has been updated Successfully"
            ], 201);
        }

        /** in case error **/
        return Response::json([
            'message' => "Something went wrong, please recheck all submitted data. Contact our support for further assistance."
        ], 422);
    }

    #function to add Source Number
    public function sendotp(Request $request)
    {

        if (Auth::user()->permission->can_add_source_number == 0) {
            return Response::json(['message' => 'You are not allowed to add source number. Contact our support to remove this limit.'], 400);
        }

        $this->validate(
            request(),
            ['contact' => 'numeric|digits:10|unique:client_manage_sources,source_number'],
            ['contact.unique' => 'This source number is already registered with us.']
        );

        $detail = $request->all();

        $source = new clientManageSources;

        $otp = $source->generateotp(6); //otp length

        $otptext = $otp . " is your IVR verification code for source number registration.";

        //save otp in db temporarily.
        $user = clientLogin::find(Auth::user()->id);
        $user->otp = $otp;
        $user->save();

        $url = "/api/pushsms.php?usr=622357&key=010B55VU0ElUkXGez68CCYNjkXPL9N&sndr=YSMSAP&ph=" . $detail['contact'] . "&text=" . $otptext . "&rpt=1";

        // GUZZLE http post
        $client = new Client();
        $res = $client->request('POST', $url);
        $status = $res->getStatusCode();
        // "200"
        $header = $res->getHeader('content-type');
        // 'application/json; charset=utf8'
        $body = $res->getBody();

        //guzzle stop

        $msg = "OTP sent to " . $detail['contact'];
        /*logs*/

        ########

        $logs = new logs;
        $logs->newlog($msg);

        ##########

        if ($status == 200) {
            return Response::json([
                'message' => $msg
            ], 200);
        } else {
            return Response::json([
                'message' => "Error occurred whIle sending otp. Contact our support for further help."
            ], 422);
        }
    }

    # prev-> verifyotp
    #addDID
    public function addDID(Request $request)
    {

        $this->validate(
            request(),
            ['contact' => 'numeric|digits:10|unique:client_manage_sources,source_number'],
            ['contact.unique' => 'This source number is already registered with us.']
        );

        $details = $request->all();
        #register new sno
        $source = new clientManageSources;
        $source->addSourceNumber($details['contact'], $details['user_id']);

        #create sms_template of this source number
        $smstemplate = new smstemplate;
        $smstemplate->newsourcenumber($details['contact'], $details['user_id']);

        $msg = "DID " . $details['contact'] . " registered Successfully.";

        /****/
        $logs = new logs;
        $logs->newlog($msg);
        /*****/

        return Response::json([
            'message' => $msg
        ], 200);
    }

    #get Client's SourceNumbers  and source number Detail
    public function getClientSourceNumberDetail()
    {
        $source = DB::table('client_manage_sources')
            ->where('user_id', Auth::user()->id)
            ->where('source_number', Session::get('source_number'))
            ->get();

        if (!array_filter((array)$source)) {
            return Response::json([
                'message' => "This user doesn't have any source number registered"
            ], 200);
        } else {
            return Response::json(
                $source,
                200
            );
        }
    }

    #delete source Number
    public function deleteClientSourceNumber(Request $request)
    {

        $detail = $request->all();

        $this->validate(
            request(),
            [
                'source_number' => 'required',
            ]
        );

        if (!array_key_exists('source_number', $detail) || empty($detail['source_number'])) {
            return Response::json([
                'message' => "Parameters missing, please recheck submitted data"
            ], 422);
        }

        $source_number = new clientManageSources;
        $status = $source_number->deleteSourceNumber($detail['source_number']); //delete source number

        $template = new smstemplate;
        $template->deleteSourceTemplate($detail['source_number']); //delete source_number's sms template

        $manageAgents = new manageAgents;
        $manageAgents->setSourceNumberNull($detail['source_number']);

        return Response::json([
            'message' => $status
        ], 200);
    }

    #[admin]
    protected function admin_sourcenumbers(clientManageSources $data, Datatables $datatables)
    {
        if (Auth::user()->client_type != 'admin') {
            return Response::json(['message' => "Not allowed"], 400);
        } else {
            return $datatables->collection($data->with('users')->get())->make(true);
        }
    }

    /*****************************************
     *
     *     Client Dashboard data
     *
     **********************************************/
    public function dashboardSourceNumberDetail(Request $request, manageAgents $manageagents, callReports $callreports, group $group)
    {

        if ($request->filled('start_date')) {
            $start_date = $request->start_date;
        } else {
            $start_date = date('Y-m-d');
        }
        if ($request->filled('end_date')) {
            $end_date = $request->end_date;
        } else {
            $end_date = date('Y-m-d');
        }
        $user_id = Auth::user()->id;
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

        $missed_calls = $callreports->where('source_number', $source_number->source_number)
            ->whereDate('start_time', '>=', $start_date)
            ->whereDate('start_time', '<=', $end_date)
            ->where('conv_duration', '=', '0')
            ->count();

        $unique_calls = $callreports->where('source_number', $source_number->source_number)
            ->whereDate('start_time', '>=', $start_date)
            ->whereDate('start_time', '<=', $end_date)
            ->distinct('caller_number')
            ->count('caller_number');

        $inbound_calls = $callreports->where('source_number', $source_number->source_number)
            ->whereDate('start_time', '>=', $start_date)
            ->whereDate('start_time', '<=', $end_date)
            ->where('call_type', 'Inbound')
            ->count();

        $outbound_calls = $callreports->where('source_number', $source_number->source_number)
            ->whereDate('start_time', '>=', $start_date)
            ->whereDate('start_time', '<=', $end_date)
            ->where('call_type', 'Outbound')
            ->count();

        // $lastsevendays = DB::select("select count(IF(conv_duration>0,1,NULL)) 'received_call',
        //                                     COUNT(IF(conv_duration=0,1,NULL)) 'missed_call',
        //                                     date(start_time) as date from call_reports
        //                                     where source_number=$source_number->source_number
        //                                     and (date(start_time) >= DATE_SUB('$end_date',
        //                                     INTERVAL 7 DAY)) group by date(start_time)");

        $lastsevendays = DB::select("select count(IF(conv_duration>0,1,NULL)) 'received_call',
                                            COUNT(IF(conv_duration=0,1,NULL)) 'missed_call',
                                            date(start_time) as date from call_reports
                                            where source_number=$source_number->source_number
                                            group by date(start_time) limit 10");

        $groups = $group->where('user_id', $user_id)
            ->where('source_number', $source_number->source_number)
            ->with('agents')
            ->get();
        $g = [];
        foreach ($groups as $group) {
            $count = 0;
            foreach ($group->agents as $agent) {
                $count += $agent->call_count($start_date, $end_date);
            }
            $g[$group->group_name] = $count;
        }

        $source_number_detail[] = [
            'source_number' => $source_number->source_number,
            'agent_count' => $manageagents->where('source_number', $source_number->source_number)->count(),
            'total_calls' => $total_calls,
            'received_calls' => $received_calls,
            'missed_calls' => $missed_calls,
            'unique_calls' => $unique_calls,
            'inbound_calls' => $inbound_calls,
            'outbound_calls' => $outbound_calls,
            'last_seven_days_data' => $lastsevendays,
            'groups' => $g,
        ];

        return $source_number_detail;
    }

    public function getRecentCalls(Request $request, callReports $callreports)
    {

        $recentCalls = $callreports->where('user_id', Auth::user()->id)
            ->where('source_number', Session::get('source_number'))
            ->orderBy('id', 'desc')
            ->take(6)->get();

        foreach ($recentCalls as $recentCall) {
            if (empty($recentCall->agent->agent_name)) {
                $agent_name = "";
            } else {
                $agent_name = $recentCall->agent->agent_name;
            }

            $calls[] = [
                'caller_number' => $recentCall->caller_number,
                'agent_number' => $recentCall->agent_number,
                'agent_name' => $agent_name,
                'start_time' => $recentCall->start_time,
                'call_status' => $recentCall->call_status,
                'call_type' => $recentCall->call_type,
            ];
        }

        return $calls;
    }
}

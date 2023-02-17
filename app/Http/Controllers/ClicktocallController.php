<?php

namespace App\Http\Controllers;

use App\clicktocall;
use App\clientManageSources;
use App\manageAgents;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;

class ClicktocallController extends Controller
{
    public function clickToCall(Request $request, manageAgents $manageAgents, clicktocall $clicktocall)
    {
        $this->validate($request, [
            'caller_number' => 'required|min:10|max:12',
            'agent_number' => 'required|min:10|max:12',
        ]);

        $source_number = Session::get('source_number');
        $caller_number = $request->caller_number;
        $agent_number = $request->agent_number;
        $user_id = Auth::user()->id;

        $source = clientManageSources::find($source_number);
        $call_time_out = $source->call_time_out;
        $ring_time_out = $source->ring_time_out;

        $credit_deduction_basis = Auth::user()->credit_deduction_basis;
        $ivr_plan = Auth::user()->ivr_plan;

        $series = substr($caller_number, 0, 4);
        $series_detail = DB::select("select circle,operator from mobile_series where series={$series}");

        if (count($series_detail) == 0) {
            $circle = "Unknown";
            $operator = "Unknown";
        } else {
            $operator = $series_detail[0]->operator;
            $circle = $series_detail[0]->circle;
        }

        if ($manageAgents->where('user_id', Auth::user()->id)->where('source_number', $source_number)->where('agent_destination', $agent_number)->exists()) {
            $clicktocall->user_id = Auth::user()->id;
            $clicktocall->caller_number = $caller_number;
            $clicktocall->agent_number = $agent_number;
            $clicktocall->save();

            $client = new \GuzzleHttp\Client();
            $post_url = "http://180.179.198.236/click2call.php?auth=GtyasF49TkKlo0A5zn&user_id=$user_id&source_number=$source_number&caller_number=$caller_number&agent_number=$agent_number&call_time_out=$call_time_out&ring_time_out=$ring_time_out&credit_deduction_basis=$credit_deduction_basis&ivrplan=$ivr_plan&circle=$circle&operator=$operator";

            $result = $client->request('GET', $post_url);

            return response()->json(['message' => 'Your request has been received', $result->getBody(), $post_url], 200);
        } else {
            return Response::json(['message' => 'We are unable to validate your request'], 400);
        }

    }
}

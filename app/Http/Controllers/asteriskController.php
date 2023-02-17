<?php

namespace App\Http\Controllers;

use App\clientLogin;
use App\clientManageSources;
use App\group;
use App\ivrTemplate;
use App\manageAgents;
use App\phonebook;
use App\recordings;
use DB;
use Illuminate\Http\Request;
use Response;

class asteriskController extends Controller
{

    public function getAgents(Request $request, clientManageSources $sources, manageAgents $agents, clientLogin $login, recordings $recordings, phonebook $phonebook, group $group)
    {

        if (!$request->has('token')) {
            return Response::json(['message' => "Token is required", 'status' => 'invalid'], 400);
        }

        if ($request->token != 'AvT562RfomnUi90IhyTgg') {
            return Response::json(['message' => "Invalid Token", 'status' => 'invalid'], 400);
        }

        if (!$request->has('source_number')) {
            return Response::json(['message' => "Source number is required", 'status' => 'invalid'], 400);
        }

        if (!$request->has('caller_number')) {
            return Response::json(['message' => "Caller number is required", 'status' => 'invalid'], 400);
        }

        if ($phonebook->where('caller_number', $request->caller_number)->where('blacklisted', 1)->exists()) {
            return Response::json(['message' => "Caller Number Blacklisted", 'status' => 'invalid'], 400);
        }

        $series = substr($request->caller_number, 0, 4);
        $series_detail = DB::select("select circle,operator from mobile_series where series={$series}");

        if (count($series_detail) == 0) {
            $caller = [
                'caller_number' => $request->caller_number,
                'circle' => "unknown",
                'operator' => "unknown",
            ];
        } else {
            $operator = $series_detail[0]->operator;
            $circle = $series_detail[0]->circle;
            $caller = [
                'caller_number' => $request->caller_number,
                'circle' => $circle,
                'operator' => $operator,
            ];
        }

        $source_number = DB::table('client_manage_sources')->where('source_number', $request->source_number)->first();

        if (empty($source_number) || $source_number == null) {
            return Response::json(['message' => "Source number not found", 'status' => 'invalid'], 400);
        }

        $dialing_strategy = $source_number->dialing_strategy;
        $ring_time_out = $source_number->ring_time_out;
        $call_time_out = $source_number->call_time_out;
        $service_type = $source_number->service_type;
        $user_id = $source_number->user_id;

        //ivr template
        $template = ivrTemplate::where('source_number', $request->source_number)
            ->where('status', 1)
            ->first();

        if (!$template) {
            return Response::json(['message' => "Template not assigned", 'status' => 'invalid'], 400);
        }

        $options = [
            'source_number' => $request->source_number,
            'ring_time_out' => $ring_time_out,
            'call_time_out' => $call_time_out,
            'dialing_strategy' => $dialing_strategy,
            'user_id' => $user_id,
            'template' => $template->id,
            'template_json' => $template->templates
        ];

        $user = $login->find($user_id);
        $ivr_credit = $user->ivr_credit;
        $credit_deduction_basis = $user->credit_deduction_basis;
        $ivr_plan = $user->ivr_plan;

        $credits = [
            'ivr_plan' => $ivr_plan,
            'deduction_basis' => $credit_deduction_basis,
        ];

        if ($ivr_credit <= 0) {
            return Response::json(['message' => "Not Enough Credit", 'status' => 'invalid'], 400);
        }

        $is_active = $user->is_active;
        if ($is_active != 1) {
            return Response::json(['message' => "Account Inactive", 'status' => 'invalid'], 400);
        }

        //get groups and agents
        $groups = $group->where('source_number', $source_number->source_number)
            ->where('is_active', 1)
            ->get();
        $agent_destination = [];
        foreach ($groups as $g) {
            if ($dialing_strategy == 'round_robin') {
                $agent_destination[$g->group_name] = manageAgents::where('source_number', $source_number->source_number)
                    ->where('is_active', 1)
                    ->where('call_status', 0)
                    ->where('group_id', $g->id)
                    ->pluck('agent_destination');
            } else if ($dialing_strategy == 'sequence') {
                $agent_destination[$g->group_name] = manageAgents::where('source_number', $source_number->source_number)
                    ->where('is_active', 1)
                    ->where('call_status', 0)
                    ->where('group_id', $g->id)
                    ->orderBy('today_inbound_calls', 'asc')
                    ->pluck('agent_destination');
            } else {
                $agent_destination[$g->group_name] = manageAgents::where('source_number', $source_number->source_number)
                    ->where('is_active', 1)
                    ->where('group_id', $g->id)
                    ->pluck('agent_destination');
            }
        }

        $keypress_clips = $recordings->where('source_number', $request->source_number)
            ->where('template_id', $template->id)
            ->get();
        foreach ($keypress_clips as $k) {
            $clips[$k->sequence] = basename($k->path);
        }

        return Response::json([
            'agents' => $agent_destination,
            'clips' => $clips,
            'options' => $options,
            'credits' => $credits,
            'caller' => $caller,
            'status' => 'valid',
        ], 200);
    }

    public function getCallRecording(Request $request)
    {

        if (!$request->has('token')) {
            return Response::json(['message' => "Token is required", 'status' => 'invalid'], 400);
        }

        if ($request->token != 'AvT562RfomnUi90IhyTgg') {
            return Response::json(['message' => "Invalid Token", 'status' => 'invalid'], 400);
        }

        if (!$request->has('recording')) {
            return Response::json(['message' => 'Recording file is required', 'status' => 'required'], 400);
        }

        $file = $request->recording;

        $path = public_path() . '/call_recordings';

        $file->move($path, $file->getClientOriginalName());

        return Response::json(['message' => 'Recording Received', 'status' => 'valid'], 200);
    }
}

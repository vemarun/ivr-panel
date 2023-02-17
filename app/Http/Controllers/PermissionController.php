<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\permission;
use Response;
use Auth;

class PermissionController extends Controller
{
    public function edit(Request $request, permission $permission)
    {
        $this->validate($request, [
            'user_id' => 'required',
        ]);
        $user = $permission->find($request->user_id);

        if (Auth::user()->client_type != 'admin') {
            if ($user->user->created_by != Auth::user()->id) {
                return Response::json(['message' => 'Not your client'], 400);
            }
        }

        if ($request->filled('can_add_source_number')) {
            $user->can_add_source_number = $request->can_add_source_number;
            $user->save();
            return Response::json(['message' => 'User can add source number permission modified'], 200);
        }
        if ($request->filled('can_change_dialing_strategy')) {
            $user->can_change_dialing_strategy = $request->can_change_dialing_strategy;
            $user->save();
            return Response::json(['message' => 'User can_change_dialing_strategy permission modified'], 200);
        }
        if ($request->filled('can_see_call_answer_time')) {
            $user->can_see_call_answer_time = $request->can_see_call_answer_time;
            $user->save();
            return Response::json(['message' => 'User can_see_call_answer_time modified'], 200);
        }
        if ($request->filled('can_see_conv_duration')) {
            $user->can_see_conv_duration = $request->can_see_conv_duration;
            $user->save();
            return Response::json(['message' => 'User can_see_conv_duration modified'], 200);
        }
        if ($request->filled('can_see_caller_circle')) {
            $user->can_see_caller_circle = $request->can_see_caller_circle;
            $user->save();
            return Response::json(['message' => 'User can_see_caller_circle permission modified'], 200);
        }
        if ($request->filled('can_see_caller_operator')) {
            $user->can_see_caller_operator = $request->can_see_caller_operator;
            $user->save();
            return Response::json(['message' => 'User can_see_caller_operator permission modified'], 200);
        }
        if ($request->filled('can_see_caller_mobile')) {
            $user->can_see_caller_mobile = $request->can_see_caller_mobile;
            $user->save();
            return Response::json(['message' => 'User can_see_caller_mobile permission modified'], 200);
        }
        if ($request->filled('can_receive_call_report_email')) {
            $user->can_receive_call_report_email = $request->can_receive_call_report_email;
            $user->save();
            return Response::json(['message' => 'User can_receive_call_report_email permission modified'], 200);
        }
        if ($request->filled('can_listen_recording')) {
            $user->can_listen_recording = $request->can_listen_recording;
            $user->save();
            return Response::json(['message' => 'User can_listen_recording permission modified'], 200);
        }
        if ($request->filled('recording_keyword_mapping')) {
            $user->recording_keyword_mapping = $request->recording_keyword_mapping;
            $user->save();
            return Response::json(['message' => 'User send_recording_text_to_url permission modified'], 200);
        }
        if ($request->filled('send_recording_text_to_url')) {
            $user->send_recording_text_to_url = $request->send_recording_text_to_url;
            $user->save();
            return Response::json(['message' => 'User send_recording_text_to_url permission modified'], 200);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\clientsetting;

use Session;

use Auth;

use Response;

use Illuminate\Http\Request;

class ClientsettingController extends Controller
{
    public function saveRecordingTextUrl(Request $request, clientsetting $setting)
    {
        $this->validate($request, [
            'recording_text_url' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $source_number = Session::get('source_number');

        $csetting = $setting->where('user_id', $user_id)->where('source_number', $source_number)->first();


        if ($request->filled('recording_text_url')) {
            if (!$csetting) {
                $setting->user_id = $user_id;
                $setting->source_number = $source_number;
                $setting->recording_text_url = $request->recording_text_url;
                $setting->save();
            } else {
                $csetting->recording_text_url = $request->recording_text_url;
                if ($request->filled('recording_text_url_method')) {
                $csetting->recoring_text_url_method = $request->recording_text_url_method;
                }
                $csetting->save();
            }
        } else {
            return Response::json(['message' => 'URL missing'], 400);
        }

        


        $csetting->save();
        return Response::json(['message' => 'Entered url saved'], 200);
    }


    public function saveRecordingKeywords(Request $request, clientsetting $setting)
    {
        $this->validate($request, [
            'keywords' => 'required'
        ]);

        $user_id = Auth::user()->id;
        $source_number = Session::get('source_number');

        $csetting = $setting->where('user_id', $user_id)->where('source_number', $source_number)->first();

        $keywords = $request->keywords;


        if ($request->filled('keywords')) {
            if (!$csetting) {
                $setting->user_id = $user_id;
                $setting->source_number = $source_number;
                $setting->recording_keywords = $keywords;
                $setting->save();
            } else {
                $csetting->recording_keywords = $keywords;
            }
        } else {
            return Response::json(['message' => 'Keywords missing'], 400);
        }


        $csetting->save();
        return Response::json(['message' => 'Entered keywords saved'], 200);
    }
}

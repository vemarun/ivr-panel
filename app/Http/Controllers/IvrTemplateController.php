<?php

namespace App\Http\Controllers;

use App\ivrTemplate;
use App\recordings;
use Auth;
use Illuminate\Http\Request;
use Response;
use Session;

class IvrTemplateController extends Controller
{
    public function get()
    {
        $template = ivrTemplate::with('recordings')->where('user_id', Auth::user()->id)
            ->where('source_number', Session::get('source_number'))
            ->get();

        return response()->json($template, 200);
    }

    public function save(Request $request, ivrTemplate $ivr)
    {
        $this->validate($request, [
            'template' => 'required',
        ]);
        $data = $request->except('_token');

        $clips = recordings::where('template_id', $data['template'])
            ->where('user_id', Auth::user()->id)
            ->where('source_number', Session::get('source_number'))
            ->whereNull('path')
            ->get();

        if ($clips->count() == 0) {

            $ivr->where('user_id', Auth::user()->id)
                ->where('source_number', Session::get('source_number'))
                ->where('status', 1)
                ->update(['status' => 0]);

            $ivr_id = $ivr->where('user_id', Auth::user()->id)
                ->where('source_number', Session::get('source_number'))
                ->where('id', $data['template'])
                ->update(['status' => 1]);

            return Response::json(['message' => 'Template saved and activated'], 200);
        } else {
            return Response::json(['message' => 'Please upload all required clips before saving this template'], 400);
        }
    }

    public function show(ivrTemplate $ivrTemplate, $id)
    {
        $templates = ivrTemplate::with('recordings')->where('user_id', $id)
            ->get();

        $user_id = $id;
        return view('admin.user-templates', compact('templates', 'user_id'));
    }

    public function newTemplate(ivrTemplate $ivrTemplate, Request $request)
    {
        $this->validate($request, [
            'template_name' => 'required',
            'source_number' => 'required',
            'no_of_recordings' => 'required',
            'user_id' => 'required'
        ]);

        if ($ivrTemplate->where('template_name', $request->template_name)->exists()) {
            return Response::json(['message' => 'Template name already exists'], 400);
        }

        $ivrTemplate->user_id = $request->user_id;
        $ivrTemplate->template_name = $request->template_name;
        $ivrTemplate->source_number = $request->source_number;
        $ivrTemplate->no_of_recordings = $request->no_of_recordings;
        $ivrTemplate->user_id = $request->user_id;
        $template_id = $ivrTemplate->save();

        for ($i = 1; $i <= $request->no_of_recordings; $i++) {
            $recordings = new recordings;
            $recordings->user_id = $request->user_id;
            $recordings->source_number = $request->source_number;
            $recordings->sequence = $i;
            $recordings->template_id = $ivrTemplate->id;
            $recordings->save();
        }
        return Response::json(['message' => 'New Template created'], 200);
    }


    public function recordings(recordings $recordings, $templateid)
    {
        $recordings = $recordings->where('template_id', $templateid)->get();

        return $recordings;
    }

    public function edit(Request $request, ivrTemplate $ivrTemplate, $id)
    {
        $this->validate($request, [
            'template_id' => 'required'
        ]);

        $template = $ivrTemplate->where('id', $request->template_id)->first();
        if ($request->filled('no_of_recordings')) {
            $template->no_of_recordings = $request->no_of_recordings;
        }
        if ($request->has('template_json')) {
            $template->templates = $request->template_json;
        }
        if ($template->save()) {
            return Response::json(['message' => 'Template saved'], 200);
        } else {
            return Response::json(['message' => 'Some unknown error has occurred'], 400);
        }
    }
}

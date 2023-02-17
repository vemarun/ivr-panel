<?php

namespace App\Http\Controllers;

use App\ivrTemplate;
use App\recordings;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Response;
use Session;
use function GuzzleHttp\json_decode;

class RecordingsController extends Controller
{

    public function index()
    {

        $recordings = Recordings::where('user_id', Auth::user()->id)
            ->where('source_number', Session::get('source_number'))
            ->where('deleted_at', null)->get();

        return response()->json($recordings, 200);
    }

    public function store(Request $request, ivrTemplate $ivr, recordings $recordings)
    {

        $this->validate(request(), [
            'file' => 'required|mimes:wav,mpga,mpeg|max:1024', // recording file type and max size
            'id' => 'required',
            'template_id' => 'required',
        ]);

        $ivr_id = $ivr->where('user_id', Auth::user()->id)
            ->where('source_number', Session::get('source_number'))
            ->first();

        /* LET'S UPLOAD file TO REC/CLIENTID/<FILENAME>  */

        $recording = $request->except('_token');

        $source_number = Session::get('source_number');
        $id = $recording['id'];
        $template_id = $recording['template_id'];

        $file = $recording['file'];

        $original_file_name = $file->getClientOriginalName();

        $file_ext = $file->getClientOriginalExtension();

        $file_name = uniqid() . '.' . $file_ext;

        $file_size = $file->getSize(); //file size

        $file_storage_path = 'rec/' . Auth::user()->id . '/';

        $file->move($file_storage_path, $file_name);

        $clip = Recordings::where('id', $id)->where('user_id', Auth::user()->id)->update([
            // 'source_number' => $source_number,
            'path' => $file_storage_path . $file_name,
            'original_filename' => $original_file_name,
            'file_size' => $file_size,
        ]);

        if (!$request->has('reupload')) {
            $ivr_id = $ivr->where('user_id', Auth::user()->id)
                ->where('source_number', $source_number)
                ->where('id', $template_id)
                ->first();

            $ivr_id->no_of_uploaded_recordings += 1;
            if (!$ivr_id->save()) {
                return "Source number doesn't have any template attached";
            }
        }

        /**********************************************************
         *  Update template json
         ***********************************************************/
        $sequence = $recordings->where('id', $id)->where('user_id', Auth::user()->id)->pluck('sequence');
        $template_json = $ivr_id->templates;
        $template_array = json_decode($template_json, true);

        if ($this->checkSequence($template_array, $sequence, $file_name) != false) {
            $new_array = $this->checkSequence($template_array, $sequence, $file_name);
            $ivr_id->templates = json_encode($new_array);
            if (!$ivr_id->save()) {
                return Response::json(['Error while saving template json'], 400);
            }
        } else {
            return Response::json(['Error while saving template json'], 400);
        }


        $client = new \GuzzleHttp\Client();

        $post_audio = 'rec/' . Auth::user()->id . '/' . $file_name;
        $post_url = "http://180.179.198.236/upload_audio.php?auth=GtyasF49TkKlo0A5zM";

        $result = $client->request('POST', $post_url, [
            'multipart' => [
                [
                    'name' => 'voice',
                    'contents' => fopen($post_audio, 'r'),
                    'filename' => "{$file_name}",
                ],
            ],
        ]);

        /****** redirect with success message or with errors if(any)****/

        return response()->json('Success ! File Uploaded', 200);
    }

    public function delete(Request $request, recordings $recordings)
    {
        $this->validate($request, [
            'recording_id' => 'required',
        ]);

        $recording = $recordings->find($request->recording_id);

        if ($recording->user_id != Auth::user()->id) {
            return Response::json(['message' => "Not Authorized for this action"], 400);
        }

        $recording->deleted_at = date('Y-m-d H:i:s');
        $recording->save();

        return Response::json(['message' => 'Audio deleted successfully'], 201);
    }

    public function checkSequence($array, $sequence, $audio_filename)
    {
        $keys = array_keys($array);
        foreach ($keys as $key) {

            if (array_key_exists('sequence', $array[$key])) {
                $array[$key]['audio'] = $audio_filename;
                return $array;
            } else {
                checkSequence($array[$key], $sequence, $audio_filename);
            }

            return false;
        }
    }
}

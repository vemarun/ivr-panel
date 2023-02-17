<?php

namespace App\Http\Controllers;

use App\ivrTemplate;
use App\recordings;
use Auth;
use AWS;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Response;
use Session;

class audioController extends Controller
{
    public function tts(Request $request)
    {

        if (!$request->filled('text')) {
            $text = "This is sample ivr text to speech voice";
        } else {
            $text = $request->text;
        }

        if ($request->filled('gender')) {
            if ($request->gender == 'female') {
                $voiceid = 'Aditi';
            } else if ($request->gender == 'female2') {
                $voiceid = "Raveena";
            } else if ($request->gender == 'male') {
                $voiceid = 'Brian';
            }
            ////https://docs.aws.amazon.com/polly/latest/dg/voicelist.html
            else {
                $voiceid = 'Aditi';
            }
        } else {
            $voiceid = 'Aditi';
        }

        $client_polly = AWS::createClient('Polly');

        $result_polly = $client_polly->synthesizeSpeech([
            'OutputFormat' => 'mp3',
            'Text' => $text,
            'TextType' => 'text',
            'VoiceId' => $voiceid,
        ]);

        $file = $result_polly->get('AudioStream')->getContents();

        $filename = public_path() . "/aws" . "/";

        if (!file_exists($filename)) {
            mkdir($filename, 0777);
        }
        $fn = uniqid() . ".mp3";
        $fp = fopen($filename . "/" . $fn, "w+");
        fwrite($fp, $file);
        fclose($fp);

        return Response::json($fn, 200);
    }

    public function save_tts(Request $request, ivrTemplate $ivr, Filesystem $filesystem)
    {
        $data = (object)$this->tts($request);

        $file = public_path("aws/") . $data->original;

        $recording = $request->except('_token');

        $id = $recording['id'];
        $template_id = $recording['template_id'];

        $original_file_name = $filesystem->name($file);

        $file_ext = $filesystem->extension($file);

        $file_name = $filesystem->basename($file);

        $file_size = $filesystem->size($file);

        $file_storage_path = 'rec/' . Auth::user()->id . '/';

        $filesystem->copy($file, public_path("/" . $file_storage_path . $file_name));

        Recordings::where('id', $id)->update([
            'path' => $file_storage_path . $file_name,
            'original_filename' => $original_file_name,
            'file_size' => $file_size,
        ]);

        if (!$request->has('reupload')) {
            $ivr_id = $ivr->where('user_id', Auth::user()->id)
                ->where('source_number', Session::get('source_number'))
                ->where('id', $template_id)
                ->first();

            $ivr_id->no_of_uploaded_recordings += 1;
            if (!$ivr_id->save()) {
                return "Source number doesn't have any template attached";
            }
        }
        $client = new \GuzzleHttp\Client();

        $post_audio = 'rec/' . Auth::user()->id . '/' . $file_name;
        $post_url = "";  //url to upload

        $client->request('POST', $post_url, [
            'multipart' => [
                [
                    'name' => 'voice',
                    'contents' => fopen($post_audio, 'r'),
                    'filename' => "{$file_name}",
                ],
            ],
        ]);

        return Response::json(['message' => 'Success ! File Uploaded'], 200);
    }
}

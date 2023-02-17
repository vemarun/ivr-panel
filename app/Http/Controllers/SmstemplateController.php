<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\smstemplate;

use Auth;

use Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SmstemplateController extends Controller
{
    //

    #update sms_template   ########################
    public function store(Request $request){



        /* Validate Template Length  */
        $this->validate(request(),[
            'sms_to_owner'=>'max:160',
			'sms_to_owner_missed'=>'max:160',
            'sms_to_caller'=>'max:160',
            'sms_to_caller_missed'=>'max:160',
            'sms_to_agent'=>'max:160',
            'sender_id'=>'max:10',
		 ]);

        /** fetch all form data except _token field**/
        $detail =$request->except(['_token']);

        /** find source number **/

        /* 1. Check whether client's source_number exist in table */
       $sourcenumber= Session::get('source_number');

        /* 2. If doesn't exist then return error */
        if(empty($sourcenumber)){

		return Response::json([
            'message' => "Source Number not found"], 422);
        }

        #use default values if missing parameters #######################################
        if(!array_key_exists('sms_to_owner',$detail)){
            $detail['sms_to_owner']=$sourcenumber->sms_to_owner;
        }
        if(!array_key_exists('sms_to_owner_missed',$detail)){
            $detail['sms_to_owner_missed']=$sourcenumber->sms_to_owner_missed;
        }
        if(!array_key_exists('sms_to_caller',$detail)){
            $detail['sms_to_caller']=$sourcenumber->sms_to_caller;
        }
        if(!array_key_exists('sms_to_caller_missed',$detail)){
            $detail['sms_to_caller_missed']=$sourcenumber->sms_to_caller_missed;
        }
        if(!array_key_exists('sms_to_agent',$detail)){
            $detail['sms_to_agent']=$sourcenumber->sms_to_agent;
        }
        if(!array_key_exists('sender_id',$detail)){
            $detail['sender_id']=$sourcenumber->sms_sender_id;
        }
        if(!array_key_exists('sms_to_owner_check',$detail)){
            $detail['sms_to_owner_check']=$sourcenumber->sms_to_owner_enabled;
        }
        if(!array_key_exists('sms_to_owner_missed_check',$detail)){
            $detail['sms_to_owner_missed_check']=$sourcenumber->sms_to_owner_missed_enabled;
        }
        if(!array_key_exists('sms_to_caller_check',$detail)){
            $detail['sms_to_caller_check']=$sourcenumber->sms_to_caller_enabled;
        }
        if(!array_key_exists('sms_to_caller_missed_check',$detail)){
            $detail['sms_to_caller_missed_check']=$sourcenumber->sms_to_caller_missed_enabled;
        }
        if(!array_key_exists('sms_to_agent_check',$detail)){
            $detail['sms_to_agent_check']=$sourcenumber->sms_to_agent_enabled;
        }
        #################################################################################

        /* 2. if exists then update */
        $query= smstemplate::where('user_id',Auth::user()->id)->where('source_number',$sourcenumber)
            ->update([
                'sms_to_owner'=>$detail['sms_to_owner'],
                'sms_to_owner_enabled'=>$detail['sms_to_owner_check'],
                'sms_to_owner_missed'=>$detail['sms_to_owner_missed'],
                'sms_to_owner_missed_enabled'=>$detail['sms_to_owner_missed_check'],
                'sms_to_caller'=>$detail['sms_to_caller'],
                'sms_to_caller_enabled'=>$detail['sms_to_caller_check'],
                'sms_to_caller_missed'=>$detail['sms_to_caller_missed'],
                'sms_to_caller_missed_enabled'=>$detail['sms_to_caller_missed_check'],
                'sms_to_agent'=>$detail['sms_to_agent'],
                'sms_to_agent_enabled'=>$detail['sms_to_agent_check'],
                'sms_sender_id'=>$detail['sender_id']
                    ]);

        /** api response if ok**/
        if($query){
        return Response::json([
            'message' => "SMS Template Has been Updated Successfully"], 201);
        }

        /** in case error **/
		return Response::json([
            'message' => "Please Check submitted data"], 422);


    }

    #get source nmber template  #######################################################################3
    public function getSourceNumberSmsTemplate(Request $request){
        $detail=$request->all();

        if(empty($detail['source_number']) || !array_key_exists('source_number',$detail)){
            return Response::json([
            'message' => "Missing Parameters. Please recheck submitted data"], 422);
        }

        //$template= smstemplate::where('source_number',$detail['source_number'])->get();

        $template=DB::table('smstemplates')->where('source_number', '=' , $request->source_number)->get();
        return Response::json($template, 200);
        }

    #api to enable disable sms to owner/caller/agent ######################################################
    public function smsEnable(Request $request){
        $detail=$request->all();

        //get keys from request array
        $keys=array_keys($detail);

        //if user posts first source_number
        if($keys[0]=='source_number'){
            $key=$keys[1];
        }
        else{
            $key=$keys[0];
        }

        $template=new smstemplate;


        //there is no missed call template for agent
        if(array_key_exists('agent',$detail)){
           $template->where('source_number',$detail['source_number'])->update(['sms_to_agent_enabled'=>$detail[$key]]);
            if($detail['agent']==1){
                return Response::json([
            'message' => "SMS to agent enabled"], 201);
            }
            if($detail['agent']==0){
                return Response::json([
            'message' => "SMS to agent disabled"], 201);
        }
        }

        //for caller and owner
        else{
           $template->where('source_number',$detail['source_number'])->update(['sms_to_'.$key.'_enabled'=>$detail[$key],'sms_to_'.$key.'_missed_enabled'=>$detail[$key]]);
            if($detail[$key]==1){
                return Response::json([
            'message' => "SMS to ".$key." enabled"], 201);
            }
            if($detail[$key]==0){
                return Response::json([
            'message' => "SMS to ".$key." disabled"], 201);

        }
        }


    }


}

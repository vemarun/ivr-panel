<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\plans;
use App\logs;

use Auth;

use Response;

class PlansController extends Controller
{
	
	public function index(plans $p){
      

	$plans=$p->get_plans(Auth::user()->id);
	
	return view('resellerivr.manage-plan',compact('plans'));
	
		}
	
	
	
    public function create(Request $request,logs $logs)
	{
		$user_id=Auth::user()->id;
		
		/** validation  **/
         $this->validate(request(),[
             'plan_title'=>'required',
             
			 'obd_pulse'=>'required',
		 ]);
		$detail=$request->except('_token');
		
		$check=plans::where('user_id',$user_id)->where('title',$detail['plan_title'])->exists();
        
		  if($check){
                
            $logs->newlog('tried to create a plan with title '.$detail['plan_title']);
            
			return Response::json([
            'message' => "You have already created a plan with this title"], 422);
		      }
		
	
        $query=plans::create([
            'user_id'=>$user_id,
        'title'=>$detail['plan_title'],
        'ivr_rate'=>$detail['ivr_rate'],
        'sms_rate'=>$detail['sms_rate'],
        'max_agents'=>$detail['max_agent'],
        'obd_pulse'=>$detail['obd_pulse']
        ]);
		
		if($query){
            
              
            $logs->newlog('created a plan with title '.$detail['plan_title']);
           
            
            return Response::json([
            'message' => "New Plan created Successfully."], 201);
		}
        /*log entry*/
            $logs=new logs;
            $logs->newlog('tried to create a plan with title '.$detail['plan_title']);
            /** log entry **/
		return Response::json([
            'message' => "Something went wrong, please recheck all submitted data. Contact our support for further assistance."], 422);
			
	}
    
    #[admin]
    public function admin_getplans(plans $data){
        if(Auth::user()->client_type!='admin')
            return Response::json(['message' => "Not allowed"], 404);
        else
        {
            return Response::json($data->getalldata(), 201);
        }
    }

    public function getPlans(plans $plans){
        $p=$plans->where('user_id',Auth::user()->id)->get();

        return Response::json($p,200);
    }
}

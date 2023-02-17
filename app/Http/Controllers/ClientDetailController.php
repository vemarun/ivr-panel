<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\clientDetail;

use App\clientLogin;

use App\clientManageSources;

use Auth;

use Response;
use App\callReports;
use App\smsReports;

class ClientDetailController extends Controller
{
	
	public function getDetails(clientDetail $clientdetail){
        return Response::json($clientdetail->detail(), 201);
    }
    
    
    
     public function personaldetails(Request $request){
		 
		 $this->validate(request(),[
             'name'=>'required',
            'std_code'=>'max:5',
			 'landline'=>'max:15'
		 ]);
        
        /** fetch all form data except _token field**/
        $detail =$request->except(['_token']);  
		
        /** find client and update database **/
       $query= clientDetail::where('user_id',Auth::user()->id)
        ->update(['name'=>$detail['name'],'stdcode'=>$detail['std_code'],'landline'=>$detail['landline'],'companyname'=>$detail['cname']
                    ]);
          
        /** api response if ok**/
        if($query){
        return Response::json([
            'message' => "User details updated successfully"], 201);
        }
		 
		return Response::json([
            'message' => "Please Check submitted data"], 422);
		 
		
        
       
       }
    
    #[admin]
    protected function admin_userlist(Request $request,clientDetail $data,clientLogin $logins,clientManageSources $sources)
    {
        if(Auth::user()->client_type!='admin')
            return Response::json(['message' => "Not allowed"], 400);

        $users=$logins->where('client_type','!=','admin');
        

        if($request->filled('client_type')){
            $users=$users->where('client_type','like','%'.$request->client_type.'%');
        }
        if($request->filled('profile_search')){
            $users=$users->where('username','like','%'.$request->profile_search.'%')
                        ->orWhere('id','like','%'.$request->profile_search.'%');
            
        }
        if($request->filled('account_status')){
            $users=$users->where('is_active',$request->account_status);
        }

        $users=$users->get();

        if($users->isEmpty()){
            $user_ids=$sources->where('source_number','like','%'.$request->profile_search.'%')->pluck('user_id')->toArray();
            $users=$logins->whereIn('id',$user_ids)->get();
        }
        

        
        
        
        foreach($users as $user)
        {
            if(empty($user->plan)){
                $plan_title="No plan assigned";
                $ivr_rate="No plan assigned";
                $sms_rate="No plan assigned";
                $max_agents="No plan assigned";
            }
            else{
                $plan_title=$user->plans->title;
                $ivr_rate=$user->plans->ivr_rate;
                $sms_rate=$user->plans->sms_rate;
                $max_agents=$user->plans->max_agents;
            }
            
            $clients[]=[
                'id'=>$user->id,
                'username'=>$user->username,
                'client_type'=>$user->client_type,
                'created_by'=>$user->users->username,
                'is_active'=>$user->is_active,
                
                'ivr_credit'=>$user->ivr_credit,
                'sms_credit'=>$user->sms_credit,
                'obd_pulse'=>$user->ivr_plan,
                'plan'=>$user->plan,
                'plan_title'=>$plan_title,
                'ivr_rate'=>$ivr_rate,
                'sms_rate'=>$sms_rate,
                'max_agents'=>$max_agents,
                'credit_deduction_basis'=>$user->credit_deduction_basis,
                'validity'=>$user->validity,
                'created_at'=>$user->created_at->toDateTimeString(),

                'name'=>$user->clientDetail->name,
                'email'=>$user->clientDetail->email,
                'contact'=>$user->clientDetail->contact,
                'stdcode'=>$user->clientDetail->stdcode,
                'landline'=>$user->clientDetail->landline,
                'city'=>$user->clientDetail->city,
                'locality'=>$user->clientDetail->locality,
                
                'industry_type'=>$user->clientDetail->industry_type,
                'product_type'=>$user->clientDetail->product_type,
                'price_slab'=>$user->clientDetail->price_slab,
                'companyname'=>$user->clientDetail->companyname,
                
            ];
        }
      

    return response::json($clients,200);
        
    }


        #[admin]
        protected function reseller_userlist(Request $request,clientDetail $data,clientLogin $logins)
        {
            if(Auth::user()->client_type!='reseller')
                return Response::json(['message' => "Not allowed"], 400);
    
            $users=$logins->where('created_by',Auth::user()->id);
            
    
            if($request->filled('client_type')){
                $users=$users->where('client_type','like','%'.$request->client_type.'%');
            }
            if($request->filled('profile_search')){
                $users=$users->where('username','like','%'.$request->profile_search.'%')
                            ->orWhere('id','like','%'.$request->profile_search.'%');
            }
            if($request->filled('account_status')){
                $users=$users->where('is_active',$request->account_status);
            }
    
            $users=$users->get();
            
    
            foreach($users as $user)
            {
                if(empty($user->plan)){
                    $plan_title="No plan assigned";
                    $ivr_rate="No plan assigned";
                    $sms_rate="No plan assigned";
                    $max_agents="No plan assigned";
                }
                else{
                    $plan_title=$user->plans->title;
                    $ivr_rate=$user->plans->ivr_rate;
                    $sms_rate=$user->plans->sms_rate;
                    $max_agents=$user->plans->max_agents;
                }
                $clients[]=[
                    'id'=>$user->id,
                    'username'=>$user->username,
                    'client_type'=>$user->client_type,
                    'created_by'=>$user->users->username,
                    'is_active'=>$user->is_active,
                    
                    'ivr_credit'=>$user->ivr_credit,
                    'sms_credit'=>$user->sms_credit,
                    'obd_pulse'=>$user->ivr_plan,
                    'plan'=>$user->plan,
                    'plan_title'=>$plan_title,
                    'ivr_rate'=>$ivr_rate,
                    'sms_rate'=>$sms_rate,
                    'max_agents'=>$max_agents,
                    'credit_deduction_basis'=>$user->credit_deduction_basis,
                    'validity'=>$user->validity,
                    'created_at'=>$user->created_at->toDateTimeString(),
    
                    'name'=>$user->clientDetail->name,
                    'email'=>$user->clientDetail->email,
                    'contact'=>$user->clientDetail->contact,
                    'stdcode'=>$user->clientDetail->stdcode,
                    'landline'=>$user->clientDetail->landline,
                    'city'=>$user->clientDetail->city,
                    'locality'=>$user->clientDetail->locality,
                    
                    'industry_type'=>$user->clientDetail->industry_type,
                    'product_type'=>$user->clientDetail->product_type,
                    'price_slab'=>$user->clientDetail->price_slab,
                    'companyname'=>$user->clientDetail->companyname,
                    
                ];
            }
          
    
        return response::json($clients,200);
            
        }
    


    // admin dashboard
    public function adminDashboardData(callReports $callreports,smsReports $smsreports,clientLogin $clientlogin){
        $total_calls=$callreports->count();
        $total_sms=$smsreports->count();
        $total_users=$clientlogin->count();
        $client_count=$clientlogin->where('client_type','client')->count();
        $reseller_count=$clientlogin->where('client_type','reseller')->count();
        $seller_count=$clientlogin->where('client_type','seller')->count();
        $admin_count=$clientlogin->where('client_type','admin')->count();

        $data=[
            'total_calls'=>$total_calls,
            'total_sms'=>$total_sms,
            'total_users'=>$total_users,
            'client_count'=>$client_count,
            'reseller_count'=>$reseller_count,
            'seller_count'=>$seller_count,
            'admin_count'=>$admin_count
        ];

        return Response::json($data,200);
    }
    

    //reseller board data
    public function resellerDashboardData(callReports $callreports,smsReports $smsreports,clientLogin $clientlogin){

        if(Auth::user()->client_type!='reseller')
            return Response::json(['message' => "Not allowed"], 400);

        $total_calls=$callreports->countCalls(Auth::user()->id);
        $total_sms=$smsreports->countSMS(Auth::user()->id);
        $total_users=$clientlogin->where('created_by',Auth::user()->id)->count();
        $client_count=$clientlogin->where('created_by',Auth::user()->id)->where('client_type','client')->count();
        $reseller_count=$clientlogin->where('created_by',Auth::user()->id)->where('client_type','reseller')->count();
        $seller_count=$clientlogin->where('created_by',Auth::user()->id)->where('client_type','seller')->count();

        $data=[
            'total_calls'=>$total_calls,
            'total_sms'=>$total_sms,
            'total_users'=>$total_users,
            'client_count'=>$client_count,
            'reseller_count'=>$reseller_count,
            'seller_count'=>$seller_count,
            
        ];

        return Response::json($data,200);
    }
}

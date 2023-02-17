<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\clientDetail;
use App\clientLogin;
use App\plans;
use App\logs;
use App\clientManageSources;
use App\permission;

use Auth;
use DB;

use Response;
use App\creditTransaction;
use App\manageAgents;

class Reseller extends Controller
{

	#get plans created by reseller/seller and redirect to view  ################################################
	public function index(){
		$plan_titles=plans::select('title')->where('user_id',Auth::user()->id)->get();

		return view('resellerivr.new-user',compact('plan_titles'));
	}

	#return list of clients created by reseller/seller  ########################################################
	public function list_(clientLogin $clientlogin){


		$resellers=$clientlogin->list_user(Auth::user()->id,'reseller')->get();
		$sellers=$clientlogin->list_user(Auth::user()->id,'seller')->get();
		$clients=$clientlogin->list_user(Auth::user()->id,'client')->get();

		$client_types=[
			'resellers'=>$resellers,
			'sellers'=>$sellers,
			'client'=>$clients
		];

		return view('resellerivr.list-user',compact('client_types'));
	}

    #for api list-user search  -> active/inacive/ search by email/name etc
    #############################################################################

    public function listuser(Request $request){
        $users=new clientDetail;


        $id=Auth::user()->id;
        $search=$request->all();


        #if user searches by account_status
        $listofusers=$users->where('created_by',$id)->get();


        if(isset($search['account_status']) && empty($search['profile_search']))
        {
            if(strcasecmp($search['account_status'],"Active")==0){
            foreach($listofusers as $active){
                if((clientLogin::find($active->user_id)->is_active)==1)
                    $data[]=$active;
            }
        }
        if(strcasecmp($search['account_status'],"Inactive")==0){

            foreach($listofusers as $inactive){
                if((clientLogin::find($inactive->user_id)->is_active)==0)
                    $data[]=$inactive;
            }
           }
       if(strcasecmp($search['account_status'],"All")==0){
            $data=$listofusers;
        }

        if(isset($data)){
          return $data;
        }
        else
        {
            return Response::json([
            'message' => "Empty Search"], 404);
        }
        }

        if(!array_key_exists('profile_search',$search) || empty($search['profile_search'])){
            $search['profile_search']='';
        }

        if(array_key_exists('profile_search',$search)){
            return $users->searchuser($search['profile_search'],$id);
        }




    }
   #################################################################################

    #function to create new client
    public function createuser(Request $request,logs $logs,plans $plans,clientLogin $login)
    {

		if(Auth::user()->client_type=='client'){
			return Response::json('Unauthorized',400);
        }

        $user_id=Auth::user()->id;

        /** validation  **/
         $this->validate(request(),[
             'uname'=>'required|unique:client_logins,username',
             'name'=>'required',
            //  'email'=>'required|email|unique:client_details,email',
            //  'mobile'=>'numeric|digits:10|unique:client_details,contact',
			 'std_code'=>'max:8',
             'clientselect'=>'required',
		 ]);

        /** fetch all form data except _token field**/
        $detail =$request->all();


        /*for api optional fields if key missing*/
        if(array_key_exists('select_plan',$detail)){
            $p=$plans->find($detail['select_plan']);
            $obd_pulse=$p->obd_pulse;
        }
        else
        {
            $detail['select_plan']='';
            $obd_pulse=30;
        }


        if(!array_key_exists('industry',$detail)){
              $detail['industry']='';
          }

        if(!array_key_exists('product',$detail)){
                 $detail['product']='';
             }

           if(!array_key_exists('sms_credit',$detail) || empty($detail['sms_credit'])){
               $detail['sms_credit']=0;
           }
          if(!array_key_exists('price',$detail)){
              $detail['price']='';
          }
           if(!array_key_exists('locality',$detail)){
               $detail['locality']='';
           }
           if(!array_key_exists('ivr_credit',$detail) || empty($detail['ivr_credit'])){
               $detail['ivr_credit']=0;
           }
           if(!$request->filled('validity')){
               $detail['validity']=365;
           }
           if(!array_key_exists('std_code',$detail)){
               $detail['std_code']='';
           }
           if(!array_key_exists('landline',$detail)){
               $detail['landline']='';
           }
           if(!array_key_exists('cname',$detail)){
               $detail['cname']='';
            }

            $generated_password=substr(md5(microtime()),rand(0,26),8);
            $encrypted_password=bcrypt($generated_password);


            $query=clientLogin::create([
            'username'=>$detail['uname'],
            'password'=>$encrypted_password,
            'created_by'=>$user_id,
            'client_type'=>$detail['clientselect'],
            'validity'=>$detail['validity'],
            'sms_credit'=>$detail['sms_credit'],
            'ivr_credit'=>$detail['ivr_credit'],
            'ivr_plan'=>$obd_pulse,
            'plan'=>$detail['select_plan'],
            'credit_deduction_basis'=>'duration'
            ]);


            clientDetail::create([
            'user_id'=>$query->id,
            'industry_type'=>$detail['industry'],
            'product_type'=>$detail['product'],
            'price_slab'=>$detail['price'],
            'city'=>$detail['city'],
            'locality'=>$detail['locality'],
            'name'=>$detail['name'],
            'email'=>$detail['email'],
            'contact'=>$detail['mobile'],
            'stdcode'=>$detail['std_code'],
            'landline'=>$detail['landline'],
            'companyname'=>$detail['cname']]);

            permission::firstOrCreate(['user_id'=>$query->id]);


            $login->logindetails($detail['uname'],$detail['name'],$detail['email'],$generated_password);

            if($query){

            return Response::json([
            'message' => "New client created Successfully. Login details has been emailed to your client."], 201);
            }


		#if [admin]
		if($detail['clientselect']=='admin'){
			$detail['city']='noida';

			$query=clientDetail::create(['created_by'=>Auth::user()->id,'username'=>$detail['uname'],'client_type'=>$detail['clientselect'],'city'=>$detail['city'],'name'=>$detail['name'],'email'=>$detail['email'],'contact'=>$detail['mobile']]);

			 #adding client login details to client_logins table
            $newclient=new clientDetail;
            $user_id=$newclient->where('username',$detail['uname'])->pluck('user_id');

            $login=new clientLogin;
            $save_login=$login->logindetails($user_id[0],$detail['uname'],$detail['name'],$detail['clientselect'],$detail['email']);

			#admin permissions
			$permission=clientLogin::find($user_id[0]);
			if(empty($detail['can_deactivate']) || !array_key_exists('can_deactivate',$detail)){
				$detail['can_deactivate']=$permission->can_deactivate;
			}
			if(empty($detail['can_login_client']) || !array_key_exists('can_login_client',$detail)){
				$detail['can_login_client']=$permission->can_login_client;
			}
			if(empty($detail['can_login_reseller']) || !array_key_exists('can_login_reseller',$detail)){
				$detail['can_login_reseller']=$permission->can_login_reseller;
			}
			if(empty($detail['can_create_user']) || !array_key_exists('can_create_user',$detail)){
				$detail['can_create_user']=$permission->can_create_user;
			}

			$permission->can_deactivate=$detail['can_deactivate'];
			$permission->can_login_client=$detail['can_login_client'];
			$permission->can_login_reseller=$detail['can_login_reseller'];
			$permission->can_create_user=$detail['can_create_user'];
			$permission->save();


            if($query){

                 /*log entry*/
                $logs=new logs;
                $logs->newlog('created a new admin with username '.$detail['uname']);
                /** log entry **/

            return Response::json([
            'message' => "New admin created Successfully. Login details has been emailed to your new admin."], 201);
            }

		}



		return Response::json([
            'message' => "Something went wrong, please recheck all submitted data. Contact our support for further assistance."], 422);


    }

    ##################### update sms credit #########################################3333333333333333
    public function UpdateSmsCredit(Request $request,logs $logs,creditTransaction $transaction){
        $credit =$request->except(['_token']);

        $client=clientLogin::find($credit['pid']);
        $user=clientLogin::find(Auth::user()->id);

        #if client doesn't exist
        if(empty($client)){
            return Response::json([
            'message' => "Error ! Recheck client's user_id."], 422);
        }

        if($user->client_type!='admin'){         //admin is allowed
        if($client->created_by!=Auth::user()->id){

            $logs->newlog('tried to add '.$credit['add_sms_credit'].' sms credit in user_id: '.$credit['pid']);
            return Response::json([
            'message' => "Not allowed. Unauthorized."], 422);

        }
        if($user->sms_credit < $credit['add_sms_credit']){
            return Response::json([
                'message' => "Insufficient sms credit in your account."], 422);
        }
		}
        $user->sms_credit=$user->sms_credit-$credit['add_sms_credit'];
        $user->save();

        $client->sms_credit+=$credit['add_sms_credit'];
        $query=$client->save();

        $transaction->user_id=$credit['pid'];
        $transaction->service='sms';
        $transaction->dateTime=date('Y-m-d H:i:s');
        $transaction->transaction_credit=$credit['add_sms_credit'];
        $transaction->transaction_id=uniqid().'id'.$credit['pid'].'sms'.$credit['add_sms_credit'];
        $transaction->save();

        if($query){

            $logs->newlog('added '.$credit['add_sms_credit'].' sms credit in user_id: '.$credit['pid']);

            return Response::json([
            'message' => "SMS credit added."], 201);
            }

    }

    ######################### Update Validity ######################################
    public function UpdateValidity(Request $request,logs $logs){
        $credit =$request->except(['_token']);

        $client=clientLogin::find($credit['pid']);

		#if client doesn't exist
        if(empty($client)){
            return Response::json([
            'message' => "Error ! Recheck client's user_id."], 422);
        }

		if(Auth::user()->client_type!='admin'){         //admin is allowed
        if($client->created_by!=Auth::user()->id){

            $logs->newlog('tried to increase '.$credit['add_validity'].' validity in user_id: '.$credit['pid']);

            return Response::json([
            'message' => "Unauthorized, Not allowed."], 422);
        }
		}


        $client->validity+=$credit['add_validity'];
        $query=$client->save();

        if($query){

            $logs->newlog('increased '.$credit['add_validity'].' days validity in user_id: '.$credit['pid']);


            return Response::json([
            'message' => "Validity Increased."], 201);
            }

    }


    /*********************************
     * Update iVR credit
     ***************************************/

    public function UpdateIVRCredit(Request $request,logs $logs,creditTransaction $transaction){
        $credit =$request->except(['_token']);

        $client=clientLogin::find($credit['pid']);
        $user=clientLogin::find(Auth::user()->id);

		#if client doesn't exist
        if(empty($client)){
            return Response::json([
            'message' => "Error ! Recheck client's user_id."], 422);
        }

		if($user->client_type!='admin'){         //admin is allowed
        if($client->created_by!=Auth::user()->id){

            $logs->newlog('tried to increase '.$credit['add_obd_credit'].' ivr credit in user_id: '.$credit['pid']);
            return Response::json([
            'message' => "Unauthorized, Not allowed."], 422);
        }
        if($user->ivr_credit < $credit['add_obd_credit']){
            return Response::json([
                'message' => "Insufficient ivr credit in your account."], 422);
        }
        }
        $user->ivr_credit-=$credit['add_obd_credit'];
        $user->save();

        $client->ivr_credit+=$credit['add_obd_credit'];
        $query=$client->save();

        $transaction->user_id=$credit['pid'];
        $transaction->service='ivr';
        $transaction->dateTime=date('Y-m-d H:i:s');
        $transaction->transaction_credit=$credit['add_obd_credit'];
        $transaction->transaction_id=uniqid().'id'.$credit['pid'].'ivr'.$credit['add_obd_credit'];
        $transaction->save();

        if($query){

            $logs->newlog('increased '.$credit['add_obd_credit'].' ivr_credit in user_id: '.$credit['pid']);
            return Response::json([
            'message' => $credit['add_obd_credit'] ." IVR Credit Added."], 201);
        }


    }

    #edit-user-pid #Account Details   #########################################################################
    public function editpid_A(Request $request,logs $logs,clientLogin $login,plans $plans){

        $detail=$request->all();

        if(!$request->filled('user_id')){
            return Response::json(['message'=>'user_id is required.'],422);
        }
        $user=$login->find($detail['user_id']);

        if(Auth::user()->client_type!='admin'){
        if($user->created_by!= Auth::user()->id)
        {

            $logs->newlog('tried to edit account details of user_id : '.json_encode($detail));
            return Response::json([
            'message' => "Not allowed."], 422);
        }
		}

        if($request->filled('plan')){
            $user->plan=$detail['plan'];
            $plan=$plans->find($detail['plan']);
            $user->ivr_plan->$plan->obd_pulse;
        }

        if($request->filled('clientselect')){
            $user->client_type=$request->clientselect;
        }

        if($request->filled('validity')){
            $user->validity=$request->validity;
        }

        if($request->filled("credit_deduction_basis")){
            $user->credit_deduction_basis=$request->credit_deduction_basis;
        }

        $user->save();

        $logs->newlog('Edited account details of user_id :'.json_encode($detail));

        return Response::json([
            'message' => "User's Account Details Updated"], 201);

        }

    #edit-user-pid #Personal Details     ##############################################################
    public function editpid_P(Request $request,logs $logs){

       $detail=$request->all();
       $user=clientDetail::find($detail['user_id']);

       if(Auth::user()->client_type!='admin'){
        if($user->clientLogin->created_by!= Auth::user()->id){

            $logs->newlog('tried to edit personal details of user_id : '.json_encode($detail));
            return Response::json([
            'message' => "Not allowed."], 422);
          }
        }


            if($request->filled("name")){
                $user->name=$detail['name'];
            }
            if($request->filled('email')){
                $user->email=$detail['email'];
            }
            if($request->filled('mobile')){
                $user->contact=$detail['mobile'];
            }
            if($request->filled('std_code')){
                $user->stdcode=$detail['std_code'];
            }
            if($request->filled('landline')){
                $user->landline=$detail['landline'];
            }
            if($request->filled('cname')){
                $user->companyname=$detail['cname'];
            }
            $user->save();

            $logs->newlog('Edited personal details of user_id : '.json_encode($detail));

        return Response::json([
            'message' => "User's Personal Details Updated"], 201);

    }

    public function holdaccount(Request $request,logs $logs){
        $detail=$request->all();
       $user=clientLogin::find($detail['user_id']);

       if(Auth::user()->client_type!='admin'){
        if($user->created_by!= Auth::user()->id){

            $logs->newlog('tried to toggle hold of user_account : '.json_encode($detail));
            return Response::json([
            'message' => "Not allowed. Fuck off"], 422);
          }
        }


            $logs->newlog("User account hold toggled".json_encode($detail));
            if($user->is_active==0)
            {
                $user->is_active=1;
                $user->save();
                return Response::json([
                    'message' => "Account Hold removed."], 200);
            }
            else if($user->is_active==1)
            {
                $user->is_active=0;
                $user->save();
                return Response::json([
                    'message' => "Account put on Hold"], 200);
            }



    }

    /*********************************
     *
     *   API get user details
     *
     ************************************/
    public function getUserDetails($user_id,logs $logs){

        $user=clientLogin::find($user_id);

        if(empty($user)){
        return Response::json([
            'message' => "Seems like this user_id doesn't exist."], 422);
        }



		if(Auth::user()->client_type!='admin'){
        if($user->created_by!= Auth::user()->id){

            return Response::json([
            'message' => "Not allowed. Fuck off"], 422);
        }
		}

            $client=[
                'id'=>$user->id,
                'username'=>$user->username,
                'client_type'=>$user->client_type,
                'created_by'=>$user->users->username,
                'is_active'=>$user->is_active,

                'ivr_credit'=>$user->ivr_credit,
                'sms_credit'=>$user->sms_credit,
                'obd_pulse'=>$user->ivr_plan,
                'plan'=>$user->plan,
                'plan_title'=>$user->plans->title,
                'ivr_rate'=>$user->plans->ivr_rate,
                'sms_rate'=>$user->plans->sms_rate,
                'max_agents'=>$user->plans->max_agents,
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

            return Response::json(
            $client, 201);

    }

    #  api getSourceNumberDetails  ################################################################################
    public function getSourceNumberDetails($user_id,logs $logs){

        if(empty($user_id)){
            $user_id='';
        }

        $user=clientLogin::find($user_id);

        #find user_id ->if not found return error
        if(empty($user)){
        return Response::json([
            'message' => "This user_id doesn't exist."], 422);
        }

        #check if this user is authorized to view
		if(Auth::user()->client_type!='admin'){
        if($user->created_by!= Auth::user()->id){

            return Response::json([
            'message' => "Not allowed. Fuck off"], 422);
        }
		}

        #if authorized

        $source=DB::table('client_manage_sources')
            ->where('user_id',$user_id)
            ->get();

            if(!array_filter((array)$source)){
                return Response::json([
                            'message' => "This user_id doesn't have any source number yet."], 422);
                            }
            else
            {
               return Response::json(
            $source, 201);
            }


    }

    # did Add Credits #####################################
    public function didAddCredits(Request $request){
        $details=$request->all();


         if(empty($details['add_credit']) || empty($details['sno']) || !array_key_exists('add_credit',$details) || !array_key_exists('sno',$details)){
            return Response::json([
                            'message' =>" Parameters Missing, recheck submitted data."], 422);
        }

        $logs=new logs;
         /*log entry*/
            $logs->newlog('Requested to add '.$details['add_credit'].' credits in source_number: '.$details['sno']);
            /** log entry **/



        $query=clientManageSources::where('source_number',$details['sno'])->first();

        if(empty($query)){
            return Response::json([
                            'message' => "Error! Recheck submitted data"], 422);
        }

        $query->call_balance=$query->call_balance+$details['add_credit'];

        if($query->save()){
            return Response::json([
                            'message' => $details['add_credit']." credit added into source_number : ".$details['sno']], 201);
                            }
        else{
            return Response::json([
                            'message' => "Error! Recheck submitted data"], 422);
                            }
    }

    # did Increase Validity #######################################################
    public function didIncreaseValidity(Request $request){
        $details=$request->all();


        if(empty($details['add_validity']) || empty($details['sno']) || !array_key_exists('add_validity',$details) || !array_key_exists('sno',$details)){
            return Response::json([
                            'message' =>" Parameters Missing, recheck submitted data."], 422);
        }

        $logs=new logs;
        /*log entry*/
            $logs->newlog('Requested to Add more '.$details['add_validity'].' days validity in source_number: '.$details['sno']);
            /** log entry **/




        $query=clientManageSources::where('source_number',$details['sno'])->first();

        if(empty($query)){
            return Response::json([
                            'message' => "Error! Recheck submitted data"], 422);
        }

        $query->expiry=date('Y-m-d', strtotime($query->expiry.' + '.$details['add_validity'].' days'));

         if($query->save()){
            return Response::json([
                            'message' => $details['add_validity']." more validity days added into source_number : ".$details['sno']], 201);
                            }
        else{
            return Response::json([
                            'message' => "Error! Recheck submitted data"], 422);
                            }
    }

    # did - hold  ###############################################################################
    public function didHold(Request $request){
        $details=$request->all();

        if(empty($details['sno']) || !array_key_exists('sno',$details)){
            return Response::json([
                            'message' =>" Parameters Missing, recheck submitted data."], 422);
        }

        $logs=new logs;
        /*log entry*/
            $logs->newlog('Requested to (toggle) hold source_number: '.$details['sno']);
            /** log entry **/

        $query=clientManageSources::where('source_number',$details['sno'])->first();

        if(empty($query)){
            return Response::json([
                            'message' => "Error! Recheck submitted data"], 422);
        }
        if($query->status=='active'){
            $query->status='inactive';
        }
        else{
            $query->status='active';
        }
        if($query->save()){
            return Response::json([
                            'message' => "Source Number status toggled"], 201);
        }
         else{
            return Response::json([
                            'message' => "Error! Something went wrong"], 422);
                            }
    }

    // get live agents
    public function getLiveAgents(manageAgents $agents,clientLogin $login){
        if(Auth::user()->client_type=='reseller'){
        $created_by=Auth::user()->id;
        $query="SELECT client_logins.username,manage_agents.agent_name,manage_agents.agent_destination,manage_agents.source_number,manage_agents.assigned_to_caller from manage_agents left join client_logins ON client_logins.id=manage_agents.user_id WHERE client_logins.created_by=$created_by and manage_agents.call_status=1";
        $liveAgents=DB::select($query);

        }
        if(Auth::user()->client_type=='admin'){
            $created_by=Auth::user()->id;
            $query="SELECT client_logins.username,manage_agents.agent_name,manage_agents.agent_destination,manage_agents.source_number,manage_agents.assigned_to_caller from manage_agents left join client_logins ON client_logins.id=manage_agents.user_id WHERE manage_agents.call_status=1";
            $liveAgents=DB::select($query);
        }
        return Response::json($liveAgents,200);

    }



}

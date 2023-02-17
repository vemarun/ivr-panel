<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Jobs\SendLoginDetails;

use Lab404\Impersonate\Models\Impersonate;
//use Illuminate\Support\Facades\Mail;

class clientLogin extends Authenticatable
{
    use Notifiable;
    use Impersonate;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'client_logins';
    
    protected $guarded=[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function users(){
        return $this->hasOne('App\clientLogin','id','created_by');

    }

    public function permission(){
        return $this->hasOne('App\permission','user_id','id');
    }

    public function plans(){
        return $this->hasOne('App\plans','id','plan');
    }
	
	public function clientDetail(){
		return $this->hasOne('App\clientDetail','user_id','id');
    }
    
    public function agents(){
        return $this->hasMany('App\manageAgents','user_id','id');
    }
    
    #new client login details
    public function logindetails($username,$name,$email,$generated_password)
    {
    $api_token=substr(md5(microtime()),rand(0,26),3).uniqid(time());
    
        
        $detail = new \stdClass();
        $detail->name = $name;
        $detail->username=$username;
        $detail->password = $generated_password;
        $detail->email=$email;

        //Mail::to($email)->send(new ClientLoginDetails($detail));
        dispatch(new SendLoginDetails($detail));
        
    
}

// impersonation authorization only admin can impersonate
        public function canImpersonate()
    {
        return $this->client_type == 'admin';
    }
    
    #[admin]
    public function getalldata(){
        return $this->all();
    }
    
    //ban/hold user
	public function ban_user($id){
        $user=$this->where('id',$id)->first();
        
        if($user->is_active=='1'){
        $this->where('id',$id)->update(['is_active'=>3]);
            return 'User has been banned';
        }
        else if($user->is_active==0 || $user->is_active==3){
            $this->where('id',$id)->update(['is_active'=>1]);
            return 'User has been Unbanned';
        }
    }
    
    //revoke toggle user's api _token
    public function revoke_token($id){
       $user=$this->where('id',$id)->first();
       $api_token=substr(md5(microtime()),rand(0,26),3).uniqid(time());
        
        if($user->api_token==null){
        $this->where('id',$id)->update(['api_token'=>$api_token]);
            return 'Api token has been reassigned.';
        }
        else if($user->api_token!=null){
         $this->where('id',$id)->update(['api_token'=>null]);
            return 'Api token has been revoked.';   
        }
    }


    #get list of all clients created by a specific seller/reseller
    public function list_user($created_by,$client_type){
	return $this->where('created_by',$created_by)->where('client_type',$client_type);
    }

    # relation reseller clients
    public function resellerClients(){
        return $this->hasMany('App\clientLogin','created_by','id');
    }
    
}

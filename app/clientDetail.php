<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class clientDetail extends Model
{
    
    protected $table='client_details';
	protected $primaryKey = 'user_id';
    protected $guarded=[];
    




public function client_sources(){
    return $this->hasMany('clientManageSources');
}

#relation b/w clientdetails table and clientlogins table */
	
public function clientLogin (){
	return $this->hasOne('App\clientLogin','id','user_id');
}

#get user detail
public function detail(){
    return $this->find(Auth::user()->id);
}
    


#find detail of a user
public function searchuser($search='',$created_by){
$users=DB::select("select * from client_details where created_by IN ($created_by) AND (name like '%".$search."%' or email like '%".$search."%' or contact like '%".$search."%' or username like '%".$search."%' or user_id like '%".$search."%')");  
return $users;
}
    
# [ admin ] get list of all clients , reseller, sellers
   public function getalldata()
   {
       
      return $this->all();
   } 

}

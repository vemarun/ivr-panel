<?php

namespace App;

use App\manageAgents;

use App\clientLogin;

use Auth;
use DB;

use Illuminate\Database\Eloquent\Model;

class clientManageSources extends Model
{
    
    protected $table="client_manage_sources";
    
    protected $guarded=[];
    
    protected $primaryKey = 'source_number';
    
    public function source_agents(){
        return $this->hasMany('manageAgents','source_number','source_number');
    }

    public function users(){
        return $this->belongsTo('App\clientLogin','user_id','id');
    }
    
    public function generateotp($len) {      //$len otp length
       $result = '';
       for($i = 0; $i < $len; $i++) {
       $result .= mt_rand(0, 9);
       }
       return $result;
   }
    
    public function addSourceNumber($sourceNumber,$user_id){
        $this->user_id=$user_id;
        $this->source_number=$sourceNumber;
        $this->save();
    }
    
    public function deleteSourceNumber($sourceNumber){
        $source=$this->find($sourceNumber);
        if(empty($source)){
            return 'Source number not found';
        }
        
        if($source->user_id!=Auth::user()->id){
            return 'Not Allowed';
        }
        
        if($this->where('source_number',$sourceNumber)->delete()){
            return 'Source Number has been deleted Successfully';
        }
        else
        {
            return 'Error! please recheck submitted Source Number';
        }
    }
    
    public function getalldata(){
        return DB::select('select * from client_manage_sources');
    }
        
    public function countAgents($source_number){
        return $this->source_agents->count;
    }
    
}

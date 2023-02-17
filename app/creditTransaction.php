<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class creditTransaction extends Model
{
    protected $table="credit_transactions";
    protected $guarded=['id'];
    
    public function users(){
        return $this->belongsTo('App\clientLogin','user_id','id');
    }
	
	public function get_trans($id){
		return $this->where('user_id',$id)->paginate(10);
	}
    
    public function getalldata($source_number,$from,$to){
        
        return $this->where('source_number','like','%'.$source_number.'%')->where('created_at','>',$from)->where('created_at','<',$to)->paginate(100);
    }
}

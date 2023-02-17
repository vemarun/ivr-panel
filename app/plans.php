<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class plans extends Model
{
    protected $table='plans';
	protected $guarded=['id'];
	
	
	public function get_plans($id){
		return $this->where('user_id',$id)->get();
	}
    
    public function getalldata(){
        return $this->all();
    }
}

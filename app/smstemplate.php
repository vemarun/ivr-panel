<?php

namespace App;

use Auth;

use Illuminate\Database\Eloquent\Model;

class smstemplate extends Model
{
     protected $table='smstemplates';
    
    protected $guarded = [];
    
    protected $primaryKey = 'source_number';
    
    
    #insert new source_number and sms template
    public function newsourcenumber($source_number,$user_id)
    {
        $this->source_number=$source_number;
        $this->user_id=$user_id;
        $this->save();
    }
    
    public function deleteSourceTemplate($source_number){
        $this->where('source_number',$source_number)->delete();
        
    }
   
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    protected $primaryKey='user_id';

    protected $guarded=[];


    public function user(){
        return $this->belongsTo('App\clientLogin','user_id','id');
    }
}

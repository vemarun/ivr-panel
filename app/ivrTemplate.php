<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ivrTemplate extends Model
{
    public $guarded = [];
    public function recordings()
    {
        return $this->hasMany('App\recordings', 'template_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\clientLogin', 'user_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    protected $guarded = [];

    public function agents()
    {
        return $this->hasMany('App\manageAgents', 'group_id', 'id');
    }

    public function call_count()
    {
        return $this->agents->call_count();
    }

}

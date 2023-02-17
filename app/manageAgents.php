<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class manageAgents extends Model
{

    protected $table = 'manage_agents';

    protected $guarded = [];

    public function source_client()
    {

        return $this->hasOne('clientDetails');
    }

    public function user()
    {
        return $this->belongsTo('App\clientLogin', 'id', 'user_id');
    }

    public function calls()
    {
        return $this->hasMany('App\callReports', 'agent_number', 'agent_destination');
    }

    public function call_count($start_date = '', $end_date = '')
    {
        return $this->calls()
            ->whereDate('start_time', '>=', $start_date)
            ->whereDate('start_time', '<=', $end_date)
            ->count();
    }

    public function group()
    {
        return $this->belongsTo('App\group', 'group_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo('App\clientLogin', 'user_id', 'id');
    }

    #delete source number and all agents linked to this source number
    public function deleteAllSourceAgents($source_number)
    {
        $this->where('source_number', $source_number)->delete();
    }

    #set source_number null without touching agents
    public function setSourceNumberNull($source_number)
    {
        $this->where('source_number', $source_number)->update(['source_number' => 'NULL']);
    }

    #getAll User's Agents and source number linked to agents
    public function getAllAgents($id)
    {
        return $this->where('user_id', $id)->get();
    }

    public function getalldata()
    {
        return $this->all();
    }
}

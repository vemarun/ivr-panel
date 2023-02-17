<?php

namespace App;

use App\clientLogin;
use Auth;
use Illuminate\Database\Eloquent\Model;

class callReports extends Model
{

    protected $table = 'call_reports';
    protected $guarded = [];
    protected $hidden = ['answer_time', 'conv_duration', 'priority', 'save_caller', 'report_status', 'updated_at', 'call_id'];

    /****     Get data  only for admin dashboard **/##################################

    public function agent()
    {
        return $this->belongsTo('App\manageAgents', 'agent_number', 'agent_destination');
    }

    ######################## client/source_number specific data ##############################

    public function getReport()
    {
        return $this->where('user_id', Auth::user()->user_id)
            ->get();
    }

    /** [admin]  */
    public function getalldata()
    {
        return $this->orderBy('created_at', 'DESC')->paginate(5000);
    }

    /**************** Reseller call count  ******************/
    public function countCalls($reseller_id)
    {

        $clientlogin = clientLogin::find($reseller_id);
        $clients = $clientlogin->resellerclients;
        foreach ($clients as $client) {
            $ids[] = $client->id;
        }
        return $this->whereIn('user_id', $ids)->count();
    }

}

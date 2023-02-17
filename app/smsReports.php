<?php

namespace App;

use App\clientLogin;

use Illuminate\Database\Eloquent\Model;

class smsReports extends Model
{
    /**************** Reseller sms count  ******************/
    public function countSMS($reseller_id){
        
        $clientlogin=clientLogin::find($reseller_id);
        $clients=$clientlogin->resellerclients;
        foreach($clients as $client){
            $ids[]=$client->id;
        }
        return $this->whereIn('user_id',$ids)->count();
        }
}

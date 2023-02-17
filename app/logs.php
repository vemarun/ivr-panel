<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;

class logs extends Model
{
    protected $guarded=[];
    
    
    ######################## THE LOG #######################
    public function newlog($logbody){
        $data=new logs;
        $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

        $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
        
        if(Auth::check()){
        $user='[ user_id: '.Auth::user()->id.' | username: '.Auth::user()->username. ' ]';
        $ip_address=\Request::ip();
        }
        else{
            $user='';
            $ip_address=$_SERVER['REMOTE_ADDR'];
        }
        if(isset($_SERVER['HTTP_REFERER'])){
        $referer=htmlspecialchars($_SERVER['HTTP_REFERER'],ENT_QUOTES, 'UTF-8');
        }
        else{
            $referer='';
        }
        
        $data->user=$user;
        $data->url=$escaped_url;
        $data->log=$logbody;
        $data->referer=$referer;
        $data->ip_address=$ip_address;
        $data->save();
    }
    
    public function getLogs(){
        if(Auth::user()->client_type=='admin'){          //check whether user is admin or not
         return $this->orderBy('created_at','DESC')->paginate(5000);   
        }
        else
            return 'Not allowed';
    }
}

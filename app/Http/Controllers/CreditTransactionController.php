<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\creditTransaction;

use Auth;

use Response;

use Carbon\Carbon;

class CreditTransactionController extends Controller
{
	
	
    public function showcredit(Request $request){

        $credits=creditTransaction::where('user_id',Auth::user()->id);

        if($request->filled('from_date')){
            $credits=$credits->where('dateTime','>=',$request->from_date);
        }
        if($request->filled('to_date')){
            $credits=$credits->where('dateTime','<=',$request->to_date);
        }

       $credits=$credits->paginate(10);
        
        return view('clientivr/credit-transaction',compact('credits'));
    } 
	
	public function reseller_transactions(){
		$trans= new creditTransaction;
		$id=Auth::user()->id;
       
		$credits=$trans->get_trans($id);
        return view('resellerivr/credit-transactions',compact('credits'));
    }
    
    
    #[admin] get all credit trnsactions
    protected function getalltransactions(Request $request,creditTransaction $credits){
        
        //admin only api
        if(Auth::user()->client_type!='admin')
        {
            return Response::json(['message'=>'Unauthorized'],400);
        }
        
        $detail=$request->all();
        
        if($request->filled('user_id')){
            $credits=$credits->where('user_id',$detail['user_id']);
        }
        if($request->filled('from')){
            $credits=$credits->where('dateTime','>=',$detail['from']);
        }
        if($request->filled('to')){
            $credits=$credits->where('dateTime','<=',$detail['to']);
        }
        $credits=$credits->get();

        foreach($credits as $credit){
            $result[]=[
                'id'=>$credit->id,
                'user_id'=>$credit->user_id,
                'username'=>$credit->users->username,
                'service'=>$credit->service,
                'transaction_credit'=>$credit->transaction_credit,
                'transaction_id'=>$credit->transaction_id,
                'created_at'=>$credit->dateTime,
            ];
        }
        
        return Response::json($result,200);
        
        
       }
    
}

<?php

namespace App\Http\Controllers;

use App\phonebook;

use Response;

use App\callReports;

use Auth;

use Illuminate\Pagination\Paginator;

use Illuminate\Http\Request;

class PhonebookController extends Controller
{

    public function show(Request $request,phonebook $phonebook){
        $user_id=Auth::user()->id;

        if($request->filled('search_term')){
            $search=$request->search_term;
        }
        else{
            $search='';
        }

        if($request->filled('page'))
        {
            $page=$request->page;
        }
        else{
            $page=1;
        }

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        if(strcasecmp($request->search_term,'blacklisted')==0){
            $contacts=$phonebook->where('user_id',$user_id)->where('blacklisted','1')->paginate(9);
            return Response::json($contacts,200);
        }
        

        $contacts=$phonebook->where(function ($contacts) use ($user_id) {
            $contacts->where('user_id',$user_id);
        })->where(function ($contacts) use ($search) {
            $contacts->where('caller_number','like','%'.$search.'%')
            ->orWhere('caller_name','like','%'.$search.'%')
            ->orWhere('caller_email','like','%'.$search.'%')
            ->orWhere('caller_address','like','%'.$search.'%');
        })->paginate(9);

        return Response::json($contacts,200);
        
    }



    public function saveCaller(Request $request,phonebook $phonebook,callReports $callreports){
        
        if($request->filled('remarks')){
            $callreports->where('id',$request->report_id)
                        ->update(['add_remark'=>$request->remarks]);
        }
        if($request->filled('priority')){
            $callreports->where('id',$request->report_id)
                        ->update(['priority'=>$request->priority]);
        }

        if($request->filled('caller_number')){
            $phonebook->caller_number=$request->caller_number;
        }
        if($request->filled('caller_name')){
            $phonebook->caller_name=$request->caller_name;
        }

        if($request->filled('caller_address')){
            $phonebook->caller_address=$request->caller_address;
        }

        if($request->filled('caller_email')){
            $phonebook->caller_email=$request->caller_email;
        }
        
            $blacklist=$request->caller_blacklist=='on'?'1':'0';
            $phonebook->blacklisted=$blacklist;
        
        

        $phonebook->user_id=Auth::user()->id;

        try {
            if($phonebook->save()){
               
            return Response::json(['message'=>'Caller details saved successfully'],200);
            }
        } 
        catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return Response::json(['message'=>'Caller number already exists in phonebook. Remarks if any has been saved.'],422);
            }
            else{
                return $e->errorInfo;
            }
        }

    }


    public function delete(Request $request, phonebook $phonebook){

        $this->validate($request,[
            'id'=>'required',
        ]);
        if($phonebook->where('id',$request->id)->delete())
        return Response::json(['message'=>'Contact deleted from phonebook'],200);

        else
        return Response::json(['message'=>'Error! Contact does not exist'],200);
    }

    public function edit(Request $request, phonebook $phone){

        $this->validate($request,[
            'id'=>'required',
        ]);

        $phonebook=$phone->find($request->id);

        if($request->filled('caller_number')){
            $phonebook->caller_number=$request->caller_number;
        }
        if($request->filled('caller_name')){
            $phonebook->caller_name=$request->caller_name;
        }

        if($request->filled('caller_address')){
            $phonebook->caller_address=$request->caller_address;
        }

        if($request->filled('caller_email')){
            $phonebook->caller_email=$request->caller_email;
        }
        
            $blacklist=$request->caller_blacklist=='on'?'1':'0';
            $phonebook->blacklisted=$blacklist;
        

        $phonebook->user_id=Auth::user()->id;

        try {
            if($phonebook->save()){
            return Response::json(['message'=>'Caller details updated successfully'],200);
            }
        } 
        catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return Response::json(['message'=>'Some unexpected error has occurred'],422);
            }
            else{
                return $e->errorInfo;
            }
        }
    }
}

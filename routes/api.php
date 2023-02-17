<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' =>'auth:api'], function () {
    
    /** common APIs **/
    
Route::post('/changePassword','clientLoginController@changePassword'); 

Route::post('/manageprofile', 'ClientDetailController@personaldetails');

    
        /** Client API **/

    
Route::post('/clientlogin','clientLoginController@login');   //client ->login auth
    
Route::post('/configure-sms', 'SmstemplateController@store');
    
Route::post('/forward-source-number', 'ClientManageSourcesController@forward_source_number');
    
Route::post('/manage-agents','ManageAgentsController@store');
    
Route::post('/add-ring-group','ClientManageSourcesController@add_ring_group');
    
Route::post('/generateReport','CallReportsController@generatereport');
    
Route::post('/sendOTP', 'ClientManageSourcesController@sendotp');
    
Route::post('/verifyOTP', 'ClientManageSourcesController@verifyotp');
    
Route::post('/smsEnable','SmstemplateController@smsEnable');
    
Route::post('/deleteClientSourceNumber','ClientManageSourcesController@deleteClientSourceNumber');
    
Route::post('/getClientSourceNumberDetail','ClientManageSourcesController@getClientSourceNumberDetail');
    
Route::post('/getSourceNumberSmsTemplate','SmstemplateController@getSourceNumberSmsTemplate');
    
Route::post('/getCallReports','CallReportsController@getCallReports');
    
Route::post('/getDetails','ClientDetailController@getDetails');
    
Route::post('/getCallCount','CallReportsController@getCallCount');
    
Route::post('/getLastSevenDaysCallCount','CallReportsController@getLastSevenDaysCallCount');
    

	
	
    
        /** Reseller API **/
    
Route::post('/new-user','Reseller@createuser');
	
Route::post('/create-plan','PlansController@create');
    
Route::post('/list-user','Reseller@listuser');
    
Route::post('/UpdateSmsCredit','Reseller@UpdateSmsCredit');
    
Route::post('/UpdateValidity','Reseller@UpdateValidity');

Route::post('/editpid/accountDetails','Reseller@editpid_A');

Route::post('/editpid/personalDetails','Reseller@editpid_P');
    
Route::post('/did/addCredit','Reseller@didAddCredits');
    
Route::post('/did/increaseValidity','Reseller@didIncreaseValidity');
    
Route::post('/did/hold','Reseller@didHold');
    
Route::post('/getUserDetails/{user_id}','Reseller@getUserDetails');   // userid must be under/created by reseller
    
Route::post('/getSourceNumberDetails/{user_id}','Reseller@getSourceNumberDetails');
    
    
    
    

    
     /** Private / Adminship only APIs    **/

Route::post('/admin/listUsers','ClientDetailController@admin_userlist');
    
Route::post('/admin/callReports','CallReportsController@admin_CallReports');
    
Route::post('/admin/sourceNumbers','ClientManageSourcesController@admin_sourcenumbers');
    
Route::post('/admin/plans','PlansController@admin_getplans');
    
Route::post('/admin/agents','ManageAgentsController@admin_getagents');

Route::post('/logs/all','LogsController@index');
    
Route::post('/admin/manageusers','clientLoginController@admin_manageuser');

Route::post('/admin/ban/{id}','clientLoginController@ban');

Route::post('/admin/revokeApiToken/{id}/','clientLoginController@revokeApiToken');
    
Route::post('/admin/revokeApiToken/{id}/','clientLoginController@revokeApiToken'); 
    
Route::post('/admin/getTransactionDetails','CreditTransactionController@getalltransactions');
    
});




<?php

use App\permission;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

/**  ---------------Client panel Routing  ------------  **/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/polly', 'audioController@tts');

Route::get('/login', function () {
    if (Auth::check()) {
        if (Auth::user()->client_type == 'reseller') {
            return redirect('/resellerivr');
        } else if (Auth::user()->client_type == 'client') {
            return redirect('/dashboard');
        } else if (Auth::user()->client_type == 'seller') {
            return redirect('/resellerivr');
        } else if (Auth::user()->client_type == 'admin') {
            return redirect('/admin');
        }
    } else {
        return view('login');
    }
});

Route::any('/getAgents', 'asteriskController@getAgents');

Route::any("getCallRecording", 'asteriskController@getCallRecording');

Route::any('/liveCallStream', 'CallReportsController@liveCallStream');

// client login and authorization

Route::get('/clientlogin', function () {
    if (Auth::check()) {
        if (Auth::user()->client_type == 'reseller') {
            return redirect('/resellerivr');
        } else if (Auth::user()->client_type == 'client') {
            return redirect('/dashboard');
        } else if (Auth::user()->client_type == 'seller') {
            return redirect('/resellerivr');
        } else if (Auth::user()->client_type == 'admin') {
            return redirect('/admin');
        }
    } else {
        return view('login');
    }
})->name('login');

Route::post('/clientlogin', 'clientLoginController@login'); //client ->login auth

Route::get('/forgotpassword', function () { //client->forgotpassword
    return view('clientivr/forgot-password');
});

/**** auth+client middleware-> following routes/pages needs client authorization **/

Route::group(['middleware' => ['auth', 'client']], function () {

    Route::get('/dashboard', function () { //client dashboard
        return view('clientivr/dashboard');
    });

    Route::get('/manageprofile', function () { //client->manageprofile
        return view('clientivr/manage-profile');
    });

    Route::get('/change-password', function () {
        return view('clientivr/change-password'); //client->change-passord
    });

    Route::get('/home', function () {
        return view('clientivr/index'); //client->index
    });

    Route::get('/add-ring-group', function () {
        return view('clientivr/add-ring-group'); //client->add-ring-group
    });

    Route::get('/add-source-no', function () {
        return view('clientivr/add-source-no'); //client->add-source-number
    });

    Route::get('/add-source', function () {
        return view('clientivr/add-source'); //client->add-source
    });

    Route::any('/credit-transaction', 'CreditTransactionController@showcredit'); //client->credit-transation

    Route::any('/in-call-report', 'CallReportsController@generatereport');

    Route::any('/obd-logs', 'CallReportsController@obdLogs');

    Route::any('/email-logs', 'CallReportsController@emailLogs');

    Route::any('/sms-report', 'SmsReportsController@generatereport');

    Route::get('/add-agent', function () {
        return view('clientivr/add-agent'); //client->manage-agent
    });

    Route::get('/manage-agents', function () {
        return view('clientivr/manage-agents'); //client->manage-agent
    });

    Route::get('/agent-reports', function () {
        return view('clientivr/agent-report'); //client->manage-agent
    });

    Route::get('/call-summary-report', function () {
        return view('clientivr/call-summary-report'); //client->manage-agent
    });

    Route::get('/manage-dial-strategy', function () {
        return view('clientivr/manage-dial-strategy'); //client->manage-dial-strategy
    });

    Route::get('/recordings', 'RecordingsController@index');
    Route::post('/upload_recording', 'RecordingsController@store');
    Route::get('/delete_recording', 'RecordingsController@delete');

    Route::get('/crm', function () {
        return view('clientivr.phonebook');
    });

    Route::get('/call-setting', function () {
        return view('clientivr.call-setting');
    });
});

Route::get('/logout', 'clientLoginController@logout')->name('logout'); //client logout

/***************** Middleware -> Reseller *********************/

Route::group(['middleware' => ['auth', 'reseller']], function () {

    Route::get('/resellerivr', function () {
        return view('resellerivr.index');
    });

    Route::get('/resellerivr/manage-profile', function () {
        return view('resellerivr.manage-profile');
    });

    Route::get('/resellerivr/new-user', 'Reseller@index');

    Route::get('/resellerivr/manage-plan', 'PlansController@index');

    Route::get('/resellerivr/list-user', 'Reseller@list_');

    Route::get('/resellerivr/did-list', function () {
        return view('resellerivr.did-list');
    });

    Route::get('/resellerivr/edit-user-pid', function () {
        return view('resellerivr.edit-user-pid');
    });

    Route::get('/resellerivr/credit-allocation', function () {
        return view('resellerivr.credit-allocation');
    });

    Route::get('/resellerivr/credit-transactions', 'CreditTransactionController@reseller_transactions');

    Route::get('/resellerivr/change-password', function () {
        return view('resellerivr.change-password');
    });

    Route::get('/resellerivr/logout', 'clientLoginController@logout'); //reseller logout

    Route::any('/resellerDashboardData', 'ClientDetailController@resellerDashboardData');

    Route::any('/resellerivr/call-reports', function () {
        return view('resellerivr/call-reports');
    });

    Route::any('/resellerivr/generate_report', 'CallReportsController@getCallReports_reseller');
});

/******************* Middleware -> admin  ****************************/

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/admin', function () {
        return view('admin/index');
    });

    Route::get('/admin/manage-profile', function () {
        return view('admin/manage-profile');
    });

    Route::get('/admin/new-user', function () {
        return view('admin/new-user');
    });

    Route::get('/admin/manage-plan', function () {
        return view('admin/manage-plan');
    });
    Route::get('/admin/moderators', function () {
        if (Auth::user()->username == 'root' && Auth::user()->client_type == 'admin') {
            return view('admin/moderators');
        } else {
            return back();
        }
    });

    Route::get('/admin/list-user', function () {
        return view('admin/list-user');
    });

    Route::get('/admin/did-list', function () {
        return view('admin/did-list');
    });

    Route::get('/admin/edit-user-pid', function () {
        return view('admin/edit-user-pid');
    });

    Route::get('/admin/credit-allocation', function () {
        return view('admin/credit-allocation');
    });

    Route::get('/admin/credit-transactions', function () {
        return view('admin/credit-transactions');
    });

    Route::get('/admin/forgot-password', function () {
        return view('admin/forgot-password');
    });

    Route::get('/admin/transaction-details', function () {
        return view('admin/transaction-details');
    });

    Route::get('/reset-password-email', function () {
        return view('reset-password-email');
    });

    Route::get('/reset-password-mobile', function () {
        return view('reset-password-mobile');
    });

    Route::get('/admin/change-password', function () {
        return view('admin/change-password');
    });

    Route::any('/admin/call-reports', function () {
        return view('admin/call-reports');
    });

    Route::any('/admin/generate_report', 'CallReportsController@getCallReports');

    Route::any('/adminDashboardData', 'ClientDetailController@adminDashboardData');

    Route::any('/user-templates/{id}', 'IvrTemplateController@show');

    Route::any('/new-template', 'IvrTemplateController@newTemplate');

    Route::any('/template-recordings/{templateid}', 'IvrTemplateController@recordings');

    Route::any('/edit-template/{templateid}', 'IvrTemplateController@edit');

    /**                 Superman
     *
     ********************* Middleware       ****/

    Route::group(['middleware' => 'superadmin'], function () {

        Route::get('/admin/logs', function () {
            return view('admin/logs');
        });

        Route::get('/admin/clients', function () {
            return view('admin/clients');
        });

        Route::get('/admin/callreports', function () {
            return view('admin/callreports');
        });

        Route::get('/admin/sourcenumbers', function () {
            return view('admin/sourcenumbers');
        });

        Route::get('/admin/plans', function () {
            return view('admin/plans');
        });

        Route::get('/admin/agents', function () {
            return view('admin/agents');
        });

        Route::get('/admin/manageusers', function () {
            return view('admin/manageusers');
        });

        Route::get('/admin/failedmails', function () {
            return view('admin/failedmails');
        });
        Route::get('/admin/cron', function () {
            return view('admin/cron');
        });
        Route::get('/admin/backups', function () {
            return view('admin/backups');
        });
    });

    // Middleware Superman ends

    Route::get('/admin/logout', 'clientLoginController@logout');
});

// Middleware admin ends

Route::impersonate(); //route impersonate/take/{id}   and impersonate/leave for admins

Route::group(['middleware' => ['auth']], function () {

    /** common APIs **/

    Route::post('/changePassword', 'clientLoginController@changePassword');

    Route::post('/manageprofile', 'ClientDetailController@personaldetails');

    /** Client API **/
    Route::any('/save-recording-text-url', 'ClientsettingController@saveRecordingTextUrl');

    Route::any('/save-recording-keywords', 'ClientsettingController@saveRecordingKeywords');

    Route::any('/save-tts', 'audioController@save_tts');

    Route::any('/click-to-call', 'ClicktocallController@clickToCall');

    Route::any('/saveRecordingSequence', 'IvrTemplateController@save');

    Route::any('/createGroup', 'GroupController@create');

    Route::any('/getIvrTemplate', 'IvrTemplateController@get');

    Route::any('/getGroups', 'GroupController@index');

    Route::any('/changeSessionSourceNumber', 'clientLoginController@changeSessionSourceNumber');

    Route::any('/getSourceNumbers', 'ClientManageSourcesController@index');

    Route::any('/saveCaller', 'PhonebookController@saveCaller');

    Route::any('/getPhonebook', 'PhonebookController@show');

    Route::any('/deleteContact', 'PhonebookController@delete');

    Route::any('/editContact', 'PhonebookController@edit');

    Route::any('/dashboardSourceNumberDetail', 'ClientManageSourcesController@dashboardSourceNumberDetail');

    Route::post('/CallSummaryReport', 'CallReportsController@CallSummaryReport');

    Route::any('/agent-report', 'ManageAgentsController@agentReport')->name('agent_report');

    Route::any('/getRecentCalls', 'ClientManageSourcesController@getRecentCalls');

    Route::post('/configure-sms', 'SmstemplateController@store');

    Route::post('/forward-source-number', 'ClientManageSourcesController@forward_source_number');

    Route::post('/add-agents', 'ManageAgentsController@store');

    Route::post('/manage-agents', 'ManageAgentsController@manageAgents');

    Route::post('/delete-agent', 'ManageAgentsController@deleteAgent');

    Route::post('/hard-delete-agent', 'ManageAgentsController@hardDeleteAgent');

    Route::any('/edit_agent', 'ManageAgentsController@editAgent');

    Route::any('/copy_agent', 'ManageAgentsController@copyAgent');

    Route::any('/move_agent', 'ManageAgentsController@moveAgent');

    Route::any('/copy_all_agent', 'ManageAgentsController@copyAll');

    Route::any('/move__all_agent', 'ManageAgentsController@moveAll');

    Route::post('/add-ring-group', 'ClientManageSourcesController@add_ring_group');

    Route::any('/generateReport', 'CallReportsController@generatereport');

    Route::any('/generateSmsReport', 'SmsReportsController@generatereport');

    Route::post('/sendOTP', 'ClientManageSourcesController@sendotp');

    Route::post('/addDID', 'ClientManageSourcesController@addDID');

    Route::post('/smsEnable', 'SmstemplateController@smsEnable');

    Route::post('/deleteClientSourceNumber', 'ClientManageSourcesController@deleteClientSourceNumber');

    Route::post('/deleteRecording', 'RecordingsController@delete');

    Route::post('/getClientSourceNumberDetail', 'ClientManageSourcesController@getClientSourceNumberDetail');

    Route::post('/getSourceNumberSmsTemplate', 'SmstemplateController@getSourceNumberSmsTemplate');

    Route::post('/getCallReports', 'CallReportsController@getCallReports');

    Route::post('/getDetails', 'ClientDetailController@getDetails');

    Route::post('/getCallCount', 'CallReportsController@getCallCount');

    Route::post('/getLastSevenDaysCallCount', 'CallReportsController@getLastSevenDaysCallCount');

    Route::post('/getCallSummaryReport', 'CallReportsController@/getCallSummaryReport');

    /** Reseller API **/

    Route::post('/new-user', 'Reseller@createuser');

    Route::post('/create-plan', 'PlansController@create');

    Route::post('/list-user', 'Reseller@listuser');

    Route::post('/reseller/listUsers', 'ClientDetailController@reseller_userlist');

    Route::post('/UpdateSmsCredit', 'Reseller@UpdateSmsCredit');

    Route::post('/UpdateIVRCredit', 'Reseller@UpdateIVRCredit');

    Route::post('/UpdateValidity', 'Reseller@UpdateValidity');

    Route::post('/editpid/accountDetails', 'Reseller@editpid_A');

    Route::post('/editpid/personalDetails', 'Reseller@editpid_P');

    Route::post('/holdaccount', 'Reseller@holdaccount');

    Route::post('/did/addCredit', 'Reseller@didAddCredits');

    Route::post('/did/increaseValidity', 'Reseller@didIncreaseValidity');

    Route::post('/did/hold', 'Reseller@didHold');

    Route::post('/getUserDetails/{user_id}', 'Reseller@getUserDetails'); // userid must be under/created by reseller

    Route::post('/getSourceNumberDetails/{user_id}', 'Reseller@getSourceNumberDetails');

    Route::any('/getLiveAgents', 'Reseller@getLiveAgents');

    Route::any('/edit-permission', 'PermissionController@edit');

    Route::any('/user-permissions/{id}', function ($id) {
        $permission = permission::firstOrCreate(['user_id' => $id]);
        return view('admin.user-permissions', compact('permission'));
    });



    /** Private / Adminship only APIs    **/

    Route::post('/admin/listUsers', 'ClientDetailController@admin_userlist');

    Route::post('/admin/callReports', 'CallReportsController@admin_CallReports');

    Route::any('/admin/sourceNumbers', 'ClientManageSourcesController@admin_sourcenumbers')->name('admin.sourcenumbers');

    Route::post('/admin/plans', 'PlansController@admin_getplans');

    Route::any('/getPlans', 'PlansController@getPlans');

    Route::any('/admin/agents_data', 'ManageAgentsController@admin_getagents')->name('admin.agents');

    Route::any('/logs/all', 'LogsController@index')->name('admin.logs');

    Route::get('/admin/manageusers_data', 'clientLoginController@admin_manageuser')->name('datatables.data');

    Route::post('/admin/ban/{id}', 'clientLoginController@ban');

    Route::post('/admin/revokeApiToken/{id}/', 'clientLoginController@revokeApiToken');

    Route::post('/admin/revokeApiToken/{id}/', 'clientLoginController@revokeApiToken');

    Route::post('/admin/getTransactionDetails', 'CreditTransactionController@getalltransactions');
});

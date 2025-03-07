<?php

use App\Models\Ie_data;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BankTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\IeDataController;
use App\Http\Controllers\FileDataController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ITCReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Guest user routes
Route::controller( HomeController::class )->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/story', 'story')->name('story');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/career', 'career')->name('career');
    Route::get('/allservices', 'services')->name('services');
    Route::get('/works/{industry}', 'industries')->name('industries.show');
    Route::get('/project_details/{project}', 'pdtails')->name('projects.details');
    Route::get('/members_protfolio/{member}', 'memberProtfolio')->name('memberProtfolio');
});



// Auth users routes
Route::group(['middleware' => ['auth']], function() {

    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    // Only for the developer
    Route::get('/route-cache', function () {
        Artisan::call('route:cache');
        return 'Routes cache cleared!';
    })->name('cache.route');

    Route::get('/config-cache', function () {
        Artisan::call('config:cache');
        return 'Config cache cleared!';
    })->name('cache.config');

    Route::get('/cache-clear', function () {
        Artisan::call('cache:clear');
        return 'Application cache cleared!';
    })->name('cache.clear');

    Route::get('/view-clear', function () {
        Artisan::call('view:clear');
        return 'View cache cleared!';
    })->name('cache.view');
    Route::get('/optimize-clear', function (){
        Artisan::call('optimize:clear');
        return 'App Optimize';
    })->name('optimize.clear');


    // Finance management
    Route::resource('banks', BankController::class);
    Route::resource('baccounts', BankAccountController::class);
    Route::resource('transactions', BankTransactionController::class);
    Route::get('/btransactions/deposit', [BankTransactionController::class, 'deposit'])->name('btransactions.deposit');
    Route::get('/btransactions/withdrawal', [BankTransactionController::class, 'withdrawal'])->name('btransactions.withdrawal');
    Route::get('/btransactions/trash', [BankTransactionController::class, 'trash'])->name('btransactions.trash');
    Route::patch('/btransactions/{transaction}/restore', [BankTransactionController::class, 'restore'])->name('btransactions.restore');
    Route::delete('/btransactions/{transaction}/forcedelete', [BankTransactionController::class, 'forceDelete'])->name('btransactions.forcedelete');


    // Reports
    // Financial reporting
    Route::get('/monthly-financial-report', [ReportController::class, 'financialMonth'])->name('reports.financial.monthly');

    Route::any('/receiver_report', [ReportController::class, 'receiver_report'])->name('reports.receiver_report');
    Route::any('/deliver_report', [ReportController::class, 'deliver_report'])->name('reports.deliver_report');



    // User management
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('/showuserrole/{user}',[UserController::class, 'showUserRoles'])->name('get.userrole');
    Route::post('/assignrole',[UserController::class, 'assignrole'])->name('assignrole');
    Route::post('/unassignrole',[UserController::class, 'unassignrole'])->name('unassignrole');


    // Importer / Exporter management
    Route::resource('ie_datas', IeDataController::class);
    Route::get('/ie_datatrash', [IeDataController::class, 'trash'])->name('ie_datas.trash');
    Route::patch('/agentrestore/{transaction}', [IeDataController::class, 'restore'])->name('ie_datas.restore');
    Route::delete('/agentforcedelete/{transaction}', [IeDataController::class, 'forcedelete'])->name('ie_datas.forcedelete');


    // Project management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    // Agent management
    Route::resource('agents', AgentController::class);
    Route::get('/agenttrash', [AgentController::class, 'trash'])->name('agents.trash');
    Route::patch('/agentrestore/{transaction}', [AgentController::class, 'restore'])->name('agents.restore');
    Route::delete('/agentforcedelete/{transaction}', [AgentController::class, 'forcedelete'])->name('agents.forcedelete');


    // File Data
    Route::resource('file_datas', FileDataController::class);


    // Importer / Exporter autocomplete
    Route::get('/ieautocomplete', function (Request $request) {
        $query = $request->get('query');
        $results = Ie_data::where('name', 'LIKE', "{$query}%")
                          ->pluck('name');
        return response()->json($results);
    });

    // Agent autocomplete
    Route::get('/ainautocomplete', function (Request $request) {
        $query = $request->get('query');
        $results = Agent::where('ain_no', 'LIKE', "%{$query}%")
                          ->pluck('name');
        return response()->json($results);
    });


    // sms routes
    Route::post('/test_sms', function(){
        $message = 'Hello, This is a test message from the system. Please ignore this message.';
        $phone = '01711000000';
        $response = sendSMS($phone, $message);
        return $response;
    })->name('sms.test');

    Route::get('/sms/send-sms', [SmsController::class, 'sendSms'])->name('sendSms');
    Route::post('/sms/send-single', [SmsController::class, 'sendSingleSms']);
    Route::post('/sms/send-bulk', [SmsController::class, 'sendBulkSms']);
    Route::post('/sms/send-dynamic', [SmsController::class, 'sendDynamicSms']);

    // Add middleware to the delete route
    Route::delete('/notices/{filename}', [NoticeController::class, 'destroy'])
    ->middleware('auth') // Only authenticated users can delete
    ->name('notices.destroy');

    Route::get('/admin/notices', [NoticeController::class, 'adminnotice'])->name('adminnotices');
    Route::post('/admin/notices', [NoticeController::class, 'store'])->name('notices.store');


    Route::get('itc-reports/create', [ITCReportController::class, 'create'])->name('itc-reports.create');
    Route::post('itc-reports', [ITCReportController::class, 'store'])->name('itc-reports.store');
    Route::get('itc-reports/{itc_report}', [ITCReportController::class, 'show'])->name('itc-reports.show');
    Route::get('itc-reports/{itc_report}/edit', [ITCReportController::class, 'edit'])->name('itc-reports.edit');
    Route::put('itc-reports/{itc_report}', [ITCReportController::class, 'update'])->name('itc-reports.update');
    Route::delete('itc-reports/{itc_report}', [ITCReportController::class, 'destroy'])->name('itc-reports.destroy');
});


// Route to view or download a notice
Route::get('/notices/{filename}', [NoticeController::class, 'show'])->name('notices.show');
Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');

// Allow 'index' to be accessible to guests
Route::get('itc-reports', [ITCReportController::class, 'index'])->name('itc-reports.index');

Route::get('monthly-itc-reports', [ITCReportController::class, 'monthly'])->name('itc-reports.monthly');
Route::get('yearly-itc-reports', [ITCReportController::class, 'yearly'])->name('itc-reports.yearly');
Route::get('general-member', [HomeController::class, 'generalMember'])->name('general-member');


Route::get('trysending', function(){
    $response = Http::post(env('SSL_SMS_BASE_URL'), [
        'api_token' => env('SSL_SMS_API_TOKEN'),
        'sid' => env('SSL_SMS_SID'),
        'msisdn' => '01956113999',
        'sms' => "test message",
        'csms_id' => "4473433434pZ684333392",
    ]);

    $data = $response->json();

    if ($data['status_code'] !== 200) {
        return [
            'success' => false,
            'message' => $data['error_message'] ?? 'An error occurred'
        ];
    }

    return [
        'success' => true,
        'message' => 'SMS sent successfully',
        'response' => $data
    ];
});


require __DIR__.'/auth.php';

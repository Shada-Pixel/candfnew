<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Ie_data;
use App\Models\Agent;
use App\Http\Controllers\{
    HomeController,
    RoleController,
    UserController,
    BankController,
    QueryController,
    // CareerController,
    ProfileController,
    DashboardController,
    PermissionController,
    BankAccountController,
    BankTransactionController,
    ReportController,
    AgentController,
    IeDataController,
    FileDataController,
    SmsController,
    DonationController,
    NoticeController,
    ITCReportController,
    ContactController,
    CustomFileController,
    AgentFeeController,
    MarqueeController,
    AdvisoryCommitteeController,
    GalleryController,
    ActivityLogController
};

// Guest user routes
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/story', 'story')->name('story');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/career', 'career')->name('career');
    Route::get('/allservices', 'services')->name('services');
    Route::get('/works/{industry}', 'industries')->name('industries.show');
    Route::get('/project_details/{project}', 'pdtails')->name('projects.details');
    Route::get('/members_protfolio/{member}', 'memberProtfolio')->name('memberProtfolio');
    Route::get('/general-member', 'generalMember')->name('general-member');
    Route::get('/agency', 'myagency')->name('myagency');

    Route::get('/expresidents', 'expresidents')->name('expresidents');
    Route::get('/exgsecratary', 'exgsecratary')->name('exgsecratary');
    Route::get('/electioncommittee', 'electioncommittee')->name('electioncommittee');
    Route::get('/internalaidcommittee', 'internalaidcommittee')->name('internalaidcommittee');
    Route::get('/photoalbum', 'photoalbum')->name('photoalbum');

});
Route::get('/weblinks', function(){
    return view('weblinks');
})->name('weblinks');
Route::get('/aboutus', function(){
    return view('aboutus');
})->name('aboutus');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Cache management
    Route::prefix('cache')->group(function () {
        Route::get('/route', fn() => Artisan::call('route:cache') && 'Routes cache cleared!')->name('cache.route');
        Route::get('/config', fn() => Artisan::call('config:cache') && 'Config cache cleared!')->name('cache.config');
        Route::get('/clear', fn() => Artisan::call('cache:clear') && 'Application cache cleared!')->name('cache.clear');
        Route::get('/view', fn() => Artisan::call('view:clear') && 'View cache cleared!')->name('cache.view');
        Route::get('/optimize', fn() => Artisan::call('optimize:clear') && 'App Optimize')->name('optimize.clear');
    });

    Route::prefix('btransactions')->group(function () {
        Route::get('/deposit', [BankTransactionController::class, 'deposit'])->name('btransactions.deposit');
        Route::get('/withdrawal', [BankTransactionController::class, 'withdrawal'])->name('btransactions.withdrawal');
        Route::get('/trash', [BankTransactionController::class, 'trash'])->name('btransactions.trash');
        Route::patch('/{transaction}/restore', [BankTransactionController::class, 'restore'])->name('btransactions.restore');
        Route::delete('/{transaction}/forcedelete', [BankTransactionController::class, 'forceDelete'])->name('btransactions.forcedelete');
    });

    // Reports
    Route::prefix('reports')->group(function () {
        Route::get('/monthly-financial', [ReportController::class, 'financialMonth'])->name('reports.financial.monthly');
        Route::any('/receiver', [ReportController::class, 'receiver_report'])->name('reports.receiver_report');
        Route::any('/deliver', [ReportController::class, 'deliver_report'])->name('reports.deliver_report');
    });

    // User management
    Route::resources([
        'roles' => RoleController::class,
        'users' => UserController::class,
        'permissions' => PermissionController::class,
        'ie_datas'=> IeDataController::class,
        // 'careers'=> CareerController::class,
        'donations'=> DonationController::class,
        'customfiles'=> CustomFileController::class,
        'marquees'=> MarqueeController::class,
        'galleries'=> GalleryController::class,
        'advisory'=> AdvisoryCommitteeController::class,
        'banks' => BankController::class,
        'baccounts' => BankAccountController::class,
        'transactions' => BankTransactionController::class,
        'itc-reports'=> ITCReportController::class,
    ]);

    Route::prefix('users')->group(function () {
        Route::get('/showuserrole/{user}', [UserController::class, 'showUserRoles'])->name('get.userrole');
        Route::post('/assignrole', [UserController::class, 'assignrole'])->name('assignrole');
        Route::post('/unassignrole', [UserController::class, 'unassignrole'])->name('unassignrole');
        Route::get('/createagentuser', [UserController::class, 'createAgentUser'])->name('createagentuser');
        Route::post('/storeagentuser', [UserController::class, 'storeAgentUser'])->name('storeagentuser');
    });

    // Importer/Exporter management
    Route::prefix('ie_datas')->group(function () {
        Route::get('/trash', [IeDataController::class, 'trash'])->name('ie_datas.trash');
        Route::patch('/restore/{transaction}', [IeDataController::class, 'restore'])->name('ie_datas.restore');
        Route::delete('/forcedelete/{transaction}', [IeDataController::class, 'forcedelete'])->name('ie_datas.forcedelete');
    });

    // Profile management
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Agent management
    Route::resource('agents', AgentController::class);
    Route::prefix('agents')->group(function () {
        Route::get('/trash', [AgentController::class, 'trash'])->name('agents.trash');
        Route::patch('/restore/{transaction}', [AgentController::class, 'restore'])->name('agents.restore');
        Route::delete('/forcedelete/{transaction}', [AgentController::class, 'forcedelete'])->name('agents.forcedelete');
    });

    // Agent Fee Management Routes
    Route::get('/agents/{agent}/fees/create', [AgentFeeController::class, 'create'])->name('agents.fees.create');
    Route::post('/agents/{agent}/fees', [AgentFeeController::class, 'store'])->name('agents.fees.store');
    Route::get('/agents/{agent}/fees/{fee}/edit', [AgentFeeController::class, 'edit'])->name('agents.fees.edit');
    Route::put('/agents/{agent}/fees/{fee}', [AgentFeeController::class, 'update'])->name('agents.fees.update');
    Route::delete('/agents/{agent}/fees/{fee}', [AgentFeeController::class, 'destroy'])->name('agents.fees.destroy');

    // File Data
    Route::resource('file_datas', FileDataController::class);

    // SMS routes
    Route::prefix('sms')->group(function () {
        Route::get('/send-sms', [SmsController::class, 'sendSms'])->name('sendSms');
        Route::post('/send-single', [SmsController::class, 'sendSingleSms']);
        Route::post('/send-bulk', [SmsController::class, 'sendBulkSms']);
        Route::post('/send-dynamic', [SmsController::class, 'sendDynamicSms']);
    });
    
    // Notices
    Route::prefix('notices')->group(function () {
        Route::get('create', [NoticeController::class, 'create'])->name('notices.create');
        Route::post('/', [NoticeController::class, 'store'])->name('notices.store');
        Route::get('{notice}/edit', [NoticeController::class, 'edit'])->name('notices.edit');
        Route::put('{notice}', [NoticeController::class, 'update'])->name('notices.update');
        Route::delete('{notice}', [NoticeController::class, 'destroy'])->name('notices.destroy');
    });

    Route::get('/agents_certificate', function(){ return view('admin.agents_certificate'); })->name('agents.certificate');
    Route::post('/agents_certificate/print', [AgentController::class, 'printCertificate'])->name('agents.certificate.print');

    // Activity Logs
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::post('/activity-logs/clear', [ActivityLogController::class, 'clear'])->name('activity-logs.clear');
});

// Guest-accessible routes
Route::prefix('notices')->group(function () {
    Route::get('/', [NoticeController::class, 'index'])->name('notices.index');
    Route::get('{notice}', [NoticeController::class, 'show'])->name('notices.show');
});

// ITC Reports
Route::get('itc-reports', [ITCReportController::class, 'index'])->name('itc-reports.index');
Route::get('monthly-itc-reports', [ITCReportController::class, 'monthly'])->name('itc-reports.monthly');
Route::get('yearly-itc-reports', [ITCReportController::class, 'yearly'])->name('itc-reports.yearly');

// Autocomplete routes
Route::get('/ieautocomplete', function (Request $request) {
    return response()->json(Ie_data::where('name', 'LIKE', "{$request->get('query')}%")->pluck('name'));
});
Route::get('/ainautocomplete', function (Request $request) {
    return response()->json(Agent::where('ain_no', 'LIKE', "%{$request->get('query')}%")
        ->orWhere('name', 'LIKE', "%{$request->get('query')}%")
        ->pluck('name'));
});

// Test SMS
Route::post('/test_sms', function () {
    $response = sendSMS('01711000000', 'Hello, This is a test message from the system. Please ignore this message.');
    return $response;
})->name('sms.test');

// Test sending SMS
Route::get('trysending', function () {
    $response = Http::post(env('SSL_SMS_BASE_URL'), [
        'api_token' => env('SSL_SMS_API_TOKEN'),
        'sid' => env('SSL_SMS_SID'),
        'msisdn' => '01956113999',
        'sms' => "test message",
        'csms_id' => bin2hex(random_bytes(10)),
    ]);

    $data = $response->json();
    return $data['status_code'] !== 200
        ? ['success' => false, 'message' => $data['error_message'] ?? 'An error occurred']
        : ['success' => true, 'message' => 'SMS sent successfully', 'response' => $data];
});

require __DIR__ . '/auth.php';

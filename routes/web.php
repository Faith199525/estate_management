<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/offline', function () {
    return view('offline');
});

Auth::routes();

Route::get('accept/{token}', 'InviteController@accept')->name('accept');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/guide', 'HomeController@guide');

    // Route::get('/vt', 'PaymentController@verrifyTransactions');

    Route::get('/dues', 'PaymentController@dues');
    Route::post('pay', 'PaymentController@process_payment')->name('process_payment');
    Route::post('admin/pay', 'PaymentController@process_payment_through_admin')->name('process_payment_through_admin');
    Route::get('/payment/{id}/receipt', 'PaymentController@downloadReceipt');

    Route::get('photos/{id}', function ($id) {
        if (Storage::exists('photos/' . $id)) {
            $file = Storage::get('photos/' . $id);
            $mimeType = Storage::mimeType('photos/' . $id);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $mimeType);

            return $response;
        }
    });

    Route::get('/download/sample/{file}', function ($file='') {
        return response()->download(public_path('sample/'.$file)); 
    });

    Route::get('landlords-profile', 'Admin\LandlordController@getProfile');
    Route::put('landlords-profile/{id}', 'Admin\LandlordController@updateProfile');
    Route::get('landlords-profile/edit', 'Admin\LandlordController@editProfile');
    Route::post('activate-resident-profile', 'Admin\ResidentController@activateLandlordResidentProfile');

    Route::get('resident-profile', 'Admin\ResidentController@getProfile');
    Route::put('resident-profile/{id}', 'Admin\ResidentController@updateProfile');
    Route::get('resident-profile/{id}/edit', 'Admin\ResidentController@editProfile');

    Route::get('properties/{pid}/residents/{rid}', 'PropertyController@showPropertyResident');

    // /properties/{{$property->id}}/residents/{{$resident->id}}
    Route::resource('properties', 'PropertyController');

    // Route to invite Tenants by landlord (non admin)
    Route::get('residents/invite', 'InviteController@residentInviteForm');
    Route::post('residents/invite', 'InviteController@inviteResidents');

    // Routes to invite Landords from the admin section
    Route::get('admin/landlords/invite', 'InviteController@landlordInviteForm')->middleware('hasAdminAccess:view_admin');
    Route::post('admin/landlords/invite', 'InviteController@inviteLandlords')->middleware('hasAdminAccess:view_admin');

    Route::get('incidents', 'Admin\IncidentController@userIncidents');
    Route::post('incidents', 'Admin\IncidentController@store');

    Route::get('visitors', 'Admin\VisitorController@userVisitors');
    Route::post('visitors', 'Admin\VisitorController@store');

    Route::get('staffs', 'Admin\StaffController@userStaffs');
    Route::resource('staffs', 'Admin\StaffController')->except(['index']);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'hasAdminAccess:view_admin']], function () {
    Route::get('/', 'UserController@home');
    Route::post('users/{id}/role', 'UserController@role')->middleware('hasAdminAccess:edit_role');
    Route::get('residents/add', 'ResidentController@addResidentProfile')->middleware('hasAdminAccess:edit_resident');
    Route::post('residents/add', 'ResidentController@createResidentProfile')->middleware('hasAdminAccess:edit_resident');
    Route::get('payment/status', 'PaymentStatusController@index');
    Route::post('import', 'PaymentStatusController@import');

    Route::group(['middleware' => ['hasAdminAccess:view_settings']], function () {
        Route::get('settings', 'SettingsController@settings');
        Route::post('settings/app', 'SettingsController@updateAppDetails');
        Route::post('settings/email', 'SettingsController@updateEmailDetails');
    });

    Route::group(['middleware' => ['hasAdminAccess:edit_settings']], function () {
        Route::post('settings/messaging/activate', 'SettingsController@activateMessaging');
        Route::post('settings/messaging/update', 'SettingsController@updateMessaging');
        Route::delete('settings/messaging/deactivate', 'SettingsController@deactivateMessaging');

        Route::post('settings/payment/activate', 'SettingsController@activatePayment');
        Route::delete('settings/payment/deactivate', 'SettingsController@deactivatePayment');

        Route::post('settings/manual_due/activate', 'SettingsController@activateDueManagement');
        Route::delete('settings/manual_due/deactivate', 'SettingsController@deactivateDueManagement');
    });

    Route::resource('users', 'UserController')->only(['index', 'show']);
    Route::resource('landlords', 'LandlordController')->only(['index', 'show']);
    Route::resource('residents', 'ResidentController')->only(['index', 'show']);
    Route::resource('streets', 'StreetController');
    Route::resource('dues', 'DueController');
    Route::resource('messages', 'MessageController');
    Route::resource('payments', '\App\Http\Controllers\PaymentController');
    Route::resource('incidents', 'IncidentController');

    Route::post('visitors/{id}/status', 'VisitorController@updateStatus');
    Route::resource('visitors', 'VisitorController');

    Route::get('staffs/{id}', 'StaffController@showAdmin');
    Route::resource('staffs', 'StaffController')->only(['index']);
});

Route::group(['prefix' => 'central', 'namespace' => 'SuperAdmin', 'middleware' => ['auth', 'hasAdminAccess:view_admin']], function () {
Route::get('/home', 'EstateController@home');
Route::get('/estate', 'EstateController@estate');
Route::post('/estate/create', 'EstateController@create');
Route::get('/estate/show/{id}', 'EstateController@show');
Route::post('/estate/edit/{id}', 'EstateController@update');
Route::post('/estate/admin/add/{id}', 'EstateController@add');
});
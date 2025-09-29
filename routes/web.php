<?php
// namespace App\Http\Controllers\bkash;

use App\Http\Controllers\Bkash\BkashController;
use App\Http\Controllers\Payment\BkashPaymentController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\Admin\UsersController;
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

Route::group(['middleware' => ['web']], function()
{
	Route::get('/bkash/make-payment', function()
	{
		return view('bkash.create-payment');
	});

	Route::post("bkash/pay",[BkashPaymentController::class,'pay'])->name('bkash.pay');
  Route::get("bkash/callback",[BkashPaymentController::class,'Callback']);

	//global variable for all pages
	// view()->share('info', ['name'=>'HP Link', 'url'=>'http://hplink.net', 'contact'=>'01737346868', 'panel_name'=>'HP Link', 'short_name'=>'HPL', 'logo' => 'hplink.jpg']);
	

//web pages

	Route::resource('home', 'HomeController');

	Route::get('/', 'HomeController@index');
	Route::get('/view-user-on-map', 'HomeController@userOnMap');
	Route::resource('/package', 'PackageCtrl', [
		'names' => [
			'create' => 'create/{id}',
			'index' => 'getPackages'
			]
	])->only(['index', 'create']);
	Route::get('/lang', 'HomeController@index')->name('changeLanguage');

	// Route::prefix('user-package')
	// ->name('package.')
	// ->controller(PackageCtrl::class)
	// ->group(function(){
	// 	//
	// });

	Route::get('/package/{id}/select', 'PackageCtrl@select');
	Route::resource('/register', 'RegisterController');
	Route::put('/register/{token}/sendsms', 'RegisterController@sendSMS')->name('register.sendsms');

	Route::get('/router_connect', 'Router@ConnectTest');

	Route::get('/admin_loginto', 'HomeController@adminLoginTo');
	Route::get('/check-account', 'HomeController@checkAccount')->name('check_account');
	Route::post('/check-account-details', 'HomeController@checkAccountDetails')->name('check_account_details');



	// Auth::routes();
	/** bkash payment API */
	// Route::controller('Bkash\BkashController')->group(function()
	// {
	// 	// Payment Routes for bKash
	// 	Route::get('/bkash/create', 'create');
  //   Route::get('bkash/get-token', 'getToken')->name('bkash-get-token');
  //   Route::post('bkash/create-payment', 'createPayment')->name('bkash-create-payment');
  //   Route::post('bkash/execute-payment', 'executePayment')->name('bkash-execute-payment');
  //   Route::get('bkash/query-payment', 'queryPayment')->name('bkash-query-payment');
  //   Route::post('bkash/success', 'bkashSuccess')->name('bkash-success');
	// });

	// Route::controller('bksah\BkashRefundController')->group(function()
	// {
	// 	// Refund Routes for bKash
  //   Route::get('bkash/refund-get', 'index')->name('bkash-refund-index');
  //   Route::post('bkash/refund', 'refund')->name('bkash-refund');
	// });

  
    //--Admin--//
    Route::prefix('admin')->group(function()
    {
      Route::get('/loginto/{id}', 'Admin\UsersController@loginto');
    
      Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
      Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.postLogin');
      Route::get('/', 'Admin\AdminHomeController@index')->name('admin.dashboard');
      Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

      Route::middleware('admin.auth')->group(function() 
      {
        Route::get('/change_my_password', 'Admin\AdminsController@changePassword');
        Route::put('/change_my_password', 'Admin\AdminsController@updatePassword')->name('admin.password_change.admin');

        Route::get('/show_admins', 'Admin\AdminsController@index');
        Route::get('/admin/{id}/edit', 'Admin\AdminsController@edit');
        Route::get('/password/{id}/edit', 'Admin\AdminsController@editpassword');
        Route::put('/password/{id}', 'Admin\AdminsController@updatePass')->name('admin.change.password');
        Route::delete('/admin/{id}', 'Admin\AdminsController@destroy')->name('admin.delete.admin');
        Route::get('/profile', 'Admin\AdminsController@profile');
        Route::put('/profile', 'Admin\AdminsController@update');
        // Route::delete('/user/{id}', 'Admin\UsersController@destroy')->name('admin.user.delete');
        Route::resource('/admin', 'Admin\AdminsController');

        //////////////////-/\\/-///////////////////

        // users
        Route::resource('/user', 'Admin\UsersController');
        Route::get('/view/{type}/users', 'Admin\UsersController@viewUsers');
        Route::get('/view_active_users', 'Admin\UsersController@active_users');
        Route::get('/send_email_tickets/{id}', 'Admin\UsersController@getEmailTickets');	
        Route::post('/email_tickets', 'Admin\UsersController@emailTickets')->name('admin.email.tickets');

        Route::get('/active/users/mikrotik', 'Admin\UsersController@activeUsersMikrotik');
        Route::controller(UsersController::class)->group(function()
        {
          Route::get('/users-upload', 'uploadList')->name('user.upload-list');
          Route::post('/users-upload-store', 'userListStore')->name('user.upload-list-store');
          Route::get('/user-on-map', 'userOnMap')->name('user.on-map');
          Route::get('/get-all-users', 'getUsers')->name('user.get-all-users');
        });
        
        //packages
        Route::resource('/package', 'Admin\PackageController');
        Route::get('/get_package_from_router', 'Admin\PackageController@routerpackage');
        Route::delete('/package/{id}', 'Admin\PackageController@destroy')->name('admin.package.delete');

        //services
        Route::get('/create/{id}/service', 'Admin\ServiceController@create');
        Route::get('/create/{id}/service/{user}', 'Admin\ServiceController@create2');
        Route::get('/service/{type}/view', 'Admin\ServiceController@view');
        Route::get('/view/live/services', 'Admin\ServiceController@liveServices');
        Route::get('/view_unpaid_services', 'Admin\ServiceController@unpaidServices');
        Route::get('/view_active_services/location/{id}', 'Admin\ServiceController@activeServicesLocation');
        Route::get('/print_due_services', 'Admin\ServiceController@printUnpaidServices');
        Route::get('/service/{id}/delete', 'Admin\ServiceController@destroy');
        Route::post('/anual_report', 'Admin\ServiceController@printAnualServices')->name('anual_report.print');
        Route::resource('/service', 'Admin\ServiceController');

        //service plans		
        Route::resource('/service_plan', 'Admin\ServicePlanCtrl');
        Route::get('/service_plan/create/{id}', 'Admin\ServicePlanCtrl@create');
        Route::get('/service_plan/{id}/delete', 'Admin\ServicePlanCtrl@delete');

        //temp
        Route::get('/service_plan_create_existing', 'Admin\ServicePlanCtrl@createExisting');

        //payments
        Route::get('/payment/{id}/{billing_date}/add', 'Admin\PaymentController@addPayment');
        Route::get('/bill/paid/view', 'Admin\PaymentController@index');
        Route::get('/bill/due/view', 'Admin\PaymentController@due');
        Route::get('/payment/{id}/total_paid', 'Admin\PaymentController@totalPaid');
        Route::get('/payment/{id}/total_due', 'Admin\PaymentController@totalDue');
        Route::get('/payment/{id}/delete', 'Admin\PaymentController@delete');
        Route::get('/payment/{id}/print', 'Admin\PaymentController@print');
        Route::resource('/payment', 'Admin\PaymentController');
        Route::get('/get-all-bills', 'Admin\PaymentController@allBills');

        // payment confirm
        Route::get('/create/{id}/user_payment', 'Admin\PaymentController@CreateUserPayment');
        Route::get('/create/{id}/user_payment_complete', 'Admin\PaymentController@UserPaymentComplete');
        Route::post('/create_user_payment', 'Admin\PaymentController@StoreUserPayment')->name('admin.create.user.payment');

        //Payement Methods
        Route::delete('/paymethod/{id}', 'Admin\PaymethodController@destroy')->name('admin.paymethod.delete');
        Route::resource('/paymethod', 'Admin\PaymethodController');

        //area
        Route::delete('/area/{id}', 'Admin\LocationController@destroy')->name('admin.area.delete');

        Route::resource('/location', 'Admin\LocationController');

        //devies
        Route::get('/device/{id}/childs', 'Admin\DeviceController@childs');
        Route::delete('/device/{id}', 'Admin\DeviceController@destroy')->name('admin.device.delete');

        Route::resource('/device', 'Admin\DeviceController');

        //user profile
        Route::get('/profile', 'Admin\ProfileController@show');
        Route::put('/profile', 'Admin\ProfileController@update')->name('admin.profile.update');

        //costs
        Route::resource('/invest', 'Admin\InvestController');

        //get data from mikrotik
        Route::get('/get_user_from_router', 'Admin\UsersController@getRouterUsers');

        //Graph chart from the begening
        Route::get('/graph_from_beginning', 'Admin\AdminHomeController@graph');

        // user view on map
        // Route::get('/dashboard/map', [MapController::class,'index'])->name('dashboard.map');
        // Route::get('/api/customers/map', [MapController::class,'customers'])->name('api.customers.map');
        Route::get('/map', [MapController::class, 'index'])->name('map.index');

      });
    });

//user routes start from here
	Route::get('/all_users', 'Admin\UsersController@index');
	Route::put('/permit_as_admin/{id}', 'Admin\UsersController@permitAdmin')->name('admin.permit.admin');

	//offer
	Route::get('/my_offer', 'User\HomeController@myOffer');
	Route::post('/my_offer', 'User\HomeController@requestForOffer')->name('user.requestOffer');

	//user login functionality
	Route::get('/home', 'User\HomeController@index');
	Route::get('/login', 'Auth\UserLoginController@getLogin');
	Route::post('/login', 'Auth\UserLoginController@login')->name('user.login');
	Route::get('/logout', 'Auth\UserLoginController@logout')->name('user.logout');

	//user profile
	Route::get('/profile', 'User\ProfileController@show');
	Route::put('/profile', 'User\ProfileController@update')->name('profile.update');

	Route::get('/change_my_password', 'User\ProfileController@changePassword');
	Route::put('/change_my_password', 'User\ProfileController@updatePassword')->name('user.password_change');

	//service route details
	Route::get('/create_service', 'User\ServiceController@create');
	Route::post('/create_service', 'User\ServiceController@store')->name('user.create.service');
	Route::get('/view_services', 'User\ServiceController@index');


	//payments
	Route::get('/{id}/payment', 'User\PaymentController@create');
	Route::post('/payment', 'User\PaymentController@store')->name('user.create.payment');
	Route::get('/view_payments', 'User\PaymentController@index');
	Route::get('/view_due_bills', 'User\PaymentController@dueBills');

	//packages for user
	Route::get('/view_packages', 'User\HomeController@packages');
	Route::get('/package/{id}/get', 'User\HomeController@get_package');

  Route::get('router-active-users', [UsersController::class, 'routerActiveUsers'])->name('router.active-users');

	// cache clear
	Route::get('reboot', function () {
		Artisan::call('cache:clear');
		Artisan::call('view:clear');
		Artisan::call('route:clear');
		Artisan::call('config:cache');
		Artisan::call('view:cache');
		dd('Done');
	});

});
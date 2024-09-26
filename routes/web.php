<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Yb_AdminController;
use App\Http\Controllers\Yb_MenuController;
use App\Http\Controllers\Yb_WaiterController;
use App\Http\Controllers\Yb_KitchenSettingController;
use App\Http\Controllers\Yb_CategoryController;
use App\Http\Controllers\Yb_ManageFoodController;
use App\Http\Controllers\Yb_TableListController;
use App\Http\Controllers\Yb_CustomerListController;
use App\Http\Controllers\Yb_CustomerTypeController;
use App\Http\Controllers\Yb_PageController;
use App\Http\Controllers\Yb_CountryController;
use App\Http\Controllers\Yb_CityController;
use App\Http\Controllers\Yb_StateController;
use App\Http\Controllers\Yb_ReservationController;
use App\Http\Controllers\Yb_SettingsController;
use App\Http\Controllers\Yb_HomeController;
use App\Http\Controllers\Yb_OrderMenuController;
use App\Http\Controllers\Yb_PaymentMethodController;
use App\Http\Controllers\Yb_BannerController;


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

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::group(['middleware'=>'installed'], function(){
    Route::get('/',[Yb_HomeController::class,'index']);
    Route::get('category/{text}',[Yb_HomeController::class,'yb_category_items']);
    Route::get('menu/{text}',[Yb_HomeController::class,'yb_menu_items']);
    Route::any('reservation',[Yb_HomeController::class,'yb_reservation']);
    Route::get('add-reservation',[Yb_HomeController::class,'yb_addReservation_view']);
    Route::post('create-reservation',[Yb_ReservationController::class,'store']);
    Route::get('/contact',[Yb_HomeController::class,'yb_contact']);
    Route::post('/contact',[Yb_HomeController::class,'yb_contactStore']);
    Route::any('/login',[Yb_CustomerListController::class,'yb_login']);
    Route::get('/signup',[Yb_CustomerListController::class,'create']);
    Route::post('/signup',[Yb_CustomerListController::class,'store']);
    Route::get('/logout',[Yb_CustomerListController::class,'yb_logout']);
    Route::get('user/profile',[Yb_CustomerListController::class,'show']);
    Route::post('/user/profile',[Yb_CustomerListController::class,'yb_customerUpdate']);
    Route::any('user/change-password',[Yb_CustomerListController::class,'yb_changePassword']);
    Route::any('forgot-password',[Yb_CustomerListController::class,'yb_forgotPassword']);
    Route::get('reset-password',[Yb_CustomerListController::class,'yb_reset_password']);
    Route::post('reset-password',[Yb_CustomerListController::class,'yb_reset_passwordUpdate']);


    Route::get('/admin',function(){
        return redirect('/admin/login');
    });
    Route::post('/admin/login',[Yb_AdminController::class,'index']);
    Route::group(['middleware'=>['protectedPage']],function(){
        Route::get('/admin/login',[Yb_AdminController::class,'index']);
        Route::post('admin/logout',[Yb_AdminController::class,'yb_logout']);
        Route::get('admin/dashboard',[Yb_AdminController::class,'dashboard']);
        Route::any('admin/change-password',[Yb_AdminController::class,'yb_changePassword']);
        Route::resource('admin/menu_type',Yb_MenuController::class);
        Route::resource('admin/waiters',Yb_WaiterController::class);
        Route::resource('admin/manage_category',Yb_CategoryController::class);
        Route::resource('admin/manage_food',Yb_ManageFoodController::class);
        Route::resource('admin/table_list',Yb_TableListController::class);
        Route::resource('admin/customer_list',Yb_CustomerListController::class);
        Route::resource('admin/customer_types',Yb_CustomerTypeController::class);
        Route::resource('admin/payment_method',Yb_PaymentMethodController::class);
        Route::resource('admin/pages',Yb_PageController::class);
        Route::resource('admin/country',Yb_CountryController::class);
        Route::resource('admin/city',Yb_CityController::class);
        Route::resource('admin/state',Yb_StateController::class);
        Route::any('admin/reservation/check',[Yb_ReservationController::class,'yb_checkavailablity']);
        Route::resource('admin/reservation',Yb_ReservationController::class);
        Route::any('admin/general_settings',[Yb_SettingsController::class,'yb_general_settings']);
        Route::any('admin/social_links',[Yb_SettingsController::class,'yb_social_links']);
        Route::any('admin/kitchen-settings',[Yb_SettingsController::class,'yb_kitchen_settings']);
        Route::resource('admin/riders',Yb_RiderController::class);
        Route::post('admin/get-cat-items',[Yb_OrderMenuController::class,'yb_showCatItems']);
        Route::post('admin/search-items',[Yb_OrderMenuController::class,'yb_searchItems']);
        Route::post('admin/food_item',[Yb_OrderMenuController::class,'yb_addFoodList']);
        Route::get('admin/on_going_order',[Yb_OrderMenuController::class,'yb_onGoing_orders']);
        
        Route::get('admin/order_list/print/{id}',[Yb_OrderMenuController::class,'yb_printInvoice']);
        Route::get('admin/cancel_order/{id}',[Yb_OrderMenuController::class,'yb_cancel_order']);
        Route::post('admin/complete_order',[Yb_OrderMenuController::class,'yb_complete_order']);
        Route::resource('admin/order_list',Yb_OrderMenuController::class);
        
        Route::resource('admin/banners',Yb_BannerController::class);
        Route::any('admin/contact-query',[Yb_SettingsController::class,'yb_contact_query']);
        Route::any('admin/contact-query/{id}',[Yb_SettingsController::class,'yb_destroy_contact_query']);
    }); 

    Route::group(['middleware'=>['kitchenprotectedPage']],function(){
        Route::any('/kitchen',[Yb_KitchenSettingController::class,'yb_kitchenLogin']);
        Route::get('kitchen/dashboard',[Yb_KitchenSettingController::class,'yb_homePage']);
        Route::get('kitchen/all_kitchen',[Yb_KitchenSettingController::class,'yb_allKitchen']);
        Route::get('kitchen/all_kitchen',[Yb_KitchenSettingController::class,'yb_singleKitchen']);
        Route::get('kitchen/logout',[Yb_KitchenSettingController::class,'yb_logout']);

        Route::post('admin/order_status_accept',[Yb_OrderMenuController::class,'yb_acceptOrderByKitchen']);
    }); 

    Route::get('/{text}',[Yb_HomeController::class,'yb_custom_page']);
});


<?php

use App\Http\Controllers\Api\DeliveryStaffController;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\EmailController;

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

// protected routes
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    // DELIVERY STAFF ROUTES FOR COMPANY //
    Route::get('/deliverystaff/{companyId}', [DeliveryStaffController::class, 'index']);
    Route::post('deliverystaff/add', [DeliveryStaffController::class, 'store']);

    // ORDERS ROUTES //
    // Route for return all orders of all company
    Route::get('allorders', [OrdersController::class, 'allOrders']);

    // Route for return all orders
    Route::get('orders', [OrdersController::class, 'companyOrders']);



    // ===========delivery token ==============
    // Route for ...
    Route::get('deliveryOrders/{id}', [OrdersController::class, 'deliveryOrders']);
    // =========================

    // ++++++++++++ route for return all orders from resturant to his delivery ++++++++++++
    Route::get('orders/waiting', [OrdersController::class, 'getWaitingOrders']);
    // ++++++++++++++++++++++++





// http://127.0.0.1:8000/api/orders/{--id--}
    Route::get('orders/{companyId}', [OrdersController::class, 'index']);

    // http://127.0.0.1:8000/api/orders/add
    Route::post('orders/add', [OrdersController::class, 'storeInvoice']);

    // routing to send wating order to delivery guy
    // http://127.0.0.1:8000/api/invoiceApi
    Route::get('allorders/waiting',[OrdersController::class, 'postInvoiceToDelivery']);



// ================= company ================
Route::post('company/logout', [CompanyController::class, 'logout']);
Route::put('company/update/{id}', [CompanyController::class, 'update']);
Route::delete('/company/{id}',[CompanyController::class,'delete']);

// ================= delivery  ================
Route::post('delivery/logout', [DeliveryStaffController::class, 'logout']);
Route::put('delivery/update/{id}', [DeliveryStaffController::class, 'update']);
Route::delete('/delivery/{id}',[DeliveryStaffController::class,'delete']);


// ===============shady====================
// function update status of delivery by the statuse of  invoices
Route::get('order/update/{invoiceId}/{status}', [OrdersController::class, 'updateStatus']);
// ===============shady====================


});


// public routes
Route::post('deliverystaff/login', [DeliveryStaffController::class, 'login']);


// ========================email==================================
// Route::get('send-email',[EmailController::class,'send']);
// ========================email==================================


// test postman
Route::get('test', function () {
    return "test";
});

Route::get('updateDeliveryStatus/{orderStatus}/{id}', [DeliveryStaffController::class, 'updateDeliveryStatus']);
// ==========



// ++++++++++++++++++++++company ++++++++++++++++++++++++++++++++
Route::post('company/add', [CompanyController::class, 'store']);
Route::post('company/login', [CompanyController::class, 'login']);


// ++++++++++++++++++++++end company++++++++++++++++++++++++++++++++



Route::get('send-email',[EmailController::class,'send'])->middleware(['auth:sanctum']);

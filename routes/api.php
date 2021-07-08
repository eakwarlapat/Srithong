<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ElectricController;
use App\Http\Controllers\Api\WaterController;
use App\Http\Controllers\CustomerByidController;
use App\Http\Controllers\Api\ReceiptController;
use App\Http\Controllers\Api\BillController;


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('allroom', [RoomController::class, 'index']);
Route::get('allrooms', [RoomController::class, 'showall']);
Route::get('room/{id}', [RoomController::class, 'show']);
Route::put('updateroom/{id}', [RoomController::class, 'update']);

Route::get('allcustomer', [CustomerController::class, 'index']);
Route::post('addcostomer', [CustomerController::class, 'store']);
Route::delete('deletecostomer/{id}', [CustomerController::class, 'delete']);
Route::put('updatecostomer/{id}', [CustomerController::class, 'update']);
Route::get('customer-by/{id}', CustomerByidController::class);

Route::get('electric', [ElectricController::class, 'index']);
Route::get('water', [WaterController::class, 'index']);
Route::put('updateelectric/{id}', [ElectricController::class, 'update']);
Route::put('updatewater/{id}', [WaterController::class, 'update']);

Route::post('addreceipt', [ReceiptController::class, 'store']);
Route::get('receiptbyid/{id}', [ReceiptController::class, 'show']);
Route::put('updatereceipt/{id}', [ReceiptController::class, 'update']);

Route::get('allbill', [BillController::class, 'index']);
Route::post('addbill', [BillController::class, 'store']);
Route::get('bill/{id}', [BillController::class, 'show']);
Route::put('updatebill/{id}', [BillController::class, 'update']);
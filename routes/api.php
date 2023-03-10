<?php

use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\TestController;
use App\Models\CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login',[LoginController::class,'login']);
Route::post('/login_user',[LoginController::class,'index'])->name('login_user');
// user_login renaming can change name to route only
Route::post('/LoginAccount/loginProcess',[LoginController::class,'login'])->name('user_login');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('customer',[CustomerController::class,'index']);
Route::post('customer',[CustomerController::class,'store']);
Route::get('customer/{cid}',[CustomerController::class,'show']);
Route::put('customer/{cid}/edit',[CustomerController::class,'update']);

//Seller
Route::get('/Dashboard/Seller/Info', [SellerController::class, 'index'])->name('seller.index');
Route::post('/Dashboard/Add/Seller/Information', [SellerController::class, 'AddSeller'])->name('seller.add');
Route::get('/Dashboard/SellerList/Data', [SellerController::class, 'sellerlist'])->name('seller.list');
Route::get('/Dashboard/Remove/Seller/{id}',[SellerController::class,'DeleteSeller'])->name('seller.delete')->where('id', '[0-9]+');
Route::post('/Dashboard/Update/Seller/Information', [SellerController::class, 'UpdateSeller'])->name('seller.update');
//seller


// Route::get('tests',[TestController::class,'index']);
// Route::post('tests',[TestController::class,'store']);
// Route::get('tests/{name}',[TestController::class,'show']);
// Route::put('tests/{name}/edit',[TestController::class,'update']);

// Route::get('tests',function(){

//     return 'hello test';
// });


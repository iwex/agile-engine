<?php

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
Route::group(
    ['prefix' => 'products', 'namespace' => 'Product'],
    function () {
        Route::get('', 'ListController@index');
        Route::get('{product}', 'ShowController@show');
        Route::post('{product}/buy', 'BuyController@buy');
        Route::patch('{product}/vouchers', 'BindVoucherController@bind');
        Route::delete('{product}/vouchers', 'BindVoucherController@bind');
        Route::post('', 'StoreController@store');
    }
);

Route::group(
    ['prefix' => 'vouchers', 'namespace' => 'Voucher'],
    function () {
        Route::get('', 'ListController@index');
        Route::post('', 'StoreController@store');
    }
);


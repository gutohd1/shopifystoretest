<?php

use Illuminate\Http\Request;

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

Route::prefix('order')->group(function(){
	Route::name('order.lineitem.createcustom')->post('/custom', [
		'uses' => 'orderController@addCustomLineItem'
	]);
	Route::name('order.lineitem.getvariant')->get('/variant/{variant_id}/', [
		'uses' => 'orderController@getLineItemByVariantId'
	]);
	Route::name('order.lineitem.createvariant')->post('/variant/{variant_id}/', [
		'uses' => 'orderController@addLineItemByVariantId'
	]);
	Route::name('order.lineitem.replacevariant')->put('/variant/{variant_id}/', [
		'uses' => 'orderController@replaceLineItemByVariantId'
	]);
	Route::name('order.lineitem.removevariant')->delete('/variant/{variant_id}/', [
		'uses' => 'orderController@removeLineItemByVariantId'
	]);
});
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('marketapp/commodity-prices', 'Api\MarketController@price');
Route::get('marketapp/category-commodities', 'Api\MarketController@commodity');
Route::get('marketapp/commodities-categories', 'Api\MarketController@commodities_cat');
Route::get('marketapp/commodities-list', 'Api\MarketController@commodities_list');
Route::get('marketapp/latest-products-updates', 'Api\MarketController@latest_product');
Route::get('marketapp/latest-products-updates-export', 'Api\MarketController@latest_product_export');
Route::get('marketapp/market-commodity-prices', 'Api\MarketController@market_commodity');
Route::get('marketapp/markets-list', 'Api\MarketController@markets_list');
Route::get('marketapp/province-commodity-prices', 'Api\MarketController@province_commodity');
Route::post('/submit', 'Api\DataController@recieve');
Route::get('/data', 'Api\DataController@index');


//Online Market
Route::get('online/new','Api\OnlineMarketController@index');
Route::get('online/new/{id}','Api\OnlineMarketController@detail');
//Route::get('/getlatestprice', 'Api\OnlineMarketController@getlatestprice');
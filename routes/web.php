<?php

Route::get('/','HomeController@Index')->name('home');
Route::get('/search', 'HomeController@search')->name('home.search');
Route::get('/getmonthly/{dataseriescode}/{cultureid}', 'HomeController@getMonthly')->name('home.getmonthly');

Route::get('/topic/{slug}/{filter?}','TopicController@Index')->name('topic');
Route::get('/article/{id}','ArticleController@Index')->name('article');
Route::get('files/pdf/{path}','TopicController@Pdf');
Route::get('/links','TopicController@links')->name('links');

Route::post('/participant/login','HomeController@Login')->name('participant.login');
Route::post('/participant/logout','HomeController@Logout')->name('participant.logout');

Route::get('coming-soon', function(){
    return view('page.coming');
});

Route::get('export', function(){
    return view('export.excel');
});

Route::get('product', function(){
    return view('products.detail');
});

Route::get('bussiness', function(){
    return view('bussiness.index');
});
Route::get('market', function(){
    return view('market.index');
});

Route::get('page/{slug}','PageController@Index')->name('page');
Route::get('document/{slug}','PageController@document')->name('document');

Route::post('/subscriber/store','PageController@storeSubscriber')->name('page.storeSubscriber');
Route::post('/contact/store','PageController@storeContact')->name('page.storeContact');

Route::get('/recent_price/excel/{current}', 'HomeController@export_excel')->name('recent_price');

Route::get('production','Voyager\ProductionController@map')->name('voyager.products.map');
Route::get('getproduction','Voyager\ProductionController@getProduction')->name('voyager.products.getdata');


Route::get('production-export','Voyager\ProductionExportController@index')->name('voyager.productexport.index');
Route::get('getproductionexport','Voyager\ProductionExportController@getProduction')->name('voyager.products.getdataexport');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::resource('amisdata', 'Voyager\AmisdataController',['as' => 'voyager']);
    Route::post('/excel_amiss','Voyager\AmisdataController@excel_amiss')->name('excel_amiss');
    Route::get('/media-modal','Voyager\VoyagerMediaController@index_modal')->name('media.modal');
    Route::get('/media-tinymce','Voyager\VoyagerMediaController@index_tinymce')->name('media.tinymce');
    Route::post('/submitproduction', 'ProductController@submitproduction')->name('submitproduction');

    Route::get('/products', 'Voyager\ProductionController@index')->name('voyager.products.index');
    Route::get('/products/browse/{id}', 'Voyager\ProductionController@browse')->name('voyager.products.browse');
    Route::post('/products/excel_data', 'Voyager\ProductionController@excel_data')->name('excel_data');
});



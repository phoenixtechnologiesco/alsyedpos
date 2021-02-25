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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

// Route::get('/row-details', 'DatatablesController@getRowDetailsData')->name('api.row_details');

// Route::get('/master-details', 'DatatablesController@getMasterDetailsData')->name('api.master_details');

// Route::get('/master-details/{id}', 'DatatablesController@getMasterDetailsSingleData')->name('api.master_single_details');

// Route::get('/column-search', 'DatatablesController@getColumnSearchData')->name('api.column_search');

// Route::get('/row-attributes', 'DatatablesController@getRowAttributesData')->name('api.row_attributes');

// Route::get('/carbon', 'DatatablesController@getCarbonData')->name('api.carbon');


Route::get('/product-row-details', 'ProductController@getRowDetailsData')->name('api.product_row_details');

Route::get('/product-row-attributes', 'ProductController@getRowAttributesData')->name('api.product_row_attributes');


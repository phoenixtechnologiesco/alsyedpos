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
Route::get('/customer_row_details', 'CustomerController@getCustomersData')->name('api.customer_row_details');
Route::get('/supplier_row_details', 'SupplierController@getSuppliersData')->name('api.supplier_row_details');
Route::get('/company_row_details', 'CompanyController@getCompaniesData')->name('api.company_row_details');
Route::get('/brand_row_details', 'BrandController@getBrandsData')->name('api.brand_row_details');

Route::get('/product-row-details', 'ProductController@getRowDetailsData')->name('api.product_row_details');
Route::get('/product-row-attributes', 'ProductController@getRowAttributesData')->name('api.product_row_attributes');

Route::get('/sale-row-details', 'SaleController@getRowDetailsData')->name('api.sale_row_details');
Route::get('/sale-row-attributes', 'SaleController@getRowAttributesData')->name('api.sale_row_attributes');
Route::get('/salereturn-row-details', 'SaleController@getRowDetailsData2')->name('api.salereturn_row_details');

Route::get('/purchase-row-details', 'PurchaseController@getRowDetailsData')->name('api.purchase_row_details');
Route::get('/purchase-row-attributes', 'PurchaseController@getRowAttributesData')->name('api.purchase_row_attributes');
Route::get('/purchasereturn-row-details', 'PurchaseController@getRowDetailsData2')->name('api.purchasereturn_row_details');

Route::get('/payment-s-row-details', 'PaymentController@getRowDetailsData')->name('api.payment_s_row_details');
Route::get('/payment-p-row-details', 'PaymentController@getRowDetailsData2')->name('api.payment_p_row_details');

Route::get('/balance_customer_row_details', 'ReportController@getBalanceCustomerData')->name('api.balance_customer_row_details');
Route::get('/balance_sale_row_details', 'ReportController@getBalanceSaleData')->name('api.balance_sale_row_details');
Route::get('/balance_purchase_row_details', 'ReportController@getBalancePurchaseData')->name('api.balance_purchase_row_details');
Route::get('/balance_creditduration_row_details', 'ReportController@getBalanceCreditDurationData')->name('api.balance_creditduration_row_details');

Route::get('/ledger-row-details', 'PurchaseController@getLedgerData')->name('api.ledger_row_details');
Route::get('/financial-row-details', 'SaleController@getFinancialData')->name('api.financial_row_details');

Route::get('/available-row-details', 'PurchaseController@getAvailableData')->name('api.available_row_details');
Route::get('/minimum-row-details', 'PurchaseController@getMinimumData')->name('api.minimum_row_details');
Route::get('/damage-row-details', 'PurchaseController@getDamageData')->name('api.damage_row_details');








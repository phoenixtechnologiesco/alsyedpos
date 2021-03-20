<?php

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

Route::group(['middleware' => ['get.menu']], function () {
    Route::get('/',        'HomeController@index')->name('homepage');
    Route::get('/dashboard', function () {           return view('dashboard.homepage'); });

    Route::group(['middleware' => ['role:superadmin']], function () {
        Route::get('/colors', function () {     return view('dashboard.colors'); });
        Route::get('/typography', function () { return view('dashboard.typography'); });
        Route::get('/charts', function () {     return view('dashboard.charts'); });
        Route::get('/widgets', function () {    return view('dashboard.widgets'); });
        Route::get('/404', function () {        return view('dashboard.404'); });
        Route::get('/500', function () {        return view('dashboard.500'); });
        Route::prefix('base')->group(function () {  
            Route::get('/breadcrumb', function(){   return view('dashboard.base.breadcrumb'); });
            Route::get('/cards', function(){        return view('dashboard.base.cards'); });
            Route::get('/carousel', function(){     return view('dashboard.base.carousel'); });
            Route::get('/collapse', function(){     return view('dashboard.base.collapse'); });

            Route::get('/forms', function(){        return view('dashboard.base.forms'); });
            Route::get('/jumbotron', function(){    return view('dashboard.base.jumbotron'); });
            Route::get('/list-group', function(){   return view('dashboard.base.list-group'); });
            Route::get('/navs', function(){         return view('dashboard.base.navs'); });

            Route::get('/pagination', function(){   return view('dashboard.base.pagination'); });
            Route::get('/popovers', function(){     return view('dashboard.base.popovers'); });
            Route::get('/progress', function(){     return view('dashboard.base.progress'); });
            Route::get('/scrollspy', function(){    return view('dashboard.base.scrollspy'); });

            Route::get('/switches', function(){     return view('dashboard.base.switches'); });
            Route::get('/tables', function () {     return view('dashboard.base.tables'); });
            Route::get('/tabs', function () {       return view('dashboard.base.tabs'); });
            Route::get('/tooltips', function () {   return view('dashboard.base.tooltips'); });
        });
        Route::prefix('buttons')->group(function () {  
            Route::get('/buttons', function(){          return view('dashboard.buttons.buttons'); });
            Route::get('/button-group', function(){     return view('dashboard.buttons.button-group'); });
            Route::get('/dropdowns', function(){        return view('dashboard.buttons.dropdowns'); });
            Route::get('/brand-buttons', function(){    return view('dashboard.buttons.brand-buttons'); });
        });
        Route::prefix('editors')->group(function () {  // word: "tables" - not working as part of adress
            Route::get('/code-editor', function(){       return view('dashboard.editors.code-editor'); });
            Route::get('/markdown-editor', function(){           return view('dashboard.editors.markdown-editor'); });
            Route::get('/text-editors', function(){           return view('dashboard.editors.text-editors'); });
        });
        Route::prefix('forms')->group(function () {  // word: "tables" - not working as part of adress
            Route::get('/advanced-forms', function(){       return view('dashboard.forms.advanced-forms'); });
            Route::get('/basic-forms', function(){           return view('dashboard.forms.basic-forms'); });
            Route::get('/validation', function(){           return view('dashboard.forms.validation'); });
        });
        Route::prefix('icon')->group(function () {  // word: "icons" - not working as part of adress
            Route::get('/coreui-icons', function(){         return view('dashboard.icons.coreui-icons'); });
            Route::get('/flags', function(){                return view('dashboard.icons.flags'); });
            Route::get('/brands', function(){               return view('dashboard.icons.brands'); });
        });
        Route::prefix('notifications')->group(function () {  
            Route::get('/alerts', function(){   return view('dashboard.notifications.alerts'); });
            Route::get('/badge', function(){    return view('dashboard.notifications.badge'); });
            Route::get('/modals', function(){   return view('dashboard.notifications.modals'); });
        });
        Route::prefix('plugins')->group(function () {  // word: "plugins" - not working as part of adress
            Route::get('/calender', function(){       return view('dashboard.plugins.calender'); });
            Route::get('/draggable-cards', function(){           return view('dashboard.plugins.draggable-cards'); });
            Route::get('/sliders', function(){       return view('dashboard.plugins.sliders'); });
            Route::get('/spinners', function(){       return view('dashboard.plugins.spinners'); });
        });
        Route::prefix('tables')->group(function () {  // word: "tables" - not working as part of adress
            Route::get('/s-tables', function(){       return view('dashboard.tables.s-tables'); });
            Route::get('/datatables', function(){           return view('dashboard.tables.datatables'); });
        });
        Route::resource('notes', 'NotesController');
    });

    Auth::routes(['register' => false]);

    Route::resource('resource/{table}/resource', 'ResourceController')->names([
        'index'     => 'resource.index',
        'create'    => 'resource.create',
        'store'     => 'resource.store',
        'show'      => 'resource.show',
        'edit'      => 'resource.edit',
        'update'    => 'resource.update',
        'destroy'   => 'resource.destroy'
    ]);

    Route::group(['middleware' => ['role:superadmin|admin']], function () {
        Route::resource('customer', 'CustomerController', ['except' => ['show']]);
        Route::resource('supplier', 'SupplierController', ['except' => ['show']]);
        Route::resource('company', 'CompanyController', ['except' => ['show']]);
        Route::resource('brand', 'BrandController', ['except' => ['show']]);
        Route::resource('product', 'ProductController', ['except' => ['show']]);
        Route::resource('sale', 'SaleController', ['except' => ['show']]);
        Route::resource('purchase', 'PurchaseController', ['except' => ['show']]);
        Route::resource('payment', 'PaymentController', ['except' => ['show']]);
    });

    Route::get('sale/pos', 'SaleController@pos')->name('sale.pos');
    Route::get('sale/payment', 'PaymentController@index')->name('sale.payment');
    Route::get('sale/payment/create', 'PaymentController@create')->name('sale.paymentcreate');
    Route::post('sale/paymentadd', 'PaymentController@store')->name('sale.paymentadd');
    Route::get('sale/financial', 'SaleController@financial')->name('sale.financial');
    Route::get('sale/return', 'SaleController@return')->name('sale.return');
    Route::get('sale/returnadd', 'SaleController@returnadd')->name('sale.returnadd');
    Route::post('sale/storereturn', 'SaleController@storereturn')->name('sale.storereturn');
    Route::get('purchase/payment', 'PaymentController@indexpurchase')->name('purchase.payment');
    Route::get('purchase/payment/create', 'PaymentController@purchasecreate')->name('purchase.paymentcreate');
    Route::post('purchase/paymentadd', 'PaymentController@purchasestore')->name('purchase.paymentadd');
    Route::get('purchase/ledger', 'PurchaseController@ledger')->name('purchase.ledger');
    Route::get('purchase/return', 'PurchaseController@return')->name('purchase.return');
    Route::get('purchase/returnadd', 'PurchaseController@returnadd')->name('purchase.returnadd');
    Route::post('purchase/storereturn', 'PurchaseController@storereturn')->name('purchase.storereturn');
    Route::get('purchase/available', 'PurchaseController@available')->name('purchase.available');
    Route::get('purchase/minimum', 'PurchaseController@minimum')->name('purchase.minimum');
    Route::get('purchase/damage', 'PurchaseController@damage')->name('purchase.damage');
    Route::get('purchase/amountwise', 'PurchaseController@amountwise')->name('purchase.amountwise');
    // Route::get('getsupplier/{id}', ['as' => 'getsupplier', 'uses' => 'SupplierController@getSupplier']);
    Route::get('purchase/searchsupplier', 'SupplierController@searchsupplier')->name('searchsupplier');
    Route::get('purchase/searchsupplierpayments', 'SupplierController@searchsupplierpayments')->name('searchsupplierpayments');
    Route::get('purchase/searchproduct', 'ProductController@searchproduct')->name('searchproduct');
    Route::get('purchase/searchbarcode', 'ProductController@searchbarcode')->name('searchbarcode');
    Route::get('sale/searchcustomer', 'CustomerController@searchcustomer')->name('searchcustomer');
    Route::get('sale/searchcustomerpayments', 'CustomerController@searchcustomerpayments')->name('searchcustomerpayments');
    Route::get('sale/searchproduct', 'ProductController@searchproduct')->name('searchproduct2');
    Route::get('sale/searchbarcode', 'ProductController@searchbarcode')->name('searchbarcode2');
    Route::get('sale/searchbarcode3', 'ProductController@searchbarcode3')->name('searchbarcode3');
    Route::get('sale/gen_invoice/{id}', 'SaleController@genInvoice')->name('saleinvoice');
    // Route::get('product/addmore', ['as' => 'product.addmore', 'uses' => 'ProductController@addMore']);
    // Route::post('product/addmore', ['as' => 'product.addmore', 'uses' => 'ProductController@addMoreBarcode']);
    Route::get('balance/customers', 'ReportController@balancecustomer')->name('balancecustomer');
    Route::get('balance/sales', 'ReportController@balancesale')->name('balancesale');
    Route::get('balance/purchases', 'ReportController@balancepurchase')->name('balancepurchase');
    Route::get('balance/creditduration', 'ReportController@balancecreditduration')->name('balancecreditduration');
    Route::get('report/date', 'ReportController@reportdate')->name('reportdate');
    Route::get('report/cashcredit', 'ReportController@reportcashcredit')->name('reportcashcredit');
    Route::get('report/customer', 'ReportController@reportcustomer')->name('reportcustomer');
    Route::get('report/brand', 'ReportController@reportbrand')->name('reportbrand');
    Route::get('report/company', 'ReportController@reportcompany')->name('reportcompany');

    Route::post('report/datereport', 'ReportController@dateReport')->name('datereport');
    Route::post('report/cashcreditreport', 'ReportController@cashcreditReport')->name('cashcreditreport');
    Route::post('report/customerreport', 'ReportController@customerReport')->name('customerreport');
    Route::post('report/brandreport', 'ReportController@brandReport')->name('brandreport');
    Route::post('report/companyreport', 'ReportController@companyReport')->name('companyreport');

    Route::group(['middleware' => ['role:superadmin|admin']], function () {
        Route::resource('users',        'UsersController');
    });

    Route::group(['middleware' => ['role:superadmin']], function () {
        Route::resource('bread',  'BreadController');   //create BREAD (resource)
        // Route::resource('users',        'UsersController');
        Route::resource('roles',        'RolesController');
        Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
        Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');
        Route::prefix('menu/element')->group(function () { 
            Route::get('/',             'MenuElementController@index')->name('menu.index');
            Route::get('/move-up',      'MenuElementController@moveUp')->name('menu.up');
            Route::get('/move-down',    'MenuElementController@moveDown')->name('menu.down');
            Route::get('/create',       'MenuElementController@create')->name('menu.create');
            Route::post('/store',       'MenuElementController@store')->name('menu.store');
            Route::get('/get-parents',  'MenuElementController@getParents');
            Route::get('/edit',         'MenuElementController@edit')->name('menu.edit');
            Route::post('/update',      'MenuElementController@update')->name('menu.update');
            Route::get('/show',         'MenuElementController@show')->name('menu.show');
            Route::get('/delete',       'MenuElementController@delete')->name('menu.delete');
        });
        Route::prefix('menu/menu')->group(function () { 
            Route::get('/',         'MenuController@index')->name('menu.menu.index');
            Route::get('/create',   'MenuController@create')->name('menu.menu.create');
            Route::post('/store',   'MenuController@store')->name('menu.menu.store');
            Route::get('/edit',     'MenuController@edit')->name('menu.menu.edit');
            Route::post('/update',  'MenuController@update')->name('menu.menu.update');
            Route::get('/delete',   'MenuController@delete')->name('menu.menu.delete');
        });
        Route::prefix('media')->group(function () {
            Route::get('/',                 'MediaController@index')->name('media.folder.index');
            Route::get('/folder/store',     'MediaController@folderAdd')->name('media.folder.add');
            Route::post('/folder/update',   'MediaController@folderUpdate')->name('media.folder.update');
            Route::get('/folder',           'MediaController@folder')->name('media.folder');
            Route::post('/folder/move',     'MediaController@folderMove')->name('media.folder.move');
            Route::post('/folder/delete',   'MediaController@folderDelete')->name('media.folder.delete');;

            Route::post('/file/store',      'MediaController@fileAdd')->name('media.file.add');
            Route::get('/file',             'MediaController@file');
            Route::post('/file/delete',     'MediaController@fileDelete')->name('media.file.delete');
            Route::post('/file/update',     'MediaController@fileUpdate')->name('media.file.update');
            Route::post('/file/move',       'MediaController@fileMove')->name('media.file.move');
            Route::post('/file/cropp',      'MediaController@cropp');
            Route::get('/file/copy',        'MediaController@fileCopy')->name('media.file.copy');
        });
    });

});
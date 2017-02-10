<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'DashboardController@index');
//Route::get('/logout','DashboardController@index');

// Dashboard
Route::get('/dashboard', 'DashboardController@index');


Auth::routes();

Route::get('/home', 'HomeController@index');
#### Access Denied
Route::get('/access-denied', function(){
    return view('pages.access_denied');
});
// System Manager
Route::get('/routes', 'RoutesController@index');
Route::post('/add-route', 'RoutesController@store');
Route::get('/get-route/{route_id}', 'RoutesController@getRoute');
Route::get('/parent-routes', 'RoutesController@getParentRoutes');
Route::post('/edit-route', 'RoutesController@update');
Route::get('/load-routes', 'RoutesController@loadRoutes');
Route::get('/delete-route/{id}', 'RoutesController@destroy');

Route::get('/menu', 'MenuController@index');
Route::post('/add-menu', 'MenuController@store');
Route::post('/arrange-menu', 'MenuController@arrangeMenu');
Route::post('/edit-menu', 'MenuController@update');
Route::get('/get-menu/{id}', 'MenuController@getMenuItem');
Route::post('/remove-menu', 'MenuController@destroy');

#### inventory module
// category

Route::get('/categories','CategoryController@index');
Route::post('/add-category','CategoryController@storeCategory');

#####Database Backups
Route::get('/backups','DatabaseBackup@index');
Route::get('/make-backup','DatabaseBackup@runBackup');

##### User manager
Route::get('/user_roles','UserManagerController@getIndex');
Route::get('/all_users','UserManagerController@getAllUsers');
Route::post('/sys-config', 'UserManagerController@updateSystemConfig');
Route::get('/load-config', 'UserManagerController@loadSystemConfig');
Route::post('/add-user-role','UserManagerController@storeRole');
Route::get('get-role-edit-details/{id}','UserManagerController@getRoleEditDetails');
Route::post('edit-user-role/{id}','UserManagerController@updateUserRoleDetails');
Route::get('/delete-user/{id}','UserManagerController@destroyRole');
Route::get('/audit_trails','UserManagerController@auditTrails');
Route::get('/ajax_trails','UserManagerController@ajaxAuditTrails');
Route::get('/load-routes-allocation', 'UserManagerController@loadRoutesForAllocation');
Route::post('/attach-route', 'UserManagerController@attachRoute');
Route::post('/detach-route', 'UserManagerController@detachRoute');
Route::get('/check-allocated-route/{id}', 'UserManagerController@isRouteAllocated');
Route::post('all_users/block-user','UserManagerController@blockUser');
Route::post('all_users/unblock-user','UserManagerController@unblockUser');


####buses

Route::get('all-buses','BusesController@getBuses');
Route::post('/add-bus','BusesController@storeBus');
Route::get('/load-bus-details/{id}','BusesController@loadBusEditD');
Route::post('/edit-bus/{id}','BusesController@editBus');
Route::delete('/delete-bus/{id}','BusesController@deleteBus');

####Expenses
Route::get('/expenses','ExpensesController@getExpenses');
Route::post('/add-expense','ExpensesController@storeExpense');
Route::get('/load-expense-edit-details/{id}','ExpensesController@loadExpenseEditDetails');
Route::post('/edit-expense/{id}','ExpensesController@editExpense');
Route::delete('/delete-expense/{id}','ExpensesController@deleteExpense');


####Accounts
Route::get('/accounts','AccountController@getAccounts');
Route::post('/store-transaction','AccountController@storeTransaction');
Route::delete('/delete-transaction/{id}','AccountController@deleteTransaction');

###masterfile
Route::get('/masterfiles','MasterfileController@index');


####Transactions

####reports
Route::get('daily-report','ReportsController@getDailyReport');
Route::get('/view-report/{id}','ReportsController@viewDailyReport');
Route::get('/all-transactions','ReportsController@viewAllTransactionsReport');
Route::get('/supplier-report/{id}','ReportsController@getSupplierReport');
Route::post('/filter_report','ReportsController@getFilteredData');
Route::get('account-status','ReportsController@accountStatus');

####  Masterfiles
Route::get('/new-mf', 'MasterfileController@index');
Route::post('/store-masterfile','MasterfileController@storeMasterfile');
Route::get('/all-masterfiles','MasterfileController@getAllMasterfiles');
Route::get('/load-masterfiles','MasterfileController@loadMasterFiles');
Route::delete('/delete-masterfile/{id}','MasterfileController@deleteMasterfile');

#### Suppliers
Route::get('/suppliers','SupplierController@getSuppliers');
Route::post('/store-supplier','SupplierController@storeSupplier');
Route::get('/supplier-items','SupplierController@getSupplierItems');
Route::post('/store-supplier-item','SupplierController@storeSupplierItem');
Route::get('/invoices','SupplierController@getInvoices');
Route::get('/load-invoice-fields/{id}','SupplierController@loadInvoiceFields');
Route::post('/raise-invoice','SupplierController@createInvoice');
Route::delete('/delete-supplier/{id}','SupplierController@destroySupplier');
Route::delete('/delete-sup-e/{id}','SupplierController@deleteSuppE');
Route::delete('/delete-invoice/{id}','SupplierController@deleteInvoice');
Route::get('/load-inv-details/{id}','SupplierController@loadInvoiceBillDetails');
Route::post('pay-bill/{id}','SupplierController@payBill');
Route::get('/load-supplier-edit-d/{id}','SupplierController@getEditSuppD');
Route::post('/edit-supplier/{id}','SupplierController@editSupplier');
Route::get('/get-supplier-d-ailm/{id}','SupplierController@getSEDetails');
Route::post('/edit-sup-e/{id}','SupplierController@editSupplierItem');

//bookings routes
Route::get('/create-booking','BookingsController@index');
Route::post('/store-booking','BookingsController@createBooking');
Route::get('/all-bookings','BookingsController@allBookings');
Route::get('/view-booking/{id}','BookingsController@viewBookingDetails');

#### reports

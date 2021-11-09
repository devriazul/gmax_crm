<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\gatewaycontroller;
use App\Http\Controllers\projectcontroller;


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

Route::get('/', function () {
    return redirect('/login');
});





Route::get('/invoice/pay/{id}', [InvoiceController::class, 'payinvoice'])->name('payinvoice');
Route::get('/quote/public/{id}', [InvoiceController::class, 'viewquotepublic'])->name('viewquotepublic');
Route::get('/quote/stat/public/{id}/{stat}', [InvoiceController::class, 'quotestatuschangepublic'])->name('quotestatuschangepublic');


Route::post('/invoices/capture/razorpaypayment', [gatewaycontroller::class, 'razorpaypayment'])->name('razorpaypayment');
Route::post('/invoices/capture/stripe', [gatewaycontroller::class, 'stripepayment'])->name('stripepayment');
Route::post('/invoices/capture/paypal', [gatewaycontroller::class, 'paypalhandlePayment'])->name('paypalhandlePayment');




Route::group(['middleware' => ['auth']], function(){
    Route::get('/dashboard', [InvoiceController::class, 'dashboard'])->name('dashboard');


    Route::get('/client/add', [ClientController::class, 'addclient'])->name('addclient');
    Route::post('/client/add/save', [ClientController::class, 'addclientsave'])->name('addclientsave');
    Route::get('/clients', [ClientController::class, 'listofclients'])->name('listofclients');
    Route::get('/client/{id}', [ClientController::class, 'viewclient'])->name('viewclient');
    Route::get('/client/delete/{id}', [ClientController::class, 'deleteclient'])->name('deleteclient');
    Route::get('/client/edit/{id}', [ClientController::class, 'editclient'])->name('editclient');
    Route::post('/client/edit/save', [ClientController::class, 'editclientsave'])->name('editclientsave');


    Route::get('/invoices', [InvoiceController::class, 'listofinvoices'])->name('listofinvoices');
    Route::post('/invoices/new/save', [InvoiceController::class, 'createnewinvoice'])->name('createnewinvoice');
    Route::post('/invoices/edit/save', [InvoiceController::class, 'editinvoicedata'])->name('editinvoicedata');    
    Route::get('/invoice/edit/{id}', [InvoiceController::class, 'editinvoice'])->name('editinvoice');
    Route::get('/invoice/delete/{id}', [InvoiceController::class, 'deleteinvoice'])->name('deleteinvoice');
    Route::get('/invoice/{id}', [InvoiceController::class, 'viewinvoice'])->name('viewinvoice');
    Route::post('/invoices/meta/save', [InvoiceController::class, 'newinvoicemeta'])->name('newinvoicemeta');
    Route::post('/invoices/meta/edit', [InvoiceController::class, 'editinvoicemeta'])->name('editinvoicemeta');
    Route::get('/invoices/deleteinvoicemeta/{id}/{invo}', [InvoiceController::class, 'deleteinvoicemeta'])->name('deleteinvoicemeta');
    Route::post('/invoices/payments/save', [InvoiceController::class, 'invopaymentsave'])->name('invopaymentsave');
    Route::get('/invoices/reversepayment/{id}/{invo}', [InvoiceController::class, 'deletepayment'])->name('deletepayment');
    Route::get('/invoice/cancel/{id}', [InvoiceController::class, 'cancelinvoice'])->name('cancelinvoice');
    Route::post('/invoice/refund/initiate', [InvoiceController::class, 'refundinvoice'])->name('refundinvoice');  
    Route::get('/invoice/email/{id}', [InvoiceController::class, 'emailinvoice'])->name('emailinvoice'); 
    Route::post('/invoice/edit/taxenable', [InvoiceController::class, 'invoicetaxenable'])->name('invoicetaxenable');  
    
    
    Route::get('/quotes', [InvoiceController::class, 'listofquotes'])->name('listofquotes');
    Route::post('/quotes/new/save', [InvoiceController::class, 'createnewquotes'])->name('createnewquotes');
    Route::get('/quote/edit/{id}', [InvoiceController::class, 'editquote'])->name('editquote');
    Route::get('/quote/{id}', [InvoiceController::class, 'viewquote'])->name('viewquote');
    Route::get('/quote/stat/{id}/{stat}', [InvoiceController::class, 'quotestatuschange'])->name('quotestatuschange');
    Route::get('/quote/convert/{id}', [InvoiceController::class, 'converttoinvo'])->name('converttoinvo');
    Route::get('/quote/email/{id}', [InvoiceController::class, 'emailquote'])->name('emailquote'); 
    
    Route::get('/projects', [projectcontroller::class, 'listofprojects'])->name('listofprojects');
    Route::post('/projects/new/save', [projectcontroller::class, 'createnewproject'])->name('createnewproject');
    Route::post('/projects/update/save', [projectcontroller::class, 'updateproject'])->name('updateproject');
    Route::post('/projects/descrip/save', [projectcontroller::class, 'updateprojectdescript'])->name('updateprojectdescript');
    Route::post('/projects/status/change', [projectcontroller::class, 'projectstatuschange'])->name('projectstatuschange');
    Route::get('/project/{id}', [projectcontroller::class, 'viewproject'])->name('viewproject');
    Route::get('/project/delete/{id}', [projectcontroller::class, 'deleteproject'])->name('deleteproject');
    Route::get('/project/tasks/{id}', [projectcontroller::class, 'viewtasks'])->name('viewtasksprjct');
    Route::post('/project/tasks/save', [projectcontroller::class, 'createprjcttask'])->name('createprjcttask');
    Route::post('/project/tasks/update', [projectcontroller::class, 'projecttaskupdate'])->name('projecttaskupdate');
    Route::get('/project/tasks/delete/{id}', [projectcontroller::class, 'deletetasks'])->name('deletetasks');
    Route::get('/project/note/{id}', [projectcontroller::class, 'viewnote'])->name('viewnoteprjct');
    Route::post('/project/note/save', [projectcontroller::class, 'updatenote'])->name('updatenoteprjct');
    
    
    
  

});	


Route::group(['middleware' => ['auth','admin']], function(){
    Route::get('/admin/listofusers', [AdminController::class, 'index'])->name('listofadmins');
    Route::post('/admin/createnewadmin', [AdminController::class, 'createnewadmin'])->name('createnewadmin');
    Route::post('/admin/updateadmin', [AdminController::class, 'updateadmin'])->name('updateadmin');
    Route::get('/admin/deleteadmin/{id}', [AdminController::class, 'deleteadmin'])->name('deleteadmin');
    
    Route::get('/admin/settings', [SettingsController::class, 'settings'])->name('adminsettings');
    Route::post('/admin/settings/save', [SettingsController::class, 'updatesettings'])->name('updatesettingssave');

    Route::get('/admin/settings/billing', [SettingsController::class, 'billingsetting'])->name('billingsetting');
    Route::post('/admin/settings/billing/save', [SettingsController::class, 'billingsettingsave'])->name('billingsettingsave');

    Route::get('/admin/settings/paymentgateway', [gatewaycontroller::class, 'paymentgatewaysettings'])->name('paymentgatewaysettings');
    Route::post('/admin/settings/paymentgateway/save', [gatewaycontroller::class, 'paymentgatewaysettingssave'])->name('paymentgatewaysettingssave');
    Route::post('/admin/settings/paymentgateway/enable', [gatewaycontroller::class, 'paymentgatewayenable'])->name('paymentgatewayenable');
    
    Route::get('/admin/settings/business', [SettingsController::class, 'businesssetting'])->name('businesssetting');
    Route::post('/admin/settings/business/save', [SettingsController::class, 'businesssettingsave'])->name('businesssettingsave');
    
  
});	
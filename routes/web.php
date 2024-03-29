<?php

use App\Models\AccountableForm;
use App\Models\AccountableFormType;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CommunityTaxController;
use App\Http\Controllers\RealPropertyController;
use App\Http\Controllers\AccountableFormController;
use App\Http\Controllers\CollectionReportController;
use App\Http\Controllers\AccountableFormItemController;
use App\Http\Controllers\AccountableFormTypeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RevenueTypeController;

/*
index - show all 
show - show one 
create - show form to create  new 
store - store new 
edit - show form to edit one 
update - save new data of edited 
destroy - delete one 
*/

Route::controller(MessageController::class)->group(function () {
    Route::post('/save-message', 'store')->name('save-message');
    Route::get('/messages', 'index')->name('messages');
}); 

Route::controller(CollectionReportController::class)->group(function () {
    Route::get('/draft-collection-report', 'draft')->name('draft-individual-report');
    Route::get('view-individual-report/{user}/{date}', 'viewIndividual')->name('view-individual-report');
    
});

Route::controller(AssignmentController::class)->group(function () {
    Route::get('/assignment/{user}', 'edit')->name('edit-assignment');
    Route::put('/assignment/{user}', 'update');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('/comment/{accountableForm}', 'store')->name('submit-comment');
});

Route::controller(CollectorController::class)->group(function () {
    Route::get('/collectors', 'index')->name('collectors-home');
    Route::get('/supervised-collectors', 'supervised')->name('supervised-collectors');
});

Route::controller(CommunityTaxController::class)->group(function () {
    Route::get('/register-community-tax-individual/{accountableForm}', 'createIndividual')->name('record-community-tax-individual');
    Route::POST('/register-community-tax-individual/{accountableForm}', 'storeIndividual');
    Route::get('/register-community-tax-corporate/{accountableForm}', 'createCorporate')->name('record-community-tax-corporate');
    Route::POST('/register-community-tax-corporate', 'storeCorporate');
});

Route::controller(RevenueTypeController::class)->group(function () {
    Route::get('/revenue-type-index', 'index')->name('revenue-type-index');
    Route::get('/create-revenue-type', 'create')->name('create-revenue-type');
    Route::POST('/create-revenue-type', 'store');
    // Route::get('/register-community-tax-corporate/{accountableForm}', 'createCorporate')->name('record-community-tax-corporate');
    // Route::POST('/register-community-tax-corporate', 'storeCorporate');
});

Route::controller(RealPropertyController::class)->group(function () {
    Route::get('/register-real-property-tax-receipt/{accountableForm}', 'create')->name('record-real-property-tax-receipt');
    Route::POST('/register-real-property-tax-receipt', 'store');
});

Route::controller(AccountableFormController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/dashboard2', 'dashboard');
    Route::get('/my-draft-report', 'userDraft')->name('view-own-draft-individual-report');
    Route::get('/review-accountable-form/{accountableForm}', 'review')->name('review-accountable-form');
    Route::get('/show-accountable-form/{accountableForm}', 'show')->name('show-accountable-form');
    Route::get('/register-accountable-form', 'create')->name('create-accountable-form');
    Route::post('/register-accountable-form', 'store');
    Route::get('record/{accountableFormType}', 'record')->name('record-accountable-form');
    Route::put('record/{accountableFormType}', 'fill');
    Route::get('edit/{accountableForm}', 'record')->name('edit-accountable-form');
    Route::put('edit/{accountableForm}', 'update');
    Route::delete('/{accountableForm}', 'destroy')->name('delete-accountable-form');
});


Route::controller(AccountableFormItemController::class)->group(function () {
    Route::get('/accountableFormItem/{accountableForm}', 'index')->name('add-accountable-form-item');
    Route::post('/accountableFormItem/{accountableForm}', 'store');
    Route::delete('/accountableFormItem/{accountableFormItem}', 'destroy')->name('delete-accountable-form-item');
});

Route::controller(AccountableFormTypeController::class)->group(function () {
    Route::get('/accountableFormType', 'index')->name('accountable-form-type-index');
    Route::get('/accountableFormType/create', 'create')->name('create-accountable-form-type');
    Route::post('/accountableFormType/create', 'store');
    Route::get('edit/{accountableFormType}', 'edit')->name('edit-accountable-form-type');
    Route::put('edit/{accountableFormType}', 'update');
    Route::delete('/accountableFormType/{accountableFormType}', 'destroy')->name('delete-accountable-form-type');
});

// Route::get('/test', function () {
//     // return a 404 message
//     abort(404);

// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\HomePageController::class, 'index']);

Auth::routes();
Route::get('register', [App\Http\Controllers\HomePageController::class, 'register'])->name('register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Users
Route::prefix('dashboard')->group(function () {
    Route::get('/referral', [App\Http\Controllers\HomeController::class, 'referral'])->name('referral');
    Route::get('/downlines', [App\Http\Controllers\HomeController::class, 'downlines'])->name('downlines');
    Route::get('/properties', [App\Http\Controllers\HomeController::class, 'properties'])->name('user.properties');
    Route::get('/view/property/{id}', [App\Http\Controllers\HomeController::class, 'view_property'])->name('user.view.property');
    Route::get('/account', [App\Http\Controllers\HomeController::class, 'account'])->name('user.account');
    Route::post('/update/user/{id}', [App\Http\Controllers\HomeController::class, 'update_user'])->name('update.user');
    Route::post('/change/user/password/{id}', [App\Http\Controllers\HomeController::class, 'change_password_user'])->name('change.password.user');
});

// Admin
Route::get('/admin/login', [App\Http\Controllers\HomePageController::class, 'admin']);
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::get('/admin/staffs', [App\Http\Controllers\AdminController::class, 'staffs'])->name('staffs');
    Route::get('/admin/agents', [App\Http\Controllers\AdminController::class, 'agents'])->name('agents');
    Route::post('/admin/user/save', [App\Http\Controllers\AdminController::class, 'add_user'])->name('add.user');
    Route::post('/admin/user/edit/{id}', [App\Http\Controllers\AdminController::class, 'edit_user'])->name('edit.user');
    Route::post('/admin/user/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_user'])->name('delete.user');
    Route::get('/admin/user/downlines/{id}', [App\Http\Controllers\AdminController::class, 'downlines_user'])->name('downlines.user');
    Route::get('/admin/account', [App\Http\Controllers\AdminController::class, 'account'])->name('account');
    Route::post('/admin/account/change/password/{id}', [App\Http\Controllers\AdminController::class, 'change_password'])->name('change.password');
    Route::get('/admin/call-bookings', [App\Http\Controllers\AdminController::class, 'call_bookings'])->name('call.bookings');
    Route::post('/admin/call-bookings/save', [App\Http\Controllers\AdminController::class, 'add_call_bookings'])->name('add.call_bookings');
    Route::post('/admin/call-bookings/edit/{id}', [App\Http\Controllers\AdminController::class, 'edit_call_bookings'])->name('edit.call_bookings');
    Route::post('/admin/call-bookings/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_call_bookings'])->name('delete.call_bookings');
    Route::get('/admin/properties', [App\Http\Controllers\AdminController::class, 'properties'])->name('properties');
    Route::get('/admin/property/add', [App\Http\Controllers\AdminController::class, 'property'])->name('property');
    Route::post('/admin/property/save', [App\Http\Controllers\AdminController::class, 'add_property'])->name('add.property');
    Route::get('/admin/property/view/{id}', [App\Http\Controllers\AdminController::class, 'view_property'])->name('view.property');
    Route::post('/admin/property/update/{id}', [App\Http\Controllers\AdminController::class, 'update_property'])->name('update.property');
    Route::post('/admin/property/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_property'])->name('delete.property');

    // Client Management
    Route::get('/admin/client-management', [App\Http\Controllers\AdminController::class, 'clients'])->name('clients');
    Route::get('/admin/client-management/add', [App\Http\Controllers\AdminController::class, 'client_management'])->name('client.management');
    Route::post('/admin/client-management/save', [App\Http\Controllers\AdminController::class, 'add_client_management'])->name('add.client.management');
    Route::get('/admin/client-management/view/{id}', [App\Http\Controllers\AdminController::class, 'view_client_management'])->name('view.client.management');
    Route::post('/admin/client-management/update/{id}', [App\Http\Controllers\AdminController::class, 'update_client_management'])->name('update.client.management');
    Route::post('/admin/client-management/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_client_management'])->name('delete.client.management');

    // Inventories
    Route::get('/admin/suppliers', [App\Http\Controllers\AdminController::class, 'suppliers'])->name('suppliers');
    Route::post('/admin/supplier/add', [App\Http\Controllers\AdminController::class, 'add_supplier'])->name('add.supplier');
    Route::post('/admin/supplier/update/{id}', [App\Http\Controllers\AdminController::class, 'update_supplier'])->name('update.supplier');
    Route::post('/admin/supplier/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_supplier'])->name('delete.supplier');

    Route::get('/admin/categories', [App\Http\Controllers\AdminController::class, 'categories'])->name('categories');
    Route::post('/admin/category/add', [App\Http\Controllers\AdminController::class, 'add_category'])->name('add.category');
    Route::post('/admin/category/update/{id}', [App\Http\Controllers\AdminController::class, 'update_category'])->name('update.category');
    Route::post('/admin/category/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_category'])->name('delete.category');

    Route::get('/admin/products', [App\Http\Controllers\AdminController::class, 'products'])->name('products');
    Route::post('/admin/product/add', [App\Http\Controllers\AdminController::class, 'add_product'])->name('add.product');
    Route::get('/admin/product/view/{id}', [App\Http\Controllers\AdminController::class, 'view_product'])->name('view.product');
    Route::post('/admin/product/update/{id}', [App\Http\Controllers\AdminController::class, 'update_product'])->name('update.product');
    Route::post('/admin/product/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_product'])->name('delete.product');
   
    // Todo List
    Route::get('/admin/todo-list', [App\Http\Controllers\AdminController::class, 'todo_list'])->name('todo.list');
    Route::post('/admin/todo-list/save', [App\Http\Controllers\AdminController::class, 'add_todo_list'])->name('add.todo.list');
    Route::get('/admin/todo-list/completed/{id}', [App\Http\Controllers\AdminController::class, 'completed_todo_list'])->name('completed.todo.list');
    Route::get('/admin/todo-list/pending/{id}', [App\Http\Controllers\AdminController::class, 'pending_todo_list'])->name('pending.todo.list');
    Route::post('/admin/todo-list/edit/{id}', [App\Http\Controllers\AdminController::class, 'edit_todo_list'])->name('edit.todo.list');
    Route::post('/admin/todo-list/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_todo_list'])->name('delete.todo.list');  

    // Financial Management
    Route::get('/admin/incomes', [App\Http\Controllers\AdminController::class, 'incomes'])->name('incomes');
    Route::post('/admin/income/add', [App\Http\Controllers\AdminController::class, 'add_income'])->name('add.income');
    Route::post('/admin/income/update/{id}', [App\Http\Controllers\AdminController::class, 'update_income'])->name('update.income');
    Route::post('/admin/income/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_income'])->name('delete.income');

    Route::get('/admin/expenses', [App\Http\Controllers\AdminController::class, 'expenses'])->name('expenses');
    Route::post('/admin/expense/add', [App\Http\Controllers\AdminController::class, 'add_expense'])->name('add.expense');
    Route::post('/admin/expense/update/{id}', [App\Http\Controllers\AdminController::class, 'update_expense'])->name('update.expense');
    Route::post('/admin/expense/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_expense'])->name('delete.expense');

    Route::get('/admin/debtors', [App\Http\Controllers\AdminController::class, 'debtors'])->name('debtors');
    Route::post('/admin/debtor/add', [App\Http\Controllers\AdminController::class, 'add_debtor'])->name('add.debtor');
    Route::post('/admin/debtor/process/{id}', [App\Http\Controllers\AdminController::class, 'process_debtor'])->name('process.debtor');
    Route::post('/admin/debtor/update/{id}', [App\Http\Controllers\AdminController::class, 'update_debtor'])->name('update.debtor');
    Route::post('/admin/debtor/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_debtor'])->name('delete.debtor');

    // Enquiry Management
    Route::get('/admin/enquiries', [App\Http\Controllers\AdminController::class, 'enquiries'])->name('enquiries');
    Route::post('/admin/enquiry/add', [App\Http\Controllers\AdminController::class, 'add_enquiry'])->name('add.enquiry');
    Route::post('/admin/enquiry/update/{id}', [App\Http\Controllers\AdminController::class, 'update_enquiry'])->name('update.enquiry');
    Route::post('/admin/enquiry/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_enquiry'])->name('delete.enquiry');
});
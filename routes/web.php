<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/', 'login');
    Route::get('/logout', 'logout')->name('logout');
});
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.view.dashboard', ['tittle' => 'Dashboard']);
        })->name('dashboard');
        Route::controller(AdminController::class)->prefix('staff')->group(function () {
            Route::post('/{user}/restore', 'restoreStaff')->name('staff.restore');
            Route::get('/deleted', 'getListDeleted')->name('staff.deleted');
            Route::get('/search', 'search')->name('staff.search');
            Route::delete('/{user}', 'destroy')->name('staff.destroy');
            Route::patch('/{user}', 'update')->name('staff.update');
            Route::get('/{user}/edit', 'edit')->name('staff.edit');
            Route::get('/create', 'create')->name('staff.create');
            Route::post('/', 'store')->name('staff.store');
            Route::get('/', 'index')->name('staff.index');
            Route::get('/{user}', 'show')->name('staff.show');
        });
        Route::controller(UserController::class)->prefix('customers')->group(function () {
            Route::post('/{user}/restore', 'restoreCustomer')->name('users.restore');
            Route::get('/deleted', 'getListDeleted')->name('users.deleted');
            Route::get('/{user}/addPackage/search', 'searchAddPackage')->name('users.addPackage.search');
            Route::post('/{user}/addPackage', 'addPackage')->name('users.addUser');
            Route::get('/{user}/addPackage', 'formAddPackage')->name('users.formAddPackage');

            Route::get('/search', 'search')->name('users.search');
            Route::delete('/{user}', 'destroy')->name('users.destroy');
            Route::patch('/{user}', 'update')->name('users.update');
            Route::get('/{user}/edit', 'edit')->name('users.edit');
            Route::get('/create', 'create')->name('users.create');
            Route::post('/', 'store')->name('users.store');
            Route::get('/', 'index')->name('users.index');
            Route::get('/{user}', 'show')->name('users.show');
            Route::post('/change-pass', 'changePassword')->name('users.change-pass');
        });
        Route::controller(DepartmentController::class)->prefix('departments')->group(function () {
            Route::get('/{department}/addUser/search', 'search')->name('departments.addMember.search');
            Route::post('/{department}/addMember', 'addMember')->name('departments.addMember');
            Route::get('/{department}/addUser', 'formAddUser')->name('departments.formAddUser');
            Route::delete('/{department}', 'destroy')->name('departments.destroy');
            Route::get('/{department}/edit', 'edit')->name('departments.edit');
            Route::patch('/{department}', 'update')->name('departments.update');
            Route::get('/', 'index')->name('departments.index');
            Route::get('/{department}/user', 'showUser')->name('departments.users');
            Route::get('/create', 'create')->name('departments.create');
            Route::post('/', 'store')->name('departments.store');
            Route::get('/{department}', 'show')->name('departments.show');
            Route::get('/{department}/add_user', 'addUser')->name('departments.addUser');
        });
        Route::controller(PackageController::class)->prefix('packages')->group(function () {
            Route::post('/{package}/restore', 'restorePackage')->name('packages.restore');
            Route::get('/deleted', 'getListDeleted')->name('packages.deleted');
            Route::get('/{package}/addUser/search', 'searchAddUser')->name('packages.addUser.search');
            Route::post('/{package}/addUser', 'addUser')->name('packages.addUser');
            Route::get('/{package}/addUser', 'getFormAddUser')->name('packages.formAddUser');
            Route::get('/search', 'search')->name('packages.search');
            Route::get('/sort', 'sort')->name('packages.sort');
            Route::delete('/{package}', 'destroy')->name('packages.destroy');
            Route::get('/{package}/edit', 'edit')->name('packages.edit');
            Route::patch('/{package}', 'update')->name('packages.update');
            Route::get('/create', 'create')->name('packages.create');
            Route::post('/', 'store')->name('packages.store');
            Route::get('/', 'index')->name('packages.index');
            Route::get('/{package}', 'show')->name('packages.show');
        });
        Route::controller(ApointmentController::class)->prefix('apointments')->group(function () {
            Route::post('/{package}/restore', 'restoreApointment')->name('apointments.restore');
            Route::get('/deleted', 'getListDeleted')->name('apointments.deleted');
            Route::get('/create', 'create')->name('apointments.create');
            Route::post('/', 'store')->name('apointments.store');
            Route::get('/search', 'search')->name('apointments.search');
            Route::get('/sort', 'sort')->name('apointments.sort');
            Route::delete('/{apointment}', 'destroy')->name('apointments.destroy');
            Route::get('/{apointment}/edit', 'edit')->name('apointments.edit');
            Route::patch('/{apointment}', 'update')->name('apointments.update');
            Route::get('/{apointment}', 'show')->name('apointments.show');
            Route::get('/', 'index')->name('apointments.index');
        });
    });
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

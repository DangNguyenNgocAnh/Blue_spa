<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('loginAccount');
    Route::post('/reset-password', 'resetPassword')->name('user.resetPassword');
});
Route::controller(UserController::class)->group(function () {
    Route::get('/register', 'getFormRegister')->name('user.getFormRegister');
    Route::post('/register', 'register')->name('user.register');
    Route::get('/apointment', 'makeApointment')->name('user.apointment');
});
Route::controller(DashboardController::class)->group(function () {

    Route::get('/', 'user')->name('user.dashboard');
    Route::get('/about', 'about')->name('dashboard.about');
    Route::get('/{category}/listItem', 'list')->name('category.listItem');
    Route::get('/coupons', 'listCoupon')->name('dashboard.coupon');
});
Route::middleware('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'logout')->name('logout');
    });
    Route::controller(PaymentController::class)->group(function () {
        Route::post('/payment/{coupon}', 'index')->name('payments.index');
        Route::get('/payment', 'dataReturn')->name('payments.dataReturn');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'show')->name('user.show');
        Route::post('/changePassword', 'changePassword')->name('user.changePassword');
        Route::patch('/update', 'update')->name('user.updateProfile');
        Route::post('/apointment', 'createApointment')->name('user.createApointment');
        Route::get('/listApointment', 'showAllPackage')->name('user.showAllPackage');
        Route::patch('/apointment', 'setValueStatus')->name('user.setValueStatus');
    });
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::controller(AdminController::class)->prefix('staff')->group(function () {
            Route::get('/profile', 'profile')->name('staff.profile');
            Route::get('/editProfile', 'editProfile')->name('staff.editProfile');
            Route::post('/{user}/reset', 'resetPassword')->name('staff.resetPassword');
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
        Route::controller(CustomerController::class)->prefix('customers')->group(function () {
            Route::get('/{user}/coupons', 'showCoupons')->name('users.showCoupons');
            Route::get('/{user}/apointments', 'showApointment')->name('users.showApointment');
            Route::get('/{user}/addApointment', 'addApointment')->name('users.addApointment');
            Route::post('/{user}/addApointment', 'storeApointment')->name('users.storeApointment');

            Route::post('/{user}/reset', 'resetPassword')->name('users.resetPassword');
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
            Route::patch('/{package}', 'update')->name('packages.update');
            Route::post('/', 'store')->name('packages.store');
            Route::post('/{package}/restore', 'restorePackage')->name('packages.restore');
            Route::get('/deleted', 'getListDeleted')->name('packages.deleted');
            Route::get('/{package}/addUser/search', 'searchAddUser')->name('packages.addUser.search');
            Route::post('/{package}/addUser', 'addUser')->name('packages.addUser');
            Route::get('/{package}/addUser', 'getFormAddUser')->name('packages.formAddUser');
            Route::get('/search', 'search')->name('packages.search');
            Route::get('/sort', 'sort')->name('packages.sort');
            Route::delete('/{package}', 'destroy')->name('packages.destroy');
            Route::get('/{package}/edit', 'edit')->name('packages.edit');
            Route::get('/create', 'create')->name('packages.create');
            Route::get('/{package}', 'show')->name('packages.show');
            Route::get('/', 'index')->name('packages.index');
        });
        Route::controller(ApointmentController::class)->prefix('apointments')->group(function () {
            Route::patch('/{apointment}', 'update')->name('apointments.update');
            Route::post('/{package}/restore', 'restoreApointment')->name('apointments.restore');
            Route::get('/deleted', 'getListDeleted')->name('apointments.deleted');
            Route::get('/create', 'create')->name('apointments.create');
            Route::post('/', 'store')->name('apointments.store');
            Route::get('/search', 'search')->name('apointments.search');
            Route::get('/sort', 'sort')->name('apointments.sort');
            Route::delete('/{apointment}', 'destroy')->name('apointments.destroy');
            Route::get('/{apointment}/edit', 'edit')->name('apointments.edit');
            Route::get('/{apointment}', 'show')->name('apointments.show');
            Route::get('/', 'index')->name('apointments.index');
        });
        Route::controller(CategoryController::class)->prefix('categories')->group(function () {
            Route::get('/{category}/addPackage', 'addPackage')->name('categories.addPackage');

            Route::delete('/{category}', 'destroy')->name('categories.destroy');
            Route::get('/{category}/edit', 'edit')->name('categories.edit');
            Route::patch('/{category}', 'update')->name('categories.update');
            Route::get('/', 'index')->name('categories.index');
            Route::get('/{category}/packages', 'showPackage')->name('categories.packages');
            Route::get('/create', 'create')->name('categories.create');
            Route::post('/', 'store')->name('categories.store');
            Route::get('/{category}', 'show')->name('categories.show');
        });
        Route::controller(CouponController::class)->prefix('coupons')->group(function () {
            Route::post('/{id}', 'restore')->name('coupons.restore');
            Route::get('/listDeleted', 'listDeleted')->name('coupons.listDeleted');

            Route::delete('/{coupon}', 'destroy')->name('coupons.destroy');
            Route::patch('/{coupon}', 'update')->name('coupons.update');
            Route::get('/', 'index')->name('coupons.index');
            Route::post('/', 'store')->name('coupons.store');
        });
    });
});

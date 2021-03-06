<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/success', [CartController::class, 'success'])->name('success');
Route::view('/register/success', 'auth.success')->name('register-success');
Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::get('categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/details/{id}', [DetailController::class, 'index'])->name('details');

Route::post('callback', [CheckoutController::class, 'callback'])->name('midtrans.callback');

Route::group(['middleware' => 'auth'], function () {
    Route::post('checkout', [CheckoutController::class, 'process'])->name('checkout');

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart');
        Route::post('/{id}', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/{id}', [CartController::class, 'delete'])->name('cart.delete');
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/products', DashboardProductController::class)->names('dashboard.products');
        Route::post('products/gallery', [DashboardProductController::class, 'uploadGallery'])->name('dashboard.gallery.upload');
        Route::get('products/gallery/{id}', [DashboardProductController::class, 'removeGallery'])->name('dashboard.gallery.remove');
        Route::get('/transaction', [DashboardTransactionController::class, 'index'])->name('dashboard.transactions');
        Route::get('/transaction/{id}', [DashboardTransactionController::class, 'show'])->name('dashboard.transactions.show');
        Route::get('/settings', [DashboardSettingController::class, 'store'])->name('dashboard.settings.store');
        Route::post('/settings/{redirect}', [DashboardSettingController::class, 'update'])->name('dashboard.settings.update');
        Route::get('/account', [DashboardSettingController::class, 'account'])->name('dashboard.settings.account');
    });

    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('categories', AdminCategoryController::class)->names('admin.categories');
        Route::resource('users', UserController::class)->names('admin.users');
        Route::resource('products', ProductController::class)->names('admin.products');
        Route::resource('galleries', ProductGalleryController::class)->names('admin.galleries');
    });
});

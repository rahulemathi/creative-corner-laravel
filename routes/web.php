<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

// Public routes
Route::get('/', function () {
    return view('pages.index');
});

Route::get('/about', function(){
    return view('pages.about');
});

Route::get('/contact', function(){
    return view('pages.contact');
});


Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/category/{slug}', [ProductController::class, 'category'])->name('products.category');

// Admin routes (protected by auth and admin middleware)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin',
])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories management
    Route::resource('categories', CategoryController::class);

    // Products management
    Route::resource('products', AdminProductController::class);

    // Admin Order Management
    Route::resource('orders', AdminOrderController::class)->except(['create', 'store', 'destroy']);
});

// Jetstream routes (user dashboard)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.index');
    })->name('dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('user.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    

    // Cart routes
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('add/{product}', [CartController::class, 'add'])->name('add');
        Route::patch('update/{product}', [CartController::class, 'update'])->name('update');
        Route::delete('remove/{product}', [CartController::class, 'remove'])->name('remove');
        Route::get('payment',[CartController::class,'payment'])->name('payment');
        Route::post('payment',[CartController::class,'paymentStore'])->name('payment.store');
    });

    // Address routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('addresses', [AddressController::class, 'index'])->name('addresses');
        Route::post('addresses', [AddressController::class, 'store'])->name('addresses.store');
        Route::patch('addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');
        Route::delete('addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
        Route::patch('addresses/{address}/default', [AddressController::class, 'setDefault'])->name('addresses.default');
    });


    // Order routes
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('{order}', [OrderController::class, 'show'])->name('show');
        // Route::post('/', [OrderController::class, 'store'])->name('store'); // For creating orders from cart
    });
});

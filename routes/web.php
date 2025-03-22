<?php

use App\Http\Controllers\Admin\BusinessSettingsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::group(['middleware' => ['web']], function () {
    Route::get('/', [HomeController::class, 'userHome'])->name('home');
    Route::get('/vendor/products', [ProductController::class, 'vendorProducts'])->name('vendor.products');
    Route::get('/vendor/register', [VendorController::class, 'showRegisterForm'])->name('vendor.register');
    Route::post('/vendor/register', [VendorController::class, 'register'])
        ->name('vendor.register.store')
        ->middleware('throttle:10,1');
    Route::get('/{brand}', [BrandController::class, 'show'])->name('brand.show');
    Route::get('/brand/{id}', [BrandController::class, 'show'])->name('brand.show.id'); // Avoid name conflict
    Route::get('/home/about-us', function () {
        return view('home.about-us');
    })->name('about-us');
});

// Authentication Routes (Guests Only)
Route::group(['middleware' => ['web', 'guest']], function () {
    Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
    Route::get('/auth/register', [RegisterController::class, 'showRegistrationForm'])->name('auth.register');
    Auth::routes(['verify' => true]); // Includes login, register, logout, etc.
});

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard Redirect Logic
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('Vendor') && $user->status === 'approved') {
            return redirect()->route('vendor.dashboard');
        }
        return redirect()->route('home')->with('message', 'Access denied or pending approval.');
    })->name('dashboard');

    // General Logout Route (Available to all authenticated users)
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Admin Routes
    Route::prefix('admin')->middleware('role:Admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/vendors', [AdminController::class, 'vendors'])->name('admin.vendors');
        Route::patch('/vendors/{id}/status', [AdminController::class, 'updateVendorStatus'])
            ->name('admin.vendors.update-status')
            ->middleware('permission:manage-vendors');
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers');

        // Products Routes
        Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products');
        Route::get('/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])
            ->name('admin.add-product')
            ->middleware('permission:manage-products');
        Route::post('/products', [App\Http\Controllers\Admin\ProductController::class, 'store'])
            ->name('admin.products.store')
            ->middleware('permission:manage-products');

        Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('admin.categories.store')
            ->middleware('permission:manage-categories');
        Route::get('/shipping', [AdminController::class, 'shipping'])->name('admin.shipping');
        Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments');
        Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
        Route::get('/business-settings', [BusinessSettingsController::class, 'index'])->name('admin.business-settings');
        Route::put('/business-settings', [BusinessSettingsController::class, 'update'])->name('admin.business-settings.update');
    });

    // Vendor Routes
    Route::prefix('vendor')->middleware('role:Vendor')->group(function () {
        Route::get('/dashboard', [VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
        Route::get('/products', [ProductController::class, 'index'])->name('vendor.products');
        Route::get('/products/create', [ProductController::class, 'create'])->name('vendor.products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('vendor.products.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('vendor.products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('vendor.products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('vendor.products.destroy');
        Route::get('/orders', [OrderController::class, 'index'])->name('vendor.orders');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('vendor.orders.show');
        Route::get('/add-coupon', [CouponController::class, 'create'])->name('vendor.coupons.create');
        Route::post('/coupons', [CouponController::class, 'store'])->name('vendor.coupons.store');
        Route::get('/settings', [SettingController::class, 'index'])->name('vendor.settings');
        Route::put('/settings', [SettingController::class, 'update'])->name('vendor.settings.update');
        Route::get('/order-report', [OrderController::class, 'report'])->name('vendor.order-report');
    });

    // General Authenticated Routes
    Route::get('/home', [HomeController::class, 'userHome'])->name('home');
    Route::get('/home/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/home/track', function () {
        return view('home.track');
    })->name('track');
    Route::get('/home/contact-us', function () {
        return view('home.contact-us');
    })->name('contact-us');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

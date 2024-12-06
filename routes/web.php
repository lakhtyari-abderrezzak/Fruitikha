<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Categories;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessagesController;

// Home Page Route
Route::get('/', function () {
    $categories = Categories::all();
    return view('categories.index', data: ['categories' => $categories]);
})->name('home');


Route::resource('/categories', CategoriesController::class)->name('get', 'categories');
Route::resource('/products', ProductController::class)->name('get', 'product');
Route::get('/catProduct/{id}', [CategoriesController::class, 'catProduct'])->name('categories.catProduct');
Route::get('cart', [CartController::class, 'index'])->name('cart.index');

// Admin Route Groupe here
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Authenticated Users 
Route::middleware('auth')->group(function () {
    // DashBoard Route 
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/profile', [DashboardController::class, 'profile'])->name('user.profile');
    Route::get('/user/edit', [AuthController::class, 'edit'])->name('user.edit');
    Route::patch('/user/{id}', [AuthController::class, 'update'])->name('user.update');

    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    //addToCart Route
    Route::post('cart', [CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::post('/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy'); 
    Route::post('/order/update/{id}',  [OrderController::class, 'change'])->name('order.change'); 
    
    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkout/payment', [checkoutController::class, 'payment'])->name('checkout.payment');
    Route::post('/checkout', [checkoutController::class, 'order'])->name('checkout.order');

    // Order Destroy 

});

// User Product Route 
Route::get('/{user}/products', [DashboardController::class, 'userProduct'])->name('products.user');
// About Route
Route::get('/about', [MessagesController::class, 'index'])->name('about.index');

// Contact Send Email
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'sendEnquiry'])->name('contact.sendEnquiry');

Route::middleware('guest')->group(function () {
    // Register Route
    Route::view('/register', '/auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Login Route
    Route::view('/login', '/auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::controller(CheckoutController::class)->group(function(){

    Route::get('stripe/{totalPrice}', 'stripe');

    Route::post('stripe/{totalPrice}', 'stripePost')->name('stripe.post');

});
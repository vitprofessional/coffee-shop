<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function(){ return view('about'); })->name('about');

Route::get('/menu', [MenuController::class,'index'])->name('menu.index');
Route::get('/menu/{slug}', [MenuController::class,'show'])->name('menu.show');

Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class,'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class,'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class,'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class,'index'])->name('checkout.index');
Route::post('/order', [CheckoutController::class,'store'])->name('order.store');
Route::get('/order/success/{number}', [OrderController::class,'success'])->name('order.success');

Route::get('/reservation', [ReservationController::class,'index'])->name('reservation.index');
Route::post('/reservation', [ReservationController::class,'store'])->name('reservation.store');

Route::get('/gallery', [GalleryController::class,'index'])->name('gallery.index');

Route::get('/events', [EventController::class,'index'])->name('events.index');
Route::get('/events/{slug}', [EventController::class,'show'])->name('events.show');

Route::get('/blog', [BlogController::class,'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class,'show'])->name('blog.show');

Route::get('/contact', [ContactController::class,'index'])->name('contact.index');
Route::post('/contact', [ContactController::class,'store'])->name('contact.store');


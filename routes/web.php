<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\KasirMiddleware;
use App\Http\Middleware\MemberMiddleware;
use App\Http\Middleware\PimpinanMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->name('admin.')->group(function () {
    Route::get('dashboard', [ProductController::class,'dashboard'])->name('dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('purchases', PurchaseController::class);
});

Route::middleware(['auth', PimpinanMiddleware::class])->group(function () {
    Route::get('pimpinan/product',[ MemberController::class, 'product'])->name('pimpinan.product');
    Route::get('pimpinan/laporan',[ PimpinanController::class, 'laporan'])->name('pimpinan.laporan');
    Route::get('/laporan/cetak-pdf', [PDFController::class, 'generatePDF'])->name('laporan.pdf');

});
Route::middleware(['auth', MemberMiddleware::class])->name('member.')->group(function () {
    Route::get('member/product',[ MemberController::class, 'product'])->name('member.product');
    Route::get('member/sale',[ MemberController::class, 'history'])->name('member.history');
});
Route::prefix('kasir')->middleware(['auth', KasirMiddleware::class])->group(function () {
    Route::get('kasir/product', [KasirController::class, 'product'])->name('kasir.product');
    Route::get('dashboard', function () {
        return view('cashier.index');
    })->name('kasir.dashboard');
    Route::resource('kasir', SaleController::class);
    Route::resource('member', MemberController::class);
});


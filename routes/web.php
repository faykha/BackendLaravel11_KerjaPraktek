<?php




use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route untuk menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk memproses login
Route::post('/login', [AuthController::class, 'login']);

// Route untuk menampilkan dashboard tanpa middleware
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

// Tambahkan route untuk logout jika diperlukan
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//redirect
Route::get('/', function () {
    return redirect()->route('login');
});


use App\Http\Controllers\DataStatikController;

// Route untuk halaman CRUD
Route::get('/datastatik', function () {
    return view('datastatik'); // Pastikan file view bernama 'data-statik-crud.blade.php'
});



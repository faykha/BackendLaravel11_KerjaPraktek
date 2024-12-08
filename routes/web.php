<?php




use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route untuk menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk memproses login
Route::post('/login', [AuthController::class, 'login']);

// Route untuk menampilkan dashboard tanpa middleware
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
// Tambahkan route untuk logout jika diperlukan
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//redirect
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/datastatik', function () {
    return view('datastatik'); // Pastikan file view benar-benar bernama 'datastatik.blade.php'
})->middleware('auth');

Route::get('/user', function () {
    return view('user'); // Pastikan file view benar-benar bernama 'datastatik.blade.php'
})->middleware('auth');

Route::get('/lantai', function () {
    return view('lantai'); // Pastikan file view benar-benar bernama 'datastatik.blade.php'
})->middleware('auth');

Route::get('/unit', function () {
    return view('unit'); // Pastikan file view benar-benar bernama 'datastatik.blade.php'
})->middleware('auth');




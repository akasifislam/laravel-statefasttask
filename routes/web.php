<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlController;
use App\Models\Url;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::resource('urls', UrlController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('urls', UrlController::class);
});


Route::group(['middleware' => ['auth', 'role:admin']], function () {});

Route::group(['middleware' => ['auth', 'role:user']], function () {});



Route::get('{url}', function ($url) {
    $urllink = Url::where('short_code', $url)->first();
    if ($urllink) {
        $urllink->increment('click_count');
        return redirect($urllink->original_url);
    }
    return abort(404);
});


require __DIR__ . '/auth.php';

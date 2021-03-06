<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeathDataController;
use App\Http\Controllers\FamilyCardController;
use App\Http\Controllers\UserController;
use App\Models\DeathData;
use App\Models\DeathDataDaily;
use App\Models\DeathDataMonthly;
use App\Models\DeathDataWeekly;
use GuzzleHttp\Psr7\Request;
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

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('attemptLogin');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $daily = DeathDataDaily::orderBy('date', 'desc')->first();
        $weekly = DeathDataWeekly::orderBy('weekly', 'desc')->first();
        $monthly = DeathDataMonthly::orderBy('date', 'desc')->first();

        return view('dashboard', [
            'daily' => $daily,
            'weekly' => $weekly,
            'monthly' => $monthly
        ]);
    })->name('dashboard');

    // Route::get('/death_data', [DeathDataController::class, 'index'])->name('death_data');

    Route::resource('/death_data', DeathDataController::class);
    // Route::resource('/family_card', FamilyCardController::class);
    Route::group(['prefix' => '/family_card'], function () {
        Route::get('/', [FamilyCardController::class, "index"])->name('family_card.index');
        Route::post('/', [FamilyCardController::class, "store"])->name('family_card.store');
        // Route::put('/update', [FamilyCardController::class, "update"])->name('family_card.update');
    });

    Route::group(['prefix' => '/user_management'], function () {
        Route::get('/', [UserController::class, 'index'])->name('user_management.index');
        Route::post('/', [UserController::class, 'store'])->name('user-management.store');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

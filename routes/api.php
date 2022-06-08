<?php

use App\Models\DeathDataDaily;
use App\Models\DeathDataMonthly;
use App\Models\DeathDataWeekly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/dataBulan', function (Request $request) {
    $monthly = DeathDataMonthly::orderBy('date', 'desc')->first()->count;

    return response($monthly);
});
Route::get('/dataMingguan', function (Request $request) {
    $weekly = DeathDataWeekly::orderBy('weekly', 'desc')->first()->count;

    return response($weekly);
});
Route::get('/dataHarian', function (Request $request) {
    $daily = DeathDataDaily::orderBy('date', 'desc')->first()->count;

    return response($daily);
});

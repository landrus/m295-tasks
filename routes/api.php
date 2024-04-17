<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Bike;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('responders')->group(function () {
   Route::get('/hi', function () {
       return 'Hallo Welt';
   });

   Route::get('/number', function () {
       return random_int(1, 10);
   });

   Route::get('/www', function () {
       return redirect('https://ict-bz.ch');
   });

   Route::get('/favi', function () {
       return response()->download(public_path('favicon.ico'));
   });

   Route::get('/hi/{name}', function (string $name) {
       return "Hi $name";
   });

    $weather = [
        'city' => 'Luzern',
        'temperature' => 20,
        'wind' => 10,
        'rain' => 0,
    ];

    Route::get('/weather', function () use($weather) {
        return response()->json($weather);
    });

    Route::get('/error', function () {
        return response()->json(['error' => 'Nicht authorisiert!'], 401);
    });

    Route::get('/multiply/{num1}/{num2}', function (int $num1, int $num2) {
        return $num1 * $num2;
    });
});

Route::prefix('/hallo-velo')->group(function () {
    Route::get('/bikes', function () {
        return Bike::all();
    });

    Route::get('/bikes/{id}', function (int $id) {
        return Bike::find($id);
    })->whereNumber('id');
});

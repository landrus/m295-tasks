<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ClownController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RelationSheepController;
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

Route::prefix('hallo-velo')->group(function () {
    Route::get('/bikes', function () {
        return Bike::all();
    });

    Route::get('/bikes/{id}', function (int $id) {
        return Bike::find($id);
    })->whereNumber('id');
});

Route::prefix('bookler')->controller(BookController::class)->group(function () {
    Route::get('books', 'all');
    Route::get('books/{id}', 'find');

    Route::get('book-finder/slug/{slug}', 'findBySlug');
    Route::get('book-finder/year/{year}', 'findByYear');
    Route::get('book-finder/max-pages/{pages}', 'findByMaxPages');

    Route::get('search/{search}', 'search');

    Route::get('meta/count', 'count');
    Route::get('meta/avg-pages', 'pages');

    Route::get('dashboard', 'dashboard');
});

Route::prefix('relationsheep')->controller(RelationSheepController::class)->group(function () {
    Route::get('posts', 'posts');
    Route::get('topics/{slug}/posts', 'postsByTopic');
});

Route::prefix('ackerer')->controller(FarmController::class)->group(function () {
    Route::get('plants', 'allPlants');
    Route::get('plants/{slug}', 'findBySlug');
    Route::get('farms', 'allFarms');
});

Route::prefix('r-rest-y')->controller(ClownController::class)->group(function () {
    Route::get('clowns', 'all');
    Route::post('clowns', 'create');
    Route::put('clowns/{clown}', 'update')->whereNumber('id');
    Route::delete('clowns/{clown}', 'delete')->whereNumber('id');
});

Route::prefix('guardener')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::post('login', 'authenticate');
        Route::get('auth', 'checkAuth')->middleware('auth:sanctum');
        Route::get('logout', 'logout')->middleware('auth:sanctum');
    });

    Route::get('geheim', function () {
        return response()->json(['location' => 'Ebikonerstrasse 75, Adligenswil']);
    })->middleware('auth:sanctum');
});

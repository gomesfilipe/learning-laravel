<?php

use App\Http\Controllers\Api\EpisodesController;
use App\Http\Controllers\Api\SeasonsController;
use App\Http\Controllers\Api\SeriesController;
use App\Models\Series;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/series', SeriesController::class);
    // Route::get('/series', [SeriesController::class, 'index']);
    
    Route::post('/upload', [SeriesController::class, 'upload']);
    
    Route::get('series/{series}/seasons', [SeasonsController::class, 'index']);
    
    Route::get('series/{series}/episodes', [EpisodesController::class, 'index']);
    
    Route::patch('episodes/{episode}', [EpisodesController::class, 'patch']);
});


Route::post('/login', function (Request $request) {
    $credentials = $request->only(['email', 'password']);
    if(Auth::attempt($credentials) === false) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    // $user = User::where('email', $credentials['email'])->first();

    // if($user === null || Hash::check($credentials['password'], $user->password) === false) {
    //     return response()->json(['message' => 'Unauthorized'], 401);
    // }
    $user = Auth::user();
    $token = $user->createToken('token');
    return response()->json(['token' => $token->plainTextToken], 200);
});

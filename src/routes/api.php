<?php

use App\Http\Api\TeamController;
use App\Http\Api\PlayerController;
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

Route::get('/teams', [TeamController::class, 'getAllTeams']);
Route::post('/teams', [TeamController::class, 'storeTeamDetails']);
Route::put('/teams/{team}', [TeamController::class, 'updateTeamDetails']);
Route::delete('/teams/{team}', [TeamController::class, 'deleteTeamDetails']);

Route::get('teams/{team}/players', [PlayerController::class, 'getTeamPlayers']);
Route::post('/players', [PlayerController::class, 'storePlayerDetails']);
Route::put('/players/{player}', [PlayerController::class, 'updatePlayerDetails']);
Route::delete('/players/{player}', [PlayerController::class, 'deletePlayerDetails']);


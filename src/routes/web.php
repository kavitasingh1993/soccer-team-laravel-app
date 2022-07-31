<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\WelcomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('/dashboard', [AuthController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('teams',[TeamController::class, 'getAllTeams'])->name('teams.index');
Route::post('teams',[TeamController::class, 'storeTeam'])->name('teams.store');
Route::get('teams/create', [TeamController::class, 'createTeam'])->name('teams.create');
Route::put('teams/{team}', [TeamController::class, 'updateTeam'])->name('teams.update');
Route::get('teams/{team}' , [TeamController::class, 'showTeam'])->name('teams.show');
Route::delete('teams/{team}'  , [TeamController::class, 'destroyTeam'])->name('teams.destroy');
Route::get('teams/{team}/edit',  [TeamController::class, 'editTeam'])->name('teams.edit');

Route::get('teams/{team}/players',[PlayerController::class, 'getTeamPlayers'])->name('players.index');
Route::post('teams/{team}/players',[PlayerController::class, 'storePlayer'])->name('players.store');
Route::get('teams/{team}/players/create', [PlayerController::class, 'createPlayer'])->name('players.create');
Route::get('players/{player}' , [PlayerController::class, 'showPlayer'])->name('players.show');
Route::delete('players/{player}'  , [PlayerController::class, 'destroyPlayer'])->name('players.destroy');
Route::get('players/{player}/edit',  [PlayerController::class, 'editPlayer'])->name('players.edit');
Route::put('players/{player}', [PlayerController::class, 'updatePlayer'])->name('players.update');

Route::resource('welcomes', WelcomeController::class);
Route::get('/', [WelcomeController::class, 'index']);

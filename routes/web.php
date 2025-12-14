<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\LiveMusicController;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Controllers\ArtistController;

Route::get('/', function () {
    // Redirects / to /home
    return redirect()->route('home.image'); 
})->name('home');

Route::get('/home', function () {
    return view('ip.home');
})->name('home.image');

// buat login dan register 
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// setel lagu, chord, lirik
Route::prefix('songs')->group(function () {
    Route::get('/', [SongController::class, 'PublicIndex'])->name('songs.index');
    Route::get('/{id}', [SongController::class, 'show'])->name('songs.show');
    Route::get('/{id}/lyrics', [SongController::class, 'lyrics'])->name('songs.lyrics');
    Route::get('/{id}/chords', [SongController::class, 'chords'])->name('songs.chords');
});

// nampil playslist
Route::middleware('auth')->prefix('playlists')->group(function () {
    Route::get('/', [PlaylistController::class, 'index'])->name('playlists.index');
    Route::get('/create', [PlaylistController::class, 'create'])->name('playlists.create');
    Route::post('/', [PlaylistController::class, 'store'])->name('playlists.store');
    Route::get('/{id}', [PlaylistController::class, 'show'])->name('playlists.show');
    Route::put('/{id}', [PlaylistController::class, 'update'])->name('playlists.update');
    Route::delete('/{id}', [PlaylistController::class, 'destroy'])->name('playlists.destroy');
    Route::post('/{id}/songs', [PlaylistController::class, 'addSong'])->name('playlists.addSong');
    Route::delete('/{id}/songs/{songId}', [PlaylistController::class, 'removeSong'])->name('playlists.removeSong');
});

// fitur live
Route::middleware(['auth'])->prefix('live')->group(function () {
    Route::get('/', [LiveMusicController::class, 'PublicIndex'])->name('live.index');
    Route::get('/{id}', [LiveMusicController::class, 'show'])->name('live.show');
    Route::post('/{id}/join', [LiveMusicController::class, 'join'])->name('live.join');
});

Route::middleware(['auth', CheckAdminRole::class])->prefix('admin')->group(function () {
    
    Route::resource('artists', ArtistController::class)->except(['show'])->names('admin.artists');
    Route::resource('songs', SongController::class)->except(['show'])->names('admin.songs');
    Route::resource('live', LiveMusicController::class)->except(['show'])->names('admin.live');
});
 
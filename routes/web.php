<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\{
    ShowTweets
};

Route::get('/{slug?}', ShowTweets::class)->name('tweets.index')->middleware('auth');


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::fallback(function () {
    return response()->json(['message' => 'Não foi dessa vez!'], 404);
});

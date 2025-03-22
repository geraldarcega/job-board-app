<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'index'])->name('jobs.index');

Route::prefix('jobs')->group(function () {
    Route::post('/', [JobController::class,'store'])->name('jobs.store');
    Route::get('create', [JobController::class,'create'])->name('jobs.create');
    Route::get('{job:slug}', [JobController::class, 'show'])->name('jobs.show');

    Route::get('approve/{job}', [JobController::class, 'approve'])
        ->name('approve-job-post');
        // ->middleware('signed');
    Route::get('mark-as-spam/{job}', [JobController::class, 'markAsSpam'])
        ->name('mark-job-post-as-spam');
        // ->middleware('signed');
});

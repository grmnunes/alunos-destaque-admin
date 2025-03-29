<?php

use App\Http\Controllers\Api\AwardController;
use Illuminate\Support\Facades\Route;

Route::middleware('api.token')->prefix('awards')->group(function () {
    Route::get('/', [AwardController::class, 'index']);
});

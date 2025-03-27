<?php

use App\Http\Controllers\Api\AwardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('awards')->group(function () {
    Route::get('/', [AwardController::class, 'index']);
});

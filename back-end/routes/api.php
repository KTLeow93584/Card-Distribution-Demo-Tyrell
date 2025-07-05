<?php

use App\Http\Controllers\CardController;

Route::prefix('cards')->group(function () {
    Route::post('/', [CardController::class, 'distribute']);
});
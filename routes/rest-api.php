<?php

use App\Http\Controllers\REST\ManufactureController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->group(function () {
  Route::get(
    'manufactures',
    [ManufactureController::class, 'index']
  );
});

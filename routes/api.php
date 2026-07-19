<?php

use Illuminate\Http\Request;
use App\Http\Controllers\REST\ManufactureController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
  Route::get(
    'manufactures',
    [ManufactureController::class, 'index']
  );

  Route::delete(
    'manufactures/{manufacture}',
    [ManufactureController::class, 'destroy']
  );
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

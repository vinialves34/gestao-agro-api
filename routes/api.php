<?php

use App\Http\Controllers\RuralProducerController;
use App\Http\Controllers\SpecieController;
use Illuminate\Support\Facades\Route;

Route::get('/health-check', function () {
    return response()->json(['status' => 'ok']);
});

Route::apiResources([
    'rural_producers' => RuralProducerController::class,
    // 'properties' => App\Http\Controllers\PropertyController::class,
    // 'herds' => App\Http\Controllers\HerdController::class,
]);

Route::get('species', [SpecieController::class, 'index']);
Route::get('species/{specie}', [SpecieController::class, 'show']);

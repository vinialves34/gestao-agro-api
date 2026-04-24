<?php

use App\Http\Controllers\HerdController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RuralProducerController;
use App\Http\Controllers\SpecieController;
use Illuminate\Support\Facades\Route;

Route::get('/health-check', function () {
    return response()->json(['status' => 'ok']);
});

Route::apiResources([
    'rural_producers' => RuralProducerController::class,
    'properties' => PropertyController::class,
    'herds' => HerdController::class,
]);

Route::get('species', [SpecieController::class, 'index']);
Route::get('species/{specie}', [SpecieController::class, 'show']);

<?php

use App\Http\Controllers\HerdController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RuralProducerController;
use App\Http\Controllers\SpecieController;
use Illuminate\Support\Facades\Route;

Route::get('/health-check', function () {
    return response()->json(['status' => 'ok']);
});

Route::apiResources([
    'rural-producers' => RuralProducerController::class,
    'properties' => PropertyController::class,
    'herds' => HerdController::class,
]);

Route::prefix('species')->group(function () {
    Route::get('/', [SpecieController::class, 'index']);
    Route::get('/{specie}', [SpecieController::class, 'show']);
});

Route::prefix('report')->group(function () {
    Route::prefix('/total')->group(function () {
        Route::get('properties-by-city', [ReportController::class, 'reportTotalPropertiesByCity']);
        Route::get('herds-by-specie', [ReportController::class, 'reportTotalHerdsBySpecie']);
    });

    Route::prefix('/download')->group(function () {
        Route::get('/properties', [PropertyController::class, 'exportProperties']);
        Route::get('/herds', [HerdController::class, 'exportHerds']);
    });
});

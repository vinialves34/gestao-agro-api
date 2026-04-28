<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use App\Traits\ApiResponseTrait;

class ReportController extends Controller
{
    use ApiResponseTrait;

    /**
     * Report total properties by city.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportTotalPropertiesByCity(ReportService $service)
    {
        try {
            $totalProperties = $service->totalPropertiesByCity();
            return $this->success($totalProperties, "Total number of properties per cities retrieved successfully", 200);
        } catch (\Exception $e) {
            return $this->error('Failed to list properties', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Report total herds by specie.
     *
     * @return \Illuminate\Http\JsonResponse
    */
    public function reportTotalHerdsBySpecie(ReportService $service)
    {
        try {
            $totalHerds = $service->totalHerdsBySpecie();
            return $this->success($totalHerds, 'Total number of herds por rural producer retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->error('Failed to list herds', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }
}

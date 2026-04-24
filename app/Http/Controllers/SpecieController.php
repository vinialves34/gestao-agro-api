<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use App\Services\SpecieService;
use App\Traits\ApiResponseTrait;

class SpecieController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @param SpecieService $service
     */
    public function index(SpecieService $service)
    {
        try {
            $species = $service->list();
            return $this->success($species, 'Species retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve species', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Specie $specie
     */
    public function show(Specie $specie)
    {
        try {
            return $this->success($specie, 'Specie retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve specie', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }
}

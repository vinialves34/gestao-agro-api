<?php

namespace App\Http\Controllers;

use App\Http\Requests\HerdRequests\StoreHerdRequest;
use App\Http\Requests\HerdRequests\UpdateHerdRequest;
use App\Models\Herd;
use App\Services\HerdService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class HerdController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, HerdService $service)
    {
        try {
            $herds = $service->list($request->query());
            return $this->paginated($herds, 'Herds retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to list herds', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreHerdRequest $request
     * @param HerdService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreHerdRequest $request, HerdService $service)
    {
        try {
            $herd = $service->create($request->validated());
            return $this->success($herd, 'Herd created successfully', 201);
        } catch (\Exception $e) {
            return $this->error('Failed to create herd', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Herd $herd
     * @param HerdService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Herd $herd, HerdService $service)
    {
        try {
            $findHerd = $service->show($herd);
            return $this->success($findHerd, 'Herd retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve herd', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHerdRequest $request
     * @param Herd $herd
     * @param HerdService $service
     */
    public function update(UpdateHerdRequest $request, Herd $herd, HerdService $service)
    {
        try {
            $updatedHerd = $service->update($herd, $request->validated());
            return $this->success($updatedHerd, 'Herd updated successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to update herd', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Herd $herd
     * @param HerdService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Herd $herd, HerdService $service)
    {
        try {
            $deletedHerd = $service->delete($herd);
            return $this->success($deletedHerd, 'Herd deleted successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to delete herd', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }
}

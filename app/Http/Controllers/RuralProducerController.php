<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuralProducerRequests\StoreRuralProducerRequest;
use App\Http\Requests\RuralProducerRequests\UpdateRuralProducerRequest;
use App\Models\RuralProducer;
use App\Services\RuralProducerService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class RuralProducerController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param RuralProducerService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, RuralProducerService $service)
    {
        try {
            $ruralProducers = $service->list($request->query());
            return $this->paginated($ruralProducers, 'Rural producers retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to list rural producers', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRuralProducerRequest $request
     * @param RuralProducerService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRuralProducerRequest $request, RuralProducerService $service)
    {
        try {
            $ruralProducer = $service->create($request->validated());
            return $this->success($ruralProducer, 'Rural producer created successfully', 201);
        } catch (\Exception $e) {
            return $this->error('Failed to create rural producer', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param RuralProducer $ruralProducer
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RuralProducer $ruralProducer)
    {
        try {
            return $this->success($ruralProducer, 'Rural producer retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve rural producer', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRuralProducerRequest $request
     * @param RuralProducer $ruralProducer
     * @param RuralProducerService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRuralProducerRequest $request, RuralProducer $ruralProducer, RuralProducerService $service)
    {
        try {
            $updatedProducer = $service->update($ruralProducer, $request->validated());
            return $this->success($updatedProducer, 'Rural producer updated successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to update rural producer', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RuralProducer $ruralProducer
     * @param RuralProducerService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RuralProducer $ruralProducer, RuralProducerService $service)
    {
        try {
            $deletedProducer = $service->delete($ruralProducer);
            return $this->success($deletedProducer, 'Rural producer deleted successfully', 204);
        } catch (\Exception $e) {
            return $this->error('Failed to delete rural producer', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }
}

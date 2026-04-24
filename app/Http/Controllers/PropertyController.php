<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyRequests\StorePropertyRequest;
use App\Http\Requests\PropertyRequests\UpdatePropertyRequest;
use App\Models\Property;
use App\Services\PropertyService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param PropertyService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, PropertyService $service)
    {
        try {
            $properties = $service->list($request->query());
            return $this->paginated($properties, 'Properties retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to list properties', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePropertyRequest $request
     * @param PropertyService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePropertyRequest $request, PropertyService $service)
    {
        try {
            $property = $service->create($request->validated());
            return $this->success($property, 'Property created successfully', 201);
        } catch (\Exception $e) {
            return $this->error('Failed to create property', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Property $property
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Property $property, PropertyService $service)
    {
        try {
            $findProperty = $service->show($property);
            return $this->success($findProperty, 'Property retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve property', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePropertyRequest $request
     * @param Property $property
     * @param PropertyService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePropertyRequest $request, Property $property, PropertyService $service)
    {
        try {
            $property = $service->update($property, $request->validated());
            return $this->success($property, 'Property updated successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to update property', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Property $property
     * @param PropertyService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Property $property, PropertyService $service)
    {
        try {
            $deletedProperty = $service->delete($property);
            return $this->success($deletedProperty, 'Property deleted successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to delete property', $e->getCode() ?: 500, ['message' => $e->getMessage()]);
        }
    }
}

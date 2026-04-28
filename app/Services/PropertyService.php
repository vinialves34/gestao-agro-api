<?php

namespace App\Services;

use App\Models\Property;

/**
 * Service class for managing properties.
 */
class PropertyService
{
    /**
     * Create a new property.
     *
     * @param array $data
     * @return Property
     */
    public function create(array $data)
    {
        $data['city'] = trim($data['city']);
        $data['state'] = trim($data['state']);

        return Property::create($data);
    }

    /**
     * List properties with optional filters.
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Property
     */
    public function list(array $filters)
    {
        $query = Property::query()->with('ruralProducer');

        $query->when($filters['name'] ?? null, fn($q, $name) =>
            $q->whereRaw('unaccent(name) ilike unaccent(?)', ["%$name%"])
        )
        ->when($filters['city'] ?? null, fn($q, $city) =>
            $q->whereRaw('unaccent(city) ilike unaccent(?)', ["%$city%"])
        )
        ->when($filters['state'] ?? null, fn($q, $state) =>
            $q->where('state', 'ilike', "%$state%")
        )
        ->when($filters['state_registration'] ?? null, fn($q, $stateRegistration) =>
            $q->where('state_registration', 'like', "%$stateRegistration%")
        )
        ->when($filters['total_area'] ?? null, fn($q, $totalArea) =>
            $q->where('total_area', $totalArea)
        )
        ->when($filters['rural_producer_name'] ?? null, fn($q, $ruralProducerName) =>
            $q->whereHas('ruralProducer', function($rel) use ($ruralProducerName) {
                $rel->whereRaw('unaccent(name) ilike unaccent(?)', ["%$ruralProducerName%"]);
            })
        );

        if (isset($filters['paginate']) && !!$filters['paginate']) {
            $perPage = $filters['perPage'] ?? 10;
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    /**
     * Show a specific property.
     *
     * @param Property $property
     * @return Property
     */
    public function show(Property $property)
    {
        return $property->load('ruralProducer');
    }

    /**
     * Update an existing property.
     *
     * @param Property $property
     * @param array $data
     * @return Property
     */
    public function update(Property $property, array $data)
    {
        if (isset($data['city'])) {
            $data['city'] = trim($data['city']);
        }

        if (isset($data['state'])) {
            $data['state'] = trim($data['state']);
        }

        $property->update($data);

        return $property;
    }

    /**
     * Delete a property.
     *
     * @param Property $property
     * @return bool|null
     */
    public function delete(Property $property)
    {
        return $property->delete();
    }
}

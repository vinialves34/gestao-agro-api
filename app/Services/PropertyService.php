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
        $data['city'] = trim(mb_strtoupper($data['city'], 'UTF-8'));

        return Property::create($data);
    }

    /**
     * List properties with optional filters.
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
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
        );

        $perPage = $filters['limit'] ?? 10;

        return $query->paginate($perPage);
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
            $data['city'] = trim(mb_strtoupper($data['city'], 'UTF-8'));
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

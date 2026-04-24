<?php

namespace App\Services;

use App\Models\Herd;

/**
 * Service class for managing herds.
 */
class HerdService
{
    /**
     * Create a new herd.
     *
     * @param array $data
     * @return Herd
     */
    public function create(array $data)
    {
        $data['purpose'] = trim($data['purpose']);
        return Herd::create($data);
    }

    /**
     * List herds with optional filters.
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function list(array $filters)
    {
        $query = Herd::query()->with(['property', 'species']);

        $query->when($filters['purpose'] ?? null, fn($q, $purpose) =>
            $q->whereRaw('unaccent(purpose) ilike unaccent(?)', ["%$purpose%"])
        )
        ->when($filters['property_id'] ?? null, fn($q, $propertyId) =>
            $q->where('property_id', $propertyId)
        )
        ->when($filters['species_id'] ?? null, fn($q, $speciesId) =>
            $q->where('species_id', $speciesId)
        )
        ->when($filters['quantity'] ?? null, fn($q, $quantity) =>
            $q->where('quantity', $quantity)
        );

        $perPage = $filters['limit'] ?? 10;

        return $query->paginate($perPage);
    }

    /**
     * Show a specific herd.
     *
     * @param Herd $herd
     * @return Herd
     */
    public function show(Herd $herd)
    {
        return $herd->load(['property', 'species']);
    }

    /**
     * Update a specific herd.
     *
     * @param Herd $herd
     * @param array $data
     * @return Herd
     */
    public function update(Herd $herd, array $data)
    {
        if (isset($data['purpose'])) {
            $data['purpose'] = trim($data['purpose']);
        }

        $herd->update($data);

        return $herd;
    }

    /**
     * Delete a specific herd.
     *
     * @param Herd $herd
     * @return bool
     */
    public function delete(Herd $herd)
    {
        return $herd->delete();
    }
}

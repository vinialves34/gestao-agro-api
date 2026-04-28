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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Herd
     */
    public function list(array $filters)
    {
        $query = Herd::query()->with(['property', 'species']);

        $query->when($filters['purpose'] ?? null, fn($q, $purpose) =>
            $q->whereRaw('unaccent(purpose) ilike unaccent(?)', ["%$purpose%"])
        )
        ->when($filters['quantity'] ?? null, fn($q, $quantity) =>
            $q->where('quantity', $quantity)
        )
        ->when($filters['property_name'] ?? null, fn($q, $propertyName) =>
            $q->whereHas('property', function($rel) use ($propertyName) {
                $rel->whereRaw('unaccent(name) ilike unaccent(?)', ["%$propertyName%"]);
            })
        )
        ->when($filters['specie_name'] ?? null, fn($q, $specieName) =>
            $q->whereHas('species', function($rel) use ($specieName) {
                $rel->whereRaw('unaccent(name) ilike unaccent(?)', ["%$specieName%"]);
            })
        );

        if (isset($filters['paginate']) && !!$filters['paginate']) {
            $perPage = $filters['perPage'] ?? 10;
            return $query->paginate($perPage);
        }

        return $query->get();
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

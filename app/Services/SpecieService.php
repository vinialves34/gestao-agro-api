<?php

namespace App\Services;

use App\Models\Specie;

/**
 * Service class for managing species.
 */
class SpecieService
{
    /**
     * List all species.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        return Specie::all();
    }
}

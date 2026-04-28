<?php

namespace App\Services;

use App\Models\Herd;
use App\Models\Property;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Report total properties by city.
     */
    public function totalPropertiesByCity()
    {
        return Property::select('city', DB::raw('COUNT(*) as total'))
            ->groupBy('city')
            ->orderBy('total', 'desc')
            ->get();
    }

    /**
     * Report total herds by specie.
     */
    public function totalHerdsBySpecie()
    {
        return Herd::select(
            'species.name as species',
            DB::raw('SUM(herds.quantity) as total')
        )
        ->join('species', 'species.id', '=', 'herds.species_id')
        ->groupBy('species.name')
        ->orderBy('total', 'desc')
        ->get();
    }
}

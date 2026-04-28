<?php

namespace App\Exports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PropertiesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Property::with('ruralProducer')
        ->get()
        ->map(function ($property) {
            return [
                $property->name,
                $property->city,
                $property->state,
                $property->ruralProducer->name,
                $property->state_registration,
                $property->total_area,
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nome',
            'Município',
            'Estado',
            'Produtor rural',
            'Inscrição Estadual',
            'Área Total (m²)',
        ];
    }
}

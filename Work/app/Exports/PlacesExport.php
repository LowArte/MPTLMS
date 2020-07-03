<?php

namespace App\Exports;

use App\Models\Places;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PlacesExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{

    public function query()
    {
        return Places::query();
    }

    /**
    * @var App\Models\Places $place
    */
    public function map($place): array
    {
        return [
            $place->id,
            $place->place_name,
            $place->info["place_country"],
            $place->info["place_city"],
            $place->info["place_street"],
            $place->info["place_building_number"],
            $place->info["place_piy"],
            $place->info["place_index"],
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Наименование',
            'Страна',
            'Город',
            'Улица',
            'Номер дома',
            'Корпус',
            'Почтовый индекс',
        ];
    }
}

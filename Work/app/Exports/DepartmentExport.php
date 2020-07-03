<?php

namespace App\Exports;

use App\Models\Department;
use Debugbar;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class DepartmentExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    public function query()
    {
        return Department::query();
    }

    /**
     * @var App\Models\Departament $depart
     */
    public function map($depart): array
    {
        return [
            $depart->id,
            $depart->dep_name_full,
            $depart->qualification,
            $depart->studysperiod,
            json_encode( $depart->info, JSON_UNESCAPED_UNICODE ),
        ];
    }

    public function headings(): array
    {
        $header = [
            '#',
            'Наименование',
            'Квалификация',
            'Период обучения',
            'Информация'
        ];
        return $header;
    }
}

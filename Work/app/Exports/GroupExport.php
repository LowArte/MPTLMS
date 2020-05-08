<?php

namespace App\Exports;

use App\Models\Group;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class GroupExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Group::with(["department",'child'])->orderBy("child_id")->get();
    }

    /**
     * @var App\Models\Group $group
     */
    public function map($group): array
    {
        return [
            $group->id,
            $group->group_name,
            $group->curs,
            $group->department->dep_name_full,
            $group->child->group_name ?? "Отсутствует",
        ];
    }

    public function headings(): array
    {
        $header = [
            '#',
            'Наименование',
            'Курс',
            'Отделение',
            'Дочерняя группа'
        ];
        return $header;
    }
}

<?php

namespace App\Imports;

use App\Models\Group;
use App\Repositories\ModelRepository\DepartmentRepository;
use App\Repositories\ModelRepository\GroupRepository;
use Debugbar;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GroupImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(\Illuminate\Support\Collection $collection)
    {
        $departmentRepository = app(DepartmentRepository::class);
        $groupRepository = app(GroupRepository::class);
        $departments = $departmentRepository->getDepartmentsForComboBox();
        $groups = $groupRepository->getGroups();

        foreach ($collection as $row) {
            $dep = $departments->where("dep_name_full", $row['otdelenie'])->first();
            $group = null;
            if ($row['dochernyaya_gruppa'] != "Отсутствует")
                $group = $groups->where("group_name", $row['dochernyaya_gruppa'])->first();

            if ($dep)
                Group::create([
                    "group_name" => $row['naimenovanie'],
                    "curs" => $row['kurs'],
                    "department_id" => $dep->id,
                    "child_id" => $group == null ? null : $group->id
                ]);
        }
    }
}

<?php

namespace App\Imports;

use App\Models\Department;
use Debugbar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DepartmentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Department([
            "dep_name_full"=>$row['naimenovanie'],
            "iamge"=>$row['kartinka'],
            "qualification"=>$row['kvalifikatsiya'],
            "studysperiod"=>$row['period_obucheniya'],
            "info"=>json_decode($row['informatsiya']),
        ]);
    }
}

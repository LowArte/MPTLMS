<?php

namespace App\Imports;

use App\Models\Places;
use Debugbar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PlacesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Places([
            "place_name"=>$row['naimenovanie'],
            'info' => [
                "place_index" => $row['pochtovyy_indeks'],
                "place_country" => $row['strana'],
                "place_city" => $row['gorod'],
                "place_street" => $row['ulitsa'],
                "place_building_number" => $row['nomer_doma'],
                "place_piy" => $row['korpus'],
            ]
        ]);
    }
}

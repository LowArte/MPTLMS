<?php

namespace App\Http\Controllers\Getter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Departament;

class Getters extends Controller
{
    public function get_all_groups()
    {
        $data = Group::select('group_name')->get();
        return response()->json($data, 200);
    }

    public function get_all_departaments()
    {
        $data = Departament::select('dep_name','dep_name_full')->get();
        return response()->json($data, 200);
    }

    public function get_groups_by_departament(Request $request)
    {
        $data = Group::join('departaments', 'groups.departaments_id', '=', 'departaments.id')
            ->where('departaments.dep_name', '=', $request['dep_name'])
            ->orWhere('departaments.dep_name_full', '=', $request['dep_name'])
            ->select('group_name')->get();
        return response()->json($data, 200);
    }
}

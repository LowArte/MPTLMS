<?php

namespace App\Http\Controllers\Api;

use App\Imports\DepartmentImport;
use App\Imports\ExcerptImport;
use App\Imports\GroupImport;
use App\Imports\PlacesImport;
use App\Imports\UserImport;
use Illuminate\Http\Request;

use Debugbar;
use Excel;

class ImportController extends BaseController
{ 
    public function insertPlaceImport(){
        $data = request()->file();
        //Excel::import(new PlacesImport, $data);
        $imp = new ExcerptImport();
        $imp->getExcert($data);
        return response()->json();
    }

    public function insertDepartamentImport(){
        $data = request()->file("file");
        Excel::import(new DepartmentImport, $data);
        return response()->json();
    }

    public function insertGroupImport(){
        $data = request()->file("file");
        Excel::import(new GroupImport, $data);
        return response()->json();
    }

    public function insertUserImport(){
        $data = request()->file("file");
        Excel::import(new UserImport, $data);
        return response()->json();
    }
}
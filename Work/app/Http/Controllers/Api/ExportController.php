<?php

namespace App\Http\Controllers\Api;

use App\Exports\DepartmentExport;
use App\Exports\GroupExport;
use App\Exports\PlacesExport;
use App\Exports\UserExport;
use Illuminate\Http\Request;

use Debugbar;
use Excel;

class ExportController extends BaseController
{ 
    public function downloadPlaceExport(){
        return Excel::download(new PlacesExport, 'places.xlsx');
    }

    public function downloadDepartamentExport(){
        return Excel::download(new DepartmentExport, 'departaments.xlsx');
    }

    public function downloadGroupExport(){
        return Excel::download(new GroupExport, 'departaments.xlsx');
    }

    public function downloadUserExport(){
        return Excel::download(new UserExport, 'users.xlsx');
    }
}
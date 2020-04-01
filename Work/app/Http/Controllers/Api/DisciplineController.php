<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\DisciplineRepository;

class DisciplineController extends BaseController
{ 
    /**
     * get disciplines from database
     * @return JSON
     */
    public function getDisciplines(DisciplineRepository $disciplineRepository)
    {
        $disciplines = $disciplineRepository->getDisciplines();
        return response()->json(compact('disciplines'));
    }
}
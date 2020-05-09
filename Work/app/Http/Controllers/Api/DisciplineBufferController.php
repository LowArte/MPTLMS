<?php

namespace App\Http\Controllers\Api;

use App\Models\DisciplineBuffer;
use App\Repositories\ModelRepository\DisciplineBufferRepository;

class DisciplineBufferController extends BaseController
{ 
    public function create(){
        DisciplineBuffer::create();
        return response()->json();
    }

    public function getDisciplineBuffer(DisciplineBufferRepository $disciplineBufferRepository)
    {
        $disciplineBuffer = $disciplineBufferRepository->getDisciplineBufferRepository();
        return response()->json(compact('disciplineBuffer'));
    }

    public function getDisciplineBufferData($dbName,DisciplineBufferRepository $disciplineBufferRepository)
    {
        $disciplineBuffer = $disciplineBufferRepository->getDisciplineBufferRepositoryData($dbName);
        return response()->json(compact('disciplineBuffer'));
    }


}
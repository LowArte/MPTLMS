<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\TeacherRepository;

class TeacherController extends BaseController
{ 
    /**
     * get teachers from database
     * @return JSON
     */
    public function getTeachers(TeacherRepository $teacherRepository)
    {
        $teachers = $teacherRepository->getTeachersWithFio();
        return response()->json(compact('teachers'));
    }
}
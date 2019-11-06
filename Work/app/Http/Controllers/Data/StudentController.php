<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Group;
use App\Models\Departament;

/**
 * Get data to student
 * 
 * @category Controller
 * 
 * @package App\Http\Controllers\Controller
 * 
 * @author Пикалов Артем <p_a.n.pikalov@mpt.ru>
 * 
 * @license MPT 
 * 
 * @link https://mpt.ru/
 */
class StudentController extends Controller
{
    /**
     * Get student by user
     * 
     * @param Request $request Request
     * 
     * @return \App\Models\Student
     */
    public function getStudent(Request $request)
    {
        $student = Student::where('user_id', $request['user_id'])->get()[0];
        $group = Group::where("id", $student["group_id"])->get()[0];
        $departament = Departament::where("id", $group["departaments_id"])->get()[0];
        return response()->json(
            [
                "student" => $student,
                "group" => $group,
                "departament" =>$departament
            ]
        );
    }
}

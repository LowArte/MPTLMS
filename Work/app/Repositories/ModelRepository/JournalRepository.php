<?php

namespace App\Repositories\ModelRepository;

use App\Models\Journal as Model;
use App\Models\Student as StudentModel;

class JournalRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getJournalById($id)
    {
        $columns = ['journals.id', 'association_id', 'titles', 'journal', 'isClose', 'group_id'];
        $result = $this->startCondition()
                        ->join('associations', 'association_id', '=', 'associations.id')
                        ->where('journals.id', $id)
                        ->select($columns)
                        ->first();

        $students = StudentModel::leftJoin('users', 'user_id', '=', 'users.id')
        ->where('students.group_id', $result->group_id)
        ->selectRaw("students.id as student_id, CONCAT(users.secName, ' ', users.name, ' ',  users.thirdName) as fullFio")
        ->get();
        $result['students'] = $students;
        $result['titles'] = json_decode($result['titles']);
        $result['journal'] = json_decode($result['journal']);
        return $result;
    }
}
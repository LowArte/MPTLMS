<?php

namespace App\Repositories\ModelRepository;

use App\Models\Association as Model;

class AssociationRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getAssociationTeacherDiscip()
    {
        $columns = ['discip_id', 'teacher_id'];
        $result = $this->startCondition()
                        ->join('journals', 'journal_id', '=', 'journals.id')
                        ->where('isClose', '<>', null)
                        ->select($columns)
                        ->get();
        return $result;
    }

    public function getAssociation()
    {
        $columns = ['id', 'journal_id', 'teacher_id'];
        $result = $this->startCondition()
                        ->select($columns)
                        ->get();
        return $result;
    }

    public function getAssociationAndJournalByGroupAndUserId($group_id, $user_id)
    {
        $columns = ['journals.id', 'discip_id', 'journals.group_id', 'group_name', 'curs', 'isClose'];
        $result = $this->startCondition()
                        ->join('journals', 'journal_id', '=', 'journals.id')
                        ->join('groups', 'journals.group_id', '=', 'groups.id')
                        ->select($columns)
                        ->orderBy('isClose', 'desc')
                        ->where([['teacher_id', $user_id],['group_id', $group_id]])
                        ->get();

        $disiplineBufferRepository = app(DisciplineBufferRepository::class);
        $disciplines = $disiplineBufferRepository->getDisciplineBufferRepositoryDataLast();
        foreach($result as $res)
        {
            $res['discipline'] = $disciplines->where("id",$res['discip_id'])->first()['discip_name'];
            $res['discipline_info'] = $disciplines->where("id",$res['discip_id'])->first();
        }
        return $result;
    }

    public function getAssociationTeacher($teacher_id)
    {
        $columns = ['journals.id', 'discip_id', 'journals.group_id', 'group_name', 'curs', 'isClose'];
        $result = $this->startCondition()
                        ->join('journals', 'journal_id', '=', 'journals.id')
                        ->join('groups', 'journals.group_id', '=', 'groups.id')
                        ->select($columns)
                        ->orderBy('isClose', 'desc')
                        ->where('teacher_id', $teacher_id)
                        ->get();

        $disiplineBufferRepository = app(DisciplineBufferRepository::class);
        $disciplines = $disiplineBufferRepository->getDisciplineBufferRepositoryDataLast();
        foreach($result as $res)
        {
            $res['discipline'] = $disciplines->where("id",$res['discip_id'])->first()['discip_name'];
            $res['discipline_info'] = $disciplines->where("id",$res['discip_id'])->first();
        }
        return $result;
    }
}
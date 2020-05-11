<?php

namespace App\Repositories\ModelRepository;

use App\Models\Journal as Model;
use App\Models\Student as StudentModel;
use Debugbar;

class JournalRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getJournalById($id)
    {
        $columns = ['id','journal', 'discip_id', 'group_id', 'isClose'];
        $result = $this->startCondition()
                        ->select($columns)
                        ->where('id', $id)
                        ->select($columns)
                        ->get();
        $disiplineBufferRepository = app(DisciplineBufferRepository::class);
        $teacherRepository = app(UserRepository::class);
        $assosiationRepositroy = app(AssociationRepository::class);

        $teachers = $teacherRepository->getTeachersFIO();
        $assosiations = $assosiationRepositroy->getAssociation();
        $disciplines = $disiplineBufferRepository->getDisciplineBufferRepositoryDataLast();
        foreach($result as $res){
            $res['journal'] = json_decode($res['journal']);
            $res['discipline'] = $disciplines->where("id",$res['discip_id'])->first()['discip_name'];
            $assosiation = $assosiations->where("journal_id",$res['id'])->all();
            $teach = [];

            foreach($assosiation as $ass){
                array_push($teach,$teachers->where("id",$ass['teacher_id'])->first()->full_name);
            }   
            $res['teachers'] = $teach;
        }
        return $result;
    }

    

    public function getJournalByGroupId($id)
    {
        $columns = ['id', 'journal', 'discip_id', 'group_id', 'isClose'];
        $result = $this->startCondition()
                        ->select($columns)
                        ->where('group_id', $id)
                        ->select($columns)
                        ->get();

        $disiplineBufferRepository = app(DisciplineBufferRepository::class);
        $teacherRepository = app(UserRepository::class);
        $assosiationRepositroy = app(AssociationRepository::class);

        $teachers = $teacherRepository->getTeachersFIO();
        $assosiations = $assosiationRepositroy->getAssociation();
        $disciplines = $disiplineBufferRepository->getDisciplineBufferRepositoryDataLast();
        foreach($result as $res){
            $res['journal'] = json_decode($res['journal']);
            $res['discipline'] = $disciplines->where("id",$res['discip_id'])->first()['discip_name'];
            $assosiation = $assosiations->where("journal_id",$res['id'])->all();
            $teach = [];
            $teach_id = [];

            foreach($assosiation as $ass){
                array_push($teach_id, $ass['teacher_id']);
                array_push($teach,$teachers->where("id",$ass['teacher_id'])->first()->full_name);
            }   
            $res['teachers'] = $teach;
            $res['teachers_id'] = $teach_id;
        }
        return $result;
    }
}
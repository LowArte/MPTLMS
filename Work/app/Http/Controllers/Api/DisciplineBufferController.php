<?php

namespace App\Http\Controllers\Api;

use App\Helpers\SQLite\SQLiteDBFunctions;
use App\Imports\ExcerptImport;
use App\Models\Association;
use App\Models\DisciplineBuffer;
use App\Models\Journal;
use App\Modifications\Create\CreateDisciplineBufferModification;
use App\Modifications\Delete\DeleteDisciplineBufferModification;
use App\Modifications\Update\UpdateDisciplineBufferModification;
use App\Repositories\ModelRepository\DisciplineBufferRepository;
use Debugbar;
use Illuminate\Http\Request;

class DisciplineBufferController extends BaseController
{
    public function create()
    {
        $data = request()->file();
        $disciplineBuffer = new DisciplineBuffer();
        $disciplineBuffer->db_name = "db_for_" . date("Y");
        $imp = new ExcerptImport();
        $result = $imp->getExcert($data);
        $db = new SQLiteDBFunctions($disciplineBuffer->db_name);
        $db->createTable();
        $db->insertFullDataAndReturnModifaedArray($result);
        foreach ($result as $key => $data) {
            foreach ($data as $key2 => $dis) {
                foreach ($dis['groups'] as $groupKey=>$group) {
                    $journal = new Journal();
                    $fill = [
                        "isClose" => ($dis["discip_hours_first"] != 0 ? 0 : 2) + ($dis["discip_hours_second"] != 0 ? 0 : 1),
                        'discip_id'=>$dis['id'],
                        'group_id'=>$groupKey,
                        'journal' => json_encode([])
                    ];
                    $journal->fill($fill);
                    $journal->save();
                    foreach($group[0] as $teach){
                        $ass = new Association();
                        if($teach==null)
                            continue;
                        $ass->fill([
                            "journal_id"=>$journal->id,
                            "teacher_id"=>$teach
                        ]);
                        $ass->save();
                    }
                }
            }
        }
        return response()->json();
    }

    /**
     * Получение дисциплин
     * @return JSON
     */
    public function getDisciplines(Request $request, DisciplineBufferRepository $disciplineRepository)
    {
        $data = $request->all();
        $disciplines = $disciplineRepository->getDisciplineBufferRepositoryDataLastFiltered($data);
        return response()->json(compact('disciplines'));
    }

    public function getDisciplineBuffer(DisciplineBufferRepository $disciplineBufferRepository)
    {
        $disciplineBuffer = $disciplineBufferRepository->getDisciplineBufferRepository();
        return response()->json(compact('disciplineBuffer'));
    }

    public function getDisciplineBufferData($dbName, DisciplineBufferRepository $disciplineBufferRepository)
    {
        $disciplineBuffer = $disciplineBufferRepository->getDisciplineBufferRepositoryData($dbName);
        return response()->json(compact('disciplineBuffer'));
    }

    public function save($dbName, Request $request, CreateDisciplineBufferModification $createDisciplineBufferModification)
    {
        $data = $request->all();
        $id = $createDisciplineBufferModification->addDisciplineBufferToDatabase($dbName, $data);
        if ($id) {
            return response()->json(compact("id"), 200);
        } else {
            return response()->json(500);
        }
    }

    public function edit($dbName, Request $request, UpdateDisciplineBufferModification $updateDisciplineBufferModification)
    {
        $data = $request->all();
        $result = $updateDisciplineBufferModification->updateDisciplineBufferInDatabase($dbName, $data);
        if ($result) {
            return response()->json(200);
        } else {
            return response()->json(500);
        }
    }

    public function delete($dbName, $id, DeleteDisciplineBufferModification $deleteDisciplineBufferModificationete)
    {
        $result = $deleteDisciplineBufferModificationete->deleteDisciplineBufferFromDatabase($dbName, $id);
        if ($result) {
            return response()->json(200);
        } else {
            return response()->json(500);
        }
    }
}

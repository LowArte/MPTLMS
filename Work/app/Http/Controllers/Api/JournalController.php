<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateJournalModification;
use App\Modifications\Delete\DeleteJournalModification;
use App\Modifications\Update\UpdateJournalModification;
use App\Repositories\ModelRepository\JournalRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Debugbar;

class JournalController extends BaseController
{ 
    /**
     * Получение журнала по id группы
     * @return JSON
     */
    public function getJournalsByGroupId($id, JournalRepository $journalRepository)
    {
        Debugbar::info($id);
        $journals = $journalRepository->getJournalByGroupId($id);
        Debugbar::info($journals);
        return response()->json(compact('journals'));
    }    

    public function save(Request $request,CreateJournalModification $createJournalModification){
        $data = $request->all();
        $id = $createJournalModification->addJournalToDatabase($data);
        if($id)
            return response()->json(compact("id"),200);
        else
            return response()->json(500);
    }
    
    public function edit(Request $request,UpdateJournalModification $updateJournalModification){
        $data = $request->all();
        if(array_key_exists('0', $data['journal']))
        {
            $delete_keys = array('0');
            $data['journal'] = array_diff_key($data['journal'], array_flip($delete_keys));
            $data['titles'] = array_diff_key($data['titles'], array_flip($delete_keys));
        }
        $data['titles'] = json_encode($data['titles']);
        $data['journal'] = json_encode($data['journal']);
        
        $result = $updateJournalModification->updateJournalInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
    //Закрытие/Открытие журнала
    public function editClose($id, $close, UpdateJournalModification $updateJournalModification)
    {
        $result = $updateJournalModification->updateJournalCloseInDatabase($id, $close);
        if($result)
            return response()->json(200);
        else
            return response()->json(500);
    }

    public function delete($id,DeleteJournalModification $deleteJournalModification){
        $result = $deleteJournalModification->deleteJournalFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}
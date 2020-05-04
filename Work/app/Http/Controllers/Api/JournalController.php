<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateJournalModification;
use App\Modifications\Delete\DeleteJournalModification;
use App\Modifications\Update\UpdateJournalModification;
use App\Repositories\ModelRepository\JournalRepository;
use Illuminate\Http\Request;

use Debugbar;
class JournalController extends BaseController
{ 
    /**
     * get JournalController from database
     * @return JSON
     */
    public function getJournal(JournalRepository $journalRepository)
    {
        $journalRepository = $journalRepository->getJournal();
        return response()->json(compact('journalRepository'));
    }

    public function save(Request $request,CreateJournalModification $createJournalModification){
        $data = $request->all();
        $id = $createJournalModification->addJournalToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdateJournalModification $updateJournalModification){
        $data = $request->all();
        $result = $updateJournalModification->updateJournalInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
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
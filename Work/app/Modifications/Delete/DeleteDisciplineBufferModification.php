<?php

namespace App\Modifications\Delete;

use App\Helpers\SQLite\SQLiteDBFunctions;
use App\Modifications\BaseModification;
use Debugbar;

class DeleteDisciplineBufferModification
{

    public function deleteDisciplineBufferFromDatabase($dbName,$id){
        Debugbar::info($dbName);
        $db = new SQLiteDBFunctions($dbName);
        $result = $db->deleteData($id);
        return $result;
    }
}
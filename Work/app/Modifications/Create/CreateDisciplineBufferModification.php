<?php

namespace App\Modifications\Create;

use App\Helpers\SQLite\SQLiteDBFunctions;
use App\Modifications\BaseModification;
use Debugbar;

class CreateDisciplineBufferModification
{


    public function addDisciplineBufferToDatabase($dbName,$request)
    {
        $db = new SQLiteDBFunctions($dbName);
        $result = $db->insertData($request);
        return $result;
    }
}
<?php

namespace App\Modifications\Update;

use App\Helpers\SQLite\SQLiteDBFunctions;
use App\Modifications\BaseModification;
use Debugbar;

class UpdateDisciplineBufferModification
{

    public function updateDisciplineBufferInDatabase($dbName,$request)
    {
        $db = new SQLiteDBFunctions($dbName);
        $result = $db->updateData($request);
        if($result)
            return true;
        return  false;
    }
}
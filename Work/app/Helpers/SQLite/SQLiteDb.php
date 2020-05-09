<?php
namespace App\Helpers\SQLite;

use Debugbar;
use PDO;
use SQLite3;
use Storage;

class SQLiteDb  extends SQLite3
{

    function __construct($dbName) {
        $filename = Storage::disk('db')->getAdapter()->applyPathPrefix($dbName.".sqlite");
        Debugbar::info($filename);
        $this->open($filename);
    }
}
<?php
namespace App\Helpers\SQLite;

use Debugbar;
use PDO;
use Storage;

class SQLiteDb extends PDO
{
    private $sem;

    function __construct($dbName) {

        $filename = storage_path('databases\\' .$dbName . ".sqlite");

        parent::__construct('sqlite:' . $filename);


        $key = ftok($filename, 'a');
        $this->sem = sem_get($key);
    }
}
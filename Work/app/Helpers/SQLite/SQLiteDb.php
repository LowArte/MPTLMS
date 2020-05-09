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

    function beginTransaction() {
        sem_acquire($this->sem);
        return parent::beginTransaction();
    }

    function commit() {
        $success = parent::commit();
        sem_release($this->sem);
        return $success;
    }

    function rollBack() {
        $success = parent::rollBack();
        sem_release($this->sem);
        return $success;
    }
}
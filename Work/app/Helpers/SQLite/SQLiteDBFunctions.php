<?php

namespace App\Helpers\SQLite;

use Debugbar;
use PDO;
use Storage;

class SQLiteDBFunctions
{
    /**
     * @var SQLiteDb
     */
    private $db;

    public function __construct($dbname)
    {

        $this->db = new SQLiteDb($dbname);
    }

    public function createTable()
    {
        $result = $this->db->exec("CREATE TABLE books (
            id_books INTEGER PRIMARY KEY AUTOINCREMENT,
            auth_name TEXT NOT NULL,
            title TEXT NOT NULL,
            count_page INTEGER NOT NULL,
            price REAL NOT NULL
            ); ");
    }
}

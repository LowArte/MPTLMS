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

    public function __construct($dbname) {

        $this->db = new SQLiteDb($dbname);
        Debugbar::info( $this->db);
    }

    public function createTable(){
        Debugbar::info( $this->db);
        $this->db->beginTransaction();
        $result = $this->db->exec("CREATE TABLE books (
            id_books INTEGER PRIMARY KEY AUTOINCREMENT,
            auth_name TEXT NOT NULL,
            title TEXT NOT NULL,
            count_page INTEGER NOT NULL,
            price REAL NOT NULL
            ); ");

        if($result)
            $this->db->commit();
        else
            $this->db->rollBack();

    }
}
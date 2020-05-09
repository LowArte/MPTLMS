<?php

namespace App\Helpers\SQLite;

use Debugbar;
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
        if ($this->db->exec("CREATE TABLE disciplines ( id INTEGER PRIMARY KEY AUTOINCREMENT, discip_name TEXT NOT NULL, discip_hours_first INTEGER NOT NULL,discip_hours_second INTEGER NOT NULL,  department INTEGER NOT NULL );"))
            return true;
        else
            return false;
    }

    public function insertData($data)
    {
        $stmt = $this->db->prepare($this->db->exec("INSERT INTO disciplines [discip_name, discip_hours, department] VALUES (:data['discip_name'], :data['discip_hours'], :data['department'])"));
        $stmt->execute([
            ':data["discip_name"]' => $data['discip_name'],
            ':data["discip_hours_first"]' => $data['discip_hours_first'],
            ':data["discip_hours_second"]' => $data['discip_hours_second'],
            ':data["department"]' => $data['department']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function insertFullDataAndReturnModifaedArray(array $data)
    {
        foreach ($data as $dat => $key) {
            foreach ($dat as $dis)
                $this->db->query("INSERT INTO 
                    Disciplines(department,discip_name, discip_hours_first,discip_hours_second)
                    VALUES ({$key},'{$dis['discip_name']}',{$dis['discip_hours_first']},{$dis['discip_hours_second']});");
            $dis['id'] = $this->pdo->lastInsertId();
        }
        return $data;
    }

    public function testData()
    {
        for ($i = 0; $i < 5; $i++) {
            $this->insertData(['discip_name' => 'test' . $i, 'discip_hours_first' => (1 + 100 % $i), 'discip_hours_second' => (1 + 100 % $i),"department"=>1 + $i%5]);
        }
    }
}

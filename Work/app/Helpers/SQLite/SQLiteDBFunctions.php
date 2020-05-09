<?php

namespace App\Helpers\SQLite;

use App\Repositories\ModelRepository\DepartmentRepository;
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


    public function getData()
    {
        $query = "SELECT * FROM disciplines";
        $results = $this->db->query($query);
        $data = array();
        $departmentRepository = app(DepartmentRepository::class);
        $departments = $departmentRepository->getDepartmentsForComboBox();
        while ($res = $results->fetchArray(1)) {
            $res['dep_name_full'] = $departments->where("id", $res['id'])->first()->dep_name_full;
            array_push($data, $res);
        }
        Debugbar::info($data);
        return $data;
    }

    public function insertData($data)
    {
        $stmt = $this->db->prepare("INSERT INTO disciplines (department,discip_name, discip_hours_first,discip_hours_second) VALUES (:department, :discip_name, :discip_hours_first, :discip_hours_second)");
        $stmt->bindValue(':discip_name', $data['discip_name']);
        $stmt->bindValue(':discip_hours_first', $data['discip_hours_first'], SQLITE3_INTEGER);
        $stmt->bindValue(':discip_hours_second', $data['discip_hours_second'], SQLITE3_INTEGER);
        $stmt->bindValue(':department', $data['department']);
        $stmt->execute();
        return $this->db->lastInsertRowID();
    }


    public function insertFullDataAndReturnModifaedArray(array $data)
    {
        foreach ($data as $dat => $key) {
            foreach ($dat as $dis)
                $this->db->query("INSERT INTO 
                    disciplines(department,discip_name, discip_hours_first,discip_hours_second)
                    VALUES ({$key},'{$dis['discip_name']}',{$dis['discip_hours_first']},{$dis['discip_hours_second']});");
            $dis['id'] = $this->db->lastInsertRowid();
        }
        return $data;
    }

    public function testData()
    {
        for ($i = 1; $i <= 5; $i++) {
            $this->insertData(['discip_name' => 'test' . $i, 'discip_hours_first' => (1 + 100 % $i), 'discip_hours_second' => (1 + 100 % $i), "department" => 1 + $i % 5]);
        }
    }
}

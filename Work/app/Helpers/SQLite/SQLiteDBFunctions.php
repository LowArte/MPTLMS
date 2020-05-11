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
        if ($this->db->exec("CREATE TABLE disciplines ( id INTEGER PRIMARY KEY AUTOINCREMENT, discip_name TEXT NOT NULL,curs TEXT NOT NULL, discip_hours_first INTEGER NOT NULL,discip_hours_second INTEGER NOT NULL,  department INTEGER NOT NULL );"))
            return true;
        else
            return false;
    }


    public function getData()
    {
        $query = "SELECT * FROM disciplines ORDER BY department";
        $results = $this->db->query($query);
        $data = collect();
        $departmentRepository = app(DepartmentRepository::class);
        $departments = $departmentRepository->getDepartmentsForComboBox();
        $curRes = ["id" => 0];
        while ($res = $results->fetchArray(1)) {
            if ($curRes['id'] != $res['department']) {
                $curRes = $departments->where("id", $res['department'])->first();
            }
            $res['dep_name_full'] =  $curRes->dep_name_full;
            $data->push($res);
        }
        return $data;
    }

    public function getDataFiltered($filter)
    {
        $query = "SELECT * FROM disciplines WHERE department = :department and curs = :curs;";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':department', $filter['department_id']);
        $stmt->bindValue(':curs', $filter['curs']);
        $results = $stmt->execute();
        $data = collect();
        $departmentRepository = app(DepartmentRepository::class);
        $departments = $departmentRepository->getDepartmentsForComboBox();
        $curRes = ["id" => 0];
        while ($res = $results->fetchArray(1)) {
            if ($curRes['id'] != $res['department']) {
                $curRes = $departments->where("id", $res['department'])->first();
            }
            $res['dep_name_full'] =  $curRes->dep_name_full;
            $data->push($res);
        }
        return $data;
    }

    public function insertData($data)
    {
        $stmt = $this->db->prepare("INSERT INTO disciplines (department,discip_name, discip_hours_first,discip_hours_second,curs) VALUES (:department, :discip_name, :discip_hours_first, :discip_hours_second, :curs)");
        $stmt->bindValue(':discip_name', $data['discip_name']);
        $stmt->bindValue(':discip_hours_first', $data['discip_hours_first'], SQLITE3_INTEGER);
        $stmt->bindValue(':discip_hours_second', $data['discip_hours_second'], SQLITE3_INTEGER);
        $stmt->bindValue(':department', $data['department']);
        $stmt->bindValue(':curs', $data['curs']);
        $stmt->execute();
        return $this->db->lastInsertRowID();
    }

    public function updateData($data)
    {
        $stmt = $this->db->prepare("UPDATE disciplines SET department = :department,discip_name = :discip_name ,discip_hours_first= :discip_hours_first,discip_hours_second = :discip_hours_second, curs=:curs WHERE id=:id;");
        $stmt->bindValue(':discip_name', $data['discip_name']);
        $stmt->bindValue(':discip_hours_first', $data['discip_hours_first'], SQLITE3_INTEGER);
        $stmt->bindValue(':discip_hours_second', $data['discip_hours_second'], SQLITE3_INTEGER);
        $stmt->bindValue(':id', $data['id'], SQLITE3_INTEGER);
        $stmt->bindValue(':department', $data['department']);
        $stmt->bindValue(':curs', $data['curs']);
        $result = $stmt->execute();
        if ($result) {
            return true;
        }
        return false;
    }

    public function deleteData($id)
    {
        $stmt = $this->db->prepare("DELETE FROM disciplines WHERE id=:id");
        $stmt->bindValue(':id', $id);
        $result = $stmt->execute();
        if ($result) {
            return true;
        }
        return false;
    }


    public function insertFullDataAndReturnModifaedArray(?array &$data)
    {
        $temp = $this->getData();
        foreach ($data as $key => $dat) {
            foreach ($dat as $key2 => $dis) {
                $check = $temp
                        ->where("discip_name",$dis['discip_name'])
                        ->where("discip_hours_first",$dis['discip_hours_first'])
                        ->where("discip_hours_second",$dis['discip_hours_second'])
                        ->where("department",$key)
                        ->where("curs",$dis['curs'])
                        ->first();
                if(!$check)
                {
                    $stmt = $this->db->prepare("INSERT INTO disciplines (department,discip_name, discip_hours_first,discip_hours_second,curs) VALUES (:department, :discip_name, :discip_hours_first, :discip_hours_second,:curs)");
                    $stmt->bindValue(':discip_name', $dis['discip_name']);
                    $stmt->bindValue(':discip_hours_first', $dis['discip_hours_first'], SQLITE3_INTEGER);
                    $stmt->bindValue(':discip_hours_second', $dis['discip_hours_second'], SQLITE3_INTEGER);
                    $stmt->bindValue(':department', $key);
                    $stmt->bindValue(':curs', $dis['curs']);
                    $stmt->execute();
                    $data[$key][$key2]['id'] = $this->db->lastInsertRowID();
                    $temp->push([
                        "discip_name" => $dis['discip_name'],
                        "discip_hours_first" => $dis['discip_hours_first'], 
                        "discip_hours_second" => $dis['discip_hours_second'], 
                        "department" => $key, 
                        "curs"=>$dis['curs'],
                        "id"=>$this->db->lastInsertRowID()
                    ]);
                }
                else{
                    $data[$key][$key2]['id'] = $check['id'];
                }
            }
        }
    }

    public function testData()
    {
        for ($i = 1; $i <= 5; $i++) {
            $this->insertData(['discip_name' => 'test' . $i, 'discip_hours_first' => (1 + 100 % $i), 'discip_hours_second' => (1 + 100 % $i), "department" => 1 + $i % 5]);
        }
    }
}

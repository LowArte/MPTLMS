<?php

namespace App\Imports;

use App\Helpers\TemporaryFiles\TemporaryFileFactory;
use App\Repositories\ModelRepository\DepartmentRepository;
use App\Repositories\ModelRepository\GroupRepository;
use App\Repositories\ModelRepository\UserRepository;
use Debugbar;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use Str;

class ExcerptImport
{
    public function getExcert($files)
    {
        $temp_file = new TemporaryFileFactory();
        $departmanetRepository = app(DepartmentRepository::class);
        $departmens = $departmanetRepository->getDepartmentsForComboBox();
        $groupsRepository = app(GroupRepository::class);
        $userRepository = app(UserRepository::class);

        $groups_collection = collect($groupsRepository->getGroups());
        $array_groups_subgects = [];
        $teachers = $userRepository->getTeachersFIO();

        foreach ($files as $file) {
            $temp_file->newTemporaryFile($file);
            $reader = IOFactory::createReader(IOFactory::identify($temp_file->getFileName()));
            $spreadsheet = $reader->load($temp_file->getFileName());
            $spreadsheet->setActiveSheetIndex(0);
            $deprtment_object = $this->getIdDep($departmens, Str::replaceFirst("специальность ", "", Str::lower($spreadsheet->getActiveSheet()->getCell("A3")->getValue())));
            $array_groups_subgects[$deprtment_object->id] = [];
            $sheetsNames = $spreadsheet->getSheetNames();
            for ($i = 0; $i < $spreadsheet->getSheetCount(); $i++) {
                preg_match("/\s\d\s|-\d\s/",$sheetsNames[$i],$sheetName);
                $curs = trim(Str::replaceFirst('-','',$sheetName[0]));
                $spreadsheet->setActiveSheetIndex($i);
                $iterator = 7;
                $time_stamp = [];
                for ($col = 1; $col <= 20; ++$col) {
                    if ($spreadsheet->getActiveSheet()->getCellByColumnAndRow($col, 6)->getValue() == "час в сем") {
                        array_push($time_stamp, $col);
                    }
                }
                while ($spreadsheet->getActiveSheet()->getCell("A" . $iterator)->getValue() != "ИТОГО" && $spreadsheet->getActiveSheet()->getCell("B" . $iterator)->getValue() != "ИТОГО") {
                    if ($spreadsheet->getActiveSheet()->getCell("B" . $iterator)->getValue()  != "") {
                        $sem1 = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[0], $iterator)->getCalculatedValue() + $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[0] + 1, $iterator)->getCalculatedValue();
                        $sem2 = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[1], $iterator)->getCalculatedValue() + $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[1] + 1, $iterator)->getCalculatedValue();
                    }
                    else{
                        $iterator++;
                        continue;
                    }
                    $groups = [];
                    for ($col = 17; $col <= 30; $col++) {
                        if ($spreadsheet->getActiveSheet()->getCellByColumnAndRow($col, 5)->getValue() == "Преподаватель") {
                            for ($cols = $col; $cols <= 30; $cols++) {
                                if ($spreadsheet->getActiveSheet()->getCellByColumnAndRow($cols, 6)->getValue() != "") {
                                    preg_match("/[А-яЁ0-9]{1,4}-\d{1,2}-\d{1,2}/u", $spreadsheet->getActiveSheet()->getCellByColumnAndRow($cols, 6)->getValue(), $group_names);
                                    $group_item = $groups_collection->where('group_name', $group_names[0])->first();
                                    $groups[$group_item->id] = [];
                                    $teacher_arr = [];
                                    foreach(explode(",", $spreadsheet->getActiveSheet()->getCellByColumnAndRow($cols, $iterator)->getValue()) as $tea){
                                        $teach = $teachers->where("full_name_inverted", trim(Str::replaceFirst("Б/Э",'',$tea)))->first();
                                        if($teach){
                                            array_push($teacher_arr,$teach->id);
                                        }
                                    } 
                                    array_push($groups[$group_item->id], $teacher_arr);
                                }
                            }
                        }
                    }
                    array_push($array_groups_subgects[$deprtment_object->id], ["curs"=>$curs,'discip_name' => $spreadsheet->getActiveSheet()->getCell("B" . $iterator)->getValue(), 'discip_hours_first' => intval($sem1), "discip_hours_second" => intval($sem2), 'groups' => $groups]);
                    $iterator++;
                }
            }
            $temp_file->clearGarbage();
        }
        return $array_groups_subgects;
    }

    private function getIdDep($departmens, $param)
    {
        foreach ($departmens as $value) {
            if (Str::contains($value->dep_name_full, $param)) {
                return $value;
            }
        }
    }
}

<?php

namespace App\Imports;

use Debugbar;
use App\Helpers\TemporaryFiles\TemporaryFileFactory;
use App\Repositories\ModelRepository\DepartmentRepository;
use App\Repositories\ModelRepository\GroupRepository;
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
        $groupsR = collect($groupsRepository->getGroupsForComboBoxWithRecursive());
        $array_groups_subgects = [];
        foreach ($files as $file) {
            $temp_file->newTemporaryFile($file);
            $reader = IOFactory::createReader(IOFactory::identify($temp_file->getFileName()));
            $spreadsheet = $reader->load($temp_file->getFileName());
            $spreadsheet->setActiveSheetIndex(0);
            $deprtment_object = $this->getIdDep($departmens, Str::replaceFirst("специальность ", "", $spreadsheet->getActiveSheet()->getCell("A3")->getValue()));
            $array_groups_subgects[$deprtment_object->id] = [];
            for ($i = 0; $i < $spreadsheet->getSheetCount(); $i++) {
                $spreadsheet->setActiveSheetIndex($i);
                $iterator = 7;
                $time_stamp = [];
                for ($col = 1; $col <= 20; ++$col) {
                    if ($spreadsheet->getActiveSheet()->getCellByColumnAndRow($col, 6)->getValue() == "час в сем") {
                        array_push($time_stamp, $col);
                    }
                }
                /* $groups = [];
                for ($col = 17; $col <= 30; $col++) {
                    if ($spreadsheet->getActiveSheet()->getCellByColumnAndRow($col, 5)->getValue() == "Преподаватель") {
                        for ($cols = $col; $cols <= 30; $cols++) {
                            if ($spreadsheet->getActiveSheet()->getCellByColumnAndRow($cols, 6)->getValue() != "") {
                                array_push($groups, $spreadsheet->getActiveSheet()->getCellByColumnAndRow($cols, 6)->getValue());
                            } else {
                                break;
                            }
                        }
                    }
                } */
                while ($spreadsheet->getActiveSheet()->getCell("A" . $iterator)->getValue() != "ИТОГО" && $spreadsheet->getActiveSheet()->getCell("B" . $iterator)->getValue() != "ИТОГО") {
                    if ($spreadsheet->getActiveSheet()->getCell("B" . $iterator)->getValue()  != "") {
                        $sem1 = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[0], $iterator)->getCalculatedValue() + $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[0] + 1, $iterator)->getCalculatedValue();
                        $sem2 = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[1], $iterator)->getCalculatedValue() + $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[1] + 1, $iterator)->getCalculatedValue();
                    }
                    $teachers = [];
                    for ($col = 17; $col <= 30; $col++) {
                        if ($spreadsheet->getActiveSheet()->getCellByColumnAndRow($col, 5)->getValue() == "Преподаватель") {
                            for ($cols = $col; $cols <= 30; $cols++) {
                                if ($spreadsheet->getActiveSheet()->getCellByColumnAndRow($cols, 6)->getValue() != "")
                                    array_push($teachers, $spreadsheet->getActiveSheet()->getCellByColumnAndRow($cols, $iterator)->getCalculatedValue());
                                else
                                    break;
                            }
                        }
                    }
                    array_push($array_groups_subgects[$deprtment_object->id], ['discip_name' => $spreadsheet->getActiveSheet()->getCell("B" . $iterator)->getValue(), 'discip_hours_first' => intval($sem1),"discip_hours_second"=>intval($sem2), 'teachers' => $teachers, 'groups' => $groups]);
                    $iterator++;
                }
            }
            Debugbar::info($array_groups_subgects);
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

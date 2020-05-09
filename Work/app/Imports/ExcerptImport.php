<?php

namespace App\Imports;

use Debugbar;
use App\Helpers\TemporaryFiles\TemporaryFileFactory;
use \PhpOffice\PhpSpreadsheet\IOFactory;

class ExcerptImport
{
    public function getExcert($file)
    {
        $temp_file = new TemporaryFileFactory();
        $temp_file->newTemporaryFile($file);
        try {

            $reader = IOFactory::createReader(IOFactory::identify($temp_file->getFileName()));
            $spreadsheet = $reader->load($temp_file->getFileName());
            $array_groups_subgects = [];
            for ($i = 0; $i < $spreadsheet->getSheetCount(); $i++) {
                $spreadsheet->setActiveSheetIndex($i);
                $iterator = 7;
                $array_groups_subgects[$i] = [];
                $time_stamp = [];
                for ($col = 1; $col <= 20; ++$col) {
                    if ($spreadsheet->getActiveSheet()->getCellByColumnAndRow($col, 6)->getValue() == "час в сем") {
                        array_push($time_stamp, $col);
                    }
                }
                $groups = [];
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
                }
                array_push($array_groups_subgects[$i], $groups);
                while ($spreadsheet->getActiveSheet()->getCell("A" . $iterator)->getValue() != "ИТОГО" && $spreadsheet->getActiveSheet()->getCell("B" . $iterator)->getValue() != "ИТОГО") {
                    if ($spreadsheet->getActiveSheet()->getCell("B" . $iterator)->getValue()  != "")
                        $test = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[0], $iterator)->getCalculatedValue() + $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[0] + 1, $iterator)->getCalculatedValue() + $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[1], $iterator)->getCalculatedValue() + $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[1] + 1, $iterator)->getCalculatedValue();
                    array_push($array_groups_subgects[$i], ['subject' => $spreadsheet->getActiveSheet()->getCell("B" . $iterator)->getValue(), 'time' => $test]);
                    $iterator++;
                }
            }
            Debugbar::info($array_groups_subgects);
        } catch (\Throwable $th) {
        }
        $temp_file->clearGarbage();
        return $array_groups_subgects;
    }
}

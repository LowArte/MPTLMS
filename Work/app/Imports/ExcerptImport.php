<?php

namespace App\Imports;

use Debugbar;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Files\TemporaryFile;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Maatwebsite\Excel\Helpers\FileTypeDetector;
use Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ExcerptImport
{
    public $file_name;
    public function getExcert($file)
    {
        try {
            $this->temp($file);
            $type = IOFactory::identify($this->file_name);
            $reader = IOFactory::createReader($type);
            $spreadsheet = $reader->load($this->file_name);
            $arr = [];
            $time_stamp = [];
            for ($i = 0; $i < $spreadsheet->getSheetCount(); $i++) {
                $spreadsheet->setActiveSheetIndex($i);
                $iterator = 7;
                $arr[$i] = [];
                for ($col = 1; $col <= 20; ++$col) {
                    if ($spreadsheet->getActiveSheet()->getCellByColumnAndRow($col, 6)->getValue() == "час в сем") {
                        array_push($time_stamp, $col);
                    }
                }
                while ($spreadsheet->getActiveSheet()->getCell("A" . $iterator)->getValue() != "ИТОГО" && $spreadsheet->getActiveSheet()->getCell("B" . $iterator)->getValue() != "ИТОГО") {
                    if ($spreadsheet->getActiveSheet()->getCell("B" . $iterator)->getValue()  != "")
                        $test = $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[0], $iterator)->getCalculatedValue() + $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[0] + 1, $iterator)->getCalculatedValue() + $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[1], $iterator)->getCalculatedValue() + $spreadsheet->getActiveSheet()->getCellByColumnAndRow($time_stamp[1] + 1, $iterator)->getCalculatedValue();
                        array_push($arr[$i], ['subject' => $spreadsheet->getActiveSheet()->getCell("B" . $iterator)->getValue(), 'time' => $test]);
                    $iterator++;
                }
                $time_stamp = array();
            }
        } catch (\Throwable $th) {
            Debugbar::info($th);
        }
        $this->clearGarbage();
        return $arr;
    }

    /**
     * Функция осуществляет поиск информации в столбце
     * @return номер первой релевантной строки
     */
    private function find(Spreadsheet $spreadsheet, $cels, $param, $iterator)
    {
        if ($spreadsheet->getActiveSheet()->getCell($cels + $iterator)->getValue() == $param) {
            return $iterator;
        }
        $this->find($spreadsheet, $cels, $param, $iterator++);
    }

    private function temp($filePath)
    {
        $fileExtension = FileTypeDetector::detect($filePath, null);
        $this->file_name = sys_get_temp_dir() . "\\temp-test-file-" . Str::random(32) . '.' . Str::lower($fileExtension);
        touch($this->file_name);
        if ($filePath instanceof UploadedFile) {
            $readStream = fopen($filePath->getRealPath(), 'rb');
        }
        file_put_contents($this->file_name, $readStream);
    }

    private function clearGarbage()
    {
        unlink($this->file_name);
    }
}

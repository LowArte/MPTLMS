<?php

namespace App\Helpers\TemporaryFiles;

use Debugbar;
use Maatwebsite\Excel\Helpers\FileTypeDetector;
use Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TemporaryFileFactory
{
    private $file_name;

    public function getFileName() {
        return $this->file_name;
    }

    public function newTemporaryFile($file_path)
    {
        $this->file_name = $this->affordNmae($file_path);
        touch($this->file_name);
        if ($file_path instanceof UploadedFile) 
        {
            $read_stream = fopen($file_path->getRealPath(), 'rb');
        }
        file_put_contents($this->file_name, $read_stream);
    }

    private function affordNmae($file_path)
    {
        return sys_get_temp_dir() . "\\temp-lms-file-" . Str::random(64) . '.' . Str::lower(FileTypeDetector::detect($file_path, null));
    }

    public function clearGarbage()
    {
        unlink($this->file_name);
    }
}

<?php

namespace App\Helpers\TemporaryFiles;

use Debugbar;
use Maatwebsite\Excel\Helpers\FileTypeDetector;
use Storage;
use Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TemporaryFileFactory
{
    private $file_name;

    public function getFileName() {
        return storage_path('temp')."/".$this->file_name;
    }

    public function newTemporaryFile($file_path)
    {
        $this->file_name = $this->affordNmae($file_path);
        if ($file_path instanceof UploadedFile) 
        {
            $content = file_get_contents($file_path->getRealPath());
        }
        Storage::disk("temp")->put($this->file_name,$content);
    }

    private function affordNmae($file_path)
    {
        return "temp-lms-file-" . Str::random(64) . '.' . Str::lower(FileTypeDetector::detect($file_path, null));
    }

    public function clearGarbage()
    {
        Storage::disk("temp")->delete($this->file_name);
    }
}

<?php

namespace App\Helpers\HomeworkFiles;

use Debugbar;
use Maatwebsite\Excel\Helpers\FileTypeDetector;
use Storage;
use Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

date_default_timezone_set('Europe/Moscow');

class HomeworkFileFactory {

    private $file_name;

    //!-----------------------------------------------------------------
    //!     Методы получения данных
    //!-----------------------------------------------------------------

    /**
     * Возвращает имя фала в текущем экземпляре объекта
     * @return String - строковое значение
     * Если приватный getter пустой, тогда вернёт null
     */
    public function getFileName($id) {
        return storage_path("homework/".$id."/exstraction")."/".$this->file_name;
    }

    /**
     * Возвращает все фалы без учета вложенных папок, если таковые имеются, в парке @exstraction
     * @return Array - массив фалов в указаном репозитории
     * Если репозиторий пуст, тогда вернёт []
     */
    public function getFilesInsideRepositoryeExstraction($id) {
        return Storage::files("homework/".$id."/exstraction");
    }

    /**
     * Возвращает все фалы без учета вложенных папок, если таковые имеются, в парке @homework/$id
     * @return Array - массив фалов в указаном репозитории
     * Если репозиторий пуст, тогда вернёт []
     */
    public function getFilesInsideRepository($id) {
        return Storage::files("homework/".$id);
    }

    /**
     * Возвращает файл, если таковой имеются, в парке @homework/$id/...
     * @return false - если файла не существует или достп не был получент
     */
    public function getFileInsideRepository($id, $fileName) {
        if (Storage::disk("homework/".$id)->exists($fileName))
            return Storage::allFiles("homework/".$id.'/'.$fileName);
        else
            return false;
    }

    //!-----------------------------------------------------------------
    //!     Методы создания файлов
    //!-----------------------------------------------------------------

    /**
     * Создаёт файл в папке @exstraction
     * @return true - если файл успешно создан, в проивном случае возвращает @false
     */
    public function createFileExstraction($file, $id) {
        $this->file_name = $this->affordNmae($file);
        if ($file instanceof UploadedFile) {
            $content = file_get_contents($file->getRealPath());
        }
        if (Storage::disk("homework/".$id."/exstraction")->put($this->file_name, $content))
            return true;
        else return false;
    }

    /**
     * Создаёт файл в папке @homework/$id
     * @return true - если файл успешно создан, в проивном случае возвращает @false
     */
    public function createFileHomework($file, $id, $userName) {
        $this->file_name = $this->affordNameHomeworck($file, $userName);
        if ($file instanceof UploadedFile) {
            $content = file_get_contents($file->getRealPath());
        }
        if (Storage::disk("homework/".$id)->put($this->file_name, $content))
            return true;
        else return false;
    }

    //!-----------------------------------------------------------------
    //!     Методы генерации имён фалов
    //!-----------------------------------------------------------------

    /**
     * Генерирует уникальное имя файла для репозитория @exstraction
     */
    private function affordName($file) {
        return "exstraction-lms-file-" . Str::random(64) . '.' . Str::lower(FileTypeDetector::detect($file, null));
    }

    /**
     * Генерирует уникальное имя файла для репозитория @homework/$id
     */
    private function affordNameHomeworck($file, $userName) {
        return "homework-lms-file-" . $userName . date("-YmdHis") . '.' . Str::lower(FileTypeDetector::detect($file, null));
    }

    //!-----------------------------------------------------------------
    //!     Методы очистики репозиториев
    //!-----------------------------------------------------------------

    /**
     * Удаляет репозиторий по указанному $id без возможности восстановить
     */
    public function deleteHomeworkRepository($id) {
        Storage::disk('homework')->deleteDirectory("./".$id);
    }

    /**
     * Удаляет репозиторий по указанному $id без возможности восстановить
     */
    public function deleteHomeworkDocument($path) 
    {
        Storage::disk('homework')->delete('./'.$path);
    }
}
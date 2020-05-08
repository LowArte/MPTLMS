<?php

namespace App\Observers;

use App\Helpers\FileWrite\FileWriter;
use App\Helpers\FileWrite\Rewrite;
use App\Models\DepartmentBuffer;
use Config;
use Debugbar;
use ErrorException;
use Schema;
use Storage;

class DepartmentBufferObserver
{
    /**
     * Формируем после создания
     *
     * @param  \App\Models\DepartmentBuffer  $departmentBuffer
     * @return void
     */
    public function creating(DepartmentBuffer $departmentBuffer)
    {
        $departmentBuffer->db_name = "db_for_" . date("Y");
        Storage::disk('db')->put($departmentBuffer->db_name . ".sqlite", '');
        $path = storage_path('databases\\' . $departmentBuffer->db_name . ".sqlite");
    }

    /**
     * Handle the department buffer "updated" event.
     *
     * @param  \App\DepartmentBuffer  $departmentBuffer
     * @return void
     */
    public function updated(DepartmentBuffer $departmentBuffer)
    {
        //
    }

    /**
     * Handle the department buffer "deleted" event.
     *
     * @param  \App\DepartmentBuffer  $departmentBuffer
     * @return void
     */
    public function deleted(DepartmentBuffer $departmentBuffer)
    {
        //
    }

    /**
     * Handle the department buffer "restored" event.
     *
     * @param  \App\DepartmentBuffer  $departmentBuffer
     * @return void
     */
    public function restored(DepartmentBuffer $departmentBuffer)
    {
        //
    }

    /**
     * Handle the department buffer "force deleted" event.
     *
     * @param  \App\DepartmentBuffer  $departmentBuffer
     * @return void
     */
    public function forceDeleted(DepartmentBuffer $departmentBuffer)
    {
        //
    }
}

<?php

namespace App\Observers;

use App\Helpers\SQLite\SQLiteDBFunctions;
use App\Models\DepartmentBuffer;

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
        // Storage::disk('db')->put($departmentBuffer->db_name . ".sqlite", '');
        $db = new SQLiteDBFunctions($departmentBuffer->db_name);
        $db->createTable();
        
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

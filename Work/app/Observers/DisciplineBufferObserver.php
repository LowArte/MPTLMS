<?php

namespace App\Observers;

use App\Helpers\SQLite\SQLiteDBFunctions;
use App\Models\DisciplineBuffer;

use Storage;

class DisciplineBufferObserver
{
    /**
     * Формируем после создания
     *
     * @param  \App\Models\DisciplineBuffer  $disciplineBuffer
     * @return void
     */
    public function creating(DisciplineBuffer $disciplineBuffer)
    {
        $disciplineBuffer->db_name = "db_for_" . date("Y");
        $db = new SQLiteDBFunctions($disciplineBuffer->db_name);
        $db->createTable();
        $db->testData();
    }

    /**
     * Handle the department buffer "updated" event.
     *
     * @param  \App\DisciplineBuffer  $disciplineBuffer
     * @return void
     */
    public function updated(DisciplineBuffer $disciplineBuffer)
    {
        //
    }

    /**
     * Handle the department buffer "deleted" event.
     *
     * @param  \App\DisciplineBuffer  $disciplineBuffer
     * @return void
     */
    public function deleted(DisciplineBuffer $disciplineBuffer)
    {
        //
    }

    /**
     * Handle the department buffer "restored" event.
     *
     * @param  \App\DisciplineBuffer  $disciplineBuffer
     * @return void
     */
    public function restored(DisciplineBuffer $disciplineBuffer)
    {
        //
    }

    /**
     * Handle the department buffer "force deleted" event.
     *
     * @param  \App\DisciplineBuffer  $disciplineBuffer
     * @return void
     */
    public function forceDeleted(DisciplineBuffer $disciplineBuffer)
    {
        //
    }
}

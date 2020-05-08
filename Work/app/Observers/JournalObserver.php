<?php

namespace App\Observers;

use App\Models\Journal;

class JournalObserver
{
    /**
     * Handle the journal "created" event.
     *
     * @param  \App\Models\Journal  $journal
     * @return void
     */
    public function created(Journal $journal)
    {
        //
    }

    /**
     * Handle the journal "updated" event.
     *
     * @param  \App\Models\Journal  $journal
     * @return void
     */
    public function updated(Journal $journal)
    {
        //
    }

    /**
     * Handle the journal "deleted" event.
     *
     * @param  \App\Models\Journal  $journal
     * @return void
     */
    public function deleted(Journal $journal)
    {
        //
    }

    /**
     * Handle the journal "restored" event.
     *
     * @param  \App\Models\Journal  $journal
     * @return void
     */
    public function restored(Journal $journal)
    {
        //
    }

    /**
     * Handle the journal "force deleted" event.
     *
     * @param  \App\Models\Journal  $journal
     * @return void
     */
    public function forceDeleted(Journal $journal)
    {
        //
    }
}

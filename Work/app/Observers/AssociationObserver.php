<?php

namespace App\Observers;

use App\Models\Association;
use App\Modifications\Create\CreateJournalModification;
use Debugbar;

class AssociationObserver
{
    /**
     * Handle the association "created" event.
     *
     * @param  \App\Models\Association  $association
     * @return void
     */
    public function created(Association $association)
    {

    }

    /**
     * Handle the association "updated" event.
     *
     * @param  \App\Models\Association  $association
     * @return void
     */
    public function updated(Association $association)
    {
        //
    }

    /**
     * Handle the association "deleted" event.
     *
     * @param  \App\Models\Association  $association
     * @return void
     */
    public function deleted(Association $association)
    {
        //
    }

    /**
     * Handle the association "restored" event.
     *
     * @param  \App\Models\Association  $association
     * @return void
     */
    public function restored(Association $association)
    {
        //
    }

    /**
     * Handle the association "force deleted" event.
     *
     * @param  \App\Models\Association  $association
     * @return void
     */
    public function forceDeleted(Association $association)
    {
        //
    }
}

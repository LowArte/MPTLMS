<?php

namespace App\Observers;

use App\Models\Places;
use App\Modifications\Create\CreateCallScheduleModification;
use App\Modifications\Delete\DeleteCallScheduleModification;

class PlacesObserver
{

    /**
     * Handle the places "created" event.
     *
     * @param  \App\Models\Places  $places
     * @return void
     */
    public function created(Places $places)
    {
        $createCallScheduleModification = app(CreateCallScheduleModification::class);
        $createCallScheduleModification->addCallScheduleToDatabase(
            [
                'place_id' => $places->id, 
                'call_schedule' => json_encode([
                    "1" => "08:30-10:00",
                    "2" => "10:10-11:40",
                    "3" => "12:00-13:30",
                    "4" => "14:00-15:30",
                    "5" => "15:40-17:10",
                    "6" => "17:20-18:50",
                    "7" => "19:00-20:30",
                ])

            ],
            [
                'place_id' => "2",
                'call_schedule' => json_encode([
                    "1" => "08:30-10:00",
                    "2" => "10:10-11:40",
                    "3" => "12:00-13:30",
                    "4" => "14:00-15:30",
                    "5" => "15:40-17:10",
                    "6" => "17:20-18:50",
                    "7" => "19:00-20:30",
                ])
            ]
        );
    }

    /**
     * Handle the places "updated" event.
     *
     * @param  \App\Models\Places  $places
     * @return void
     */
    public function updated(Places $places)
    {
        //
    }

    /**
     * Handle the places "deleted" event.
     *
     * @param  \App\Models\Places  $places
     * @return void
     */
    public function deleted(Places $places)
    {
        $deleteCallScheduleModification = app(DeleteCallScheduleModification::class);
        $deleteCallScheduleModification->deleteCallScheduleFromDatabaseByPlaceId($places->id);
    }

    /**
     * Handle the places "restored" event.
     *
     * @param  \App\Models\Places  $places
     * @return void
     */
    public function restored(Places $places)
    {
        //
    }

    /**
     * Handle the places "force deleted" event.
     *
     * @param  \App\Models\Places  $places
     * @return void
     */
    public function forceDeleted(Places $places)
    {
        //
    }
}

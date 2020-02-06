<?php

namespace App\Repositories;

class PanelExtentionRepository extends BaseRepository
{
    protected function getModelClass(){
        return "";
    }
    /** 
     * get panel array for driving school
     * @return Array
    */
    public function getPanelForDrivingSchool()
    {
        return array(
            array(
                "header"  => "Подробная информация",
                "content" => "information-page-f/DrivingSchool",
                "props"   => array()
            )
        );
    }
    /** 
     * get panel array for call schedule
     * @return Array
    */
    public function getPanelForCallSchedule()
    {
        $callScheduleRepository = app(CallScheduleRepository::class);
        $calls = $callScheduleRepository->getCallSchedule();
        return array(
            array(
                "header"  => "Расписание звонков",
                "content" => "call-schedule-f/CallSchedule",
                "props"   => array('_time_table'=>$calls)
            )
        );
    }
}
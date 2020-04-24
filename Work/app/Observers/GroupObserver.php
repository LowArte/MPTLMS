<?php

namespace App\Observers;

use App\Models\Group;
use App\Modifications\Create\CreateScheduleModification;
use App\Modifications\Delete\DeleteScheduleModification;
use App\Repositories\ModelRepository\ScheduleRepository;

class GroupObserver
{
    /**
     * Handle the group "created" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function created(Group $group)
    {
        $createScheduleModification = app(CreateScheduleModification::class);
        $days = array('Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
        $les = array('TeacherChisl' => [], 'LessonChisl' => [], 'chisl' => false, 'TeacherZnam' => [], 'LessonZnam' => []);
        $lessons = array($les);
        $rasp = array();
        foreach ($days as $key => $value) {
            $lesons = array('Place' => rand(1, 2), '1' => $lessons[0], '2' => $lessons[0], '3' => $lessons[0], '4' => $lessons[0], '5' => $lessons[0], '6' => $lessons[0], '7' => $lessons[0]);
            $rasp[$value] = $lesons;
        }
        $createScheduleModification->addScheduleToDatabase(['group_id' => $group->id, 'schedule' => json_encode($rasp)]);
    }

    /**
     * Handle the group "updated" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function updating(Group $group)
    {
        if ($group->isDirty('child_id')) {
            $scheduleRepository = app(ScheduleRepository::class);
            if ($group->child_id != null) {
                $deleteScheduleModification = app(DeleteScheduleModification::class);
                $deleteScheduleModification->deleteScheduleFromDatabaseByGroupId($group->id);
            } else {
                $createScheduleModification = app(CreateScheduleModification::class);
                $days = array('Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
                $les = array('TeacherChisl' => [], 'LessonChisl' => [], 'chisl' => false, 'TeacherZnam' => [], 'LessonZnam' => []);
                $lessons = array($les);
                $rasp = array();
                foreach ($days as $key => $value) {
                    $lesons = array('Place' => rand(1, 2), '1' => $lessons[0], '2' => $lessons[0], '3' => $lessons[0], '4' => $lessons[0], '5' => $lessons[0], '6' => $lessons[0], '7' => $lessons[0]);
                    $rasp[$value] = $lesons;
                }
                $createScheduleModification->addScheduleToDatabase(['group_id' => $group->id, 'schedule' => json_encode($rasp)]);
            }
        }
    }

    /**
     * Handle the group "deleted" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function deleted(Group $group)
    {
        $deleteScheduleModification = app(DeleteScheduleModification::class);
        $deleteScheduleModification->deleteScheduleFromDatabaseByGroupId($group->id);
    }

    /**
     * Handle the group "restored" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function restored(Group $group)
    {
        $createScheduleModification = app(CreateScheduleModification::class);
        $days = array('Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
        $les = array('TeacherChisl' => [], 'LessonChisl' => [], 'chisl' => false, 'TeacherZnam' => [], 'LessonZnam' => []);
        $lessons = array($les);
        $rasp = array();
        foreach ($days as $key => $value) {
            $lesons = array('Place' => rand(1, 2), '1' => $lessons[0], '2' => $lessons[0], '3' => $lessons[0], '4' => $lessons[0], '5' => $lessons[0], '6' => $lessons[0], '7' => $lessons[0]);
            $rasp[$value] = $lesons;
        }
        $createScheduleModification->addScheduleToDatabase(['group_id' => $group->id, 'schedule' => json_encode($rasp)]);
    }

    /**
     * Handle the group "force deleted" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function forceDeleted(Group $group)
    {
        //
    }
}

<?php

namespace App\Modifications\Create;

use App\Models\Notifications as Model;
use App\Models\Students as StudentModel;
use App\Modifications\BaseModification;
use Debugbar;


class CreateNotificationsModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }
    //Создание записи уведомлений в таблице для определённого пользователя
    public function addNotificationToDatabase($request)
    {
        $notification = new Model();
        $notification->user_id = $request['user_id'];
        $notification->info = $request['info'];
        $result = $notification->save();
        return  $result;
    }
    //Добавление уведомления для пользователя
    public function saveForUserToDatabase($data)
    {
        $notifications = $this->startCondition()->where('user_id', $data['user_id'])->first();
        if($notifications == null){
            return false;
        }
        $add = json_decode($notifications->info);
        $data['info']['id'] = uniqid();
        array_push($add, $data['info']);
        $notifications->info = json_encode($add);
        $notifications->save();
        return true;
    }
    //Добавление уведомления для пользователей с определённой ролью
    public function saveForUserPostToDatabase($data)
    {
        $notifications = $this->startCondition()
        ->leftJoin('users', 'user_id', '=', 'users.id')
        ->where('post_id', $data['post_id'])
        ->select('notifications.id', 'notifications.user_id', 'notifications.info')
        ->get();
        if($notifications == null){
            return false;
        }
        foreach($notifications as $item)
        {
            $add = json_decode($item->info);
            $data['info']['id'] = uniqid();
            array_push($add, $data['info']);
            $item->info = json_encode($add);
            $item->save();
        }
        return true;
    }
    //Добавление уведомления для группы пользователей
    public function saveForGroupToDatabase($data)
    {
        $notifications = $this->startCondition()
        ->join('users', 'user_id', '=', 'users.id')
        ->leftJoin('students', 'users.id', '=', 'students.user_id')
        ->where('students.group_id', $data['group_id'])
        ->select('notifications.id', 'notifications.user_id', 'notifications.info')
        ->get();
        if($notifications == null){
            return false;
        }
        foreach($notifications as $item)
        {
            $add = json_decode($item->info);
            $data['info']['id'] = uniqid();
            array_push($add, $data['info']);
            $item->info = json_encode($add);
            $item->save();
        }
        return true;
    }
    //Добавление уведомления для пользователей отделения
    public function saveForUserDepartmentToDatabase($data)
    {
        $notifications = $this->startCondition()
        ->join('users', 'user_id', '=', 'users.id')
        ->leftJoin('students', 'users.id', '=', 'students.user_id')
        ->leftJoin('groups', 'students.group_id', '=', 'groups.id')
        ->where('groups.department_id', $data['department_id'])
        ->select('notifications.id', 'notifications.user_id', 'notifications.info')
        ->get();
        if($notifications == null){
            return false;
        }

        foreach($notifications as $item)
        {
            $add = json_decode($item->info);
            $data['info']['id'] = uniqid();
            array_push($add, $data['info']);
            $item->info = json_encode($add);
            $item->save();
        }
        return true;
    }

    //Добавление уведомления для всех пользователей системы
    public function saveForUserAllToDatabase($data)
    {
        $notifications = $this->startCondition()->get();
        if($notifications == null){
            return false;
        }

        foreach($notifications as $item)
        {
            $add = json_decode($item->info);
            $data['id'] = uniqid();
            array_push($add, $data);
            $item->info = json_encode($add);
            $item->save();
        }
        return true;
    }
}
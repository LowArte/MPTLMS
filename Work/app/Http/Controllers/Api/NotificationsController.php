<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ModelRepository\NotificationsRepository;
use App\Modifications\Update\UpdateNotificationsModification;
use App\Modifications\Create\CreateNotificationsModification;
use App\Modifications\Delete\DeleteNotificationsModification;


class NotificationsController extends BaseController
{
    /**
     * Получение уведомлений для пользователя по его id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getNotificationsForUser($id, NotificationsRepository $notificationsRepository)
    {
        $notifications = $notificationsRepository->getNotificationsForUser($id);
        return response()->json(compact('notifications'));
    }
    /**
     * Редактирования уведомлений для пользователя
     */
    public function edit(Request $request,UpdateNotificationsModification $updateNotificationsModification)
    {
        $data = $request->all();
        $result = $updateNotificationsModification->updateNotificationsForUserInDatabase($data);
        if($result)
            return response()->json(200);
        else
            return response()->json(500);
    }

    /**
     * Добавление уведомления для пользователя
     */
    public function saveForUser(Request $request, CreateNotificationsModification $createNotificationsModification)
    {
        $data = $request->all();
        $result = $createNotificationsModification->saveForUserToDatabase($data);
        if($result)
            return response()->json(200);
        else
            return response()->json(500);
    }
    /**
     * Добавление уведомления для группы пользователей
     */
    public function saveForUserGroup(Request $request, CreateNotificationsModification $createNotificationsModification)
    {
        $data = $request->all();
        $result = $createNotificationsModification->saveForGroupToDatabase($data);
        if($result)
            return response()->json(200);
        else
            return response()->json(500);
    }
    /**
     * Добавление уведомления для пользователей отделения
     */
    public function saveForUserDepartment(Request $request, CreateNotificationsModification $createNotificationsModification)
    {
        $data = $request->all();
        $result = $createNotificationsModification->saveForUserDepartmentToDatabase($data);
        if($result)
            return response()->json(200);
        else
            return response()->json(500);
    }
    /**
     * Добавление уведомления для пользователей с определённой ролью
     */
    public function saveForUserPost(Request $request, CreateNotificationsModification $createNotificationsModification)
    {
        $data = $request->all();
        $result = $createNotificationsModification->saveForUserPostToDatabase($data);
        if($result)
            return response()->json(200);
        else
            return response()->json(500);
    }
    /**
     * Добавление уведомления для всех пользователей
     */
    public function saveForUserAll(Request $request, CreateNotificationsModification $createNotificationsModification)
    {
        $data = $request->all();
        $result = $createNotificationsModification->saveForUserAllToDatabase($data);
        if($result)
            return response()->json(200);
        else
            return response()->json(500);
    }
}
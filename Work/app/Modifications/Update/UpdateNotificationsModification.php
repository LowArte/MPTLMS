<?php

namespace App\Modifications\Update;

use App\Models\Notifications as Model;
use App\Modifications\BaseModification;

use Debugbar;

class UpdateNotificationsModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateNotificationsForUserInDatabase($data)
    {
        $notifications = $this->startCondition()->find($data['id']);
        if($notifications == null){
            return false;
        }
        $notifications->info = json_encode($data['info']);
        $notifications->save();
        return true;
    }
}
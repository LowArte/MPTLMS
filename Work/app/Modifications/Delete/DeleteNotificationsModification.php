<?php

namespace App\Modifications\Delete;

use App\Models\Notifications as Model;
use App\Modifications\BaseModification;

class DeleteNotificationsModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteNotificationFromDatabase($id){
        $result = $this->startCondition()->where('user_id', $id)->delete();
        return $result;
    }
}
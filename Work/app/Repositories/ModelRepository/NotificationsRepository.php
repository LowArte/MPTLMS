<?php

namespace App\Repositories\ModelRepository;

use App\Models\Notifications as Model;

class NotificationsRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getNotificationsForUser($id)
    {
        $columns = ['id','user_id','info'];
        $result = $this->startCondition()->where('id', $id)->select($columns)->toBase()->first();   
        $result->info = json_decode($result->info);
        return $result;
    }
}
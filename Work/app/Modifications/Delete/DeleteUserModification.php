<?php

namespace App\Modifications\Delete;

use App\Models\User as Model;
use App\Models\Student as StudentModel;
use App\Models\Teacher as TeacherModel;
use App\Modifications\BaseModification;
use Illuminate\Support\Facades\DB;

class DeleteUserModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteUserFromDatabase($id, $post_id){
        if($post_id == 2)
            StudentModel::where('user_id', $id)->delete();
        if($post_id == 3)
            TeacherModel::where('user_id', $id)->delete();

        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}
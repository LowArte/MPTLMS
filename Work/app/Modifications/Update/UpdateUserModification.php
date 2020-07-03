<?php

namespace App\Modifications\Update;

use App\Models\User as Model;
use App\Models\Student as StudentModel;
use App\Models\Teacher as TeacherModel;
use App\Modifications\BaseModification;
use Illuminate\Support\Facades\DB;

use Debugbar;

class UpdateUserModification extends BaseModification
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function updateUserInDatabase($data)
    {
        $user = $this->startCondition()->where('users.id', $data['id'])->first();
        $post_id = $user->post_id;
        $user->fill($data);
        if($data['thirdName'] != null && $data['thirdName'] != '')
            $user->thirdName = $data['thirdName'];
        $result = $user->save();
        
        if($result)
        {
            if($post_id == 2 && $data['post_id'] != 2)
                StudentModel::where('user_id', $user->id)->delete();
            if($post_id == 2 && $data['post_id'] == 2)
            {
                $userStudent = StudentModel::where('user_id', $user->id)->first();
                $userStudent->group_id = $data['student']['group_id'];
                $userStudent->birthday = $data['student']['birthday'];
                $userStudent->gender = $data['student']['gender'];
                $userStudent->type_of_financing = $data['student']['type_of_financing'];
                $userStudent->save();  
            }
            
            if($post_id == 3 && $data['post_id'] != 3)
                TeacherModel::where('user_id', $user->id)->delete();

            if($post_id != 2 && $data['post_id'] == 2)
            {
                $userStudent = new StudentModel();
                $userStudent->user_id = $user->id;
                $userStudent->group_id = $data['student']['group_id'];
                $userStudent->birthday = $data['student']['birthday'];
                $userStudent->gender = $data['student']['gender'];
                $userStudent->type_of_financing = $data['student']['type_of_financing'];
                $userStudent->save();  
            }

            if($post_id != 3 && $data['post_id'] == 3)
            {
                $userTeacher = new TeacherModel();
                $userTeacher->user_id = $user->id;
                $userTeacher->save(); 
            }
        }
        if($result)
            return true;
        return  false;
    }
}
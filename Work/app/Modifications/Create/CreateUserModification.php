<?php

namespace App\Modifications\Create;

use App\Models\User as Model;
use App\Models\Student as StudentModel;
use App\Models\Teacher as TeacherModel;
use App\Modifications\BaseModification;


class CreateUserModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addUserToDatabase($data){

        $user = $this->startCondition()->select(['id'])->where('email',$data['email'])->toBase()->first();
        if($user != null){
            return false;
        }
        
        $user = new Model();
        $user->fill($data);
        if($data['thirdName'] != null && $data['thirdName'] != '')
            $user->thirdName = $data['thirdName'];
        $user->password = $data['password'];
        $result = $user->save();    
        if($result)
        {   
            if($data['post_id'] == 2)
            {
                $userStudent = new StudentModel();
                $userStudent->user_id = $user->id;
                $userStudent->group_id = $data['student']['group_id'];
                $userStudent->birthday = $data['student']['birthday'];
                $userStudent->gender = $data['student']['gender'];
                $userStudent->type_of_financing = $data['student']['type_of_financing'];
                $userStudent->save();  
            }

            if($data['post_id'] == 3)
            {
                $userTeacher = new TeacherModel();
                $userTeacher->user_id = $user->id;
                $userTeacher->save();  
            }
            
            return $user->id;  
        }   
        return false;
    }
}
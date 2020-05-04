<?php

namespace App\Repositories\ModelRepository;

use App\Models\User as Model;
use Illuminate\Support\Facades\DB;
use Debugbar;

class UserRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getUsers()
    {   $columns = ['id', 'name','secName','thirdName','email','post_id','disabled'];
        $result = $this->startCondition()->select($columns)->with('post:id,name')->get();
        foreach ($result as $value)
            if($value->post_id == 2)
                $value->student = DB::table('students')->where('user_id', '=', $value->id)->first();
                
        return $result;
    }

    public function getUserByEmail($email)
    {   $columns = ['id','email'];
        $result = $this->startCondition()->select($columns)->where("email",$email)->first();
        return $result;
    }

    public function getUserFIO($id)
    {   $columns = ['id','name','secName','thirdName'];
        $result = $this->startCondition()->select($columns)->where('id', $id)->first();
        return $result;
    }

    public function getTeachersFIO()
    {   $columns = ['id','name','secName','thirdName'];
        $result = $this->startCondition()->select($columns)->where('post_id', 3)->get();
        return $result;
    }
}
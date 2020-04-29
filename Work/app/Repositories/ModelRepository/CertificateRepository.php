<?php

namespace App\Repositories\ModelRepository;

use App\Models\Certificates as Model;

class CertificateRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getCertificates()
    {
        $columns = ['certificates.id','user_id','type', 'certificates_data', 'done', 'certificates.created_at'];
        $result = $this->startCondition()
        ->join('users', 'user_id', '=', 'users.id')
        ->select($columns)
        ->selectRaw("CONCAT(users.name,users.secName,users.thirdName) as fullFio, users.email")
        ->orderBy('id', 'desc')
        ->toBase()
        ->get();   
        foreach ($result as $value)
            $value->certificates_data = json_decode($value->certificates_data);
        return $result;
    }
}
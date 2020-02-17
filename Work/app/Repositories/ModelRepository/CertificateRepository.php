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
        $columns = ['id','user_id','type', 'certificates_data', 'done', 'created_at'];
        $result = $this->startCondition()->select($columns)->orderBy('id', 'desc')->toBase()->get();
        return $result;
    }
}
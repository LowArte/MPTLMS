<?php

namespace App\Repositories;

use App\Models\Certificates as Model;

class CertificateRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getCertificates()
    {
        $columns = ['id','user_id','type', 'certificates_data'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }
}
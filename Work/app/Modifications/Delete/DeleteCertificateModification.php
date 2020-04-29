<?php

namespace App\Modifications\Delete;

use App\Models\Certificates as Model;
use App\Modifications\BaseModification;

class DeleteCertificateModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteCertificateFromDatabase($id)
    {
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}
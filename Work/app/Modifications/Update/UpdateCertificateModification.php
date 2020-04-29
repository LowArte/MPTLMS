<?php

namespace App\Modifications\Update;

use App\Models\Certificates as Model;
use App\Modifications\BaseModification;

use Debugbar;
use Exception;

class UpdateCertificateModification extends BaseModification
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function updateCertificateAnswerdInDatabase($id)
    {
        $certificate = $this->startCondition()->find($id);
        $certificate->done = true;
        $result = $certificate->save();
        if($result)
            return true;
        return  false;
    }
}
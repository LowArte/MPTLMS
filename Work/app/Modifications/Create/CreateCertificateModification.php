<?php

namespace App\Modifications\Create;

use App\Models\Certificates as Model;
use App\Modifications\BaseModification;
use Illuminate\Support\Facades\Auth;

class CreateCertificateModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addCertificateToDatabase($request)
    {
        $cer = new Model();
        $cer->user_id = Auth::user()->id;
        $cer->done = false;
        $cer->type = $request['type'];
        $cer->certificates_data = $request['data'];
        $cer->save();
        return true;
    }
}
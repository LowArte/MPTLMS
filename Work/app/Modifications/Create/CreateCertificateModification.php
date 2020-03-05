<?php

namespace App\Modifications\Create;

use App\Models\Certificates as Model;
use App\Modifications\BaseModification;
use Illuminate\Support\Facades\Auth;
use Hash;

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
        $cer->certificates_data = json_encode($request['data']);
        $cer->save();
        return true;
    }
}
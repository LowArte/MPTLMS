<?php

namespace App\Modifications\Delete;
use App\Models\HomeWorkStudent as Model;
use App\Modifications\BaseModification;
use Debugbar;

class DeleteHomeWorkStudentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteHomeWorkStudent($assoctiation_home_work_id)
    {
        $result = $this->startCondition()
                        ->where('association_home_work_id', $assoctiation_home_work_id)
                        ->get();
        $deleteHomeWorkStudentDocumentModification = app(DeleteHomeWorkStudentDocumentModification::class);
        foreach($result as $value)
        {
            if($deleteHomeWorkStudentDocumentModification->deleteHomeWorkByIdDocument($value['id']))
                $value->delete();
        }
        return $result;
    }
}
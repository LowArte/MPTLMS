<?php

namespace App\Modifications\Delete;
use App\Models\HomeWorkDocument as Model;
use App\Modifications\BaseModification;
use App\Helpers\HomeworkFiles\HomeworkFileFactory;


class DeleteHomeWorkDocumentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteHomeWorkDocumentFromDatabase($id){
        $result = $this->startCondition()->where('id', $id)->first();
        if($result)
        {
            $homeworkFileFactory = app(HomeworkFileFactory::class);
            $homeworkFileFactory->deleteHomeworkDocument($result['path']);
            $result->delete();
        }
        return $result;
    }

    public function deleteHomeWorkByIdDocument($home_work_id)
    {
        $result = $this->startCondition()
                        ->where('home_work_id', $home_work_id)
                        ->get();
        $homeworkFileFactory = app(HomeworkFileFactory::class);
        foreach($result as $value)
        {
            $homeworkFileFactory->deleteHomeworkDocument($value['path']);
            $value->delete();
        }
        return $result;
    }
}
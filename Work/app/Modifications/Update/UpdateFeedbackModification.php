<?php

namespace App\Modifications\Update;

use App\Models\Feedback as Model;
use App\Modifications\BaseModification;

use Debugbar;
use Exception;

class UpdateFeedbackModification extends BaseModification
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function updateFeedbackAnswerdInDatabase($id)
    {
        $feedback = $this->startCondition()->find($id);
        $feedback->answered = true;
        $result = $feedback->save();
        if($result)
            return true;
        return  false;
    }
}
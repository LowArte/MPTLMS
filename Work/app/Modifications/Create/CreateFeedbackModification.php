<?php

namespace App\Modifications\Create;

use App\Models\Feedback as Model;
use App\Modifications\BaseModification;

class CreateFeedbackModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addFeedbackToDatabase($data, $user_id)
    {
        $feedback = new Model();
        $feedback->user_id = $user_id;
        $feedback->type = $data["type"];
        $feedback->text = $data["text"];
        $feedback->answered = 0;
        $feedback->save();
        return true;
    }
}
<?php

namespace App\Modifications\Other;

use App\Repositories\ModelRepository\UserRepository;
use Debugbar;

class OtherFeedbackModification
{
    public function sendEmail($data)
    {

        $userRepository = app(UserRepository::class);
        $user = $userRepository->getUserByEmail($data['to']);
        Debugbar::info($user);
        $data['by'] = auth()->user()->email;
        $user->sendAnswerForFeedback($data);
        return true;
    }
}

<?php

namespace App\Modifications\Other;

use App\Repositories\ModelRepository\UserRepository;
use Debugbar;

class OtherUserModification
{
    public function sendEmailNewUser($data)
    {
        $userRepository = app(UserRepository::class);
        $user = $userRepository->getUserByEmail($data['email']);
        $user->sendEmailNewUser($data);
        return true;
    }
}

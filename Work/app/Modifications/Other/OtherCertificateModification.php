<?php

namespace App\Modifications\Other;

use App\Repositories\ModelRepository\UserRepository;
use Debugbar;

class OtherCertificateModification
{
    public function sendEmailAccess($data)
    {
        $userRepository = app(UserRepository::class);
        $user = $userRepository->getUserByEmail($data['to']);
        $user->sendAnswerForCertificateAccess($data);
        return true;
    }

    public function sendEmailCancel($data)
    {
        $userRepository = app(UserRepository::class);
        $user = $userRepository->getUserByEmail($data['to']);
        $user->sendAnswerForCertificateCancel($data);
        return true;
    }
}

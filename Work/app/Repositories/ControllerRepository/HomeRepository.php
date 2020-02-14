<?php

namespace App\Repositories\ControllerRepository;

use App\Repositories\ModelRepository\DepartamentRepository;
use App\Repositories\ModelRepository\RetrainingInfoRepository;
use App\Repositories\ModelRepository\SiteOptionsRepository;
use App\Repositories\OtherRepository\PanelExtentionRepository;

class HomeRepository extends BaseRepository
{
    public function getDataForDefaultHomePage()
    {
        $pannel_repository = app(PanelExtentionRepository::class);
        $retraining_repository = app(RetrainingInfoRepository::class);
        $departamentRepository = app(DepartamentRepository::class);

        $departaments = $departamentRepository->getDepartamentsForDepartamentsInfo();
        $panel_array = $pannel_repository->getPanelForDrivingSchool();
        $retraining = $retraining_repository->getRetrainingInfo();

        return compact('panel_array', 'retraining', 'departaments');
    }

    public function getDataForWelcomeHomePage()
    {
        $pannel_repository = app(PanelExtentionRepository::class);
        $retraining_repository = app(RetrainingInfoRepository::class);
        $departamentRepository = app(DepartamentRepository::class);
        $siteOptionsRepository = app(SiteOptionsRepository::class);


        $panel_array = $pannel_repository->getPanelForDrivingSchool();
        $retraining = $retraining_repository->getRetrainingInfo();
        $departaments = $departamentRepository->getDepartamentsForDepartamentsInfo();
        $profilactic = $siteOptionsRepository->getIsProfilactic();

        return compact('panel_array', 'retraining', 'profilactic', 'departaments');
    }
}

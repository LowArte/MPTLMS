<?php

namespace App\Repositories\ControllerRepository;

use App\Repositories\ModelRepository\DepartmentRepository;
use App\Repositories\ModelRepository\RetrainingInfoRepository;
use App\Repositories\ModelRepository\SiteOptionsRepository;
use App\Repositories\OtherRepository\PanelExtentionRepository;

class HomeRepository extends BaseRepository
{
    public function getDataForDefaultHomePage()
    {
        $pannel_repository = app(PanelExtentionRepository::class);
        $retraining_repository = app(RetrainingInfoRepository::class);
        $departmentRepository = app(DepartmentRepository::class);

        $departments = $departmentRepository->getDepartmentsForDepartmentsInfo();
        $panel_array = $pannel_repository->getPanelForDrivingSchool();
        $retraining = $retraining_repository->getRetrainingInfo();

        return compact('panel_array', 'retraining', 'departments');
    }

    public function getDataForWelcomeHomePage()
    {
        $pannel_repository = app(PanelExtentionRepository::class);
        $retraining_repository = app(RetrainingInfoRepository::class);
        $departmentRepository = app(DepartmentRepository::class);
        $siteOptionsRepository = app(SiteOptionsRepository::class);


        $panel_array = $pannel_repository->getPanelForDrivingSchool();
        $retraining = $retraining_repository->getRetrainingInfo();
        $departments = $departmentRepository->getDepartmentsForDepartmentsInfo();
        $profilactic = $siteOptionsRepository->getIsProfilactic();

        return compact('panel_array', 'retraining', 'profilactic', 'departments');
    }
}

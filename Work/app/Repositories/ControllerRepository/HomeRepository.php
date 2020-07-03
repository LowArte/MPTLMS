<?php

namespace App\Repositories\ControllerRepository;

use App\Repositories\ModelRepository\DepartmentRepository;
use App\Repositories\ModelRepository\SiteOptionsRepository;
use App\Repositories\OtherRepository\PanelExtentionRepository;

class HomeRepository extends BaseRepository
{
    public function getDataForDefaultHomePage()
    {
        $pannel_repository = app(PanelExtentionRepository::class);
        $departmentRepository = app(DepartmentRepository::class);

        $departments = $departmentRepository->getDepartmentsForDepartmentsInfo();
        $panel_array = $pannel_repository->getPanelForDrivingSchool();

        return compact('panel_array', 'departments');
    }

    public function getDataForWelcomeHomePage()
    {
        $pannel_repository = app(PanelExtentionRepository::class);
        $departmentRepository = app(DepartmentRepository::class);
        $siteOptionsRepository = app(SiteOptionsRepository::class);


        $panel_array = $pannel_repository->getPanelForDrivingSchool();
        $departments = $departmentRepository->getDepartmentsForDepartmentsInfo();
        $profilactic = $siteOptionsRepository->getIsProfilactic();

        return compact('panel_array', 'profilactic', 'departments');
    }
}

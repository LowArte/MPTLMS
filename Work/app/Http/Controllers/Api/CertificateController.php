<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateCertificateModification;
use Illuminate\Http\Request;
use App\Repositories\ModelRepository\CertificateRepository;
use App\Modifications\Other\OtherCertificateModification;
use App\Modifications\Update\UpdateCertificateModification;
use App\Modifications\Delete\DeleteCertificateModification;



class CertificateController extends BaseController
{
    /**
     * Получение заказанных документов
     * @return JSON
     */
    public function getCertificates(CertificateRepository $certificateRepository)
    {
        $certificates = $certificateRepository->getCertificates();
        return response()->json(compact('certificates'));
    }

    /**
     * Сохранение заявки в базу данных
     * @return JSON
     */
    public function save(Request $request, CreateCertificateModification $createCertificateModification)
    {
        $result = $createCertificateModification->addCertificateToDatabase($request);
        if ($result)
            return response()->json(["success"=>true]);
    }

    /**
     * Ответ пользователю о выполнении справки
     * @return JSON
     */
    public function access(Request $request, OtherCertificateModification $otherCertificateModification, UpdateCertificateModification $updateCertificateModification)
    {
        $data = $request->all();
        $result = $otherCertificateModification->sendEmailAccess($data);
        
        if($result)
        {
            $this->editAnswered($data, $updateCertificateModification);
            return response()->json(["success"=>true]);
        }   
    }

    /**
     * Отказ пользователю в выполнении справки
     * @return JSON
     */
    public function cancel(Request $request, OtherCertificateModification $otherCertificateModification, DeleteCertificateModification $deleteCertificateModification)
    {
        $data = $request->all();
        $result = $otherCertificateModification->sendEmailCancel($data);

        if ($result)
        {
            $this->deleteCertificate($data['id'], $deleteCertificateModification);
            return response()->json(["success"=>true]);
        }
    }

    public function editAnswered($data, UpdateCertificateModification $updateCertificateModification){
        $result = $updateCertificateModification->updateCertificateAnswerdInDatabase($data['id']);
        if($result)
            return response()->json(["success"=>true]);
    }

    public function deleteCertificate($id, DeleteCertificateModification $deleteCertificateModification){
        $result = $deleteCertificateModification->deleteCertificateFromDatabase($id);
        if($result)
            return response()->json(["success"=>true]);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateHomeWorkDocumentModification;
use App\Modifications\Delete\DeleteHomeWorkDocumentModification;
use App\Modifications\Update\UpdateHomeWorkDocumentModification;
use App\Repositories\ModelRepository\HomeWorkDocumentRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;
use Storage;
use Str;
use Maatwebsite\Excel\Helpers\FileTypeDetector;

use Debugbar;
class HomeWorkDocumentController extends BaseController
{ 
    /**
     * Получение файлов
     * @return JSON
     */
    public function getHomeWorkDocument($home_work_id, HomeWorkDocumentRepository $homeworkdocumentRepository)
    {
        $documents = $homeworkdocumentRepository->getHomeWorkDocument($home_work_id);
        return response()->json(compact('documents'));
    }

    public function save($home_work_id, Request $request, CreateHomeWorkDocumentModification $createHomeWorkDocumentModification){
        Debugbar::info($request);
        Debugbar::info($home_work_id);
        $data = request()->file();
        foreach ($data as $file) {
            Debugbar::info($file);
            Debugbar::info($file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $path = Storage::disk('homework')->putFile('./'.$home_work_id.'/exstraction', $file);
            $createHomeWorkDocumentModification->addHomeWorkDocumentToDatabase([
                'home_work_id' => $home_work_id,
                'path' => $path,
                'name' => $file_name
            ]);
        }
        return response()->json(200);
    }

    public function getDocument($id, HomeWorkDocumentRepository $homeworkdocumentRepository)
    {
        $path = $homeworkdocumentRepository->getHomeWorkPathDocument($id);
        return Storage::disk('homework')->download("./".$path);
    }
    
    public function edit(Request $request,UpdateHomeWorkDocumentModification $updateHomeWorkDocumentModification){
        $data = $request->all();
        $result = $updateHomeWorkDocumentModification->updateHomeWorkDocumentInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeleteHomeWorkDocumentModification $deleteHomeWorkDocumentModification){
        $result = $deleteHomeWorkDocumentModification->deleteHomeWorkDocumentFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}
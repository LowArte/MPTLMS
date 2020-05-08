<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateJournalModification;
use App\Modifications\Delete\DeleteJournalModification;
use App\Modifications\Update\UpdateJournalModification;
use App\Repositories\ModelRepository\JournalRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_Writer_PDF;
use Debugbar;
use Excel;

class JournalController extends BaseController
{ 
    /**
     * Получение журнала по ассоциации id
     * @return JSON
     */
    public function getJournal($id, JournalRepository $journalRepository)
    {
        $journal = $journalRepository->getJournalById($id);
        return response()->json(compact('journal'));
    }

    public function parseExcel(Request $request)
    {
        $path = $request->file('file')->store('uploads', 'public');
        return Storage::download("./public/".$path);
        //Debugbar::info(Storage::download($path));
        //return response()->download(storage_path("/app/public/{$path}"));
        //return Storage::download($path);
        
        //return response()->json(compact('path'),200);
        /**$excel = new \PHPExcel();
s
        $excel->createSheet();
        $excel->setActiveSheetIndex(1);
        $excel->getActiveSheet()->setTitle('ChartTest');
        $writer = new \PHPExcel_Writer_Excel2007($excel);
        $writer->setIncludeCharts(TRUE);**/

        // Save the file.
        Debugbar::info($request);
        $data = $request->all();
        Debugbar::info($data);
        /*$objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->getActiveSheet();
        $sheet->setCellValue('A1','Test value');
        $writer = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $writer->save("test.xlsx");
        //$writer = new PHPExcel_Writer_PDF($objPHPExcel);
        //$writer->save("test.xlsx");
        return response()::download('test.xlsx', 'test.xlsx');*/
    }

    public function save(Request $request,CreateJournalModification $createJournalModification){
        $data = $request->all();
        $id = $createJournalModification->addJournalToDatabase($data);
        if($id)
            return response()->json(compact("id"),200);
        else
            return response()->json(500);
    }
    
    public function edit(Request $request,UpdateJournalModification $updateJournalModification){
        $data = $request->all();
        if(array_key_exists('0', $data['journal']))
        {
            $delete_keys = array('0');
            $data['journal'] = array_diff_key($data['journal'], array_flip($delete_keys));
            $data['titles'] = array_diff_key($data['titles'], array_flip($delete_keys));
        }
        $data['titles'] = json_encode($data['titles']);
        $data['journal'] = json_encode($data['journal']);
        
        $result = $updateJournalModification->updateJournalInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
    //Закрытие/Открытие журнала
    public function editClose($id, $close, UpdateJournalModification $updateJournalModification)
    {
        $result = $updateJournalModification->updateJournalCloseInDatabase($id, $close);
        if($result)
            return response()->json(200);
        else
            return response()->json(500);
    }

    public function delete($id,DeleteJournalModification $deleteJournalModification){
        $result = $deleteJournalModification->deleteJournalFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}
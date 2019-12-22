<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use App\Models\Files;
use Illuminate\Http\Request;
use Debugbar;
use Illuminate\Support\Facades\Storage;

class FileManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','profilactic']);
    }

    public function saveFile (Request $request)
    {
        try
        {
            $file = Files::where("name",'=', $request->file["name"])->first();
            if($request->file["id"]==-1){ //new file
                if ($file != null)
                    return response()->json(['success'=>'errorname']);
                $file = new Files();
                $file->name = $request->file["name"];
                $file->path = "/files/" .  $request->file["name"];
                $file->save();
            }else{ // update file
                if ($file != null && $file->id != $request->file["id"])
                    return response()->json(['success'=>'errorname']);
                $file->name = $request->file["name"];
                $file->path = "/files/" .  $request->file["name"];
                $file->save();
            }
            return response()->json(['success'=>true]);
        }
        catch(MNF $e)
        {
            return response()->json(['error'=>$e],400);
        }
    }

    public function deleteFile (Request $request)
    {
        try
        {
            $file = Files::where("id",$request->id)->first();
            $file->delete();
            return response()->json(['success'=>true]);
        }
        catch(MNF $e)
        {
            return response()->json(['error'=>$e],400);
        }
    }

    public function getFile(Request $request)
    {
        Debugbar::info($request);
        //$files = Files::get();
        return Storage::download($request["name"]);
    }

    public function getFiles()
    {
        $files = Files::get();
        return response()->json(['files'=>json_encode($files)],200);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = Files::all();
        return view('components/file-management', ['files' => json_encode($files)]);
    }
}
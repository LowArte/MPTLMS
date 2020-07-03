<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreatePlaceModification;
use App\Modifications\Delete\DeletePlaceModification;
use App\Modifications\Update\UpdatePlaceModification;
use App\Repositories\ModelRepository\PlaceRepository;
use Illuminate\Http\Request;

class PlaceController extends BaseController
{ 

    /**
     * get places from database
     * @return JSON
     */
    public function getPlaces(PlaceRepository $placeRepository)
    {
        $places = $placeRepository->getPlaces();
        return response()->json(compact('places'));
    }

    public function save(Request $request,CreatePlaceModification $createPlaceModification){
        $data = $request->all();
        $id = $createPlaceModification->addPlaceToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdatePlaceModification $updatePlaceModification){
        $data = $request->all();
        $result = $updatePlaceModification->updatePlaceInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeletePlaceModification $deletePlaceModification){
        $result = $deletePlaceModification->deletePlaceFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}

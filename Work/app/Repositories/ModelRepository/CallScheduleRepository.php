<?php

namespace App\Repositories\ModelRepository;

use App\Models\CallSchedule as Model;

class CallScheduleRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getCallSchedule()
    {
        $placeRepository = app(PlaceRepository::class);

        $columns = ['call_schedule','place_id'];
        $calls = $this->startCondition()->select($columns)->toBase()->get();

        $place = $placeRepository->getPlaces();
        $result = collect();
        foreach ($calls as $call) {
            $result->push([
                "place"=>$place->where('id',$call->place_id)->first(),
                'schedule'=>json_decode($call->call_schedule)
            ]);
        }
        return $result;
    }

    public function getCallScheduleForSchedule(){
        $placeRepository = app(PlaceRepository::class);

        $columns = ['call_schedule','place_id'];
        $calls = $this->startCondition()->select($columns)->toBase()->get();

        $place = $placeRepository->getPlaces();
        $result = collect();
        foreach ($calls as $call) {
            $result->push([
                "place"=>$place->where('id',$call->place_id)->first(),
                'schedule'=>json_decode($call->call_schedule)
            ]);
        }
        return $result;
    }

    public function getCallScheduleIdByPlace($place_id)
    {
        $columns = ['id'];
        $result = $this->startCondition()->select($columns)->where('place_id', $place_id)->toBase()->first()->id;
        return $result;
    }
}
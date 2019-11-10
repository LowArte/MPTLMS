@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
<contimetable discip="{{json_encode($discip) ?? null}}" c
all="{{json_encode($call) ?? null}}" 
teachers="{{json_encode($teachers) ?? null}}" 
place="{{json_encode($place) ?? null }}"   
departaments="{{json_encode($dep) ?? null}}"></contimetable>
</v-container>

@endsection
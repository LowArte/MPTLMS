@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <c-replacements 
        :_departaments_info="{{json_encode($departaments_info) ?? null}}" 
        :_groups_info="{{json_encode($groups_info) ?? null}}" 
        _replacements="{{json_encode($replacements) ?? null}}"/>
    <c-bild-replacements 
        :_departaments_info="{{json_encode($departaments_info) ?? null}}" 
        :_groups_info="{{json_encode($groups_info) ?? null}}"
        _teachers="{{json_encode($teachers) ?? null}}" 
        _discip="{{json_encode($discip) ?? null}}" />
</v-container>

@endsection
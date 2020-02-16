@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <c-replacement :_departaments_info="{{json_encode($departaments_info) ?? null}}" 
        :_groups_info="{{json_encode($groups_info) ?? null}}"
        :_replacements="{{json_encode($replacements) ?? null}}"/>
</v-container>
@endsection
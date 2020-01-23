@extends('layouts.app')

@section('content')
<v-tabs grow>
    <v-tab>
        Замены
    </v-tab>
    <v-tab>
        Конструктор
    </v-tab>
    <v-tab-item>
        <c-replacement :_departaments_info="{{json_encode($departaments_info) ?? null}}" 
    :_groups_info="{{json_encode($groups_info) ?? null}}" 
    :_schedule="{{json_encode($schedule) ?? null}}"></c-replacement>
    </v-tab-item>
    <v-tab-item>
        <c-bild-replacement :_departaments_info="{{json_encode($departaments_info) ?? null}}" 
    :_groups_info="{{json_encode($groups_info) ?? null}}" 
    :_schedule="{{json_encode($schedule) ?? null}}"></c-bild-replacement>
    </v-tab-item>
</v-tabs>
@endsection
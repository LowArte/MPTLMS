@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <!-- <c-department-managment :_departments="{{json_encode($departments) ?? null}}"/> -->
    <c-crud :_flood="{{json_encode($departments) ?? null}}" :_title="{{json_encode($title = ' - Специальности')}}" :_headers="{{json_encode($headers)}}"></c-crud>
</v-container>
@endsection

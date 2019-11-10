@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <listcertificate requests="{{json_encode($requests) ?? null}}"></listcertificate>
</v-container>

@endsection
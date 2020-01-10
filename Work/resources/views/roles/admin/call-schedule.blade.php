@extends('layouts.app')

@section('content')
<v-container fluid grid-list-md text-xs-center>
    <v-tabs grow >
        <v-tab>
            Рассписание звонков
          </v-tab>
          <v-tab>
            Конструктор рассписания звонков
          </v-tab>
        <v-tab-item>
            <c-call-schedule></c-call-schedule>
        </v-tab-item>
        <v-tab-item>
            <c-bild-call-schedule></c-bild-call-schedule>
        </v-tab-item>
    </v-tabs>
</v-container>
@endsection

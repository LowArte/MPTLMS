@extends('layouts.notregister')

@section('content')
<v-container>
    <v-card class="ma-0 pa-5 pb-2 mx-auto" style="width: 440px">
        <v-card-title class="pl-0 pb-0">
            <span class="headline">Новый пароль</span>
        </v-card-title>
        @if ($errors->any())
        <v-alert  class="my-2" text dense type="error">
            @foreach ($errors->all() as $error)
                <small>{{ $error }}</small>  
            @endforeach
        </v-alert>
        @endif
        <v-container class="pa-0 text-center">
            <v-form action="{{route('password.update')}}" method="post">
                @csrf
                <input type="hidden" name="token" value = "{{$token}}"></input>
                <input type="hidden" name="email" value = "{{$email}}"></input>
                <v-row>
                    <v-col cols="12" class="pt-0 pb-0">
                        <v-text-field name="password"  min="6" type="password" label="Пароль" required ></v-text-field>
                    </v-col>
                    <v-col cols="12" class="pt-0 pb-0">
                        <v-text-field name="password_confirmation" min="6" type="password" required label="Повторите пароль"></v-text-field>
                    </v-col>                  
                </v-row>
                <v-card-actions class="pr-1">
                    <v-btn type="submit" text block>Изменить</v-btn>
                </v-card-actions>
            </v-form>
        </v-container>   
  </v-card>
</v-container>
@endsection

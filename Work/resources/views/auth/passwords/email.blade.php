@extends('layouts.notregister')

@section('content')
<v-container>
    <v-card ma-0 pa-0>
        <v-card-title>
          <span class="headline">Сброс пароля</span>
        </v-card-title>
        @if ($errors->any())
        <v-alert text dense type="error">
            @foreach ($errors->all() as $error)
               <p>{{ $error }}</p>  
            @endforeach
        </v-alert>
        @endif
        <div style="margin:0 auto; width:500px">
          <small style="color: #FF3D00;">На вашу почту бедет отправлено письмо с подробной инструкцией.</small>
          <small style="color: #FF3D00;">Укажите свою почту в поле ниже.</small>
        </div>
        <v-form method="post" action="{{route("password.email")}}" style="margin:0 auto; width:500px">
            @csrf
            <v-col cols="12">
                <v-text-field label="E-mail" name="email" required></v-text-field>
            </v-col>
            <v-card-actions class="text-right">
            <div class="flex-grow-1"></div>
              <v-btn color="accent" text>Отмена</v-btn>
              <v-btn type="submit" text> Отправить</v-btn>
            </v-card-actions>
        </v-form>
      </v-card>
</v-container>
@endsection

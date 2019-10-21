@extends('layouts.app')

@section('content')

<v-container fluid grid-list-md text-xs-center>
    <v-row>
        <v-col cols="12">
            <v-hover v-slot:default="{ hover }">
                <v-card :elevation="hover ? 12 : 2" class="mx-auto pa-4" height="auto" width="max">
                    <v-card-text class="my-1 ma-2 pa-0 display-1 font-weight-black">Ваша учётная карточка</v-card-text>
                    <v-divider class="ma-2"></v-divider>
                    <v-container class="ma-0 pa-2">
                        <p class="red--text"></p>
                        <p class="black--text"><b></b><br>Статус</p>
                        <p class="black--text"><b></b><br>Пол</p>
                        <p class="black--text"><b></b><br>Дата рождения</p>
                        <v-divider></v-divider>
                        <p class="black--text"><b></b><br>Email</p>
                        <p class="black--text"><b></b><br>Специальность</p>
                        <p class="black--text"><b></b><br>Курс</p>
                        <p class="black--text"><b></b><br>Группа</p>
                        <p class="black--text"><b></b><br>Специализация</p>
                        <v-divider></v-divider>
                        <p class="black--text"><b></b><br>Форма обучения</p>
                        <p class="black--text"><b></b><br>Вид финансирования</p>
                        <p class="black--text"><b></b><br>Срок обучения</p>
                        <v-divider></v-divider>
                    </v-container>
                </v-card>
            </v-hover>
        </v-col>
    </v-row>
</v-container>

@endsection
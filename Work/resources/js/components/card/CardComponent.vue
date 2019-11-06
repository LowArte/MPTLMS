<template>
    <v-row>
        <v-col cols="12">
            <v-hover v-slot:default="{ hover }">
                <v-card :elevation="hover ? 12 : 2" class="mx-auto pa-4" height="auto" width="max">
                    <v-card-text class="my-1 ma-2 pa-0 display-1 font-weight-black">Ваша студенческая карточка</v-card-text>
                    <v-divider class="ma-2"></v-divider>
                    <v-container class="ma-0 pa-2">
                        <p class="font-weight-black headline">{{FIO}}</p>
                        <v-divider></v-divider>
                        <p class="black--text"><br><b>Гендерная принадлежность: </b>{{Gender}}</p>
                        <p class="black--text"><br><b>Дата рождения: </b>{{Birthday}}</p>
                        <v-divider></v-divider>
                        <p class="black--text"><br><b>Email: </b>{{Email}}</p>
                        <p class="black--text"><br><b>Специальность: </b>{{Specialty}}</p>
                        <p class="black--text"><br><b>Курс: </b>{{Course}}</p>
                        <p class="black--text"><br><b>Группа: </b>{{Group}}</p>
                        <p class="black--text"><br><b>Специализация: </b>{{Specialization}}</p>
                        <v-divider></v-divider>
                        <p class="black--text"><br><b>Форма обучения: </b>{{TrainingForm}}</p>
                        <p class="black--text"><br><b>Вид финансирования: </b>{{FinancingType}}</p>
                        <p class="black--text"><br><b>Срок обучения: </b>{{TrainingPeriod}}</p>
                    </v-container>
                </v-card>
            </v-hover>
        </v-col>
    </v-row>
</template>

<script>
import { mapGetters } from "vuex";
import * as actions from "../../store/action-types";
export default {
    data: () => ({

    }),
    computed: {
        ...mapGetters([   
            "student",    
            "group",
            "departament"
        ]),
        FIO:function(){
            if(this.student != null)
                return user.name +" "+user.secName+" "+user.thirdName
            else   
                return "Загрузка данных"
        },
        Gender: function(){
             if(this.student != null)
                return this.student.gender
            else   
                return "Загрузка данных"
        },
        Birthday: function(){
             if(this.student != null)
                return this.student.birthday
            else   
                return "Загрузка данных"
        },
        Email:function(){
            if(this.student != null)
                return user.email
            else   
                return "Загрузка данных"
        },
        Specialty:function(){
            if(this.departament != null)
                return this.departament.dep_name_full
            else   
                return "Загрузка данных"
        } ,
        Course: function(){
            if(this.group != null)
                return this.group.сurs
            else   
                return "Загрузка данных"
        },
        Group: function(){
            if(this.group != null)
                return this.group.group_name
            else   
                return "Загрузка данных"
        },
        Specialization: function(){
            if(this.departament != null)
                return this.departament.specialization
            else   
                return "Загрузка данных"
        },
        TrainingForm: function(){
            if(this.group != null)
                return this.group.type_of_study
            else   
                return "Загрузка данных"
        },
        FinancingType: function(){
            if(this.student != null)
                return this.student.type_of_financing
            else   
                return "Загрузка данных"
        },
        TrainingPeriod: function(){
            if(this.group != null)
                return this.group.study_period
            else   
                return "Загрузка данных"
        },
  }
}
</script>
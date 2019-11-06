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
            return user.name +" "+user.secName+" "+user.thirdName
        },
        Gender: function(){
             if(this.student != null)
                return this.student.gender
        },
        Birthday: function(){
             if(this.student != null)
                return this.student.birthday
        },
        Email:function(){
            return user.email
        },
        Specialty:function(){
            if(this.departament != null)
                return this.departament.dep_name_full
        } ,
        Course: function(){
            if(this.group != null)
                return this.group.сurs
        },
        Group: function(){
            if(this.group != null)
                return this.group.group_name
        },
        Specialization: function(){
            if(this.departament != null)
                return this.departament.specialization
        },
        TrainingForm: function(){
            if(this.group != null)
                return this.group.type_of_study
        },
        FinancingType: function(){
            if(this.student != null)
                return this.student.type_of_financing
        },
        TrainingPeriod: function(){
            if(this.group != null)
                return this.group.study_period
        },
  }
}
</script>
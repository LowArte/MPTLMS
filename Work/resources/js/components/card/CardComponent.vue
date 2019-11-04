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
                        <p class="black--text"><br><b>Должность: </b>{{Post}}</p>
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
export default {
    data: () => ({
        FIO: 'Анпилогов Артём Олегович',
        Post: 'Студент',
        Gender: 'Мужчина',
        Birthday: '02.02.2001',
        Email: 'p_a.o.anpilogov@mpt.ru',
        Specialty: 'Программирование в компьютерных системах',
        Course: '4',
        Group: 'П-3-16',
        Specialization: 'Техник-программист',
        TrainingForm: 'Очная',
        FinancingType: 'Бюджет',
        TrainingPeriod: '3 года 10 месяцев'
    })
}
</script>
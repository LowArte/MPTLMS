<template>
  <v-row>
    <v-col cols="12">
      <v-hover v-slot:default="{ hover }">
        <v-card :elevation="hover ? 12 : 2" class="mx-auto" height="auto" width="max">
          <v-form v-model="form">
            <v-container>
              <v-row class="pa-2">
                <v-text-field v-model="FIO" label="Фамилия, Имя, Отчество студента" readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-select v-model="special" :items="itemss" label="Специальность" readonly></v-select>
              </v-row>
              <v-row class="pa-2">
                <v-select v-model="group" :items="itemsg" label="Группа" readonly></v-select>
              </v-row>
              <v-row class="pa-2">
                <v-text-field
                  v-model="datebirth"
                  label="Дата рождения"
                  hint="Формат День/Месяц/Год"
                  persistent-hint
                  @blur="date = parseDate(dateFormatted)"
                  readonly
                ></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-text-field v-model="school" label="Школа" readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-text-field
                  v-model="dateendschool"
                  label="Год оконачния школы"
                  hint="Формат День/Месяц/Год"
                  persistent-hint
                  @blur="date = parseDate(dateFormatted)"
                  readonly
                ></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-text-field v-model="yearmpt" label="Год поступления в МПТ" readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-select
                  v-model="postofgroup"
                  :items="postofgroup"
                  label="Обязанности в группе"
                  readonly
                ></v-select>
              </v-row>
              <v-row class="pa-2">
                <v-textarea
                  v-model="modelprogress"
                  :auto-grow="true"
                  :clearable="false"
                  :counter="255 ? 255 : false"
                  :filled="false"
                  :flat="true"
                  :hint="'Не более 255 символов'"
                  :label="'Успеваемость'"
                  :loading="false"
                  :no-resize="false"
                  :outlined="false"
                  :persistent-hint="false"
                  :placeholder="''"
                  :rounded="false"
                  :row-height="24"
                  :rows="1"
                  :shaped="false"
                  :single-line="false"
                  :solo="false"
                  :rules="progressRules"
                ></v-textarea>
              </v-row>
              <v-row class="pa-2">
                <v-text-field v-model="email" label="E-mail" required readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-textarea
                  v-model="modelorder"
                  :auto-grow="true"
                  :clearable="false"
                  :counter="255 ? 255 : false"
                  :filled="false"
                  :flat="true"
                  :hint="'Не более 255 символов'"
                  :label="'Куда нужна характеристика'"
                  :loading="false"
                  :no-resize="false"
                  :outlined="false"
                  :persistent-hint="false"
                  :placeholder="''"
                  :rounded="false"
                  :row-height="24"
                  :rows="3"
                  :shaped="false"
                  :single-line="false"
                  :solo="false"
                  :rules="orderRules"
                ></v-textarea>
              </v-row>
              <v-row class="pa-2 justify-center">
                <v-btn :disabled="!form" class="white--text" color="blue" depressed @click="sendQuery">Заказать</v-btn>
              </v-row>
            </v-container>
          </v-form>
        </v-card>
      </v-hover>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data: () => ({
    modelorder: "",
    modelprogress: "",
  
    group: "П-2-16",
    FIO: "Борисов Артём Игоревич",
    itemss: ["09.02.03 - Программирование в компьютерных системах"],
    special: "09.02.03 - Программирование в компьютерных системах",
    itemsg: ["П-1-16", "П-2-16", "П-3-16", "П-4-16"],
    school: "Школа №3",
    datebirth: "16-09-2000",
    dateendschool: "12-06-2016",
    yearmpt: "2019",
    email: "p_a.i.borisov@mpt.ru",
    postofgroup: "Ответственый за успеваемость",
    postofgroups: [
      "Староста",
      "Ответственый за успеваемость",
      "Ответственый за посещяемость",
      "Студент"
    ],
    progressRules: [
      v => v.length > 0 || "Успеваемость не указана",
      v =>
        v.length <= 255 ||
        "Текст успеваемости должен быть не более 255 символов"
    ],
    orderRules: [
      v => v.length > 0 || "Текст заявки не указан",
      v => v.length <= 255 || "Текст заявки должен быть не более 255 символов"
    ],
    form: false
  }),
   methods: {
    sendQuery() {
      //Вписывай отправку
      alert("Отправлен запрос на получение характеристики!");
    }
  },
};
</script>
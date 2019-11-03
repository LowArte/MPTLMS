<template>
  <v-row>
    <v-col cols="12">
      <v-hover v-slot:default="{ hover }">
        <v-card :elevation="hover ? 12 : 2" class="mx-auto pa-4" height="auto" width="max">
          <v-card-text class="my-1 ma-2 pa-0 display-1 font-weight-black">Обратная связь</v-card-text>
          <v-card-text
            class="my-1 ma-2 pa-0 title font-weight-black"
          >с разработчиками и администратором сервиса</v-card-text>
          <v-divider class="ma-2"></v-divider>
          <v-form v-model="form">
            <v-container>
              <p>Опишите проблему, с которой вы столкнулись как можно более подробно, чтобы наши специалисты могли решить её в кротчайшие сроки.</p>
              <v-row>
                <v-text-field v-model="FIO" label="ФИО" readonly></v-text-field>
              </v-row>
              <v-row>
                <v-text-field v-model="group" label="Группа" required readonly></v-text-field>
              </v-row>
              <v-row>
                <v-text-field v-model="email" label="E-mail" required readonly></v-text-field>
              </v-row>
              <v-row>
                <v-select v-model="thematic" :items="thematics" label="Тематика"></v-select>
              </v-row>
              <v-row>
                <v-textarea
                  v-model="modelmessage"
                  :auto-grow="true"
                  :clearable="false"
                  :counter="255 ? 255 : false"
                  :filled="false"
                  :flat="true"
                  :hint="'Не более 255 символов'"
                  :label="'Сообщение'"
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
                  :rules="messageRules"
                ></v-textarea>
              </v-row>
              <v-row class="pa-2 justify-center">
                <v-btn :disabled="!form" class="white--text" color="blue" depressed @click="sendQuery">Отправить</v-btn>
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
    group: "П-2-16",
    FIO: "Борисов Артём Игоревич",
    email: "p_a.i.borisov@mpt.ru",

    thematic: "Другое",
    thematics: ["Проблемы с отображением", "Другое"],

    modelmessage: "",
    messageRules: [
      v => v.length > 0 || "Текст сообщения не указан",
      v =>
        v.length <= 255 || "Текст сообщения должен быть не более 255 символов"
    ],
    form: false
  }),
  methods: {
    sendQuery() {
      //Вписывай отправку
      alert("Отправлено обращение!");
    }
  },
};
</script>
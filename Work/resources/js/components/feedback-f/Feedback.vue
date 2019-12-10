<template lang="pug">
  v-row
    v-col(cols="12")
      v-hover(v-slot:default="{ hover }")
        v-card(:elevation="hover ? 12 : 2" class="mx-auto pa-4" height="auto" width="max")
          v-card-text(class="my-1 ma-2 pa-0 display-1 font-weight-black") Обратная связь
          v-card-text(class="my-1 ma-2 pa-0 title font-weight-black") с разработчиками и администратором сервиса
          v-divider(class="ma-2")
          v-form(v-model="form")
            v-container
              <p>Опишите проблему, с которой вы столкнулись как можно более подробно, чтобы наши специалисты могли решить её в кротчайшие сроки.</p>
              v-row
                v-text-field(v-model="FIO" label="ФИО" readonly)
              v-row
                v-text-field(v-model="email" label="E-mail" required readonly)
              v-row
                v-select(v-model="thematic" :items="thematics" label="Тематика")
              v-row
                v-textarea(
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
                  :rules="messageRules")
              v-row(class="pa-2 justify-center")
                v-btn( :disabled="!form" class="white--text" color="blue" depressed @click="sendQuery") Отправить
</template>

<script>
import feedbackApi from "../../api/feedback";
import withSnackbar from "../mixins/withSnackbar";

export default {
  mixins: [withSnackbar],
  data: () => ({
    group: "П-2-16",
    FIO: user.secName + " " + user.name + " " + user.thirdName,
    email: user.email,

    thematic: "Другое",
    thematics: ["Проблемы с отображением", "Проблема с данными", "Другое"],

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
      feedbackApi
        .save({ type: this.thematic, text: this.modelmessage })
        .then(res => {
          this.showMessage(
            "Ваше обращение будет рассмотрено в ближайшее время"
          );
          this.modelmessage = "";
        })
        .catch(ex => {
          this.showError("Что-то пошло не так");
        });
    }
  }
};
</script>
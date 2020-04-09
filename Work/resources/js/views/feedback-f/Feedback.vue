<template lang="pug">
  v-layout.row.wrap
    v-col(cols="12")
        v-card.mx-auto.pa-4(height="auto" width="max")
          v-card-title.ma-0.pa-0 Обратная связь
          v-form(v-model="form")
            v-alert.my-2(border="left" dense type="warning")
              span Опишите проблему, с которой вы столкнулись как можно более подробно, чтобы наши специалисты могли решить её в кротчайшие сроки.
            v-select.my-2(v-model="thematic" :items="thematics" label="Тема")
            v-textarea.my-2( v-model="modelmessage" :auto-grow="true" :clearable="false" :counter="255 ? 255 : false" :filled="false" :flat="true" :hint="'Описание проблемы'" :label="'Текст'"
              :loading="false" :no-resize="false" :outlined="false" :persistent-hint="false" :placeholder="''" :rounded="false" :row-height="24" :rows="3" :shaped="false"
              :single-line="false" :solo="false" :rules="messageRules")
            v-btn.my-2(block :disabled="!form" class="white--text" color="accent" depressed @click="sendQuery") Отправить
</template>

<script>
import feedbackApi from "@/js/api/feedback";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //*Оповещения

export default {
  mixins: [withSnackbar],

  data() {
    return {
      thematic: "Другое",
      thematics: [
        "Проблемы с отображением",
        "Проблема с данными",
        "Ошибка в текста",
        "Нарушение моих прав",
        "Оскорбления или проявления нетерпимости",
        "Оскорбление чувств верующих и экстримизм",
        "Другое"
      ],
      modelmessage: "",
      messageRules: [
        v => v.length > 0 || "Поле не должно быть пустым",
        v =>
          v.length <= 255 || "Текст сообщения должен быть не более 255 символов"
      ],
      form: false
    };
  },

  methods: 
  {
    async sendQuery() 
    {
      if(await feedbackApi.save({ type: this.thematic, text: this.modelmessage }, this))
        this.modelmessage = "";        
    }
  }
};
</script>
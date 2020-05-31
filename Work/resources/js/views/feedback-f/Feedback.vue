<template lang="pug">
v-content.ma-0.pa-2
  v-layout.row.wrap
    v-flex
      v-card
        v-system-bar
          span Обратная связь 
        v-form.pa-2(ref="form")
          v-alert.my-2(border='left' dense color='primary' dark)
            span Опишите проблему, с которой вы столкнулись как можно более подробно, чтобы наши специалисты могли решить её в кротчайшие сроки.
          v-select.my-2(outlined dense v-model="thematic" :rules="titleRules" :items="thematics" label="Тема")
          v-textarea.my-2(outlined v-model="modelmessage" :auto-grow="true" :counter="255 ? 255 : false" :hint="'Описание проблемы'" :label="'Текст'" :loading="false" :no-resize="false" :persistent-hint="false" :row-height="24" :rows="3" :rules="messageRules")
          v-btn.my-2(block class="white--text" color="blue" depressed @click="sendQuery") Отправить
</template>

<script>
import api_feedback from "@/js/api/feedback";
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
      titleRules: [
        v => !!v || "Тематика не указана сообщения не указан",
      ],
      messageRules: [
        v => !!v || "Поле не должно быть пустым",
        v => !!v && v.length <= 255 || "Текст сообщения должен быть не более 255 символов"
      ],
    };
  },

  methods: 
  {
    async sendQuery() 
    {
      if(this.$refs.form.validate())
      {
        if(await api_feedback.save({ type: this.thematic, text: this.modelmessage }))
        {
          this.showMessage("Отправлено!");
          this.$refs.form.reset();
        }
      }
      else
        this.showError("Заполните корректно поля!");   
    }
  }
};
</script>
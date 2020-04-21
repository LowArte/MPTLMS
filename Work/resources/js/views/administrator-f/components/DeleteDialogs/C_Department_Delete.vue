<template lang="pug">
  v-dialog(v-model="dialog" persistent max-width="500px" scrollable)
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Удалить запись
      v-card-text
        v-alert(dense type="info") Данное действие необратимо
        v-text-field.ma-2(v-model="item.image" label="Ссылка на картинку" readonly)
        v-text-field.ma-2(v-model="item.dep_name_full" label="Название специальности" readonly)
        v-text-field.ma-2(v-model="item.qualification" label="Квалификация" readonly)
        v-textarea.ma-2(outlined v-model="item.info.text" label="Описание" readonly)
        v-text-field.ma-2(v-model="item.studysperiod" :items="studysperiods" label="Период обучения" readonly)
        v-alert.mx-2(text dense type="warning")
          span Перечислите все необходимые спецификации через запятую
        v-list(v-for="(info,i) in Object.keys(item.info)" :key="i" v-if="info != 'text'" readonly)
          v-card-text.title {{info}}
          v-list-item-group(v-if="typeof(item.info[info]) == 'object'" color="primary")
            v-list-item(v-for="(item, j) in item.info[info]" :key="j" dense)
              v-card-text.py-1(v-text="item")
      v-card-actions              
        v-btn(color="accent darken-1" text @click="clickCancel") Отмена
        v-spacer
        v-btn(color="info darken-1" text @click="clickSave") Удалить
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"

export default {
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      studysperiods:[
        "3 года 10 месяцев",
        "2 года 10 месяцев",
        "1 год 10 месяцев",
      ],
      item: {
        id: null,
        dep_name_full: null,
        image: null,
        qualification: null,
        studysperiod:"3 года 10 месяцев",
        info: {
          text: ""
        }
      },
      resolve: null
    };
  },

  methods: {
    pop(item) {
      this.item = JSON.parse(JSON.stringify(item));
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },

    clickSave() {
      this.dialog = false;
      this.clearForm();
      this.resolve(this.item.id);
    },

    clickCancel() {
      this.dialog = false;
      this.clearForm();
      this.resolve(false);
    },

    clearForm()
    {
      this.item.dep_name_full = null
      this.item.image = null
      this.item.qualification = null
      this.item.studysperiod = "3 года 10 месяцев"
      this.item.info = []
      this.item.info['text'] = ""
    }
  }
};
</script>
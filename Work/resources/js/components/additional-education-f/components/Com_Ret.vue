<template lang="pug">
  v-flex.my-2
    v-card.mx-auto(max-width="420px" style="display: flex; flex-direction: column;" height="100%")
      v-img(max-height="200px" v-bind:src="_item.href")
      v-card-text.grow
        .my-1.subtitle-1.black--text(style="color: #FF3D00") {{ _item.title }}
        .my-1.subtitle-1.black--text ₽ • {{_item.cost}}
        .my-4.subtitle-1.black--text Продолжительность • {{_item.time}}
        div {{_item.text}}
      v-card-actions(wrap)
        v-btn.mx-auto(text small color="primary"  @click="dialog = true") Подать заявку
        v-btn.mx-auto(text small color="accent"  @click="dialogMore = true") Подробнее
        v-dialog(v-model="dialog" width="480")
          v-card
            v-card-title.headline.grey.lighten-3(primary-title) Заявка
            v-card-text
              v-container
                v-row
                  v-card-text.py-0(v-show="!visible") Так как вы авторизованный пользователь, Вам необходимо указать только номер телефона, по которому с вами свяжутся сотрудники центра дополнительного образования.
                  v-card-text.py-0(v-show="visible") Если у Вас есть учетная запись, Вы можете авторизоваться и данные будут автоматически отправлены в обработку.
                  v-card-text.py-0 Программа: {{ _item.title }}
                  v-col.py-0(cols="12")
                    v-text-field(label="Имя" v-model="name" :rules="validation" v-show="visible")
                  v-col.py-0(cols="12")
                    v-text-field(label="Фамилия" v-model="secName" :rules="validation" v-show="visible")
                  v-col.py-0(cols="12")
                    v-text-field(label="Отчество (при наличии)" v-model="thirdName" v-show="visible")
                  v-col.py-0(cols="12")
                    v-text-field(label="Email" v-model="email" :rules="emailRules" v-show="visible")
                  v-col.py-0(cols="12")
                    v-text-field(label="Телефонный номер" :rules="validation" v-model="telephon")
            v-divider
            v-card-actions
              v-spacer
              v-btn(color="red" text @click="dialog = false") Отмена
              v-btn(color="primary" text) Отправить
        v-dialog(v-model="dialogMore" fullscreen transition="dialog-bottom-transition")
          v-card
            v-toolbar(dark color="primary")
              v-btn(icon @click="dialogMore = false")
                v-icon mdi-close
              v-spacer
              v-toolbar-items
                v-btn(dark text @click="dialog = true") Подать заявку
            c-detailed-info(:_info="_item")
        
   
</template>

<script>
import DetailedInformation_C from "./../DetailedInformationRetraining"
export default {
  data: () => {
    return {
      dialog: false,
      dialogMore: false,
      name: null,
      secName: null,
      thirdName: null,
      email: null,
      telephon: null,
      visible: null,
      validation: [
        v => !!v || "Данное поле должено быть заполнено"
      ],
      emailRules: [
        v => !!v || "Почта не соответствует требованиям",
        v =>
          /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          "Не соответствует формату почты"
      ]
    };
  },
  mounted(){
      this.name =  this._user == null ? "" : this._user.name
      this.secName = this._user == null ? "" : this._user.secName
      this.thirdName = this._user == null ? "" : this._user.thirdName
      this.email = this._user == null ? "" :  this._user.email
      this.visible =  this._user == null
  },
  props: {
    _item: {
      type: Object,
      default: null
    },
    _user:{
      type:Object,
      default:null
    }
  },
  methods: {
    send() {
      /**
       * ! Отправлять данные в базу
       * * Присылать уведомление на почту подавшему заявку
       * * Прислать уведомление о новом заявление на почту UC
       */
    }
  },
  components:{
    "c-detailed-info": DetailedInformation_C
  }
};
</script>

<style>
.flexcard {
  display: flex;
  flex-direction: row;
}
</style>
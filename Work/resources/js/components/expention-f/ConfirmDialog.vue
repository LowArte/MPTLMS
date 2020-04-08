<template lang="pug">
    v-dialog(v-model="dialog" max-width="290")
        v-card
            v-card-title(color="warrning darken-1" class="headline") {{_title}}
            v-card-text {{_text}}
            v-card-actions
                v-spacer
                v-btn(color="accent darken-1" text @click="clickNot") Нет
                v-btn(color="green darken-1" text @click="clickYes") Да
</template>

<script>
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert
export default {
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      resolve: null
    };
  },

  methods: 
  {
    pop() 
    {
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },

    clickYes() 
    {
      this.dialog = false;
      this.resolve(true);
    },

    clickNot() 
    {
      this.showInfo("Действие было отменено пользователем");
      this.dialog = false;
      this.resolve(false);
    }
  },

  props: {
    _title: {
      type: String,
      default: "Внимание"
    },
    _text: {
      type: String,
      default: "Вы уверены, что хотите выполнить данное действие?"
    }
  }
};
</script>
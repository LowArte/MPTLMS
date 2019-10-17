<template>
  <v-dialog
    v-model="showRememberPassword"
    persistent
    max-width="600px"
    transition="dialog-transition"
  >
    <v-card>
      <v-card-title>
        <span class="headline">Сброс пароля</span>
      </v-card-title>
      <div style="margin:0 auto; width:500px">
        <small
          style="color: #FF3D00;"
        >На вашу почту бедет отправлено письмо с подробной инструкцией.</small>
        <small style="color: #FF3D00;">Укажите свою почту в поле ниже.</small>
      </div>
      <v-form style="margin:0 auto; width:500px" ref="rememberPasswordForm" v-model="valid">
        <v-col cols="12">
          <v-text-field
            label="E-mail"
            v-model="email"
            :rules="emailRules"
            :error-messages="errors['email']"
            required
          ></v-text-field>
        </v-col>
      </v-form>
      <v-card-actions class="text-right">
        <div class="flex-grow-1"></div>
        <v-btn color="accent" text @click.native="showRememberPassword = false">Отмена</v-btn>
        <v-btn
          :loading="loading"
          text
          :color="done ? 'green' : 'blue darken-1'"
          @click.native="rememberPassword"
        >
          <template v-if="!done">Отправить</template>
          <template v-else>Готово</template>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>


<script>
import * as actions from "../store/action-types";
import sleep from "../utils/sleep";
import withSnackbar from "./mixins/withSnackbar";

export default {
  mixins: [withSnackbar],
  data() {
    return {
      valid: false,
      internalAction: this.action,
      loading: false,
      done: false,
      errorMessage: "",
      errors: [],
      email: "",
      emailRules: [
        v => !!v || "Почта не соответствует требованиям",
        v =>
          /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          "Не соответсвтует формату почты"
      ]
    };
  },
  props: {
    action: {
      type: String,
      default: null
    }
  },
  methods: {
    rememberPassword() {
      if (this.$refs.rememberPasswordForm.validate()) {
        this.loading = true;
        this.$store
          .dispatch(actions.REMEMBER_PASSWORD, this.email)
          .then(response => {
            this.loading = false;
            this.done = true;
            sleep(4000).then(() => {
              this.showRememberPassword = false;
            });
          })
          .catch(error => {
            console.log(error.response)
            if (error.response && error.response.status === 422) {
              this.showError({
                message: "Не верные данные"
              });
            } else {
              this.showError(error);
            }
          })
          .then(() => {
            this.loading = false;
          });
      }
    }
  },
  computed: {
    showRememberPassword: {
      get() {
        if (
          this.internalAction &&
          this.internalAction === "request_new_password"
        )
          return true;
        return false;
      },
      set(value) {
        if (value) this.internalAction = "request_new_password";
        else this.internalAction = null;
      }
    }
  }
};
</script>

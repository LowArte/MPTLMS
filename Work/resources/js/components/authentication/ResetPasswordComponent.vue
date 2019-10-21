<template>
  <v-dialog v-model="showResetPassword" persistent max-width="320px" transition="dialog-transition">
    <v-card class="mx-auto" height="320" max-width="320">
      <v-card-title>
        <span class="headline">Новый пароль</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-form ref="resetPasswordForm" v-model="valid">
            <v-row>
              <v-text-field
                v-model="password"
                :rules="passwordRules"
                min="6"
                type="password"
                label="Пароль"
                required
              ></v-text-field>
              <v-text-field
                v-model="passwordConfirmation"
                :rules="passwordRules"
                type="password"
                min="6"
                :error-messages="errors['password']"
                required
                label="Повторите пароль"
              ></v-text-field>
            </v-row>
          </v-form>
        </v-container>
        <v-card-actions class="pr-1">
          <div class="flex-grow-1"></div>
          <v-btn
            :loading="loading"
            text
            :color="done ? '#FF3D00' : 'blue darken-1'"
            @click.native="reset"
          >
            <template v-if="!done">Изменить</template>
            <template v-else>Готово</template>
          </v-btn>
        </v-card-actions>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>


<script>
import * as actions from "../../store/action-types";
import withSnackbar from "../mixins/withSnackbar";
import sleep from "../../utils/sleep";

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
      password: "",
      passwordConfirmation: "",
      passwordRules: [
        v => !!v || "Пароль не соответствует требования",
        v => v.length >= 6 || "Пароль должен быть как минимум 6 символов"
      ]
    };
  },
  props: {
    action: {
      type: String,
      default: null
    },
    token: {
      type: String,
      default: null
    },
    email: {
      type: String,
      default: null
    }
  },
  methods: {
    reset() {
      if (this.$refs.resetPasswordForm.validate()) {
        const user = {
          email: this.email,
          password: this.password,
          password_confirmation: this.passwordConfirmation,
          token: this.token
        };
        this.loading = true;
        this.$store
          .dispatch(actions.RESET_PASSWORD, user)
          .then(response => {
            console.log("end");
            this.loading = false;
            this.done = true;
            sleep(4000).then(() => {
              this.showResetPassword = false;
              window.location = "/home";
            });
          })
          .catch(error => {
            if (error.response && error.response.status === 422) {
              this.showError({
                message: "Ошибка данных"
              });
            } else {
              this.showError(error);
            }
            this.errors = error.response.data.errors;
            console.log(this.errors);
          })
          .then(() => {
            this.loading = false;
          });
      }
    }
  },
  computed: {
    showResetPassword: {
      get() {
        if (this.internalAction && this.internalAction === "reset_password")
          return true;
        return false;
      },
      set(value) {
        if (value) this.internalAction = "reset_password";
        else this.internalAction = null;
      }
    }
  }
};
</script>

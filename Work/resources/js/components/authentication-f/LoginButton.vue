<template>
  <v-dialog
    v-show="show"
    v-model="showLogin"
    persistent
    max-width="600px"
    transition="dialog-transition"
  >
    <template v-slot:activator="{ on }">
      <v-btn color="accent" dark v-on="on">ВОЙТИ</v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="headline">ВОЙТИ</span>
      </v-card-title>
      <v-card-text>
        <v-form ref="loginForm" v-model="valid">
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  v-model="email"
                  :error-messages="errors['email']"
                  :rules="emailRules"
                  label="Email"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  min="1"
                  v-model="password"
                  :rules="passwordRules"
                  label="Пароль"
                  type="password"
                  required
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-form>
        <div class="flex-grow-1"></div>
        <v-btn color="accent font-weight-light" text href="/password/reset">
          <small>Не можете войти?</small>
        </v-btn>
        <div class="flex-grow-1"></div>
        <v-card-actions class="text-right">
          <div class="flex-grow-1"></div>
          <v-btn color="accent" text @click.native="showLogin = false">Отмена</v-btn>
          <v-btn @click.native="login" :loading="loginLoading" color="blue darken-1" text>ВОЙТИ</v-btn>
        </v-card-actions>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import * as actions from "../../store/action-types";
import withSnackbar from "../mixins/withSnackbar";

export default {
  mixins: [withSnackbar],
  data() {
    return {
      errors: [],
      internalAction: this.action,
      email: "",
      emailRules: [
        v => !!v || "Почта не соответствует требованиям",
        v =>
          /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          "Не соответствует формату почты"
      ],
      password: "",
      passwordRules: [
        v => !!v || "Пароль не соответствует требования",
      ],
      valid: false,
      loginLoading: false
    };
  },
  props: {
    action: {
      type: String,
      default: null
    },
    show: {
      type: Boolean,
      default: true
    }
  },
  computed: {
    showLogin: {
      get() {
        if (this.internalAction && this.internalAction === "login") return true;
        return false;
      },
      set(value) {
        if (value) this.internalAction = "login";
        else this.internalAction = null;
      }
    }
  },
  methods: {
    login() {
      if (this.$refs.loginForm.validate()) {
        this.loginLoading = true;
        const credentials = {
          email: this.email,
          password: this.password
        };
        this.$store
          .dispatch(actions.LOGIN, credentials)
          .then(response => {
            this.loginLoading = false;
            this.showLogin = false;
            window.location = "/home";
          })
          .catch(error => {
            if (error.response && error.response.status === 422) {
              this.showError({
                message: "Не верные данные"
              });
            } 
            else {
              this.showError(error);
            }
            this.errors = error.response.data.errors;
          })
          .then(() => {
            this.loginLoading = false;
          });
      }
    }
  }
};
</script>

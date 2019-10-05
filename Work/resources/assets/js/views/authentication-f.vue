<template>
    <div class="wrapper">
      <div style="height: 100%; margin: auto auto;">
        <div>
          <div class="logo" :style="{'background': `url(${require('../assets/svg/logo-mpt-light.svg')}) no-repeat`}"></div>
        </div>
        <div>
          <p class="main-text">Добро пожаловать</p>
          <p class="text">
            В ЛИЧНЫЙ КАБИНЕТ ОБУЧАЮЩЕГОСЯ И ПРЕПОДАВАТЕЛЯ
            <a href="https://www.mpt.ru" style="color: #fa4955; text-decoration-line: none;">МОСКОВСКОГО ПРИБОРОСТРОИТЕЛЬНОГО ТЕХНИКУМА</a>
          </p>
        </div>
        <div>
          <form @submit.prevent>
            <input class="put" type="text" v-model="form.login_email" placeholder="Введите Email" required />
            <input class="put-p" type="password" v-model="form.password" placeholder="Введите пароль" @keyup="onKeyup" required />
            <button class="login" @click="onLogin">ВОЙТИ</button>
          </form>
          <a href="#" class="wtf" @click="onRestore">Проблемы со входом?</a>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        login_email: "",
        password: ""
      },
      errors: {}
    };
  },
  methods: {
    onLogin() {
      this.errors = {};
      Vue.axios
        .post("auth/login", this.form)
        .then(responce => {
          this.$store.dispatch("login", { user: responce.data.user });
          this.$router.push("/main");
        })
        .catch(error => {
          console.log(error);
        });
    },
    checkError(field) {
      //return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
    },
    onKeyup(e) {
      if (e.code === "Enter") {
        this.onLogin();
      }
    },
    onRestore() {
      this.$router.push("/restore");
    }
  }
};
</script>

<style>
.page-enter-active,
.page-leave-active {
  transition: opacity 0.5s;
}
.page-enter,
.page-leave-active {
  opacity: 0;
}
.wrapper {
  height: 100%;
  width: 375px;
  margin: 0 auto;
}
.logo {
  position: absolute;
  width: 165px;
  height: 142px;
  left: calc(50% - 165px / 2 - 0.5px);
  top: calc(50% - 142px / 2 - 160px);
}
.main-text {
  position: absolute;
  /* width: 326px; */
  height: 42px;
  left: calc(50% - 326px / 2);
  top: calc(50% - 42px / 2 - 56px);
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  font-style: normal;
  font-weight: 500;
  font-size: 36px;
  line-height: 42px;
  text-align: center;
  color: #ffffff;
}
.text {
  position: absolute;
  width: 366px;
  height: 40px;
  left: calc(50% - 366px / 2);
  top: calc(50% - 40px / 2 - 15px);
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 13px;
  line-height: 20px;
  text-align: center;
  color: #ffffff;
}
.put {
  position: absolute;
  width: 326px;
  height: 35px;
  left: calc(50% - 326px / 2);
  top: calc(50% - 35px / 2 + 40.5px);
  background: #f7f7f7;
  border-radius: 3px;
  border-width: 1px;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  text-align: center;
  color: #434343;
}
.put-p {
  position: absolute;
  width: 326px;
  height: 35px;
  left: calc(50% - 326px / 2);
  top: calc(50% - 35px / 2 + 93.5px);
  background: #f7f7f7;
  border-radius: 3px;
  border-width: 1px;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  text-align: center;
  color: #434343;
}
.login {
  position: absolute;
  width: 100px;
  height: 35px;
  cursor: pointer;
  left: calc(50% - 100px / 2);
  top: calc(50% - 35px / 2 + 153.5px);
  background: #ffffff;
  border-radius: 3px;
  border-width: 1px;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  text-align: center;
}
.wtf {
  position: absolute;
  width: 164px;
  height: 20px;
  left: calc(50% - 164px / 2);
  top: calc(50% - 20px / 2 + 192px);
  font-family: Roboto;
  font-style: normal;
  font-weight: normal;
  font-size: 13px;
  line-height: 20px;
  text-align: center;
  text-decoration: none;
  color: #ffffff;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}
.wtf:hover {
  color: #F5C525;
}
</style>
<template>
    <div v-show="true" class="wrapper">
      <div v-show="true" style="height: 100%; margin: auto auto;">
        <div v-show="true">
          <div v-show="true" class="logo" :style="{'background': `url(${require('../assets/svg/warning.svg')}) no-repeat`}"></div>
        </div>
        <div>
          <p v-show="true" class="main-text">ВНИМАНИЕ</p>
          <p v-show="true" class="text">
            Для проведения процедуры смены пароля
            Вам на почту будет выслано письмо
            с дальнейшими инструкциями.
            Обратите внимание, что письмо действительно
            в течении 24 часов с момента отправки.
          </p>
        </div>
        <div>
          <form v-show="true" @submit.prevent>
            <input v-show="true" class="put" type="text" v-model="form.login_email" placeholder="Введите Email" required/>
            <button v-show="true" class="send" @click="onLogin">ОТПРАВИТЬ</button>
          </form>
          <a v-show="true" href="#" class="back" @click="onBack">Авторизация</a>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        login_email: null,
        password: null
      },
      errors: {}
    };
  },
  methods: {
    onLogin() {},
    checkError(field) {},
    onKeyup(e) {
      if (e.code === "Enter") {
        this.onLogin();
      }
    },
    onBack() {
      this.$router.push("/");
    }
  }
};
</script>

<style scoped>
.wrapper {
  height: 100%;
  width: 375px;
  margin: 0 auto;
}
.logo {
  position: absolute;
  width: 40px;
  height: 40px;
  left: calc(50% - 40px / 2 - 142px);
  top: calc(50% - 40px / 2 - 157px);
}
.main-text {
  position: absolute;
  width: 201px;
  height: 42px;
  left: calc(50% - 201px / 2 - 8.5px);
  top: calc(50% - 42px / 2 - 156px);
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
  width: 323px;
  height: 128px;
  left: calc(50% - 323px / 2 - 0.5px);
  top: calc(50% - 128px / 2 - 64px);
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 14px;
  line-height: 16px;
  text-align: justify;
  color: #ff3d00;
}
.put {
  position: absolute;
  width: 326px;
  height: 35px;
  left: calc(50% - 326px / 2);
  top: calc(50% - 35px / 2 + 43.5px);
  background: #f7f7f7;
  border-radius: 3px;
  border-width: 1px;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  text-align: center;
  color: #434343;
}
.send {
  position: absolute;
  width: 325px;
  height: 35px;
  left: calc(50% - 325px / 2 + 0.5px);
  top: calc(50% - 35px / 2 + 104.5px);
  background: #ffffff;
  border-radius: 3px;
  border-width: 1px;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  text-align: center;
}
.back {
  position: absolute;
  width: 81px;
  height: 20px;
  left: calc(50% - 81px / 2 + 1.5px);
  top: calc(50% - 20px / 2 + 159px);
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
.back:hover {
  color: #F5C525;
}
</style>
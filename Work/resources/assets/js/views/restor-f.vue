<template>
  <div class="wrapper">
    <transition name="slide-fade" mode="in-out">
      <div style="height: 100%; margin: auto auto;">
        <div>
          <div
            class="logo"
            :style="{'background': `url(${require('../assets/svg/warning.svg')}) no-repeat`}"
          ></div>
        </div>
        <div>
          <p class="main-text">ВНИМАНИЕ</p>
          <p class="text">
            Для проведения процедуры смены пароля
            Вам на почту будет выслано письмо
            с дальнейшими инструкциями.
            Обратите внимание, что письмо действительно
            в течении 24 часов с момента отправки.
          </p>
        </div>
        <div>
          <form>
            <input
              class="put"
              type="text"
              v-model="form.login_email"
              placeholder="Введите Email"
              required
            />
            <button class="send" @click="onLogin">ОТПРАВИТЬ</button>
          </form>
          <a href class="back" @click="onBack">Авторизация</a>
        </div>
      </div>
    </transition>
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
/* Animation */

.slide-fade-enter-active {
  transition: all 0.3s ease;
}
.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter,
.slide-fade-leave-to {
  transform: translateX(10px);
  opacity: 0;
}

/* End of animation block */

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
  background: #868686;
  border-radius: 5px;
  border-width: 1px;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  text-align: center;
  color: #ffffff;
}
.send {
  position: absolute;
  width: 325px;
  height: 35px;
  left: calc(50% - 325px / 2 + 0.5px);
  top: calc(50% - 35px / 2 + 104.5px);
  background: #ffffff;
  border-radius: 5px;
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
  color: #ffffff;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}
</style>
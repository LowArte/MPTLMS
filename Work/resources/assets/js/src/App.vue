<template>
  <div id="app">
    <div class="student-page">
      <div class="header">
        <div class="main-title">
          <p>Личный кабинет</p>
        </div>
        <div class="btn">
          <button class="exit">ВОЙТИ</button>
        </div>
      </div>
      <div class="wrapper">
        <div class="menu">
          <!-- Area for buttons of users -->
          <cbutton v-for="(item) of buttons" :key="item.content" v-bind:item="item" />
        </div>
        <div class="content">
          <!-- Area for contents of users -->
        </div>
      </div>
    </div>
    <router-view />
  </div>
</template>

<script>
import cbutton from "../components/c-buttons";
export default {
  data() {
    return {
      buttons: [
        { content: "Расписание занятий" },
        { content: "Успеваемость" },
        { content: "Посещаемость" }
      ]
    };
  },
  components: {
    cbutton
  }
};
</script>

<style>
* {
  padding: 0px;
  margin: 0px;
}

#app {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}

.non-selected {
  -ms-user-select: none;
  -moz-user-select: none;
  -khtml-user-select: none;
  -webkit-user-select: none;
}

div.header {
  position: fixed;
  z-index: 100;
  display: flex;
  display: -webkit-flex;
  display: -ms-flexbox;
  width: 100%;
  height: 45px;
  background-color: #231f20;
}

div.main-title > p {
  width: 100%;
  font-size: 16pt;
  color: #ffffff;
  align-content: center;
  padding: 5px 5px 5px 10px;
}

/* Wrepper content grid */

.wrapper {
  padding-top: 45px;
  height: 100%;
  display: grid;
  grid-template-rows: auto 100%;
}

.wrapper > div.menu {
  display: inline-flex;
  background-color: #231f20;
}

.wrapper > div.content {
  height: auto;
  background-color: #ffffff;
}

/* Input styles */

div.main-title {
  width: 100%;
}

input,
button {
  outline: 0 !important;
}

.btn {
  justify-items: stretch;
  align-items: center;
}

.exit {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 20px;
  min-width: 160px;
  height: 45px;
  background-color: #231f20;
  border: none;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  font-size: 16px;
  color: #ffffff;
  line-height: 1.2;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.exit:hover {
  background-color: #eb7272;
}

/* Media qwery for mobilephons */

/* All for a mobilephons */

@media only screen and (min-width: 320px) and (max-width: 480px) {
  .wrapper {
    padding-top: 55px;
  }
  div.header {
    height: 55px;
  }
  div.main-title > p {
    padding: 10px;
  }
  .btn {
    padding: 0px;
  }
}

@media only screen and (min-width: 480px) and (max-width: 320px) {
  .wrapper {
    padding-top: 55px;
  }
  div.header {
    height: 55px;
  }
  div.main-title > p {
    padding: 0px;
  }
}
</style>

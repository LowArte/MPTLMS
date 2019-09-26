<template>
  <div>
    <div class="header">
      <div class="main-title">
        <p>Личный кабинет</p>
      </div>
      <div class="btn">
        <button v-if="user.user" @click="logout" class="exit">ВЫХОД</button>
        <button v-else @click="login" class="exit">Войти</button>
      </div>
    </div>
    <div class="wrapper">
      <div v-if="user.user" class="menu">
        <!-- Area for buttons of users -->
        <cbutton v-for="(item) of buttons" :key="item.content" v-bind:item="item" />
      </div>
      <div class="content">
        <!-- Area for contents of users -->
      </div>
    </div>
  </div>
</template>

<script>
import cbutton from "../components/c-buttons";
export default {
  name: "bar",
  data() {
    return {
      buttons: [
        { content: "Расписание занятий" },
        { content: "Успеваемость" },
        { content: "Посещаемость" }
      ]
    };
  },
  computed:{
    user(){
      return this.$store.getters.getAuth
    }
  },
  methods: {
    logout() {
      Vue.axios.post("auth/logout").then(() => {
        this.$store.dispatch("logout", null);
        this.$router.push("/login");
      });
    },
    login(){
      this.$router.push('/login')
    }
  },
  components: {
    cbutton
  }
};
</script>
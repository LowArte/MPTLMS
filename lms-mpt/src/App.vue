<template>
  <div id="app">
    <Welcome/>
  </div>
</template>

<script>
import Welcome from "./components/Welcome.vue";

export default {
  name: "app",
  components: {
    Welcome
  }
};
</script>

<style>
#app {
  font-family: "Roboto", Helvetica, Arial, sans-serif;
  font-style: normal;
  font-weight: 100;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  background: #303030;
  height: 100%;
}
html, body{
  margin: 0px;
  padding: 0px;
  height: 100%;
}
</style>

<template>
  <div>
    <!-- <div id="nav">
      <router-link to="/">Home</router-link> |
    </div> -->
    <router-view/>
  </div>
</template>

<style>
* {
  padding: 0px;
  margin: 0px;
}
#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>

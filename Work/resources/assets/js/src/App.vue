<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<style>
  * {
    padding: 0px;
    margin: 0px;
  }

  #app {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  }

  .non-selected {
    -ms-user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
  }
</style>

<template>
  <div class="wrapper">
    <div class="container-login100">
      <div class="wrap-login100">
        Email
        import Schedule from '../views/schedule.vue'
      </div>
    </div>
  </div>
</template>

<script>
  
</script>

<style scoped>
/*[ RESTYLE TAG ]*/
* {
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
  text-decoration: none;
}

body,
html {
  height: 100%;
}

.font {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}

.font-title {
  color: #fff;
  font-size: 24pt;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}

/*[ login ]*/

.wrapper {
  width: 640px;
  margin: 0 auto;
}

.container-login100 {
  width: 100%;
  min-height: auto;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  padding: 15px;
  background: #ffffff;
}

.wrap-login100 {
  width: auto;
  background: #fff;
  border-radius: 0px;
  overflow: hidden;
  position: relative;
  box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
}

/*[ Form ]*/
.login100-form {
  width: 100%;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  padding: 43px 88px 93px 190px;
}
</style>
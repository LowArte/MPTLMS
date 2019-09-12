<template>
  <div class="welcome">
    <main class="wrapper">
      <section class="main-content">
        <div class="back-block-auth">
          <h1>Авторизация</h1>
          <div class="contant">
            <form>
              <div class="group">
                <input type="text" required />
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Email</label>
              </div>
              <div class="group">
                <input type="password" required />
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Пароль</label>
              </div>
              <div class="group" style="margin-top: 10px;">
                <button class="custom-button">ВОЙТИ</button>
              </div>
            </form>
          <!--   <div style="margin-top: 10px;">
              <label class="help-text">Не можете войти?</label>
            </div> -->
          </div>
        </div>
      </section>
      <footer class="footer"></footer>
    </main>
  </div>
</template>

<script>
export default {
  name: "Welcome"
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1,
h2,
h3,
h4 {
  margin: 0px;
  padding: 0px;
  font-style: normal;
  font-weight: 100;
  font-size: 24pt;
}
.welcome {
  height: 100%;
}
.custom-button {
  width: 147px;
  height: 30px;
  background: #303030;
  box-shadow: 0px 0px 5px #00000080;
  border-radius: 5px;
  padding: 5px 15px 5px 15px;
  border: none;
  color: #f0f1f3;
}
.help-text {
  color: #999;
  font-size: 12pt;
  font-weight: normal;
  margin: 0 auto;
}
.main-content {
  min-width: 100%;
  height: 100%;
  position: relative;
}
.wrapper {
  height: 100%;
}
.back-block-auth {
  width: 340px;
  height: 276px;
  border-radius: 5px;
  background: #f0f1f3;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  margin: auto;
  overflow: auto;
  box-shadow: 0px 0px 15px #00000080;
  border-radius: 5px;
  padding: 15px;
}
.footer {
  min-height: 375px;
  background: #dd5858;
}
.group {
  position: relative;
  margin-top: 25px;
}
input {
  font-size: 18px;
  padding: 10px 10px 10px 5px;
  display: block;
  width: 95%;
  border: none;
  border-bottom: 1px solid #757575;
}
input:focus {
  outline: none;
}
label {
  color: #999;
  font-size: 18px;
  font-weight: normal;
  position: absolute;
  pointer-events: none;
  left: 5px;
  top: 10px;
  transition: 0.2s ease all;
  -moz-transition: 0.2s ease all;
  -webkit-transition: 0.2s ease all;
}
input:focus ~ label,
input:valid ~ label {
  top: -20px;
  font-size: 14px;
  color: #303030;
}
.bar {
  position: relative;
  display: block;
  width: 99.2%;
}
.bar:before,
.bar:after {
  content: "";
  height: 2px;
  width: 0;
  bottom: 1px;
  position: absolute;
  background: #db5656;
  transition: 0.2s ease all;
  -moz-transition: 0.2s ease all;
  -webkit-transition: 0.2s ease all;
}
.bar:before {
  left: 50%;
}
.bar:after {
  right: 50%;
}
input:focus ~ .bar:before,
input:focus ~ .bar:after {
  width: 50%;
}
.highlight {
  position: absolute;
  height: 60%;
  width: 100px;
  top: 25%;
  left: 0;
  pointer-events: none;
  opacity: 0.5;
}
input:focus ~ .highlight {
  -webkit-animation: inputHighlighter 0.3s ease;
  -moz-animation: inputHighlighter 0.3s ease;
  animation: inputHighlighter 0.3s ease;
}
@-webkit-keyframes inputHighlighter {
  from {
    background: #303030;
  }
  to {
    width: 0;
    background: transparent;
  }
}
@-moz-keyframes inputHighlighter {
  from {
    background: #303030;
  }
  to {
    width: 0;
    background: transparent;
  }
}
@keyframes inputHighlighter {
  from {
    background: #303030;
  }
  to {
    width: 0;
    background: transparent;
  }
}
</style>

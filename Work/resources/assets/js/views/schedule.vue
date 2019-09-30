<template>
  <div class="wrapper">
    <div class="container-schedule">
      <div class="wrap-schedule">

        <nav class="nv-header" role="navigation">
          <div class="site-logo_up">
            <div class="site-logo">
              <a class="brand" href="https://ucmpt.ru/" title="Центр дополнительного образования РЭУ им. Г.В. Плеханова">
              <img src="https://ucmpt.ru/wp-content/uploads/2019/07/cropped-Logo-MPT.png" alt="Центр дополнительного образования РЭУ им. Г.В. Плеханова"></a>
            </div>
          </div>
        </nav>

        <main id="content" class="neve-main" role="main">
          <div class="container single-post-container">
            <h1 class="title entry-title">{{message}}Расписание занятий</h1>
          </div>

          <div class="container single-post-container">
            <nav class="nv-calendar" role="navigation">
              <div class="calendar-head">
                <div class="previous">
                  <a href="?date=2019-8&amp;t=full" rel="noindex, nofollow">
                    <span>&lt;</span>
                    <span class="month-name" style="display: inline;"> Август </span>
                  </a>
                </div>
                <div class="current-month">
                  <a href="?date=2018-9-24&amp;t=full" rel="noindex, nofollow">&lt;</a>
                  &nbsp;2019&nbsp;
                  <a href="?date=2020-9-24&amp;t=full" rel="noindex, nofollow">&gt;</a>
                  <div>Сентябрь</div>
                </div>
                <div class="next">
                  <a href="?date=2019-10-15&amp;t=full" rel="noindex, nofollow">
                    <span class="month-name" style="display: inline;"> Октябрь </span>
                    <span>&gt;</span>
                  </a>
                </div>
                <input type="hidden" class="ecwd_current_link" value="?date=2019-9-24&amp;t=full">
              </div>

              <div class="tabcontrol">
                <div class="filter-container" style="width: 640px;">                        
                  <ul>
                    <li v-bind:class="typeMonth" style="width: 162px; left: 0px;">
                      <a @click="onMonth">Месяц</a>
                    </li>
                    <li v-bind:class="typeList" style="width: 162px; left: 0px;">
                      <a href="?date=2019-9-24&amp;t=list" rel="noindex, nofollow" @click="onList">Список</a>
                    </li>
                    <li v-bind:class="typeWeek" style="width: 162px; left: 0px;">
                      <a href="?date=2019-8-26&amp;t=week" rel="noindex, nofollow" @click="onWeek">Неделя</a>
                    </li>
                    <li v-bind:class="typeDay" style="width: 162px; left: 0px;">
                      <a href="?date=2019-9-1&amp;t=day" rel="noindex, nofollow" @click="onDay">День</a>
                    </li>
                  </ul>
                </div>
                <div class="ecwd-search">
                  <input class="ecwd-search" name="search" type="text" value="день">
                  <button class="btn btn-default ecwd-search-submit">
                    <span class="glyphicon glyphicon-search"></span>
                    <i class="fa fa-search"></i>
                  </button>                
                </div>
              </div>
              import Schedule from '../views/schedule.vue'
              Email
            </nav>
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
export default {
  data() {
    return {
      message: 'Тест',
      typeMonth: 'type ecwd-selected-mode',
      typeList: 'type',
      typeWeek: 'type',
      typeDay: 'type',
      errors: {}
    };
  },
  methods: {
    onMonth() {
      this.errors = {};
      this.typeMonth = 'type ecwd-selected-mode';
      this.typeList = 'type';
      this.typeWeek = 'type';
      this.typeDay = 'type';
    },
    onList() {
      this.errors = {};
      this.typeMonth = 'type';
      this.typeList = 'type ecwd-selected-mode';
      this.typeWeek = 'type';
      this.typeDay = 'type';
    },
    onWeek() {
      this.errors = {};
      this.typeMonth = 'type';
      this.typeList = 'type';
      this.typeWeek = 'type ecwd-selected-mode';
      this.typeDay = 'type';
    },
    onDay() {
      this.errors = {};
      this.typeMonth = 'type';
      this.typeList = 'type';
      this.typeWeek = 'type';
      this.typeDay = 'type ecwd-selected-mode';
    }
  }
}
</script>

<style scoped>
/***General***/
* {
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
  text-decoration: none;
}

main {
    display: block;
}

/***Font***/

html, body, p, ol, ul, li, dl, dt, dd, blockquote, figure, fieldset, legend, textarea, pre, iframe, hr, h1, h2, h3, h4, h5, h6 {
    font-family: 'Akrobat-Regular'!important;
}

body {
  font-size: 16px;
}

h1 {
    display: block;
    font-size: 2em;
    font-weight: normal;
    line-height: 0px;
}

.ecwd_theme_calendar_grey .calendar-head .next a, .ecwd_theme_calendar_grey .calendar-head .previous a {
    font-size: 18px !important;
}
.ecwd_theme_calendar_grey .calendar-head .next a, .ecwd_theme_calendar_grey .calendar-head .previous a {
    color: #3f3f3f !important;
}
/***Header***/
.nv-header {
    background-color: #fff;
    border-bottom: 1px solid #f0f0f0;
    max-height: 100vh;
}

.container-schedule {
  width: 100%;
  height: 100%;
  padding: 15px;
  background: #ffffff;
}

.wrap-schedule {
  width: 100%;
  height: 100%;
  background: #fff;
  border-radius: 0px;
  overflow: hidden;
  position: relative;
  box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
}

.site-logo img {
    max-height: 80px;
    padding-top: 15px;
    padding-bottom: 5px;
    padding-left: 40px;
}

/***Calender***/
.nv-calendar {
    margin-top: 40px;
    padding-top: 0px;
    background-color: #fff;
    border: 1px solid #E5E5E5;
    max-height: 100vh;
}

.calendar_main .ecwd_calendar .ecwd_calendar_prev_next {
    text-align: center;
    z-index: 3;
    position: relative;
}

.calendar-head {
    background: #ffffff !important;
    border: 1px solid #E5E5E5;
}

.calendar-head {
    display: table;
    width: 100%;
    height: 85px;
}

/***C-head***/

table.cal_blue.mini .previous, .calendar_main .ecwd_calendar .previous {
    left: 0px;
}

table.cal_blue.mini .previous, table.cal_blue.mini .next, .calendar_main .ecwd_calendar .previous, .calendar_main .ecwd_calendar .next {
    float: none;
}

.calendar-head .previous {
    text-align: left;
    padding-left: 2%;
    border-right: 1px solid #E5E5E5 !important;
}
.calendar-head .previous, .calendar-head .next {
    color: #3f3f3f !important;
    width: 20%;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    display: table-cell;
    vertical-align: middle;
}

.calendar-head .current-month {
    color: #3f3f3f !important;
    border-left: 1px solid #E5E5E5 !important;
    border-right: 1px solid #E5E5E5 !important;
    font-size: 26px !important;

    line-height: 1.5;
    text-align: center;
    width: 60%;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    display: table-cell;
    vertical-align: middle;
}

table.cal_blue.mini .next, .calendar_main .ecwd_calendar .next {
    right: 0px;
}
table.cal_blue.mini .previous, table.cal_blue.mini .next, .calendar_main .ecwd_calendar .previous, .calendar_main .ecwd_calendar .next {
    float: none;
}
.calendar-head .next {
    text-align: right;
    padding-right: 2%;
}
.calendar-head .previous, .calendar-head .next {
    width: 20%;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    display: table-cell;
    vertical-align: middle;
}

.calendar-head .current-month a {
    color: #3f3f3f !important;
    font-size: 24px;
    font-family: 'Akrobat-Regular'!important;
}

.calendar-head .previous a, .calendar-head .next a {
    color: #3f3f3f !important;
    font-size: 18px;
    font-family: 'Akrobat-Regular'!important;
}

.calendar-head .current-month div {
    font-size: 18px !important;
    line-height: 18px !important;
    font-family: 'Akrobat-Regular'!important;
}

/***Calendar TabControl***/

.tabcontrol {
    position: relative;
}

ul {
    display: block;
    list-style-type: disc;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 40px;
}

.tabcontrol ul li, .tabcontrol ol li {
    line-height: 2em;
    margin-bottom: 10px;
}

.tabcontrol ul li {
    display: inline-block;
    width: 150px;
    text-align: center;
}

.tabcontrol .filter-container ul li a, .tabcontrol .filter-arrow-right, .tabcontrol .filter-container ul li, .tabcontrol .filter-arrow-left {
    color: #555555 !important;
    border-left: 1px solid #ffffff !important;
    border-right: 1px solid #ffffff !important;
    background-color: #f5f5f5 !important;
}

.tabcontrol .filter-container ul {
    list-style: outside none none !important;
    padding: 0px !important;
    margin: 0px !important;
    overflow: hidden;
    position: relative;
    float: left;
    width: 700%;
}

.tabcontrol ul li a {
    display: block;
    padding: 13.5px 0px;
    text-decoration: none;
    font-size: 16px;
    line-height: 22px;
}

.tabcontrol ul li.ecwd-selected-mode a {
    color: #555555 !important;
}

.tabcontrol ul li.ecwd-selected-mode a {
    background-color: #ffffff !important;
}

element.style {
    width: 162px;
    left: 0px;
}

/***Calendar Month***/



/***Main***/
.neve-main {
    margin-top: 0px!important;
    margin-bottom: 75px!important;
}

html {
    font-size: 100%;
    overflow-x: hidden;
    -webkit-tap-highlight-color: transparent;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

.col {
    flex-basis: 0;
    flex-grow: 1;
    max-width: 100%;
    margin-left: auto;
    margin-right: auto;
}

.single-post-container  {
    margin-top: 30px;
}
</style>
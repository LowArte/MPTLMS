<template lang="pug">
    v-card.pb-2(v-if="timetable")
        v-system-bar
          span {{days[(new Date()).getDay()]}} • Сегодня
        div.ma-2(v-if="new Date().getDay() != 0")
            div(v-if="!isChisl")
                div.ma-0.pa-0(v-for="(item, index) in timetable" :key="index")
                    div(v-if="item.GroupChisl.length > 0")
                        v-card.my-1(outlined)
                            v-system-bar(color="alizarin lighten-5")
                                span() Числитель - Пара №{{index}}
                            v-chip.ma-2(label x-small color="grey lighten-5") {{item.PlaceChisl[0]}}
                            v-card-title.py-1.pb-0.subtitle-1 {{item.TimeChisl[0]}} {{item.Classroom[0] ? '| ' + item.Classroom[0] : '| НУ'}}
                            v-card-text.py-0 Группа: {{item.GroupChisl[0]}}
                            v-card-text.py-0 {{item.LessonChisl[0]}}
                            v-divider.mt-1
                            v-expansion-panels(v-if="item.GroupZnam.length > 0" flat)
                                v-expansion-panel
                                    v-expansion-panel-header Знаменатель
                                    v-expansion-panel-content
                                        v-card.my-1(outlined)
                                            v-system-bar(color="cobalt lighten-5")
                                                span Знаменатель - Пара №{{index}}
                                            v-chip.ma-2(label x-small color="grey lighten-5") {{item.PlaceZnam[0]}}
                                            v-card-title.py-1.pb-0.subtitle-1 {{item.TimeZnam[0]}} {{item.Classroom[0] ? '| ' + item.Classroom[0] : '| НУ'}}
                                            v-card-text.py-0 Группа: {{item.GroupZnam[0]}}
                                            v-card-text.py-0 {{item.LessonZnam[0]}}
            div(v-else)
                div.ma-0.pa-0(v-for="(item, index) in timetable" :key="index")
                    div(v-if="item.GroupZnam.length > 0")
                        v-card.my-1(outlined)
                            v-system-bar(color="cobalt lighten-5")
                                span Знаменатель - Пара №{{index}}
                            v-chip.ma-2(label x-small color="grey lighten-5") {{item.PlaceZnam[0]}}
                            v-card-title.py-1.pb-0.subtitle-1 {{item.TimeZnam[0]}} {{item.Classroom[0] ? '| ' + item.Classroom[0] : '| НУ'}}
                            v-card-text.py-0 Группа: {{item.GroupZnam[0]}}
                            v-card-text.py-0 {{item.LessonZnam[0]}}
                            v-divider.mt-1
                            v-expansion-panels(v-if="item.GroupChisl.length > 0" flat)
                                v-expansion-panel
                                    v-expansion-panel-header Числитель
                                    v-expansion-panel-content.pa-2
                                        v-card.my-1(outlined)
                                            v-system-bar(color="alizarin lighten-5")
                                                span Числитель - Пара №{{index}}
                                            v-chip.ma-2(label x-small color="grey lighten-5") {{item.PlaceChisl[0]}}
                                            v-card-title.py-1.pb-0.subtitle-1 {{item.TimeChisl[0]}} {{item.Classroom[0] ? '| ' + item.Classroom[0] : '| НУ'}}
                                            v-card-text.py-0 Группа: {{item.GroupChisl[0]}}
                                            v-card-text.py-0 {{item.LessonChisl[0]}}
                                
        div(v-else)
            v-alert(type="warning" elevation="3") Внимание: сегодня выходной день - рассписание не было найдено. Чтобы посмотреть своё рассписание перейдите в решим "неделя", где будут отображены ваши учебные занятий.

</template>

<script>
export default {
  data() {
    return {
      timetable: null,
      days: [
        "Воскресенье",
        "Понедельник",
        "Вторник",
        "Среда",
        "Четверг",
        "Пятница",
        "Суббота"
      ]
    };
  },
  computed: {
    isChisl: function() {
      var year = new Date().getFullYear();
      var month = new Date().getMonth();
      var today = new Date(year, month, 0).getTime();
      var now = new Date().getTime();
      var week = Math.round((now - today) / (1000 * 60 * 60 * 24 * 7));
      return week % 2;
    },

    isColor: function() {
      return this.isChisl ? "cobalt" : "alizarin";
    }
  },
  props: {
    _items: {
      type: null,
      default: null
    }
  },
  mounted() {
    this.timetable = this._items;
  }
};
</script>
<template lang="pug">
    v-layout.column.wrap
        v-chip.mx-2(v-if="isToday != 0" label color="accent") Знаменатель
        v-chip.mx-2(v-if="isToday == 0" label color="info") Числитель
        v-layout.row.wrap
            v-flex.ma-2
                v-card.mx-auto(min-width="300")
                    v-system-bar
                        small Фильтрация
                    v-combobox.ma-3(label="Специальность")
                    v-combobox.ma-3(label="Группа")
                    v-switch.shrink.ma-3(color="primary" label="Отобразить с заменами")
            v-flex.ma-2
                v-card.mx-auto(min-width="300")
                    v-system-bar
                        small Дополнительные панели
                    v-switch.shrink.ma-3(color="primary" label="Изменения в расписании")
                    v-switch.shrink.ma-3(color="primary" label="Расписание экзаменов")
        v-layout.row.wrap
            v-flex.ma-2
                v-card.mx-auto(min-width="265px" max-width="265px" style="display: flex; flex-direction: column;")
                    v-system-bar
                        span Понедельник
                    v-chip.ma-3(label) Территория 
                    v-divider
                    v-list(subheader three-line)
                        v-list-item.mt-2
                            v-list-item-content.pa-0
                                span Компьютерное делопроизводство
                                v-list-item-subtitle Преподаватель / Преподаватель / Преподаватель
                    
</template>

<script>
Date.prototype.getWeek = function() {
  const onejan = new Date(this.getFullYear(), 0, 1);
  return Math.ceil(((this - onejan) / 86400000 + 1) / 7);
};

export default {
  data: () => ({
    isToday: null
  }),
  methods: {
    isChisl() {
      var today = new Date(new Date().getTime() + 8 * (24 * 60 * 60 * 1000));
      return today.getWeek() % 2;
    }
  },
  beforeMount() {
    this.isToday = this.isChisl();
  }
};
</script>
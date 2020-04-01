<template lang="pug">
    v-layout.column.wrap
        v-chip.mx-2(v-if="isToday != 0" label color="accent") Знаменатель
        v-chip.mx-2(v-if="isToday == 0" label color="info") Числитель
        v-layout.row.wrap
            v-flex.ma-2
                v-card.mx-auto(min-width="300")
                    v-system-bar
                        span Фильтрация
                    v-combobox.ma-3(label="Специальность")
                    v-combobox.ma-3(label="Группа")
                    v-switch.shrink.ma-3(color="primary" label="Отобразить с заменами")
            v-flex.ma-2
                v-card.mx-auto(min-width="300")
                    v-system-bar
                        span Дополнительные панели
                    v-switch.shrink.ma-3(color="primary" label="Изменения в расписании")
                    v-switch.shrink.ma-3(color="primary" label="Расписание экзаменов")
        v-layout.row.wrap
            v-flex.ma-2
                v-card.mx-auto(min-width="320px" max-width="320px" style="display: flex; flex-direction: column;")
                    v-system-bar
                        span Понедельник
                    v-chip.ma-3(label) Территория 
                    v-divider
                    v-list(subheader three-line)
                        v-list-item.mt-2(v-if="!item.zamena")
                            v-list-item-content.pa-0
                                span Компьютерное делопроизводство
                                v-list-item-subtitle(small) Преподаватель / Преподаватель / Преподаватель

                    
</template>

<script>
Date.prototype.getWeek = function() {
  const onejan = new Date(this.getFullYear(), 0, 1);
  return Math.ceil(((this - onejan) / 86400000 + 1) / 7);
};

export default {
  data: () => ({
    isToday: null,
    groups_info: { groups: null, selected_group: null }, //Группы
    departaments_info: { departaments: null, selected_departament: null }, //Отделения
    schedule: null, //Расписание
    titleDialog: "Конструктор расписания",
    dialog: false,
    places: null,
    days: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"] //Дни недели
  }),
  methods: {
    isChisl() {
      var today = new Date(new Date().getTime() + 8 * (24 * 60 * 60 * 1000));
      return today.getWeek() % 2;
    },
    getCallScheduleForPanel() {
      callSchedule_api
        .getCallScheduleForPanel()
        .then(res => {
          this.$refs.panel.loadData(res.data.panel_array);
        })
        .catch(ex => {
          this.showError(
            "Ошибка инициализации раписания звонков. Причина: " + ex
          );
        });
    },
    getPlaces() {
      places_api
        .getPlaces()
        .then(res => {
          this.places = res.data.places;
        })
        .catch(ex => {
          this.showError(ex);
        });
    },
    getDepartament() {
      departament_api
        .getDepartmentsForCombobox()
        .then(res => {
          this.departaments_info.departaments = res.data.departaments;
          this.departaments_info.selected_departament = this.departaments_info.departaments[0];
          this.departament_change();
        })
        .catch(ex => {
          this.showError(ex);
        });
    },
    departament_change() {
      group_api
        .getGroupsByDepartamentId(
          this.departaments_info.selected_departament.id
        )
        .then(res => {
          this.groups_info.groups = res.data.groups_info.groups;
          this.groups_info.selected_group = this.groups_info.groups[0];
          this.group_change();
        })
        .catch(ex => {
          this.showError(ex);
        });
    }
  },
  beforeMount() {
    this.isToday = this.isChisl();
  }
};
</script>
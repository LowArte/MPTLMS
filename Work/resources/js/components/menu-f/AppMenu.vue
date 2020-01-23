<template lang='pug'>
    v-list(dense)
        template(v-for="(item, i) in items" )
            v-layout( row v-if="item.heading" :key="i" align-center)
                v-flex( xs10 )
                    v-subheader(v-if="item.heading") {{item.heading}}
            v-list-group(v-else-if="item.children"  :prepend-icon='item.icon' v-model="item.model")
                template(v-slot:activator)
                    v-list-item-title {{item.text}}
                v-list-item(v-for="(child, i) in item.children" :key="'c'+i" @click="menuItemSelected(child)")
                    v-list-item-action(v-if="child.icon")
                        v-icon {{ child.icon }}
                    v-list-item-content
                        v-list-item-title.pl-4 {{ child.text }}
            v-list-item(v-else @click="menuItemSelected(item)")      
                v-list-item-action
                    v-icon {{ item.icon }}
                v-list-item-content
                    v-list-item-title {{item.text}}
</template>

<script>
export default {
  data: () => {
    return {
      items: []
    };
  },
  props: {
    _role: {
      type: String,
      default: null
    }
  },
  mounted() {
    switch (this._role) {
      case "admin": {
        //Администраторы
        return (this.items = [
          {
            icon: "home",
            text: "Главная",
            href: "/admin/home"
          },
          {
            icon: "settings_brightness",
            text: "Панель управления",
            children: [
              {
                text: "Настройки сервера",
                href: "/admin/panel_control",
                icon: "settings_applications"
              }
            ]
          },
          {
            icon: "assignment",
            text: "Расписания",
            children: [
              {
                text: "Расписание",
                href: "/admin/timetable",
                icon: "today"
              },
              {
                text: "Изменения в расписании",
                href: "/admin/replacements",
                icon: "autorenew"
              },
              {
                text: "Расписание звонков",
                href: "/admin/callschedule",
                icon: "alarm"
              }
            ]
          },
          {
            icon: 'sd_storage',
            text: "Управление данными",
            children: [
              {
                text: "Управление пользователями",
                href: "/admin/user_managment",
                icon: "account_box"
              },
              {
                text: "Отделения",
                href: "/admin/department_managment",
                icon: "table_chart"
              },
              {
                text: "Группы",
                href: "/admin/group_managment",
                icon: "people_alt"
              },
              {
                text: "Места проведения",
                href: "/admin/place_managment",
                icon: "apartment"
              },
              {
                text: "Дополнительное образование",
                href: "/admin/retraining_managment",
                icon: "add_to_queue"
              },
              {
                text: "Роли",
                href: "/admin/post_managment",
                icon: "event_seat"
              }
              /*               ,
              {
                text: "Управление файлами",
                href: "/admin/file_management",
                icon: "insert_drive_file"
              } */
            ]
          },
          {
            icon: "feedback",
            text: "Обращение пользователей",
            href: "/admin/requestsusers"
          }
        ]);
      }
      case "student": {
        //Студент
        return (this.items = [
          {
            icon: "home",
            text: "Главная",
            href: "/student/home"
          },
          {
            icon: "portrait",
            text: "Профиль",
            href: "/student/bio"
          },
          {
            text: "Учебные процесс",
            icon: "school",
            children: [
              {
                icon: "",
                text: "Расписание",
                href: "/student/timetable"
              },
              {
                icon: "",
                text: "Изменеия в расписание",
                href: "/student/changes"
              },
              {
                icon: "",
                text: "Расписание экзаменов",
                href: "/student/exams"
              },
              {
                icon: "",
                text: "Домашнее задание",
                href: "/student/homework"
              },
              {
                icon: "",
                text: "Успеваемость",
                href: "/student/progress"
              },
              {
                icon: "",
                text: "Преподаватели",
                href: "/student/teachers"
              }
            ]
          },
          {
            text: "ДО",
            icon: "business_center",
            children: [
              {
                icon: "",
                text: "Программы",
                href: "/student/blueprints"
              },
              {
                icon: "",
                text: "Автошкола",
                href: "/student/drivingschool"
              }
            ]
          },
          {
            text: "Услуги",
            icon: "beenhere",
            children: [
              {
                icon: "",
                text: "Справки и направления",
                href: "/student/certificate"
              },
              {
                icon: "",
                text: "Стипендия",
                href: "/student/petition"
              },
              {
                icon: "",
                text: "Психолог",
                href: "/student/psych"
              }
            ]
          },
          {
            text: "Студенческая жизнь",
            icon: "palette",
            children: [
              {
                icon: "",
                text: "Фотоархив",
                href: "/student/photos"
              },
              {
                icon: "",
                text: "Соревнования и чемпионаты",
                href: "/student/competitions"
              },
              {
                icon: "",
                text: "Спортивная жизнь",
                href: "/student/sportlife"
              }
            ]
          },
          {
            icon: "cloud",
            text: "Хранилище данных",
            href: "/student/datastorage"
          },
          {
            icon: "layers",
            text: "Базы практики",
            href: "/student/plants"
          },
          {
            icon: "group",
            text: "Студенческий совет",
            href: "/student/convocation"
          },
          {
            icon: "feedback",
            text: "Обратная связь",
            href: "/student/feedback"
          }
        ]);
      }
      case 3: {
        //Преподы
        return (this.items = [
          {
            icon: "home",
            text: "Главная",
            href: "/home"
          },
          {
            icon: "today",
            text: "Расписание",
            href: "/timetable"
          },
          // {
          //   icon: 'home',
          //   text: 'Домашнее задание',
          //   href: '/teacherhomework'
          // },
          /*{
              icon: 'layers',
              text: 'Ведомости',
              href: '/home'
            },*/
          // {
          //   icon: 'home',
          //   text: 'Электронный журнал',
          //   href: '/teacheracademicperfomance'
          // },
          {
            icon: "feedback",
            text: "Обратная связь",
            href: "/feedback"
          }
        ]);
      }
      case 4: {
        //Учебная часть (manager)
        return (this.items = [
          {
            icon: "home",
            text: "Главная",
            href: "/home"
          },
          {
            icon: "home",
            text: "Расписание",
            href: "/timetable"
          },
          {
            icon: "find_replace",
            text: "Замены",
            href: "/replacements"
          },
          {
            icon: "feedback",
            text: "Обратная связь",
            href: "/feedback"
          }
        ]);
      }
      case 5: {
        //Лапшина (Канцелярия)
        return (this.items = [
          {
            icon: "home",
            text: "Главная",
            href: "/home"
          },
          {
            icon: "home",
            text: "Заказ справок",
            href: "/listcertificate"
          },
          {
            icon: "feedback",
            text: "Обратная связь",
            href: "/feedback"
          }
        ]);
      }
      default: {
        return null;
      }
    }
  },
  methods: {
    menuItemSelected(item) {
      console.log(item.href);
      if (item.href) {
        if (item.new) {
          window.open(item.href);
        } else {
          window.location.href = item.href;
        }
      }
    }
  }
};
</script>
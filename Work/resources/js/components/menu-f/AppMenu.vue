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
                        v-list-item-title {{ child.text }}
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
            text: "Панель управления",
            icon: "",
            children: [
              {
                text: "Настройки сервера",
                href: "/admin/panel_control",
                icon: "build"
              },
              {
                text: "Управление пользователями",
                href: "/admin/user_managment",
                icon: "accessible"
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
            text: "Рассписания",
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
            href: "/home"
          },
          {
            icon: "portrait",
            text: "Студенческая карточка",
            href: "/card"
          },
          {
            text: "Учебные процесс",
            children: [
              {
                icon: "today",
                text: "Расписание",
                href: "/certificate"
              },
              {
                icon: "autorenew",
                text: "Изменеия в расписание",
                href: "/detailedir"
              },
              {
                icon: "",
                text: "Расписание экзаменов",
                href: "/detailedir"
              },
              {
                icon: "",
                text: "Домашнее задание",
                href: "/detailedir"
              },
              {
                icon: "show_chart",
                text: "Успеваемость",
                href: "/home"
              },
              {
                icon: "school",
                text: "Преподаватели",
                href: "/home"
              },
              {
                icon: "",
                text: "Тесты по дисциплинам",
                href: "/home"
              }
            ]
          },
          {
            text: "Дополнительное образование",
            children: [
              {
                icon: "business_center",
                text: "Доступные программы",
                href: "/detailedir"
              },
              {
                icon: "",
                text: "Текущие программы ДО",
                href: "/certificate"
              },
              {
                icon: "",
                text: "Автошкола",
                href: "/drivingschool"
              }
            ]
          },
          {
            text: "Услуги",
            children: [
              {
                icon: "edit",
                text: "Справки и направления",
                href: "/certificate"
              },
              {
                icon: "",
                text: "Стипендия",
                href: "/certificate"
              },
              {
                icon: "favorite",
                text: "Психолог",
                href: "/certificate"
              }
            ]
          },
          {
            icon: "storefront",
            text: "Портфолио",
            href: "/home"
          },
          {
            icon: "",
            text: "Личный репозиторий",
            href: "/home"
          },
          {
            icon: "layers",
            text: "Базы практики",
            href: "/home"
          },
          {
            icon: "",
            text: "Студенческий совет",
            href: "/home"
          },
          {
            text: "Студенческая жизнь",
            children: [
              {
                icon: "",
                text: "Фотоархив",
                href: "/certificate"
              },
              {
                icon: "",
                text: "Соревнования и чемпионаты",
                href: "/certificate"
              },
              {
                icon: "",
                text: "Спортивная жизнь",
                href: "/certificate"
              }
            ]
          },
          {
            icon: "feedback",
            text: "Обратная связь",
            href: "/feedback"
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
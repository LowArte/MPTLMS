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
            icon: "edit",
            children: [
              {
                text: "Настройки сервера",
                href: "/admin/panel_control",
                icon: "settings"
              },
              {
                icon: "edit",
                text: "Управление пользователями",
                href: "/admin/user_managment"
              },
              {
                icon: "edit",
                text: "Управление файлами",
                href: "/admin/file_management"
              }
            ]
          },
          {
            text: "Панель рассписания",
            icon: "today",
            children: [
              {
                icon: "today",
                text: "Расписание",
                href: "/admin/timetable"
              },
              {
                icon: "find_replace",
                text: "Замены",
                href: "/admin/replacements"
              },
              {
                icon: "today",
                text: "Расписание звонков",
                href: "/admin/callschedule"
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
            icon: "today",
            text: "Расписание",
            href: "/timetable"
          },
          {
            icon: "autorenew",
            text: "Изменения в расписании",
            href: "/replaces"
          },
          /* 
            {
              icon: 'show_chart',
              text: 'Успеваемость',
              href: '/home'
            }, */
          // {
          //   icon: 'business_center',
          //   text: 'Дополнительное образование',
          //   href: '/detailedir'
          // },
          /*
                     {
                       icon: 'school',
                       text: 'Преподаватели',
                       href: '/home'
                     }, */
          {
            icon: "edit",
            text: "Справки",
            href: "/certificate"
          },
          /* 
                      {
                        icon: 'home',
                        text: 'Домашнее задание',
                        href: '/home'
                      }, */
          /*{
              icon: 'storefront',
              text: 'Портфолио',
              href: '/home'
            }, {
              icon: 'layers',
              text: 'Базы практики',
              href: '/home'
            },*/
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
          {
            icon: "today",
            text: "Расписание звонков",
            href: "/callschedule"
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
        //Учебная часть
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
      console.log(item.href)
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
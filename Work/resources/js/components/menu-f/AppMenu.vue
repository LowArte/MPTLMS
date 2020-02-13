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
    },
    _disabled: {
      type: String,
      default: "0"
    }
  },
  mounted() {
    if (this._disabled == 1) {
      switch (this._role) {
        case "admin": {
          //Администраторы
          return (this.items = [
            {
              icon: "home",
              text: "Главная",
              href: "/admin/home"
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
              icon: "feedback",
              text: "Обратная связь",
              href: "/student/feedback"
            }
          ]);
        }
        case "teacher": {
          //Преподы
          return (this.items = [
            {
              icon: "home",
              text: "Главная",
              href: "/home"
            },
            {
              icon: "feedback",
              text: "Обратная связь",
              href: "/feedback"
            }
          ]);
        }
        case "unit": {
          //Учебная часть (unit)
          return (this.items = [
            {
              icon: "home",
              text: "Главная",
              href: "/home"
            },
            {
              icon: "feedback",
              text: "Обратная связь",
              href: "/feedback"
            }
          ]);
        }
        case "chancellery": {
          //Лапшина (Канцелярия)
          return (this.items = [
            {
              icon: "home",
              text: "Главная",
              href: "/home"
            },
            {
              icon: "feedback",
              text: "Обратная связь",
              href: "/chancellery/feedback"
            }
          ]);
        }
        default: {
          return null;
        }
      }
    } else
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
                  icon: ""
                }
              ]
            },
            {
              icon: "assignment",
              text: "Расписания",
              children: [
                {
                  text: "Учебное расписание",
                  href: "/admin/timetable",
                  icon: ""
                },
                {
                  text: "Изменения в расписании",
                  href: "/admin/replacements",
                  icon: ""
                },
                {
                  text: "Расписание звонков",
                  href: "/admin/callschedule",
                  icon: ""
                }
              ]
            },
            {
              icon: "sd_storage",
              text: "CRUD",
              children: [
                {
                  text: "Пользователи",
                  href: "/admin/user-crud",
                  icon: ""
                },
                {
                  text: "Отделения",
                  href: "/admin/department-crud",
                  icon: ""
                },
                {
                  text: "Группы",
                  href: "/admin/group-crud",
                  icon: ""
                },
                {
                  text: "Места проведения",
                  href: "/admin/place-crud",
                  icon: ""
                },
                {
                  text: "ДО",
                  href: "/admin/retraining-crud",
                  icon: ""
                },
                {
                  text: "Роли",
                  href: "/admin/post-crud",
                  icon: ""
                },
                {
                  text: "Управление файлами",
                  href: "/admin/file-crud",
                  icon: ""
                }
              ]
            },
            {
              icon: "feedback",
              text: "Обращение пользователей",
              href: "/admin/request_users"
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
              icon: "whatshot",
              text: "Новости",
              href: "/student/news"
            },
            {
              icon: "portrait",
              text: "Профиль",
              href: "/student/account"
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
                  href: "/student/replacements"
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
                  text: "Справки и характеристики",
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
        case "teacher": {
          //Преподы
          return (this.items = [
            {
              icon: "home",
              text: "Главная",
              href: "/teacher/home"
            },
            {
              icon: "feedback",
              text: "Обратная связь",
              href: "/teacher/feedback"
            }
          ]);
        }
        case "unit": {
          //Учебная часть (manager)
          return (this.items = [
            {
              icon: "home",
              text: "Главная",
              href: "/unit/home"
            },
            {
              icon: "feedback",
              text: "Обратная связь",
              href: "/unit/feedback"
            }
          ]);
        }
        case "chancellery": {
          //Лапшина (Канцелярия)
          return (this.items = [
            {
              icon: "home",
              text: "Главная",
              href: "/chancellery/home"
            },
            {
              icon: "home",
              text: "Заказ справок",
              href: "/chancellery/listcertificate"
            },
            {
              icon: "feedback",
              text: "Обратная связь",
              href: "/chancellery/feedback"
            }
          ]);
        }
        case "nullfunc": {
          //Ограниченный функционал
          return (this.items = [
            {
              icon: "home",
              text: "Главная",
              href: "/nullfunc/home"
            },
            {
              icon: "feedback",
              text: "Обратная связь",
              href: "/nullfunc/feedback"
            }
          ]);
        }
        case "editor": {
          //Редактор новостей
          return (this.items = [
            {
              icon: "home",
              text: "Главная",
              href: "/editor/home"
            },
            {
              icon: "whatshot",
              text: "Новости",
              href: "/editor/news"
            },
            {
              icon: "feedback",
              text: "Обратная связь",
              href: "/editor/feedback"
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
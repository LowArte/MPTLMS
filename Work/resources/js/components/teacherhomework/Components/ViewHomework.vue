<template lang="pug">
  v-container(fluid)
        v-row(align="center")
          v-col
            v-hover.pa-5(v-slot:default="{ hover }")
              v-card.mx-auto(:elevation="hover ? 12 : 2" height="auto" width="max")
                v-card-text.my-1.ma-0.pt-2.pb-2.text-center.title Домашние задания
                v-container.pa-0.pb-2(fluid)
                  v-row.pa-3(column  )
                    v-select.mr-5.ml-5(v-model="group" :items="itemsg" label="Группа" solo)
                    v-select.mr-5.ml-5(v-model="lesson" :items="lessons" label="Дисциплина" solo)
                  v-divider.ma-0
                  v-expansion-panels
                    v-expansion-panel(v-for="(item,i) in hw" :key="i")
                      v-expansion-panel(v-if="((item.lesson == lesson || lesson == 'Все дисциплины')&&(item.group == group || group == 'Все группы'))")
                        v-expansion-panel-header
                          v-row
                            v-card-text.my-1.ma-0.pa-0.text {{item.group}}
                            v-card-text.my-1.ma-0.pa-0.text {{item.lesson}}
                            v-card-text.my-1.ma-0.pa-0.text Дата выдачи: {{item.datestart}}
                            v-card-text.my-1.ma-0.pa-0.text(v-if="item.dateend != ''") Крайний срок сдачи: {{item.dateend}}
                            v-card-text.my-1.ma-0.pa-0.text(v-if="item.answer == true") Требуется отправить преподователю файлы
                        v-divider.ma-0
                        v-expansion-panel-content
                          v-row.my-1.ma-0.pa-0.text
                            v-btn.white--text.ma-2(color="blue" depressed="") Редактировать
                            v-btn.white--text.ma-2(color="blue" depressed="") Удалить
                          v-row.pa-2 Название: {{item.name}}
                          v-row.pa-2 Описание: {{item.body}}
                          div(v-if="item.files.length > 0")
                            v-row.pa-2 Есть приложенные файлы!
                            div(v-for="(item2,i2) in item.files" :key="i2")
                              v-row.pa-2 
                                v-btn(text small) Файл {{i2+1}}: {{item2.name}}
                            v-row.pa-2(v-if="item.files.length > 1")
                              v-btn.white--text(color="blue" depressed="") Скачать все файлы
                          div(v-if="item.answer == true")
                            v-divider.ma-2
                            v-card-text.my-1.ma-0.pt-2.pb-2.text-center.title Ответы студентов
                            v-expansion-panels.ma-0
                              v-expansion-panel(v-for="(item3,i3) in studanswer" :key="i3")
                                v-expansion-panel(v-if="item3.id == item.id")
                                  v-expansion-panel-header
                                    v-row
                                      v-card-text.my-1.ma-0.pa-0.text Студент: {{item3.studlogin}}
                                      v-card-text.my-1.ma-0.pa-0.text Фио: {{item3.studFIO}}
                                  v-divider.ma-0
                                  v-expansion-panel-content
                                    v-row.pa-2 Есть приложенные файлы!
                                    div(v-for="(item4,i4) in item3.files" :key="i4")
                                      v-row.pa-2 
                                        v-btn(text small) Файл {{i4+1}}: {{item4.name}}
                                      v-row.pa-2
                                        v-btn.white--text(color="blue" depressed="") Скачать файл
                                    v-row.pa-2(v-if="item3.files.length > 1")
                                      v-btn.white--text(color="blue" depressed="") Скачать все файлы   

</template>

<script>
export default {
  data: () => ({
    hw: [
      {
        id: "П-2-16_2019-10-10_ТРПО_1",
        lesson: "Технология разработки программного обеспечения",
        teacher: "Шимбирёв Андрей Андреевич",
        group: "П-2-16",
        name: "Подготовка к опросу",
        body: "Опрос по лекции 5",
        datestart: "2019-10-10",
        dateend: "2019-12-10",
        answer: true,
        files: [
          { name: "Файл1", file: "Файл1" },
          { name: "Файл2", file: "Файл2" }
        ]
      },
      {
        id: "П-1-16_2019-10-10_ОП_1",
        lesson: "Основы программирования",
        teacher: "Шимбирёв Андрей Андреевич",
        group: "П-1-16",
        name: "Подготовка к опросу",
        body: "Опрос по лекции 5",
        datestart: "2019-10-10",
        dateend: "2019-12-10",
        answer: true,
        files: [
          { name: "Файл1", file: "Файл1" },
          { name: "Файл2", file: "Файл2" }
        ]
      },
      {
        id: "П-2-16_2019-10-10_ОС_1",
        lesson: "Операционные системы",
        teacher: "Горбунов Антон Дмитриевич",
        group: "П-2-16",
        name: "Практическая работа 1",
        body: "Установка Windows 7 на Virtual Box",
        datestart: "2019-10-10",
        dateend: "",
        answer: false,
        files: []
      }
    ],

    studanswer: [
      {
        id: "П-2-16_2019-10-10_ТРПО_1",
        studlogin: "p_a.i.borisov@mpt.ru",
        studFIO: "Борисов Артём Игоревич",
        files: [
          { name: "Файл1", file: "Файл1" },
          { name: "Файл2", file: "Файл2" }
        ]
      },
      {
        id: "П-2-16_2019-10-10_ТРПО_1",
        studlogin: "p_a.i.borisov@mpt.ru",
        studFIO: "Борисов Артём Игоревич",
        files: [
          { name: "Файл1", file: "Файл1" },
          { name: "Файл2", file: "Файл2" }
        ]
      },
      {
        id: "П-1-16_2019-10-10_ОП_1",
        studlogin: "p_a.i.borisov@mpt.ru",
        studFIO: "Борисов Артём Игоревич",
        files: [
          { name: "Файл1", file: "Файл1" },
          { name: "Файл2", file: "Файл2" }
        ]
      }
    ],

    itemsg: ["Все группы", "П-1-16", "П-2-16", "П-3-16", "П-4-16"],
    group: "П-2-16",

    lesson: "Все дисциплины",
    lessons: [
      "Все дисциплины",
      "Технология разработки программного обеспечения",
      "Операционные системы",
      "Основы программирования"
    ],
    loadfiles: [],
    datestart: new Date().toISOString().substr(0, 10),
    modal: false
  })
};
</script>
<template>
  <v-container fluid>
    <v-row align="center">
      <v-col>
        <v-hover v-slot:default="{ hover }" class="pa-5">
          <v-card :elevation="hover ? 12 : 2" class="mx-auto" height="auto" width="max">
            <v-card-text class="my-1 ma-0 pt-2 pb-2 text-center title">Домашние задания</v-card-text>
            <v-container class="pa-0 pb-2" fluid>
              <v-row class="pa-3">
                <v-text-field v-model="TFIO" label="Преподаватель" readonly></v-text-field>
              </v-row>
              <v-row class="pa-2 mb-0 pb-0">
                <v-select v-model="group" :items="itemsg" label="Группа" solo></v-select>
              </v-row>
              <v-row class="pa-2 mb-0 pt-0 pb-0">
                <v-select v-model="lesson" :items="lessons" label="Дисциплина" solo></v-select>
              </v-row>
              <v-divider class="ma-0"></v-divider>
              <v-expansion-panels>
                <v-expansion-panel v-for="(item,i) in hw" :key="i">
                  <v-expansion-panel
                    v-if="((item.lesson == lesson || lesson == 'Все дисциплины')&&(item.group == group || group == 'Все группы')) && item.teacher == TFIO"
                  >
                    <v-expansion-panel-header>
                      <v-row>
                        <v-card-text class="my-1 ma-0 pa-0 text">{{item.group}}</v-card-text>
                        <v-card-text class="my-1 ma-0 pa-0 text">{{item.lesson}}</v-card-text>
                        <v-card-text class="my-1 ma-0 pa-0 text">Дата выдачи: {{item.datestart}}</v-card-text>
                        <v-card-text
                          v-if="item.dateend != ''"
                          class="my-1 ma-0 pa-0 text"
                        >Крайний срок сдачи: {{item.dateend}}</v-card-text>
                        <v-card-text
                          v-if="item.answer == true"
                          class="my-1 ma-0 pa-0 text"
                        >Требуется отправить преподователю файлы</v-card-text>
                      </v-row>
                    </v-expansion-panel-header>
                    <v-divider class="ma-0"></v-divider>
                    <v-expansion-panel-content>
                      <v-row class="my-1 ma-0 pa-0 text">
                        <v-btn class="white--text ma-2" color="blue" depressed>Редактировать</v-btn>
                        <v-btn class="white--text ma-2" color="blue" depressed>Удалить</v-btn>
                      </v-row>
                      <v-row class="pa-2">Название: {{item.name}}</v-row>
                      <v-row class="pa-2">Описание: {{item.body}}</v-row>
                      <div v-if="item.files.length > 0">
                        <v-row class="pa-2">Есть приложенные файлы!</v-row>
                        <div v-for="(item2,i2) in item.files" :key="i2">
                          <v-row class="pa-2">Файл {{i2+1}}: {{item2.name}}</v-row>
                          <v-row class="pa-2">
                            <v-btn class="white--text" color="blue" depressed>Скачать файл</v-btn>
                          </v-row>
                        </div>
                        <v-row v-if="item.files.length > 1" class="pa-2">
                          <v-btn class="white--text" color="blue" depressed>Скачать все файлы</v-btn>
                        </v-row>
                      </div>
                      <div v-if="item.answer == true">
                        <v-divider class="ma-2"></v-divider>
                        <v-card-text class="my-1 ma-0 pt-2 pb-2 text-center title">Ответы студентов</v-card-text>
                        <v-expansion-panels class="ma-0">
                          <v-expansion-panel v-for="(item3,i3) in studanswer" :key="i3">
                            <v-expansion-panel v-if="item3.id == item.id">
                              <v-expansion-panel-header>
                                <v-row>
                                  <v-card-text
                                    class="my-1 ma-0 pa-0 text"
                                  >Студент: {{item3.studlogin}}</v-card-text>
                                  <v-card-text class="my-1 ma-0 pa-0 text">Фио: {{item3.studFIO}}</v-card-text>
                                </v-row>
                              </v-expansion-panel-header>
                              <v-divider class="ma-0"></v-divider>
                              <v-expansion-panel-content>
                                <v-row class="pa-2">Есть приложенные файлы!</v-row>
                                <div v-for="(item4,i4) in item3.files" :key="i4">
                                  <v-row class="pa-2">Файл {{i4+1}}: {{item4.name}}</v-row>
                                  <v-row class="pa-2">
                                    <v-btn class="white--text" color="blue" depressed>Скачать файл</v-btn>
                                  </v-row>
                                </div>
                                <v-row v-if="item3.files.length > 1" class="pa-2">
                                  <v-btn
                                    class="white--text"
                                    color="blue"
                                    depressed
                                  >Скачать все файлы</v-btn>
                                </v-row>
                              </v-expansion-panel-content>
                            </v-expansion-panel>
                          </v-expansion-panel>
                        </v-expansion-panels>
                      </div>
                    </v-expansion-panel-content>
                  </v-expansion-panel>
                </v-expansion-panel>
              </v-expansion-panels>
            </v-container>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    TFIO: "Шимбирёв Андрей Андреевич",
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
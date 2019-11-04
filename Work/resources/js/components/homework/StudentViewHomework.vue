<template>
  <v-container fluid>
    <v-row align="center">
      <v-col>
        <v-hover v-slot:default="{ hover }" class="pa-5">
          <v-card :elevation="hover ? 12 : 2" class="mx-auto" height="auto" width="90%">
            <v-card-text class="my-1 ma-0 pt-2 pb-2 text-center title">Домашние задания</v-card-text>
            <v-container class="pa-0 pb-2" fluid>
              <v-row class="pa-2">
                <v-select v-model="lesson" :items="lessons" label="Дисциплина" solo></v-select>
              </v-row>
              <v-divider class="ma-0"></v-divider>
              <v-expansion-panels>
                <v-expansion-panel v-for="(item,i) in hw" :key="i">
                  <v-expansion-panel v-if="item.lesson == lesson || lesson == 'Все дисциплины'">
                    <v-expansion-panel-header>
                      <v-row>
                        <v-card-text class="my-1 ma-0 pa-0 text">{{item.teacher}}</v-card-text>
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
                        <v-divider class="ma-0"></v-divider>
                        <v-row>
                          <v-card-text
                            class="my-1 ma-0 pa-2 mt-5 title"
                          >Преподавателю требуется отправить файлы для выполнения домашнего задания</v-card-text>
                        </v-row>
                        <v-row class="pa-2">
                          <v-file-input
                            v-model="loadfiles"
                            label="Загрузка файлов"
                            multiple
                            prepend-icon="mdi-paperclip"
                          >
                            <template v-slot:selection="{ text }">
                              <v-chip small label color="primary">{{ text }}</v-chip>
                            </template>
                          </v-file-input>
                        </v-row>
                        <v-row class="pa-2 justify-center">
                          <v-btn
                            :disabled="!loadfiles.length"
                            class="white--text"
                            color="blue"
                            depressed
                          >Отправить</v-btn>
                        </v-row>
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
    hw: [
      {
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
        lesson: "Операционные системы",
        teacher: "Горбунов А.Д.",
        group: "П-2-16",
        name: "Практическая работа 1",
        body: "Установка Windows 7 на Virtual Box",
        datestart: "2019-10-10",
        dateend: "",
        answer: false,
        files: []
      }
    ],

    itemsg: ["П-1-16", "П-2-16", "П-3-16", "П-4-16"],
    group: "П-2-16",

    lesson: "Все дисциплины",
    lessons: [
      "Технология разработки программного обеспечения",
      "Операционные системы",
      "Все дисциплины"
    ],
    loadfiles: [],
    datestart: new Date().toISOString().substr(0, 10),
    modal: false
  })
};
</script>
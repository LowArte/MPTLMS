<template>
  <v-row align="center" justify="center" class="pl-4 pr-4">
    <v-col cols="12">
      <v-hover v-slot:default="{ hover }">
        <v-card :elevation="hover ? 12 : 2" class="mx-auto" height="auto" width="max">
          <v-card-text class="my-1 ma-0 pt-2 pb-2 text-center title">Формирования домашнего задания</v-card-text>
          <v-divider class="ma-0"></v-divider>
          <v-form v-model="form">
            <v-container>
              <v-row class="pa-2">
                <v-text-field v-model="TFIO" label="Преподаватель" readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-autocomplete v-model="group" label="Группа" solo :items="itemsg"></v-autocomplete>
                <!-- <v-select v-model="group" :items="itemsg" label="Группа"></v-select> -->
              </v-row>
              <v-row class="pa-2">
                <v-autocomplete v-model="lesson" label="Дисциплина" solo :items="lessons"></v-autocomplete>
                <!-- <v-select v-model="lesson" :items="lessons" label="Дисциплина"></v-select> -->
              </v-row>
              <v-row class="pa-2">
                <v-checkbox
                  v-model="enabled"
                  hide-details
                  label="Студенту требуется приложить файлы"
                  class="shrink ma-0"
                ></v-checkbox>
              </v-row>
              <v-row class="pa-2">
                <v-text-field
                  v-model="namehw"
                  label="Название"
                  :counter="100 ? 100 : false"
                  :rules="namehwRules"
                ></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-textarea
                  v-model="bodyhw"
                  :auto-grow="true"
                  :clearable="false"
                  :counter="1000 ? 1000 : false"
                  :filled="false"
                  :flat="true"
                  :hint="'Не более 1000 символов'"
                  :label="'Описание домашнего задания'"
                  :loading="false"
                  :no-resize="false"
                  :outlined="false"
                  :persistent-hint="false"
                  :placeholder="''"
                  :rounded="false"
                  :row-height="24"
                  :rows="5"
                  :shaped="false"
                  :single-line="false"
                  :solo="false"
                  :rules="bodyhwRules"
                ></v-textarea>
              </v-row>
              <v-row class="pa-2">
                <v-file-input
                  v-model="files"
                  placeholder="Дополнительные документы"
                  label="Загрузка файлов"
                  multiple
                  prepend-icon="mdi-paperclip"
                >
                  <template v-slot:selection="{ text }">
                    <v-chip small label color="primary">{{ text }}</v-chip>
                  </template>
                </v-file-input>
              </v-row>
              <v-row class="pa-2">
                <v-col>
                  <v-text-field
                    v-model="datestart"
                    label="Дата выдачи"
                    hint="Формат Год/Месяц/День"
                    persistent-hint
                    @blur="datestart = parseDate(datestart)"
                    readonly
                  ></v-text-field>
                </v-col>
                <v-col>
                  <v-dialog
                    ref="dialog"
                    v-model="modal"
                    :return-value.sync="dateend"
                    persistent
                    width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field v-model="dateend" label="Крайний срок сдачи" readonly v-on="on"></v-text-field>
                    </template>
                    <v-date-picker v-model="dateend" scrollable>
                      <div class="flex-grow-1"></div>
                      <v-btn text color="primary" @click="modal = false">Отмена</v-btn>
                      <v-btn text color="primary" @click="$refs.dialog.save(dateend)">Принять</v-btn>
                    </v-date-picker>
                  </v-dialog>
                </v-col>
              </v-row>
              <v-row class="pa-2 justify-center">
                <v-btn
                  :disabled="!form"
                  class="white--text"
                  color="blue"
                  depressed
                >Оформить домашнее задание</v-btn>
              </v-row>
            </v-container>
          </v-form>
        </v-card>
      </v-hover>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data: () => ({
    TFIO: "Шимбирёв Андрей Андреевич",
    enabled: false,
    itemsg: ["П-1-16", "П-2-16", "П-3-16", "П-4-16"],
    group: "П-2-16",

    lesson: "Технология разработки программного обеспечения",
    lessons: [
      "Технология разработки программного обеспечения",
      "Операционные системы",
      "Технология разработки и защиты баз данных"
    ],

    namehw: "",
    bodyhw: "",
    files: [],

    datestart: new Date().toISOString().substr(0, 10),
    dateend: "",
    modal: false,

    namehwRules: [
      v => v.length > 0 || "Название домашнего задания не указано",
      v =>
        v.length <= 100 ||
        "Название домашнего задания должно быть не более 100 символов"
    ],
    bodyhwRules: [
      v => v.length > 0 || "Описание домашнего задания не указано",
      v =>
        v.length <= 1000 ||
        "Описание домашнего задания должно быть не более 1000 символов"
    ],
    form: false
  })
};
</script>
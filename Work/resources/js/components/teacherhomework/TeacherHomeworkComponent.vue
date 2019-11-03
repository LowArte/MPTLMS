<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab :key="item">Просмотр домашних заданий</v-tab>
    <v-tab :key="item">Новое домашнее задание</v-tab>
    <v-tab-item :key="item">
      <ViewHomework />
    </v-tab-item>
    <v-tab-item :key="item">
      <NewHomework />
    </v-tab-item>
  </v-tabs>
</template>

<script>
import NewHomework from "./Components/NewHomework";
import ViewHomework from "./Components/ViewHomework";
export default {
  data: () => ({
    tab: null,
    tabs: 2,
    tabitem: [
      {
        name: "Новое домашнее задание",
        com: NewHomework
      },
      {
        name: "Просмотр домашних заданий",
        com: ViewHomework
      }
    ]
  }),
  components: {
    NewHomework,
    ViewHomework
  }
};
</script>


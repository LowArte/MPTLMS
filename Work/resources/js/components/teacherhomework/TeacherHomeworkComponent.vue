<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab>Просмотр домашних заданий</v-tab>
    <v-tab>Новое домашнее задание</v-tab>
    <v-tab-item>
      <ViewHomework />
    </v-tab-item>
    <v-tab-item>
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
  }),
  components: {
    NewHomework,
    ViewHomework
  }
};
</script>


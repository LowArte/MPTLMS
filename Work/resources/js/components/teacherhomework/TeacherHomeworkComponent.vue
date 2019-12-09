<template lang="pug">
    v-tabs(grow)
      v-tab Просмотр Д/З
      v-tab Новое Д/З
      v-tab-item
        ViewHomework
      v-tab-item
        NewHomework
</template>

<script>
import NewHomework from "./Components/NewHomework";
import ViewHomework from "./Components/ViewHomework";
export default {
  components: {
    NewHomework,
    ViewHomework
  }
};
</script>


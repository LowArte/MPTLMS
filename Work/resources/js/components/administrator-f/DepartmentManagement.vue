<template lang="pug">
    c-crud-form(:_func_add="add")
    //dsgfjsguydfgusd
</template>

<script>
import apidepartments from "../../api/departments"; //api для отделений
import { mask } from "vue-the-mask"; //маски vue
import withSnackbar from "../mixins/withSnackbar"; //Alert
import CRUD_C from "./CRUDForm"; //Диалог confirm

export default {
  mixins: [withSnackbar],
  components: {
    'c-crud-form': CRUD_C
  },
  methods: {
    add(id) {
      console.log(id);
    }
  }
};
</script>
<template lang="pug">
  v-layout.row.wrap
    c-add-new-specialtie
    c-specialtie(v-for="(item, index) in specialities" :key="index" :item="item")
</template>

<script>
import SpecialtiePage_C from "./components/C_SpecialtyPage";
import C_AddNewSpecialties from "./components/C_AddNewSpecialties";

import { mapGetters } from "vuex";
import * as actions from "@/js/store/action-types";
import withSnackbar from "@/js/components/mixins/withSnackbar";

export default {
  data: () => ({
    items: []
  }),
  mixins: [withSnackbar],

  computed: {
    ...mapGetters(["specialities"])
  },

  components: {
    "c-specialtie": SpecialtiePage_C,
    "c-add-new-specialtie": C_AddNewSpecialties
  },

  async beforeMount() {
    if(this.specialities == null)
    {
      this.$store.dispatch(actions.CREATE_SPECIALITIE);
    }
  },
};
</script>
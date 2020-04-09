<template lang="pug">
  v-layout.row.wrap
    c-add-new-specialtie(v-if="printing == 1" :_add="add")
    c-specialtie(v-for="(item, index) in specialities" :key="index" :item="item")
</template>

<script>
import SpecialtiePage_C from "./components/C_SpecialtyPage";
import C_AddNewSpecialties from "./components/C_AddNewSpecialties";
import departament_api from "@/js/api/departments"; //Api отделения

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import withSnackbar from "@/js/components/mixins/withSnackbar";

export default {
  data: () => ({
    printing: 0,
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

  props: {
    _printing: {
      type: Number,
      default: 0
    }
  },

  async beforeMount() {
    if(this.specialities == null)
    {
      let items = await departament_api.getDepartments();
      this.$store.commit(mutations.SET_SPECIALITIES_FULL,items);
    }

  },

  mounted() {
    this.printing = this._printing;
  },

  methods: {
    add(item) {
      this.$store.commit(mutations.ADD_SPECIALITIE,{context:this,"result":item});
    }
  }
};
</script>
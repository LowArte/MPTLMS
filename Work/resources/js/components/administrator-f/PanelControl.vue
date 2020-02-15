<template lang="pug">
  v-switch.mx-2(v-model='options.option_value' label='Режим профилактики' color='accent' @click='sendQuery')
</template>

<script>
import panelApi from "../../api/panel";
import withSnackbar from "../mixins/withSnackbar"; //Alert

export default {
  mixins: [withSnackbar],

  data: () => {
    return {
      options: null
    };
  },

  props: {
    _options: {
      data: Object,
      default: null
    },
    _slug: {
      type: String,
      default: ""
    }
  },

  beforeMount() {
    this.options = this._options;
    this.options.option_value = this.options.option_value == "true";
  },

  methods: {
    sendQuery() {
      panelApi
        .setOptionValue({
          id: this.options.id,
          value: this.options.option_value,
          slug: this._slug
        })
        .then(res => {
          this.showMessage("Сохранено!");
        })
        .catch(ex => {
          this.showError(ex);
        });
    }
  }
};
</script>
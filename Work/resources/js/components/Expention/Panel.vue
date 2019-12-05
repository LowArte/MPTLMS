<template lang="pug">
  v-expansion-panels(class="pa-2" v-model="panel" multiple)
    v-expansion-panel(v-for="(component,i) in components" :key="i")
      v-expansion-panel-header {{ component.header }}
      v-expansion-panel-content
        component(:is="component.component" v-bind="component.props")
</template>

<script>
export default {
  props: {
    components_prop: {}
  },
  data() {
    return {
      panel: [],
      components: []
    };
  },
  mounted() {
    this.components = JSON.parse(this.components_prop);
    for (var i = 0; i < this.components.length; i++) {
      this.components[i].component = this.loader(this.components[i].content);
    }
  },
  methods: {
    loader: function(value) {
      console.log(value);
      return () => import("../" + `${value}`);
    }
  }
};
</script>


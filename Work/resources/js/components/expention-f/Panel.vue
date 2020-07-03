<template lang="pug">
  v-expansion-panels(class="pa-0 mt-3" v-model="panel" multiple)
    v-expansion-panel(v-for="(component,i) in components" :key="i")
      v-expansion-panel-header {{ component.header }}
      v-expansion-panel-content
        component(:is='component.component')
</template>

<script>
export default {
  data() {
    return {
      panel: [],
      components:[]
    };
  },

  methods: {
    //Компонент для вывода
    loader: function(value) {
      return () => import("@/js/views/" + `${value}`);
    }, 
    //Загрузка данных
    loadData(item){
      this.components = item;
      for (var i = 0; i < this.components.length; i++) {
        this.components[i].component = this.loader(this.components[i].content);
      }
    },
  }
};
</script>
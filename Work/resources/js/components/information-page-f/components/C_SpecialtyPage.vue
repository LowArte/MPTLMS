
<template lang="pug">
  v-flex.my-2
    v-card.mx-auto(max-width='420px' min-width='420px' style='display: flex; flex-direction: column;' height='100%')
      v-img(v-if="error == false" v-bind:src='item.image' @error="onError()" max-height='200px')
        template(v-slot:placeholder)
          v-row(class="fill-height ma-0" align="center" justify="center")
            v-progress-circular(indeterminate color="grey lighten-5")
      v-img(v-else v-bind:src="loadImg('reu.png')" max-height='200px')
        template(v-slot:placeholder)
          v-row(class="fill-height ma-0" align="center" justify="center")
            v-progress-circular(indeterminate color="grey lighten-5")            
      v-card-text.grow
        v-card-text.my-2.pa-0.subtitle-1.black--text(style='color: #FF3D00' max-height="70") {{item.dep_name_full}}
        v-card-text.pa-0() {{item.info.text.length > 255 ? (item.info.text.slice(0,255).substr(-1) == '.' ? item.info.text.slice(0,254) + "..." : item.info.text.slice(0,255) + "...") : item.info.text}}
      v-card-actions.ma-2.mt-0.pa-0.text--center
        v-dialog(v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition")
          template(v-slot:activator="{ on }")
            v-btn(block text small color='accent' v-on="on") Подробнее
          v-card
            v-toolbar(color="white")
              v-btn(icon dark @click="dialog = false")
                v-icon(color="primary") mdi-close
              v-toolbar-title(text--primary) Подробная информация
            v-content.pa-0
              v-img(v-bind:src="item.image" max-height='256px')
                template(v-slot:placeholder)
                  v-row(class="fill-height ma-0" align="center" justify="center")
                    v-progress-circular(indeterminate color="grey lighten-5")
              v-card.ma-2
                v-card-text.title {{item.dep_name_full}}
                v-card-text {{item.info.text}}
                v-card-text Квалификация: {{item.qualification}}
                v-list(v-for="(info,i) in Object.keys(item.info)" :key="i" v-if="info != 'text'" disabled)
                  v-card-text.title {{info}}
                  v-list-item-group(v-if="typeof(item.info[info]) == 'object'" color="primary")
                    v-list-item(v-for="(item, j) in item.info[info]" :key="j" dense)
                      v-card-text.py-1(v-text="item")
</template>


<script>
export default {
  data() {
    return {
      dialog: false, 
      error: false,
    };
  },
  props: 
  {
    item: {
      type: Object,
      default: null
    }
  },

  beforeMount()
  {
    var img = new Image();
    img.src = this.item.image;
    img.onerror = function(){console.log("Картинка не загрузилась!");};
  },

  methods:{
    onError()
    {
      this.error = true;
    },

    loadImg: function(path){
      return require(`@img/${path}`);
    }
  }
};
</script>

<style scoped>
.rounded-card {
  border-radius: 50px;
}
</style>
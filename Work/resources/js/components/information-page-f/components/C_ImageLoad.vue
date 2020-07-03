<template lang="pug">
    v-img(:src='image' :lazy-src="loadImg('reu.png')" @error="onError" max-height='200px')
      template(v-slot:placeholder)
        v-row(class="fill-height ma-0" align="center" justify="center")
          v-progress-circular(indeterminate color="grey lighten-5")    
</template>

<script>
import loadImg from "@/js/plugins/loadImage";
export default {
  data() {
    return {
      error: false,
    };
  },
  mixins: [loadImg],
  props: {
    _image: {
      type: String,
      default: ""
    }
  },
  computed: {
    image: function() {
      let result = this.error ? this.loadImg("reu.png") : this._image;
      return result;
    }
  },
  methods: {
    onError() {
      this.error = true;
    }
  }
};
</script>
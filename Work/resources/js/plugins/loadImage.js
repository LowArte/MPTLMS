export default {
    methods:{
        loadImg: function(path) {
            return require(`@img/${path}`);
          },
    }
}
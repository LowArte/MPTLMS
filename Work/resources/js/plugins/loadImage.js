export default {
    methods:{
        loadImg: function(path) {
            return require(`@img/${path}`);
        },
        loadNewsImg:function(name,id) {
            return `../storage/${id}/${name}`;
        },
    }
}
<template lang='pug'>
    v-btn(@click="test")
</template>

<script>
import axios from "axios";
export default {
    methods:{
        test()
        {
            axios.post('/xerest')
            .then(() => {return true;})
            .catch(() => {return false;});
        }
    }
}
</script>
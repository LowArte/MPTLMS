<template lang="pug">
    component(v-if="layout"  :is="layout.component")
</template>

<script>
import {mapGetters} from 'vuex'
export default {
     computed: {
        ...mapGetters([
            'layout'
        ])
    },
}
</script>
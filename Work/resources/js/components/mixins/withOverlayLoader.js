import * as mutations from  "@/js/store/mutation-types"

export default {

    methods: {
        showLoading(message)
        {
            this.$store.commit(mutations.SET_OVERLAYLOADING_SHOW, true)
            this.$store.commit(mutations.SET_OVERLAYLOADING_TEXT, message);
        },

        closeLoading()
        {
            this.$store.commit(mutations.SET_OVERLAYLOADING_SHOW, false);
        }
    }
}

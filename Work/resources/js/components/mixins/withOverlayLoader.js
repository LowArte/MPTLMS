import * as mutations from  "@/js/store/mutation-types"

export default {

    methods: {
        showLoading(message)
        {
            if(!this.$store.getters.overlayLoadingShow)
                this.$store.commit(mutations.SET_OVERLAYLOADING_SHOW, true);
            this.$store.commit(mutations.SET_OVERLAYLOADING_TEXT, message);
        },

        closeLoading(item = null)
        {
            if(item == null)
            {
                this.$store.getters.overlayLoadingText = [];
                this.$store.commit(mutations.SET_OVERLAYLOADING_SHOW, false);
            }    
            else
                this.$store.commit(mutations.SET_OVERLAYLOADING_TEXT_DELETE, item);
        }
    }
}
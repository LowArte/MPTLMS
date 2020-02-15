<template lang="pug">
    v-layout.row.wrap
        v-flex
            v-card.ma-3(max-width="420px" outline)
                v-card-title История
                v-divider
                v-card-text Тут будет история последних действий
                v-card-actions
                    v-spacer
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(icon light v-on="on" color="pimary")
                                v-icon more_horiz
                        span Подробнее
        v-flex
            v-card.ma-3(max-width="420px" outline)
                v-card-title Панель управления
                v-divider
                //c-panel-control(:_options="null")
                v-card-text.pt-0 Переводит систему в режим профилактики на неопределённый срок. Администраторы имеют доступ к к системе.
</template>

<script>
import PanelControl_C from "./PanelControl";
export default {
  components: {
    "c-panel-control": PanelControl_C
  }
};
</script>

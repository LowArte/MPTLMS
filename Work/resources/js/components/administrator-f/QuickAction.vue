<template lang="pug">
    v-layout.row.wrap
        v-flex
            v-card.ma-3(max-width="420px" outline)
                v-card-title История
                v-divider
                v-card-text Тут будут историй последних действий
                v-card-actions
                    v-spacer
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(icon light v-on="on" color="pimary")
                                v-icon more_horiz
                        span Подробнее
        v-flex
            v-card.ma-3(max-width="420px" outline)
                v-card-title Кол-во обращений
                v-divider
                v-card-text Тут будет статистика
                v-card-actions
                    v-spacer
                    v-tooltip(bottom)
                        template(v-slot:activator="{ on }")
                            v-btn(icon light v-on="on" color="pimary")
                                v-icon more_horiz
                        span Подробнее
        v-flex
            v-card.ma-3(max-width="420px" outline)
                v-card-title Статистика посещений
                v-divider
                v-card-text Тут будет график входа в систему
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
                v-switch.mx-4.mb-0( label='Режим профилактики' color='accent')
                v-card-text.pt-0 Переводит систему в режим профилактики на неопределённый срок. Администраторы имеют доступ к к системе.
</template>
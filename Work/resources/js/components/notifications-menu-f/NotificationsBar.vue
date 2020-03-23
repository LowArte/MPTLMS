<template lang="pug">
    div(class="text-center")
        v-menu(v-model="menu" :close-on-content-click="false" :nudge-width="200" offset-x)
            template(v-slot:activator="{ on }")
                v-btn(icon)
                    v-icon notifications
            v-card
                v-system-bar(color="pimary")
                    small Уведомления
</template>
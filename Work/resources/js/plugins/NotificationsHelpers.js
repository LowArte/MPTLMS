import api_notification from "@/js/api/notification"; //api для центра уведомлений
import * as actions from "@/js/store/action-types";
import { mapActions, mapGetters } from "vuex";

export default {
    computed: {
        ...mapGetters(["user", "notifications", "unread_notifications_count"])
    },
    methods:{
        //Получение уведомлений
        async getNotifications() {
            await this.$store.dispatch(actions.GET_NOTIFICATIONS, this.user.id);
        },
        //Редактирование уведомлений
        async editNotifications(data) {
            await this.$store.dispatch(actions.EDIT_NOTIFICATIONS, data);
        },
        //Редактирование всех уведомлений пользователя
        async editAllNotifications(data) {
            await this.$store.dispatch(actions.EDIT_ALL_NOTIFICATIONS, data);
        },
        //Добавление уведомления для пользователя
        async addMessageForUser(user_id, info) {
            var data = {user_id: user_id, info: info};
            return await api_notification.addNotificationsForUser(data);
        },
        //Добавление уведомления для групп
        async addMessageForUserGroup(group_id, info) {
            var data = {group_id: group_id, info: info};
            return await api_notification.addNotificationsForUserGroup(data);
        },
        //Добавление уведомления для отделения
        async addMessageForUserDepartment(department_id, info) {
            var data = {department_id: department_id, info: info};
            return await api_notification.addNotificationsForUserDepartment(data);
        },
        //Добавление уведомления для пользователей определённой роли
        async addMessageForUserPost(post_id, info) {
            var data = {post_id: post_id, info: info};
            return await api_notification.addNotificationsForUserPost(data);
        },
        //Добавление уведомления для всех пользователей
        async addMessageForUserAll(info) {
            return await api_notification.addNotificationsForUserAll(info);
        },
    }
}
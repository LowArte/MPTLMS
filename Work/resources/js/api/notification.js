//? Документация к api ------------------------

//! Описание
// Api для работы с центром уведомлений

//! Таблицы базы данных
//

//! Метод 
/**
 * 
 */

import axios from 'axios'

export default {
    //*----------------------------------------
    //!         Модель данных
    //*----------------------------------------
    /**
     * id - BIGINT
     * info - json - not null
     * user_id - int - not null - FK
     */
    //*----------------------------------------


    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    //*Получение уведомления для пользователя по его id
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *NOTIFICATIONS* (Центр уведомлений)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getNotifications(id) {
        return axios.get('/api/getters/notificications/' + id)
        .then(result => {return result.data.notifications;})
        .catch(exception => {return undefined});
    },

    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Добавление уведомления для пользователя по его id
    //! Комментарий ---------------------------
    //? Добавление данных таблицы *NOTIFICATIONS* (Центр уведомлений)
    //! Требование ----------------------------
    //!----------------------------------------
    addNotificationsForUser(data) {
        return axios.post('/api/save/notificications_for_user/', data)
        .then(result => {return true;})
        .catch(exception => {return false});
    },

    //*Добавление уведомления для всех пользователей определенной группы
    //! Комментарий ---------------------------
    //? Добавление данных таблицы *NOTIFICATIONS* (Центр уведомлений)
    //! Требование ----------------------------
    //!----------------------------------------
    addNotificationsForUserGroup(data) {
        return axios.post('/api/save/notificications_for_user_group/', data)
        .then(result => {return true;})
        .catch(exception => {return false});
    },

    //*Добавление уведомления для всех пользователей определенного отделения
    //! Комментарий ---------------------------
    //? Добавление данных таблицы *NOTIFICATIONS* (Центр уведомлений)
    //! Требование ----------------------------
    //!----------------------------------------
    addNotificationsForUserDepartment(data) {
        return axios.post('/api/save/notificications_for_user_department/', data)
        .then(result => {return true;})
        .catch(exception => {return false});
    },

    //*Добавление уведомления для всех пользователей определенной роли
    //! Комментарий ---------------------------
    //? Добавление данных таблицы *NOTIFICATIONS* (Центр уведомлений)
    //! Требование ----------------------------
    //!----------------------------------------
    addNotificationsForUserPost(data) {
        return axios.post('/api/save/notificications_for_user_post/', data)
        .then(result => {return true;})
        .catch(exception => {return false});
    },

    //*Добавление уведомления для всех пользователей
    //! Комментарий ---------------------------
    //? Добавление данных таблицы *NOTIFICATIONS* (Центр уведомлений)
    //! Требование ----------------------------
    //!----------------------------------------
    addNotificationsForUserAll(data) {
        return axios.post('/api/save/notificications_for_user_all/', data)
        .then(result => {return true;})
        .catch(exception => {return false});
    },

    //*Редактирование уведомлений для пользователя по его id
    //! Комментарий ---------------------------
    //? Реализуется редактирование данных таблицы *NOTIFICATIONS* (Центр уведомлений)
    //! Требование ----------------------------
    //!----------------------------------------
    editNotifications(data) {
        return axios.post('/api/edit/notificications/', data)
        .then(result => {return true;})
        .catch(exception => {return false});
    },
}
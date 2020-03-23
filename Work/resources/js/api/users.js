//? Документация к api ------------------------

//! Описание
// Api для работы с пользователями системы

//! Таблицы базы данных
//

//! Метод 
/**
 * 
 */

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
     * 
     */
    //*----------------------------------------





    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    //*Получение пользователей
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *USERS* (Пользователи)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //! Отсутсвуют
    //!----------------------------------------
    getUsers() {
        return axios.get('/api/getters/users');
    },

    //*Получение пользователей
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *USERS* (Пользователи)
    //? Возвращается экзмемпляр данных по id
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    getUser(user_id) {
        return axios.get('/api/admin/getters/users/' + user_id);
    },





    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Сохранение пользователя
    //! Комментарий ---------------------------
    //? Реализуется сохранение данных в таблицу *USERS* (Пользователи)
    //? Передаётся ОДИН экземпляр записи
    //? ВНИМАНИЕ: Имеются пустые поля, которые не заполнеяются в связи с разницей в должностях, т.к. у пользовтелей на разных должностях различаются атрибуты.
    //! Требование ----------------------------
    //! Отсутсвует
    //!----------------------------------------
    saveUser(user) {
        return axios.post('/api/admin/user_management/save', {
            "user": user
        });
    },

    //*Удаление пользователя
    //! Комментарий ---------------------------
    //? Реализуется удаление данных из таблицы *USERS* (Пользователи)
    //? Передаётся id в функцию
    //! Требование ----------------------------
    //! Отсутсвует
    //!----------------------------------------
    deleteUser(user_id) {
        return axios.post('/api/admin/user_management/delete/' + user_id);
    },

    //*Редактирование пользователя
    //! Комментарий ---------------------------
    //? Реализуется редактирование данных в таблице *USERS* (Пользователи)
    //? Передаётся ОДИН экземпляр записи 
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    editUser(user) {
        return axios.post('/api/admin/user_management/edit/' + user.user_id, {
            "user": user
        });
    },

    //*Логическое удаление пользователей
    //! Комментарий ---------------------------
    //? Реализуется стирание данных в таблице *USERS* (Пользователи) С ВОЗМОЖНОСТЬЮ ВОССТАНОВЛЕНИЯ
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    dropUsers() //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/user_management/deleteAll');
    },

    login(data)
    {
        return axios.post('/login',data)
    },

    init(){
        return axios.post('/getToken')
    }
}

//? Документация к api ------------------------

//! Описание
// Api для работы с новостной лентой

//! Таблицы базы данных
// NEWS

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
    //*Получение последних 124-х постов
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *NEWS* (Новости)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    getNews() {
        return axios.get('/api/getters/news');
    },

    //*Получение постов по фильтру тегов
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *NEWS* (Новости) в соответсвии с установленным фильтром
    //? Возвращается таблица данных JSON формата
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    getNewsFiltered(filter) {
        return axios.get('/api/getters/news_filtered/' + filter);
    },

    //*Получение постов по тексту
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *NEWS* (Новости) в соответсвии с посковым запросом
    //? Возвращается таблица данных JSON формата
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    getNewsSearching(searching_text) {
        return axios.get('/api/getters/news_searching/' + searching_text);
    }, 
    
    //*Получение поста по id
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *NEWS* (Новости) в соответсвии с id
    //? Возвращается объект
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    getNewsById(id) {
        return axios.get('/api/getters/news_by_id/' + id);
    },




    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Добавление новой записи
    //! Комментарий ---------------------------
    //? Реализуется добавление данных в таблицу *NEWS* (Новости)
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    insertNews(data) {
        return axios.post('/api/editor/news/insert', data);
    },

    //*Редактирование записи
    //! Комментарий ---------------------------
    //? Реализуется редактирование данных в таблице *NEWS* (Новости)
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    updateNews(data) {
        return axios.post('/api/editor/news/update', data);
    },

    //*Логическое удаление записи
    //! Комментарий ---------------------------
    //? Реализуется стирание данных в таблице *NEWS* (Новости) С ВОЗМОЖНОСТЬЮ ВОССТАНОВЛЕНИЯ
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    deleteNews(id) {
        return axios.post('/api/editor/news/delete/' + id);
    },

    //*Логическое удаление записей
    //! Комментарий ---------------------------
    //? Реализуется стирание данных в таблице *NEWS* (Новости) С ВОЗМОЖНОСТЬЮ ВОССТАНОВЛЕНИЯ
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    dropNews() {
        return axios.post('/api/editor/news/drop');
    },

    //*Отправка жалобы на запись
    //! Комментарий ---------------------------
    //? Реализуется возможность подать жалобу на контент в случае наружение морально-этических норм или правил сообщества
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    complaintNews(complaint) {
        return axios.post('/api/editor/news/complaint', complaint);
    }
}
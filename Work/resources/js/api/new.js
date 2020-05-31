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
    //!----------------------------------------
    getNews(user_id) 
    {
        return axios.get('/api/getters/news/' + user_id)
        .then(res => {return res.data.news;})
        .catch(() => {return false;});
    },
    //*Получение поста по id
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *NEWS* (Новости) в соответсвии с id
    //? Возвращается объект
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    getNewsById(id) 
    {
        return axios.get('/api/getters/news_by_id/' + id)
        .then(res => {return true;})
        .catch(() => {return false;});
    },
    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Добавление новой записи
    //! Комментарий ---------------------------
    //? Реализуется добавление данных в таблицу *NEWS* (Новости)
    //! Требование ----------------------------
    //!----------------------------------------
    insertNews(post) {
        return axios.post('/api/save/news', post,{
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(() => {return true;})
        .catch(() => {return false;});
    },
    //*Редактирование записи
    //! Комментарий ---------------------------
    //? Реализуется редактирование данных в таблице *NEWS* (Новости)
    //! Требование ----------------------------
    //! Реализовать front и back-end для api
    //!----------------------------------------
    updateNews(data) 
    {
        return axios.post('/api/update/news', data)
        .then(() => {return true;})
        .catch(() => {return false;});
    },
    //*Логическое удаление записи
    //! Комментарий ---------------------------
    //? Реализуется стирание данных в таблице *NEWS* (Новости) С ВОЗМОЖНОСТЬЮ ВОССТАНОВЛЕНИЯ
    //! Требование ----------------------------
    //!----------------------------------------
    deleteNews(id) 
    {
        return axios.post('/api/delete/news/' + id)
        .then(() => {return true;})
        .catch(() => {return false;});
    },
    //*Оценка записи
    //! Комментарий ---------------------------
    //? Реализуется установка флага отметки новости
    //! Требование ----------------------------
    //!----------------------------------------
    likeNews(data) 
    {
        return axios.post('/api/functions/set_like', data)
        .then(res => {return res.data.count;})
        .catch(() => {return null;});
    },
    //*Комментарий к записи
    //! Комментарий ---------------------------
    //? Реализуется установка флага отметки новости
    //! Требование ----------------------------
    //!----------------------------------------
    addComment(data,id) 
    {
        return axios.post('/api/functions/add_comment/'+id, data)
        .then((res) => {return res.data.comment;})
        .catch(() => {return null;});
    },
}
//? Документация к api ------------------------

//! Описание
// Api для работы с преподавателями

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
     * 
     */
    //*----------------------------------------
    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    //*Получение пользователей
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *USERS* (Пользователи) и *Teachers* (Преподаватели)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getTeachers() 
    {
        return axios.get('/api/getters/get_teachers')
        .then(res => {return res.data.teachers;})
        .catch(() => {return undefined;});
    },
}
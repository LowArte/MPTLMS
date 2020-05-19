//? Документация к api ------------------------

//! Описание
// Api для работы с домашними заданиями

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
     */
    //*----------------------------------------
    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    //*Получение заданий для преподавателя
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *HOMEWORK* (Домашние задания)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getHomeWorkByTeacherId(teacher_id)
    {
        return axios.get('/api/getters/homework_by_teacher_id/' + teacher_id)
        .then(res => {return res.data.home_works;})
        .catch(() => {return undefined});
    },
    //*Получение заданий для студента по id группы
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *HOMEWORK* (Домашние задания)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getHomeWorkByGroupId(group_id)
    {
        return axios.get('/api/getters/homework_by_group_id/' + group_id)
        .then(res => {return res.data.home_works;})
        .catch(() => {return undefined});
    },
    //*Получение задания по id
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *HOMEWORK* (Домашние задания)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getHomeWorkById(homework_id)
    {
        return axios.get('/api/getters/homework_by_id/' + homework_id)
        .then(res => {return res.data.home_work;})
        .catch(() => {return undefined});
    },
    //*Получение экзаменов по id группы
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *HOMEWORK* (Домашние задания)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getHomeWorkExams()
    {
        return axios.get('/api/getters/homework_exam')
        .then(res => {return res.data.exams;})
        .catch(() => {return undefined});
    },

    
    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Создание домашнего задания преподавателем
    //! Комментарий ---------------------------
    //? Реализуется сохранение данных в таблице *HOMEWORK* (Домашние задания)
    //! Требование ----------------------------
    //!----------------------------------------
    saveHomeWork(data)
    {
        return axios.post('/api/save/homework', data)
        .then(() => {return true;})
        .catch(() => {return undefined});
    },
    //*Редактирование домашнего задания преподавателем
    //! Комментарий ---------------------------
    //? Реализуется редактирование данных в таблице *HOMEWORK* (Домашние задания)
    //! Требование ----------------------------
    //!----------------------------------------
    editHomeWork(data)
    {
        return axios.post('/api/edit/homework', data)
        .then(() => {return true;})
        .catch(() => {return undefined});
    },
    //*Удаление домашнего задания преподавателем
    //! Комментарий ---------------------------
    //? Реализуется удаление данных в таблице *HOMEWORK* (Домашние задания)
    //! Требование ----------------------------
    //!----------------------------------------
    deleteHomeWork(id)
    {
        return axios.post('/api/edit/homework/' + id)
        .then(() => {return true;})
        .catch(() => {return undefined});
    }
}
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
    getHomeWorkTeacherById(home_work_id, user_id)
    {
        return axios.get('/api/getters/homework_teacher_by_id/' + home_work_id + '/' + user_id)
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
        .then(res => {return res.data.id;})
        .catch(() => {return false;});
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
        .catch(() => {return false;});
    },
    //*Редактирование домашнего задания преподавателем
    //! Комментарий ---------------------------
    //? Реализуется редактирование данных в таблице *HOMEWORK* (Домашние задания)
    //! Требование ----------------------------
    //!----------------------------------------
    editAccess(data)
    {
        return axios.post('/api/edit/homework_access', data)
        .then(() => {return true;})
        .catch(() => {return false;});
    },
    //*Удаление домашнего задания преподавателем
    //! Комментарий ---------------------------
    //? Реализуется удаление данных в таблице *HOMEWORK* (Домашние задания)
    //! Требование ----------------------------
    //!----------------------------------------
    deleteHomeWork(id)
    {
        return axios.post('/api/delete/homework/' + id)
        .then(() => {return true;})
        .catch(() => {return undefined});
    },
    //*Удаление документа
    //! Комментарий ---------------------------
    //? Реализуется удаление данных в таблице *HOMEWORK* (Домашние задания)
    //! Требование ----------------------------
    //!----------------------------------------
    deleteDocument(document_id)
    {
        return axios.post('/api/delete/homework_document/' + document_id)
        .then(() => {return true;})
        .catch(() => {return undefined});
    },

    //*----------------------------------------
    //!         Загрузка файлов
    //*----------------------------------------
    loadDocuments(data) 
    {
        return axios.post('/api/save/load_documents_homework/' + data.homework_id, data.documents, 
        {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(() => { return true; })
        .catch(() => {  return false; });
    },
    //Скачивание файла
    downloadDocument(document_id) {
        return axios({
                url: '/api/functions/download_document_by_id/' + document_id,
                method: 'GET',
                responseType: 'blob',
            })
        .then((res) => {
            return res.data;
        })
        .catch(() => {
            return undefined;
        });
    },


    //*----------------------------------------
    //!         Комментарии
    //*----------------------------------------
    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    getComment(home_work_id)
    {
        return axios.get('/api/getters/homework_comment/' + home_work_id)
        .then(res => {return res.data.comments;})
        .catch(() => {return false;});
    },
    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    saveComment(data)
    {
        return axios.post('/api/save/homework_comment/', data)
        .then(() => {return true;})
        .catch(() => {return false;});
    },
}
//? Документация к api ------------------------

//! Описание
// Api для работы с расписанием звонков для учебных мест проведения

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
     * call_schedule - JSON - not null
     * place_id - int - not null - FK
     */
    //*----------------------------------------
    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    //*Получение ассоциаций для преподавателей
    //! Комментарий ---------------------------
    //! Требование ----------------------------
    //!----------------------------------------
    getAssociationTeacher(teacher_id) 
    {
        return axios.get('/api/getters/association_for_teacher/' + teacher_id)
        .then(res => {return res.data.association;})
        .catch(() => {return undefined;});
    },
    //*Получение ассоциаций для студента
    //! Комментарий ---------------------------
    //! Требование ----------------------------
    //!----------------------------------------
    getAssociationStudent(group_id) 
    {
        return axios.get('/api/getters/association_for_student/' + group_id)
        .then(res => {return res.data.association;})
        .catch(() => {return undefined;});
    },
    //*Получение ассоциаций между преподавателем и дисциплиной
    //! Комментарий ---------------------------
    //! Требование ----------------------------
    //!----------------------------------------
    getAssociationTeacherDiscip() 
    {
        return axios.get('/api/getters/association_teacher_discip')
        .then(res => {return res.data.associations;})
        .catch(() => {return undefined;});
    },
    
    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Создание ассоциации
    //! Комментарий ---------------------------
    //! Требование ----------------------------
    //!----------------------------------------
    saveAssociation(data) 
    {
        return axios.post('/api/save/association', data)
        .then(() => {return true;})
        .catch(() => {return false;});
    }
}
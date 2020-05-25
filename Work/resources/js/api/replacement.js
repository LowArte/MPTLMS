//? Документация к api ------------------------

//! Описание
// Api для работы с заменами в учебном расписании групп

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
     * swap_date - DATE - no null
     * swap - JSON - no null
     * schedule_id - int - not null - FK
     */
    //*----------------------------------------
    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    //*Получение всех замен
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *SCHEDULE_SWAPS* (Замены)
    //? Возвращается полная таблица данных JSON форматаd
    //! Требование ----------------------------
    //!----------------------------------------
    getReplacements() 
    {
        return axios.get('/api/getters/replacements')
        .then(res => {return res.data.replacements;})
        .catch(() => {return undefined;});
    },
    //Проверка замены для преподавателя
    getCheckTeacherReplacement(teacher_id) 
    {
        return axios.get('/api/getters/replacements_check_teacher/' + teacher_id)
        .then(res => {return res.data.check;})
        .catch(() => {return undefined;});
    },

    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Сохранение замены
    //! Комментарий ---------------------------
    //? Реализуется сохранение данных в таблице *SCHEDULE_SWAPS* (Замены)
    //? Передается объект
    //! Требование ----------------------------
    //!----------------------------------------
    saveReplacements(data) 
    {
        return axios.post('/api/save/replacement/' + data.group_id + '/' + data.date, {"replacement": data.replacement})
        .then(() => {return true; })
        .catch(() => {return false; });
    },
    //*Логическое удаление замены
    //? Реализуется стирание данных в таблице *SCHEDULE_SWAPS* (Замены)
    //? Передается id замены
    //! Требование ----------------------------
    //!----------------------------------------
    deleteReplacement(replacement_id) 
    {
        return axios.post('/api/delete/replacement/' + replacement_id)
        .then(() => {return true;})
        .catch(() => {return false;});
    },
}
//? Документация к api ------------------------

//! Описание
// Api для работы с учебными журналами

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
    //*Получение учебного журнала
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *JOURNALS* (Журналы)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getJournalById(id) 
    {
        return axios.get('/api/getters/journals_by_id/' + id)
        .then(res => {console.log(res.data); return res.data.journal;})
        .catch(() => {return undefined});
    },
    //*Получение учебных журналов
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *JOURNALS* (Журналы)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getJournalsByGroupId(id) 
    {
        return axios.get('/api/getters/journals_by_group_id/' + id)
        .then(res => {return res.data.journals;})
        .catch(() => {return undefined});
    },

    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Создание нового журнала
    //! Комментарий ---------------------------
    //? Реализуется создание данных в таблице *JOURNALS* (Журналы)
    //! Требование ----------------------------
    //!----------------------------------------
    saveJournal(data) 
    {
        return axios.post('/api/save/journals', data)
        .then(() => {return true;})
        .catch(() => {return false;});
    },

    //*Закрытие/Открытие журнала
    //! Комментарий ---------------------------
    //? Реализуется открытие/закрытие журнала для преподователя
    //! Требование ----------------------------
    //!----------------------------------------
    editJournalClose(id) 
    {
        return axios.post('/api/edit/journal_close/' + id)
        .then(() => {return true;})
        .catch(() => {return false;});
    },

    //*Закрытие/Открытие журнала для группы
    //! Комментарий ---------------------------
    //? Реализуется открытие/закрытие журнала для преподователя
    //! Требование ----------------------------
    //!----------------------------------------
    editJournalCloseGroups(id_group) 
    {
        return axios.post('/api/edit/journal_close_groups/' + id_group)
        .then(() => {return true;})
        .catch(() => {return false;});
    },

    //*Редактирование журнала
    //! Комментарий ---------------------------
    //? Реализуется редактирование журнала
    //! Требование ----------------------------
    //!----------------------------------------
    editJournal(data) 
    {
        return axios.post('/api/edit/journal', data)
        .then(() => {return true;})
        .catch(() => {return false;});
    },
}
    
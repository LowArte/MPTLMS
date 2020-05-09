//? Документация к api ------------------------

//! Описание
// Api для работы с дисциплинами

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
     * discip_name - text
     */
    //*----------------------------------------
    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    //*Получение дисциплин
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *Discipline* (Пользователи)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getDisciplines() 
    {
        return axios.get('/api/getters/get_disciplines')
        .then(res => {return res.data.disciplines;})
        .catch(() => {return undefined;});
    },
    //*Получение бд
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *Discipline* (Пользователи)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getDisciplinesDB() 
    {
        return axios.get('/api/getters/discipline_buffer')
        .then(res => {return res.data.disciplineBuffer;})
        .catch(() => {return undefined;});
    },

    //*Получение дисциплин из бд
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *Discipline* (Пользователи)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getDisciplinesDBContent(db_name) 
    {
        return axios.get('/api/getters/discipline_buffer_data/' + db_name)
        .then(res => {return res.data.disciplineBuffer;})
        .catch(() => {return undefined;});
    },
    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    saveDiscipline()
    {
        return axios.post('/api/save/discipline_buffer_data/', + data)
        .then(() => {return true;})
        .catch(() => {return false;});
    },

    deleteDiscipline(id)
    {
        return axios.post('/api/delete/discipline_buffer_data/' + id)
        .then(() => {return true;})
        .catch(() => {return false;});
    },

    editDiscipline(data)
    {
        return axios.post('/api/edit/discipline_buffer_data/', + data)
        .then(() => {return true;})
        .catch(() => {return false;});
    },

    //*----------------------------------------
    //!         Загрузка файлов
    //*----------------------------------------
    importDiscipline(file) 
    {
        return axios.post('/api/functions/import_discipline', file, 
        {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(() => {
            return true;
        })
        .catch(() => {
            return false;
        });
    }
}

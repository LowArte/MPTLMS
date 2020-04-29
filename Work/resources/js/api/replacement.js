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
    getReplacements(_this) {
        return axios.get('/api/getters/replacements')
        .then(res => {return res.data.replacements;})
        .catch(ex => { _this.showError("Ошибка выполнения данных!"); return undefined;});
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
    saveReplacements(data, _this) {
        return axios.post('/api/save/replacement/' + data.group_id + '/' + data.date, {"replacement": data.replacement})
        .then(result => { _this.showMessage("Выполнено!"); return true; })
        .catch(exception => { _this.showError("Ошибка выполнения!"); return false; });
    },

    //*Логическое удаление замены
    //? Реализуется стирание данных в таблице *SCHEDULE_SWAPS* (Замены)
    //? Передается id замены
    //! Требование ----------------------------
    //!----------------------------------------
    deleteReplacement(replacement_id, _this) {
        return axios.post('/api/delete/replacement/' + replacement_id)
        .then(result => { _this.showMessage("Выполнено!"); return true; })
        .catch(exception => { _this.showError("Ошибка выполнения!"); return false; });
    },
}
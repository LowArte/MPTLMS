//? Документация к api ------------------------

//! Описание
// Api для работы с обратной связью системы

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
     * user_id - int - not null - FK
     * type - string - not null
     * text - string - not null
     * answered - int - not null
     */
    //*----------------------------------------




    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    //*Получение обращений пользователей
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *FEEDBACK* (Обраная связь)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getFeedbackRequests(_this) {
        return axios.get('/api/getters/get_feedback_requests')
        .then(res => {return res.data.feedback;})
        .catch(ex => {_this.showError("Ошибка получения данных!"); return undefined;});
    },




    //*----------------------------------------
    //!         Работа с данными*
    //*---------Имеется модификация------------
    //*Заказ нового документа
    //! Комментарий ---------------------------
    //? Реализуется сохранения данных в таблице *FEEDBACK* (Обраная связь)
    //! Требование ----------------------------
    //!----------------------------------------
    save(data, _this) {
        return axios.post('/api/save/feedback/', {"text": data.text, "type": data.type})
        .then(res => {_this.showMessage("Выполнено!"); return true;})
        .catch(ex => {_this.showError("Не выполнено!"); return false;});
    },

    //*Оправка сообщений на почту
    //*------------Модификация-----------------
    //! Комментарий ---------------------------
    //? Реализуется отправка сообщения на почту пользователя в качестве ответа на обращение
    //! Требование ----------------------------
    //! Реализовать back-end для api 
    //!----------------------------------------
    sendEmail(data, _this)
    {
        return axios.post('/api/functions/send_feedback_email_answer/', data)
        .then(result => {return true;})
        .catch(ex => {return false;});
    },
}
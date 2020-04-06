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
import withSnackbar from "@/js/components/mixins/withSnackbar";

export default {
    mixins: [withSnackbar],
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
    //! Отсутсвуют
    //!----------------------------------------
    getTeachers() {
        axios.get('/api/getters/get_teachers')
        .then(res => {return res.data.teachers;})
        .catch(ex => {this.showError(ex);});
    },
}

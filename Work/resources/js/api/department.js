//? Документация к api ------------------------

//! Описание
// Api для работы с учебными отделениями

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
     * dep_name_full - VARCHAR
     * qualification - VARCHAR
     * about - VARCHAR
     * image - VARCHAR
     * studysperiod - VARCHAR
     * info - JSON
     */
    //*----------------------------------------


    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    //*Получение отделений
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *departments* (Специальности)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getDepartments(_this) {
        return axios.get('/api/getters/departments')
        .then(result => { return result.data.departments; })
        .catch(exception => { _this.showError("Ошибка получения данных!"); return undefined;});
    },

    //*Получение отделений для комбобокса
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *departments* (Специальности)
    //? Возвращается список специальностей для выпадающих списков
    //! Требование ----------------------------
    //!----------------------------------------
    getDepartmentsForCombobox(_this) {
        return axios.get('/api/getters/departments_for_combobox')
        .then(res => { return res.data.departments; })
        .catch(ex => { _this.showError("Ошибка получения данных!"); return undefined; });
    },




    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Сохранение отделений
    //! Комментарий ---------------------------
    //? Реализуется сохранение данных в таблицу *departments* (Специальности)
    //? Передаётся ОДИН экземпляр записи
    //! Требование ----------------------------
    //!----------------------------------------
    saveDepartment(department, _this) {
        return axios.post('/api/save/department', department)
        .then(res => { _this.showMessage("Сохранено!"); return res.data.id; })
        .catch(exception => { _this.showError("Ошибка выполения"); return false; });
    },

    //*Удаление отделений
    //! Комментарий ---------------------------
    //? Реализуется удаление данных из таблицы *departments* (Специальности)
    //? Передаётся id в функцию
    //! Требование ----------------------------
    //!----------------------------------------
    deleteDepartment(id, _this) {
        return axios.post('/api/delete/department/' + id)
        .then(result => { _this.showMessage("Удалено!"); return true; })
        .catch(exception => { _this.showError("Ошибка выполнения!"); return false; });
    },

    //*Редактирование отделений
    //! Комментарий ---------------------------
    //? Реализуется редактирование данных в таблице *departments* (Специальности)
    //? Передаётся ОДИН экземпляр записи 
    //! Требование ----------------------------
    //!----------------------------------------
    editDepartment(department, _this) {
        return axios.post('/api/edit/department/',  department)
        .then(res => { _this.showMessage("Выполнено!"); return true; })
        .catch(exception => { _this.showError("Ошибка выполнения!"); return false; });
    },
}
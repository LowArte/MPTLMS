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
    //! Отсутсвуют
    //!----------------------------------------
    getDepartments(_this) {
        return axios.get('/api/getters/departments')
        .then(result => { return result.data.departments; })
        .catch(exception => { console.log(exception); _this.showError("Ошибка получения данных!"); return undefined;});
    },

    //*Получение отделений для комбобокса
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *departments* (Специальности)
    //? Возвращается список специальностей для выпадающих списков
    //! Требование ----------------------------
    //! Отсутсвуют
    //!----------------------------------------
    getDepartmentsForCombobox(_this) {
        return axios.get('/api/getters/departments_for_combobox')
        .then(res => { return res.data.departaments; })
        .catch(ex => { _this.showError("Ошибка получения данных!"); return undefined; });
    },

    //*Получение отделеня
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *departments* (Специальности)
    //? Возвращается ОДИН экземпляр по переданному id
    //! Требование ----------------------------
    //! Нужно получать department по ID
    //!----------------------------------------
    getDepartment(id, _this) {
        return axios.get('/api/admin/getters/department/' + id)
        .then(result => { return result.data; })
        .catch(exception => { _this.showError("Ошибка получения данных!"); return undefined; });
    },





    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Сохранение отделений
    //! Комментарий ---------------------------
    //? Реализуется сохранение данных в таблицу *departments* (Специальности)
    //? Передаётся ОДИН экземпляр записи
    //! Требование ----------------------------
    //! Отсутсвует
    //!----------------------------------------
    saveDepartment(department, _this) {
        return axios.post('/api/save/departament', department)
        .then(res => { _this.showMessage("Сохранено!"); return res.data.id; })
        .catch(exception => { _this.showError("Ошибка выполения"); return false; });
    },

    //*Удаление отделений
    //! Комментарий ---------------------------
    //? Реализуется удаление данных из таблицы *departments* (Специальности)
    //? Передаётся id в функцию
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    deleteDepartment(id, _this) {
        return axios.post('/api/delete/departament/' + id)
        .then(result => { _this.showMessage("Удалено!"); return true; })
        .catch(exception => { _this.showError("Ошибка выполнения!"); return false; });
    },

    //*Редактирование отделений
    //! Комментарий ---------------------------
    //? Реализуется редактирование данных в таблице *departments* (Специальности)
    //? Передаётся ОДИН экземпляр записи 
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    editDepartment(department, _this) {
        return axios.post('/api/edit/departament/',  department)
        .then(res => { _this.showMessage("Выполнено!"); return true; })
        .catch(exception => { _this.showError("Ошибка выполнения!"); return false; });
    },
}
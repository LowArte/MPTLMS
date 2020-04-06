//? Документация к api ------------------------

//! Описание
// Api для работы с учебными отделениями

//! Таблицы базы данных
//

//! Метод 
/**
 * 
 */

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
    getDepartments() {
        return axios.get('/api/getters/departments')
        .then(result => { return result.data.departments; })
        .catch(exception => { this.showError("Произошёл сбой: " + exception); return undefined;});
    },

    //*Получение отделений для комбобокса
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *departments* (Специальности)
    //? Возвращается список специальностей для выпадающих списков
    //! Требование ----------------------------
    //! Отсутсвуют
    //!----------------------------------------
    getDepartmentsForCombobox() {
        axios.get('/api/getters/departments_for_combobox')
        .then(res => { return res.data.departaments; })
        .catch(ex => { this.showError('Произошёл сбой: ' + ex); });
    },

    //*Получение отделеня
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *departments* (Специальности)
    //? Возвращается ОДИН экземпляр по переданному id
    //! Требование ----------------------------
    //! Нужно получать department по ID
    //!----------------------------------------
    getDepartment(id) {
        return axios.get('/api/admin/getters/department/' + id)
        .then(result => { return result.data; })
        .catch(exception => { this.showInfo("Произошёл сбой: " + exception); });
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
    saveDepartment(department) {
        axios.post('/api/admin/department_management/save/', department)
        .then(res => { this.showMessage("Действие выполнено успешно"); })
        .catch(exception => { this.showError( "Произошёл сбой: " + exception ); });
    },

    //*Удаление отделений
    //! Комментарий ---------------------------
    //? Реализуется удаление данных из таблицы *departments* (Специальности)
    //? Передаётся id в функцию
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    deleteDepartment(id) {
        axios.post('/api/admin/department_management/delete/' + id)
        .then(result => { this.showMessage("Действие выполнено успешно"); })
        .catch(exception => { this.showError( "Произошёл сбой: " + exception ); });
    },

    //*Редактирование отделений
    //! Комментарий ---------------------------
    //? Реализуется редактирование данных в таблице *departments* (Специальности)
    //? Передаётся ОДИН экземпляр записи 
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    editDepartment(department) {
        axios.post('/api/admin/department_management/edit/' + department.id, { "department": department })
        .then(res => { this.showMessage("Действие выполнено успешно!"); })
        .catch(exception => { this.showError( "Произошёл сбой: " + exception ); });
    },





    //*----------------------------------------
    //!         Очистка таблицы
    //*----------------------------------------
    //*Полное удаление отделений
    //! Комментарий ---------------------------
    //? Реализуется сброс данных в таблице *departments* (Специальности) 
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    dropDepartments() {
        axios.post('/api/admin/department_management/deleteAll')
        .then(res => { this.showMessage("Действие выполнено успешно"); })
        .catch(exception => { this.showError("Произошёл сбой: " + exception); });
    }
}

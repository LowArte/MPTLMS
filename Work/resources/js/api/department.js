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
    getDepartments() 
    {
        return axios.get('/api/getters/departments')
        .then(res => {return res.data.departments;})
        .catch(() => {return undefined;});
    },
    //*Получение отделений для комбобокса
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *departments* (Специальности)
    //? Возвращается список специальностей для выпадающих списков
    //! Требование ----------------------------
    //!----------------------------------------
    getDepartmentsForCombobox() 
    {
        return axios.get('/api/getters/departments_for_combobox')
        .then(res => {return res.data.departments;})
        .catch(() => {return undefined;});
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
    saveDepartment(department) 
    {
        return axios.post('/api/save/department', department)
        .then(res => {return res.data.id;})
        .catch(() => {return false;});
    },
    //*Удаление отделений
    //! Комментарий ---------------------------
    //? Реализуется удаление данных из таблицы *departments* (Специальности)
    //? Передаётся id в функцию
    //! Требование ----------------------------
    //!----------------------------------------
    deleteDepartment(id)
    {
        return axios.post('/api/delete/department/' + id)
        .then(() => {return true;})
        .catch(() => {return false;});
    },
    //*Редактирование отделений
    //! Комментарий ---------------------------
    //? Реализуется редактирование данных в таблице *departments* (Специальности)
    //? Передаётся ОДИН экземпляр записи 
    //! Требование ----------------------------
    //!----------------------------------------
    editDepartment(department) 
    {
        return axios.post('/api/edit/department/',  department)
        .then(() => {return true;})
        .catch(() => {return false;});
    },

    exportDepartaments() {
        return axios({
                url: '/api/functions/download_departament_export',
                method: 'GET',
                responseType: 'blob',
            })
            .then((res) => {
                return res;
            })
            .catch((er) => {
                return er;
            });
    },

    importDepartaments(file) {
        return axios.post('/api/functions/import_departament', file, {
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
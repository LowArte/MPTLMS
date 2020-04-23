//? Документация к api ------------------------

//! Описание
// Api для работы с учебными группами отделений

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
     * group_name - string - not null
     * group_name - string - not null
     * group_name - string - not null
     * curs - string - not null
     * departments_id - int - not null - FK
     */
    //*----------------------------------------


    //*----------------------------------------
    //!         Получение данных
    //*----------------------------------------
    //*Получение всех групп
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *GROUPS* (Группы)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getGroups(_this) {
        return axios.get('/api/getters/groups')
        .then(result => {return result.data.groups;})
        .catch(exception => {_this.showError("Ошибка получения данных!"); return undefined});
    },

    //*Получение всех групп для выпадающего списка
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *GROUPS* (Группы)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getGroupsForCombobox(_this) {
        return axios.get('/api/getters/groups_for_combobox')
        .then(result => {return result.data.groups;})
        .catch(exception => {_this.showError("Ошибка получения данных!"); return undefined});
    },

    //*Получение всех групп для выпадающего списка с учётом вспомогательных групп
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *GROUPS* (Группы)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getGroupsForComboboxRecursive(_this) {
        return axios.get('/api/getters/groups_for_combobox_recursive')
        .then(result => {return result.data.groups;})
        .catch(exception => {_this.showError("Ошибка получения данных!"); return undefined});
    },

    //*Получение групп по id отделению
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *GROUPS* (Группы)
    //? Возвращается таблица данных JSON формата по id соответствующей группы
    //! Требование ----------------------------
    //!----------------------------------------
    getGroupsByDepartmentId(department_id, _this) {
        return axios.get('/api/getters/group_by_department_id/' + department_id)
        .then(result => { return result.data.groups;})
        .catch(exception => {_this.showError("Ошибка получения данных!"); return undefined;});
    },

    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Сохранение группы
    //! Комментарий ---------------------------
    //? Реализуется сохранение данных в таблице *GROUPS* (Группы)
    //? Передается объект
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    saveGroup(group, _this) {
        return axios.post('/api/save/group/', group)
        .then(res => {_this.showMessage("Выполнено!"); return res.data.id;})
        .catch(exception => {_this.showError("Ошибка выполнения!"); return false;});
    },

    //*Редактирование группы
    //! Комментарий ---------------------------
    //? Реализуется изменение данных в таблице *GROUPS* (Группы)
    //? Передается объект и заменет оригинал по id
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    editGroup(group, _this) {
        return axios.post('/api/edit/group/', group)
        .then(res => {_this.showMessage("Выполнено!"); return true;})
        .catch(exception => {_this.showError("Ошибка выполнения!"); return false;});
    },

    //*Логическое удаление группы
    //! Комментарий ---------------------------
    //? Реализуется стирание данных в таблице *GROUPS* (Группы)
    //? Передается id группы
    //! Требование ----------------------------
    //! Реализовать back-end для api
    //!----------------------------------------
    deleteGroup(group_id, _this) {
        return axios.post('/api/delete/group/' + group_id)
        .then(result => {_this.showMessage("Выполнено!"); return true;})
        .catch(exception => {_this.showError("Ошибка выполнения!"); return false;});
    },
}
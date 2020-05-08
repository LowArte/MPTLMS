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
    getGroups() 
    {
        return axios.get('/api/getters/groups')
        .then(res => {return res.data.groups;})
        .catch(() => {return undefined});
    },
    //*Получение всех групп для выпадающего списка
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *GROUPS* (Группы)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getGroupsForCombobox() 
    {
        return axios.get('/api/getters/groups_for_combobox')
        .then(res => {return res.data.groups;})
        .catch(() => {return undefined});
    },
    //*Получение всех групп для выпадающего списка с учётом вспомогательных групп
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *GROUPS* (Группы)
    //? Возвращается полная таблица данных JSON формата
    //! Требование ----------------------------
    //!----------------------------------------
    getGroupsForComboboxRecursive() 
    {
        return axios.get('/api/getters/groups_for_combobox_recursive')
        .then(res => {return res.data.groups;})
        .catch(() => {return undefined});
    },
    //*Получение групп по id отделению
    //! Комментарий ---------------------------
    //? Реализуется получение данных из таблицы *GROUPS* (Группы)
    //? Возвращается таблица данных JSON формата по id соответствующей группы
    //! Требование ----------------------------
    //!----------------------------------------
    getGroupsByDepartmentId(department_id) 
    {
        return axios.get('/api/getters/group_by_department_id/' + department_id)
        .then(res => {return res.data.groups;})
        .catch(() => {return undefined;});
    },
    //*----------------------------------------
    //!         Работа с данными
    //*----------------------------------------
    //*Сохранение группы
    //! Комментарий ---------------------------
    //? Реализуется сохранение данных в таблице *GROUPS* (Группы)
    //? Передается объект
    //! Требование ----------------------------
    //!----------------------------------------
    saveGroup(group) 
    {
        return axios.post('/api/save/group/', group)
        .then(res => {return res.data.id;})
        .catch(() => {return false;});
    },
    //*Редактирование группы
    //! Комментарий ---------------------------
    //? Реализуется изменение данных в таблице *GROUPS* (Группы)
    //? Передается объект и заменет оригинал по id
    //! Требование ----------------------------
    //!----------------------------------------
    editGroup(group) 
    {
        return axios.post('/api/edit/group/', group)
        .then(() => {return true;})
        .catch(() => {return false;});
    },
    //*Логическое удаление группы
    //! Комментарий ---------------------------
    //? Реализуется стирание данных в таблице *GROUPS* (Группы)
    //? Передается id группы
    //! Требование ----------------------------
    //!----------------------------------------
    deleteGroup(group_id) 
    {
        return axios.post('/api/delete/group/' + group_id)
        .then(() => {return true;})
        .catch(() => {return false;});
    },

    exportGroup() {
        return axios({
                url: '/api/functions/download_group_export',
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
    importGroup(file) {
        return axios.post('/api/functions/import_group', file, {
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
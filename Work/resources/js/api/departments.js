//Api для работы с учебными отделениями

import axios from 'axios'

export default {
    //Получение отделений
    getDepartments() {
        return axios.get('/api/getters/departments');
    },

    //Получение отделений для комбобокса
    getDepartmentsForCombobox() {
        return axios.get('/api/getters/departments_for_combobox');
    },

    //*Получение отделеня
    getDepartment(id) { //! Нужно получать department по ID
        return axios.get('/api/admin/getters/department/' + id);
    },

    //Сохранение отделений
    saveDepartment(department) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/department_management/save', {
            "department": department
        });
    },

    //Удаление отделений
    deleteDepartment(id) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/department_management/delete/' + id);
    },

    //Редактирование отделений
    editDepartment(department) //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/department_management/edit/' + department.id, {
            "department": department
        });
    },

    //Полное удаление отделений
    dropDepartments() //!Требуется сделать рабочим
    {
        return axios.post('/api/admin/department_management/deleteAll');
    }
}

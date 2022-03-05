require('./bootstrap');

import {createRouter, createWebHistory} from "vue-router";
import {createApp} from 'vue';

import App from './components/App'
import Home from './components/Home'
import Employee from './components/Employee'
import Department from './components/Department'
import ShowDepartment from './components/ShowDepartment'
import CreateDepartment from './components/CreateDepartment'
import CreateEmployee from './components/CreateEmployee'
import ShowEmployee from './components/ShowEmployee'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/employee',
        name: 'employee',
        component: Employee
    },
    {
        path: '/employee/:employeeId',
        name: 'showEmployee',
        component: ShowEmployee,
        props: true
    },
    {
        path: '/employee/create',
        name: 'createEmployee',
        component: CreateEmployee,
    },
    {
        path: '/department',
        name: 'department',
        component: Department
    },
    {
        path: '/department/:departmentId',
        name: 'showDepartment',
        component: ShowDepartment,
        props: true
    },
    {
        path: '/department/create',
        name: 'createDepartment',
        component: CreateDepartment,
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router

createApp(App).use(router).mount('#app')

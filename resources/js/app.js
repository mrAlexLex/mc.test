require('./bootstrap');

import {createRouter, createWebHistory} from "vue-router";
import {createApp} from 'vue';

import App from './components/App'
import Home from './components/Home'
import Employee from './components/Employee'
import Department from './components/Department'

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
        path: '/department',
        name: 'department',
        component: Department
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router

createApp(App).use(router).mount('#app')

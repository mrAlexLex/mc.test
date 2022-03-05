<template>
    <h1>Сотрудники</h1>
    <div class="row">
        <div class="col-1 offset-11">
            <router-link :to="{name: 'createEmployee'}" class="btn btn-outline-primary">Добавить</router-link>
        </div>
    </div>
    <div class="row">
        <div class="spinner-border offset-5" style="width: 7rem; height: 7rem;" role="status" v-if="loading">
            <span class="sr-only"></span>
        </div>
    </div>
    <div class="row">
        <div class="alert alert-danger" role="alert" v-if="errors">
            Ошибка загрузки данных!
        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Фамилия</th>
                <th scope="col">Отчество</th>
                <th scope="col">Пол</th>
                <th scope="col">З/П</th>
                <th scope="col">Отделы</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="employee in emloyees">
                <th scope="row">{{employee.id}}</th>
                <td>
                    <router-link :to="{name: 'showEmployee', params: {employeeId: employee.id}}">
                        {{employee.name}}
                    </router-link>
                </td>
                <td>{{employee.surname}}</td>
                <td>{{employee.patronymic}}</td>
                <td>{{employee.gender}}</td>
                <td>{{employee.wage}}</td>
                <td>
                    <ul class="list">
                        <li class="list-item" v-for="department in employee.departments">
                            {{department.departments_name}}<br>
                        </li>
                    </ul>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-dark" @click="deleteEmployee(employee.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                        </svg>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data(){
        return {
            emloyees: [],
            errors: false,
            loading: true
        }
    },
    methods: {
        getEmployees(){
            axios.get('/api/v1/employee')
                .then(response => {
                    this.emloyees = response.data.data
                })
                .catch(error => {
                    console.log(error)
                    this.errors = true
                })
                .finally(() => {
                    this.loading = false
                })
        },
        deleteEmployee(id) {
            if(confirm('Удалить отдел?')){
                axios.post('/api/v1/employee/' + id, {
                    _method: 'DELETE',
                })
                    .then(response => {
                        this.emloyees = []
                        this.getEmployees()
                    })
                    .catch(error => {
                        this.errors = true
                    })
                    .finally(() => {
                        this.loading = false
                    })
            }
        }
    },
    mounted() {
        this.getEmployees()
    }
}
</script>


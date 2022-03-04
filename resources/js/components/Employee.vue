<template>
    <h1>Сотрудники</h1>
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
            </tr>
            </thead>
            <tbody>
            <tr v-for="employee in emloyees">
                <th scope="row">{{employee.id}}</th>
                <td><a href="/department/{{employee.id}}">{{employee.name}}</a></td>
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
    mounted() {
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
    }
}
</script>


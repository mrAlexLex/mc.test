<template>
<h1>Отделы</h1>
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
                <th scope="col">Наименование</th>
                <th scope="col">Количество сотрудников</th>
                <th scope="col">Максимальная зп</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="department in departments">
                <th scope="row">{{department.id}}</th>
                <td><a href="/department/{{department.id}}">{{department.departments_name}}</a></td>
                <td>{{department.employees_count}}</td>
                <td>Максимальная зп</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data(){
        return {
            departments: [],
            errors: false,
            loading: true
        }
    },
    mounted() {
        axios.get('/api/v1/department')
        .then(response => {
            this.departments = response.data.data
        })
        .catch(error => {
            console.log(error)
            this.errors = true
        })
            .finally(() => {
                this.loading = false
                console.log(this.departments)
            })
    }
}
</script>

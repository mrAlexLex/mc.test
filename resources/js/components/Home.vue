<template>
    <h1>Главная</h1>
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
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col" v-for="department in departments">
                    {{department.departments_name}}
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="employee in emloyees">
                <th scope="row">{{employee.name}}</th>
                <th scope="row" v-for="department in departments">
                    <i class="bi bi-check" v-for="edep in employee.departments">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16" v-if="edep.id === department.id">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                    </i>
                </th>
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
            departments: [],
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
            })
    }
}
</script>


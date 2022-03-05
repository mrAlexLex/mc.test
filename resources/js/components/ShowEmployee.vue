<template>
    <h1>{{ name }}</h1>
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
        <div class="alert alert-success" role="alert" v-if="success">
            Данные изменены!
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <input type="text" v-model="name"
                   class="form-control"
                   id="name"
                   placeholder="Имя" required>
            <div class="invalid-feedback">
                Сообщение об ошибке.
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <input type="text" v-model="surname"
                   class="form-control"
                   id="surname"
                   placeholder="Фамилия" required>
            <div class="invalid-feedback">
                Сообщение об ошибке.
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <input type="text" v-model="patronymic"
                   class="form-control"
                   id="patronymic"
                   placeholder="Отчество" required>
            <div class="invalid-feedback">
                Сообщение об ошибке.
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="male" value="male" v-model="gender">
                <label for="male">Мужской</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="female" value="female" v-model="gender">
                <label for="female">Женский</label>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <input type="text" v-model="wage"
                   class="form-control"
                   id="gender"
                   placeholder="З/П" required
                   data-bind="value:replyNumber"
            >
            <div class="invalid-feedback">
                Сообщение об ошибке.
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <select class="custom-select" multiple v-model="employee_departments">
                <option
                    v-for="department in departments"
                    v-bind:value='department.id'
                    selected="selected"
                >
                    {{ department.departments_name }}
                </option>
            </select>
            <div class="invalid-feedback">
                Сообщение об ошибке.
            </div>
        </div>
    </div>
    <div class="form-row">
        <button type="button" class="btn btn-outline-primary" @click="saveEmployee">Сохранить</button>
    </div>
</template>

<script>
export default {
    props: [
        'employeeId'
    ],
    data() {
        return {
            employee: [],
            departments: [],
            employee_departments: [],
            name: null,
            surname: null,
            patronymic: null,
            gender: null,
            wage: null,
            errors: false,
            success: false,
            loading: true
        }
    },
    methods: {
        saveEmployee() {
            axios.post('/api/v1/employee/' + this.employeeId, {
                _method: 'PUT',
                name: this.name,
                surname: this.surname,
                patronymic: this.patronymic,
                gender: this.gender,
                wage: this.wage,
                departments: this.employee_departments
            })
                .then(response => {
                    this.success = false
                    console.log(response);
                })
                .catch(error => {
                    console.log(error)
                    this.errors = true
                })
                .finally(() => {
                    this.success = true
                    this.loading = false
                })
        },
        getDepartments() {
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
        },
        getEmployye() {
            axios.get('/api/v1/employee/' + this.employeeId)
                .then(response => {
                    this.name = response.data.data.name
                    this.surname = response.data.data.surname
                    this.patronymic = response.data.data.patronymic
                    this.gender = response.data.data.gender
                    this.wage = response.data.data.wage
                    this.employee_departments = response.data.data.departments
                })
                .catch(error => {
                    console.log(error)
                    this.errors = true
                })
                .finally(() => {
                    this.loading = false
                })
        },
    },
    mounted() {
        this.getDepartments()
        this.getEmployye()
    }
}
</script>

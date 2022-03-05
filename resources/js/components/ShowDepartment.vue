<template>
    <h1>{{ departments_name }}</h1>
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
            <label for="validationDefault03">Наименование отдела</label>
            <input type="text" v-model="departments_name"
                   class="form-control"
                   id="validationDefault03"
                   placeholder="Наименование отдела" required>
            <div class="invalid-feedback">
                Сообщение об ошибке.
            </div>
        </div>
    </div>
    <div class="form-row">
        <button type="button" class="btn btn-outline-primary" @click="saveDepartment">Сохранить</button>
    </div>
</template>

<script>
export default {
    props: [
        'departmentId'
    ],
    data() {
        return {
            department: [],
            departments_name: null,
            errors: false,
            success: false,
            loading: true
        }
    },
    methods: {
        getDepartment() {
            axios.get('/api/v1/department/' + this.departmentId)
                .then(response => {
                    this.departments_name = response.data.data.departments_name
                })
                .catch(error => {
                    console.log(error)
                    this.errors = true
                })
                .finally(() => {
                    this.loading = false
                })
        },
        saveDepartment() {
            axios.post('/api/v1/department/' + this.departmentId, {
                _method: 'PUT',
                departments_name: this.departments_name
            })
            .then(response => {
                this.success = true
            })
            .catch(error => {
                console.log(error)
                this.errors = true
                this.success = false
            })
            .finally(() => {
                this.success = true
                this.loading = false
            })
        }
    },
    mounted() {
        this.getDepartment()
    }
}
</script>

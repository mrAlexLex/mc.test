<template>
    <h1>Добавить отдел</h1>
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
            Отдел добавлен
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
        <button type="button" class="btn btn-outline-primary" @click="createDepartment">Сохранить</button>
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
            loading: false
        }
    },
    methods: {
        createDepartment() {
            axios.post('/api/v1/department/', {
                departments_name: this.departments_name
            })
                .then(response => {
                    this.loading = true
                    this.success = true
                    this.errors = false
                    this.department = response.data.data
                })
                .catch(error => {
                    console.log(error)
                    this.errors = true
                    this.success = false
                })
                .finally(() => {
                    this.loading = false
                })
        }
    }
}
</script>

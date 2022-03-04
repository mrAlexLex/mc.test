<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <router-link to="/" class="nav-link">Главная</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="employee" class="nav-link">Сотрудники</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="department" class="nav-link">Отделы</router-link>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <router-view></router-view>
    </div>
</template>

<script>
export default {

}
</script>

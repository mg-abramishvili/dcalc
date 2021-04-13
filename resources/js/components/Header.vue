<template>
    <header class="bg-light mb-4">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light p-0 py-2">
                <router-link class="navbar-brand" to="/">DreamApp</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <router-link class="nav-link" to="/">Главная</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/calculations">Расчеты</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/elements">Компоненты</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/users">Пользователи</router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <router-link class="nav-link dropdown-toggle" to="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </router-link>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <router-link class="dropdown-item" to="#">Action</router-link>
                                <router-link class="dropdown-item" to="#">Another action</router-link>
                            <div class="dropdown-divider"></div>
                                <router-link class="dropdown-item" to="#">Something else here</router-link>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>
    export default {
        data() {
            return {
                moment: moment
            }
        },
        created() {
        },
        components: {
        }
    }
</script>
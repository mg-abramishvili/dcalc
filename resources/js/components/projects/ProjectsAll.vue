<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Проекты</h1>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <router-link :to="{name: 'ProjectCreate'}" class="btn btn-primary">Добавить</router-link>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Название проекта</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="project in projects" :key="project.id">
                            <td class="align-middle">{{ project.id }}</td>
                            <td class="align-middle">{{ project.name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                projects: []
            }
        },
        created() {
            axios
                .get('/api/projects')
                .then(response => (
                    this.projects = response.data
                ));
        },
        components: {
        }
    }
</script>
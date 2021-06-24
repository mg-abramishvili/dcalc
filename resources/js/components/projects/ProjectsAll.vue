<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Проекты</h1>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <!--<router-link :to="{name: 'ProjectCreate'}" class="btn btn-primary">Добавить</router-link>-->
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Название проекта</th>
                            <th scope="col">Ответственный</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="project in projects" :key="project.id" @click="goTo(project.id)">
                            <td class="align-middle">{{ project.id }}</td>
                            <td class="align-middle">{{ project.name }}</td>
                            <td class="align-middle">
                                <template v-for="user in project.users">
                                    <img src="/img/profile.png" width="48" height="48" class="rounded-circle me-2">
                                    {{ user.name }}
                                </template>
                            </td>
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
        methods: {
            goTo(id) {
                this.$router.push({ name: 'ProjectItem', params: { id: id } });
            }
        },
        components: {
        }
    }
</script>
<style scoped>
    .table tr:hover {
        cursor: pointer;
    }
</style>
<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Пользователи</h1>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <router-link to="/users/create" class="btn btn-primary">Добавить</router-link>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Имя</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <template v-if="user.id !== 9999">
                                <td class="align-middle">{{ user.id }}</td>
                                <td class="align-middle">{{ user.name }}</td>
                                <td class="align-middle">{{ user.email }}</td>
                                <td class="align-middle text-end">
                                    <router-link :to="{name: 'UserEdit', params: {id: user.id}}" class="btn btn-warning">Правка</router-link>
                                </td>
                            </template>
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
                users: []
            }
        },
        created() {
            axios
                .get('/api/users')
                .then(response => (
                    this.users = response.data
                ));
        },
        components: {
        }
    }
</script>
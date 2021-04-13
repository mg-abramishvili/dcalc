<template>
    <div>
        <h1 class="mt-0 mb-4">Пользователи</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Имя</th>
                    <th scope="col">E-mail</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                </tr>
            </tbody>
        </table>
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
<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Клиенты</h1>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <router-link :to="{name: 'ClientCreate'}" class="btn btn-primary">Добавить</router-link>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">ИНН</th>
                            <th scope="col">Телефон</th>
                            <th scope="col">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="client in clients" :key="client.id">
                            <td class="align-middle">{{ client.name }}</td>
                            <td class="align-middle">{{ client.inn }}</td>
                            <td class="align-middle">{{ client.phone }}</td>
                            <td class="align-middle">{{ client.email }}</td>
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
                clients: []
            }
        },
        created() {
            axios
                .get('/api/clients')
                .then(response => (
                    this.clients = response.data
                ));
        },
        components: {
        }
    }
</script>
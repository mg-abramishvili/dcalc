<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Партнеры</h1>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <router-link :to="{name: 'PartnerCreate'}" class="btn btn-primary">Добавить</router-link>
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
                        <tr v-for="partner in partners" :key="partner.id">
                            <td class="align-middle">{{ partner.name }}</td>
                            <td class="align-middle">{{ partner.inn }}</td>
                            <td class="align-middle">{{ partner.phone }}</td>
                            <td class="align-middle">{{ partner.email }}</td>
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
                partners: []
            }
        },
        created() {
            axios
                .get('/api/partners')
                .then(response => (
                    this.partners = response.data
                ));
        },
        components: {
        }
    }
</script>
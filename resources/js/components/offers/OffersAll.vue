<template>
    <div>

        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Коммерческие предложения</h1>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <!--<router-link to="/offers/create" class="btn btn-primary">Новое КП</router-link>-->
            </div>
        </div>

        <div class="card">
            <div class="card-body pt-1">
                <table class="table table-striped table-hover dataTable no-footer dtr-inline">
                    <thead>
                        <tr>
                            <th>Автор КП</th>
                            <th>Клиент</th>
                            <th class="text-end">Дата создания</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="offer in offers" :key="offer.id" @click="goTo(offer.id)">
                            <td class="align-middle">
                                <img src="/img/profile.png" width="48" height="48" class="rounded-circle me-2" alt="Avatar">
                                <template v-for="user in offer.users">
                                    {{ user.name }}
                                </template>
                            </td>
                            <td class="align-middle">
                                {{ offer.client }}
                            </td>
                            <td class="align-middle text-end">
                                {{moment(offer.created_at).format('D MMMM YYYY')}}
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
                offers: [],
                moment: moment,
            }
        },
        created() {
            axios
                .get('/api/offers')
                .then(response => (
                    this.offers = response.data
                ));
        },
        methods: {
            goTo(id) {
                this.$router.push({ name: 'OfferItem', params: { id: id } });
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
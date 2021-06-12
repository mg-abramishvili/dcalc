<template>
    <div>

        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Расчеты</h1>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <router-link to="/calculations/create" class="btn btn-primary">Новый расчет</router-link>
            </div>
        </div>

        <div class="card">
            <div class="card-body pt-1">
                <table class="table table-striped table-hover dataTable no-footer dtr-inline">
                    <thead>
                        <tr>
                            <th>Автор расчета</th>
                            <th>№</th>
                            <th>Комментарий</th>
                            <th class="text-end">Дата расчета</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="calculation in calculations" :key="calculation.id" @click="goTo(calculation.id)">
                            <td class="align-middle">
                                <img src="https://appstack.bootlab.io/img/avatars/avatar-3.jpg" width="48" height="48" class="rounded-circle me-2" alt="Avatar"> Петр Иванов
                            </td>
                            <td class="align-middle">
                                Расчет №{{ calculation.id }}
                            </td>
                            <td class="align-middle">
                                {{ calculation.comment }}
                            </td>
                            <td class="align-middle text-end">
                                {{moment(calculation.created_at).format('D MMMM YYYY')}}
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
                calculations: [],
                moment: moment,
            }
        },
        created() {
            axios
                .get('/api/calculations')
                .then(response => (
                    this.calculations = response.data
                ));
        },
        methods: {
            goTo(id) {
                this.$router.push({ name: 'CalculationItem', params: { id: id } });
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
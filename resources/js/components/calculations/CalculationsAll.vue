<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="m-0">Расчеты</h1>
            </div>
            <div class="col-12 col-lg-6 text-right">
                <router-link to="/calculations/create" class="btn btn-info">Новый расчет</router-link>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <tbody>
                <tr v-for="calculation in calculations" :key="calculation.id" @click="goTo(calculation.id)">
                    <td class="align-middle">
                        <span class="font-weight-bold text-primary">
                            №{{ calculation.id }}
                        </span>
                        <br>
                        <span class="text-muted">
                            {{ calculation.comment }}
                        </span>
                    </td>
                    <td class="align-middle text-right">
                        {{moment(calculation.created_at).format('D MMMM YYYY')}}
                    </td>
                </tr>
            </tbody>
        </table>
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
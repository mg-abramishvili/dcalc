<template>
    <div>
        <h1 class="h3 mb-4">Расчет №{{ calculation.id }} от {{moment(calculation.created_at).format('D MMMM YYYY')}}</h1>
        <div class="card">
            <div class="card-body">
                
                
                <table class="table table-striped table-hover dataTable no-footer dtr-inline">
                    <thead>
                        <th>
                            Наименование
                        </th>
                        <th class="text-end">
                            Цена
                        </th>
                    </thead>
                    <tbody>
                        <tr v-for="element in calculation.elements">
                            <td>{{ element.title }}</td>
                            <td class="text-end">{{ element.price }} ₽</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-4">
                    Итого: <strong class="text-primary">{{ calculation.price_total }} ₽</strong>
                    <p class="mb-0 mt-4">{{ calculation.comment }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                calculation: {},
                moment: moment,
            }
        },
        created() {
            axios
                .get(`/api/calculation/${this.$route.params.id}`)
                .then(response => (
                    this.calculation = response.data
                ));
        },
        components: {
        }
    }
</script>
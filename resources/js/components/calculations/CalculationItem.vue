<template>
    <div>
        <h2>Расчет №{{ calculation.id }}</h2>
        <p>{{ calculation.comment }}</p>
        <p>{{moment(calculation.created_at).format('D MMMM YYYY')}}</p>
        
        <table class="table table-bordered table-hover">
            <thead>
                <th>
                    Наименование
                </th>
                <th>
                    Кол-во
                </th>
                <th>
                    Цена
                </th>
            </thead>
            <tbody>
                <tr v-for="element in calculation.elements">
                    <td>{{ element.title }}</td>
                    <td>{{ element.pivot.amount }}</td>
                    <td>{{ element.pivot.price }}</td>
                </tr>
            </tbody>
        </table>
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
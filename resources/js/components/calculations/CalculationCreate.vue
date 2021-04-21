<template>
    <div>
        <h1 class="mb-4">Новый расчет</h1>

        <table class="table table-bordered">
            <tr v-for="category in categories" :key="category.id">
                <td>
                    <h5>{{ category.title }}</h5>
                </td>
                <td>
                    <select v-model="selected">
                        <option v-for="element in elements" :key="element.id" v-bind:value="{ id: element.id, price: element.price }">{{ element.title }}</option>
                    </select>
                </td>
                <td>
                    {{selected.price}}
                </td>
            </tr>
        </table>
        <hr>
        <div class="row">
            <div class="col-6">
                Итого:
            </div>
            <div class="col-6 text-right">
                {{ offer_total }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: [],
                elements: [],
                selected: '',
                offer_total: {},
            }
        },
        created() {
            axios
                .get('/api/element-categories')
                .then(response => (
                    this.categories = response.data
                ));
            axios
                .get('/api/elements')
                .then(response => (
                    this.elements = response.data
                ));
        },
        methods: {
        },
        watch: {
        },
        components: {
        }
    }
</script>
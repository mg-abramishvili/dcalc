<template>
    <div>
        <h1 class="mb-4">Новый расчет</h1>

        <table class="table table-bordered">
            <tr v-for="(category, index) in categories" :key="index">
                <td class="w-30 align-middle">
                    <h5 class="m-0">{{ category.title }}</h5>
                </td>
                <td class="w-45 align-middle py-4">
                    <select v-model="selects[index]" @change="onChange(index, $event)" class="custom-select">
                        <template v-for="element in elements">
                            <template v-for="ect in element.categories">
                                <option v-if="ect.id === category.id" v-bind:value="{ id: element.id, price: element.price }">{{ element.title }}</option>
                            </template>
                        </template>
                    </select>
                </td>
                <td class="w-25 align-middle">
                    <input type="text" class="form-control text-right">
                </td>
            </tr>
        </table>
        <hr class="mt-4">
        <div class="row">
            <div class="col-6">
                Итого:
            </div>
            <div class="col-6 text-right">
                <h4 v-if="offer_total > 0" class="text-primary">{{ offer_total }} ₽</h4>
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
                offer_total: {},
                selects: [],
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
            onChange(index, event) {
                //console.log(this.selects);
                this.offer_total =  this.selects.reduce((acc, curr) => acc + parseInt(curr.price), 0);
            },
        },
        watch: {
        },
        components: {
        }
    }
</script>

<style scoped>
    .w-45 {
        width: 45%;
    }
    .w-40 {
        width: 40%;
    }
    .w-35 {
        width: 35%;
    }
    .w-30 {
        width: 30%;
    }
    .w-25 {
        width: 25%;
    }
</style>
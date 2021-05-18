<template>
    <div>
        <h1 class="mb-4">Новый расчет</h1>

        <table class="table table-bordered">
            <tr v-for="(category, index) in categories" :key="index">
                <td class="w-30 align-middle text-right">
                    <h5 class="m-0">{{ category.title }}</h5>
                </td>
                <td class="w-70 align-middle py-4">
                    <select v-model="selected_elements[index]" @change="onChange(index, $event)" class="custom-select">
                        <template v-for="element in elements">
                            <template v-for="ect in element.categories">
                                <option v-if="ect.id === category.id" v-bind:value="{ id: element.id, price: element.price }">{{ element.title }} — {{ element.price }} ₽</option>
                            </template>
                        </template>
                    </select>
                </td>
            </tr>
        </table>
        <hr class="mt-4">
        <textarea class="form-control mb-2" v-model="comment"></textarea>
        <div v-if="price_total > 0" class="row align-items-center">
            <div class="col-10 text-right" style="color: #888;">
                Итого:
            </div>
            <div class="col-2 text-right">
                <h4 class="text-primary m-0">{{ price_total }} ₽</h4>
            </div>
        </div>
        <button @click="saveCalculation()" class="btn btn-primary">Сохранить</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: [],
                elements: [],
                price_total: {},
                comment: '',
                selected_elements: [],
                selected_elements_amounts: [],
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
                //console.log(this.selected_elements);
                this.price_total =  this.selected_elements.reduce((acc, curr) => acc + parseInt(curr.price), 0);
            },
            saveCalculation() {
                axios
                .post('/api/calculations', { comment: this.comment, price_total: this.price_total, elements: this.selected_elements.map(element=>({id:element.id})), amounts: this.selected_elements_amounts })
                .then(response => (
                    this.$router.push({path: '/calculations'}) 
                ));
            }
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
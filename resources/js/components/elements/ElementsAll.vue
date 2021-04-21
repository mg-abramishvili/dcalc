<template>
    <div>
        <h1 class="mt-0 mb-4">
            Компоненты
            <span v-if="current_category" class="text-primary">{{ current_category.title }}</span>
        </h1>
        <div class="row">
            <div class="col-12 col-lg-3">
                <ul class="list-group">
                    <li v-for="element_category in element_categories" :key="element_category.id" @click="filter_category(element_category)" class="list-group-item">
                        <span v-if="current_category.id === element_category.id" class="text-primary">
                            {{ element_category.title }}
                        </span>
                        <span v-else>
                            {{ element_category.title }}
                        </span>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-9">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Наименование</th>
                            <th scope="col">Цена</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="element in elements" :key="element.id">
                            <td>{{ element.id }}</td>
                            <td>{{ element.title }}</td>
                            <td>{{ element.price }}</td>
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
                element_categories: [],
                elements: [],
                current_category: '',
            }
        },
        created() {
            axios
                .get('/api/element-categories')
                .then(response => (
                    this.element_categories = response.data
                ));
            axios
                .get('/api/elements')
                .then(response => (
                    this.elements = response.data
                ));
        },
        methods: {
            filter_category(element_category) {
                axios
                .get(`/api/elements/category/${element_category.id}`)
                .then(response => (
                    this.elements = response.data
                ));
                axios
                .get(`/api/element-category/${element_category.id}`)
                .then(response => (
                    this.current_category = response.data
                ));
            },
        },
        components: {
        }
    }
</script>

<style scoped>
    .list-group-item:hover {
        cursor: pointer;
    }
</style>
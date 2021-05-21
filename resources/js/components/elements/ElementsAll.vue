<template>
    <div>

        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Компоненты <span v-if="current_category" class="text-primary">{{ current_category.title }}</span></h1>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <router-link to="/elements/create" class="btn btn-primary">Новый компонент</router-link>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="list-group list-group-flush">
                        <div v-for="element_category in element_categories" @click="filter_category(element_category)">
                            <a v-if="current_category.id === element_category.id" class="list-group-item list-group-item-action active">
                                {{ element_category.title }}
                            </a>
                            <a v-else class="list-group-item list-group-item-action">
                                {{ element_category.title }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Наименование</th>
                                <th scope="col" class="text-end">Цена</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="element in elements" :key="element.id">
                                <td class="align-middle">{{ element.id }}</td>
                                <td class="align-middle">{{ element.title }}</td>
                                <td class="align-middle text-end">{{ element.price }} ₽</td>
                                <td class="align-middle text-end">
                                    <button class="btn btn-warning">Правка</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
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
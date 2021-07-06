<template>
    <div>
        <div class="card mb-2">
            <div class="list-group list-group-flush">
                <div>
                    <router-link :to="{name: 'Boxes', params: {type_id: 'all'}}" class="list-group-item list-group-item-action">
                        Корпуса
                    </router-link>
                </div>
                <div v-for="category in categories" :key="category.id">
                    <router-link :to="{name: 'ElementsByCategory', params: {id: category.id}}" class="list-group-item list-group-item-action">
                        {{ category.title }}
                    </router-link>
                </div>
            </div>
        </div>
        <router-link :to="{name: 'CategoryCreate'}" class="btn btn-outline-secondary btn-sm">добавить категорию</router-link>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: [],
                types: {},
            }
        },
        created() {
            axios
                .get('/api/categories')
                .then(response => (
                    this.categories = response.data
                ));
        },
        methods: {
        },
        components: {
        }
    }
</script>

<style scoped>
    .list-group-item:hover {
        cursor: pointer;
    }

    .list-group-item a {
        color: #212529;
        
    }
</style>
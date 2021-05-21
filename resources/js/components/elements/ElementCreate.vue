<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новый компонент</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <label>Название</label>
                <input v-model="title" type="text" class="form-control mb-3">
                <label>Цена</label>
                <input v-model="price" type="text" class="form-control mb-3">
                <label>Категория</label>
                <select v-model="categories_selected" class="form-control mb-3">
                    <template v-for="category in categories">
                        <option :value="category.id">{{ category.title }}</option>
                    </template>
                </select>
                <button @click="saveCalculation()" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: {},
                categories_selected: '',
                title: '',
                price: '',
            }
        },
        created() {
            axios
                .get('/api/element-categories')
                .then(response => (
                    this.categories = response.data
                ));
        },
        methods: {
            onChange(index, event) {
                
            },
            saveCalculation() {
                axios
                .post('/api/elements', { title: this.title, price: this.price, categories: this.categories_selected })
                .then(response => (
                    this.$router.push({path: '/elements'}) 
                ));
            }
        },
        watch: {
        },
        components: {
        }
    }
</script>
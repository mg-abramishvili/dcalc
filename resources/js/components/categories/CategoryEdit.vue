<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">{{ category.title }}</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <label id="title_label">Название</label>
                <input v-model="title" type="text" class="form-control mb-3">

                <div class="d-flex justify-content-between">
                    <button @click="saveCategory()" class="btn btn-primary">Сохранить</button>
                    <button @click="deleteCategory()" class="btn btn-outline-danger">Удалить категорию</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                category: {},
                title: '',
            }
        },
        created() {
            axios
                .get(`/api/category/${this.$route.params.id}`)
                .then(response => (
                    this.category = response.data,
                    this.title = response.data.title
                ));
        },
        methods: {
            saveCategory() {
                axios
                .post(`/api/category/${this.$route.params.id}/edit`, {
                    id: this.category.id,
                    title: this.title,
                })
                .then(response => (
                    this.$router.push({path: '/elements'}) 
                ))
            },
            deleteCategory(id) {
                if(this.category.elements.length) {
                    alert('Невозможно удалить категорию - категория не пуста!')
                } else {
                    axios
                    .get(`/api/category/${this.$route.params.id}/delete`)
                    .then(response => (
                        this.$router.push({path: '/elements'})
                    ));
                }
                
            },
        },
        watch: {
        },
        components: {
        }
    }
</script>

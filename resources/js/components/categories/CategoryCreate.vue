<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новая категория</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <label id="title_label">Название</label>
                <input v-model="title" type="text" class="form-control mb-3">

                <label id="title_label">Код</label>
                <input v-model="slug" type="text" class="form-control mb-3">

                <div>
                    <button @click="saveCategory()" class="btn btn-primary">Сохранить</button>
                    <router-link :to="{name: 'Elements'}" class="btn btn-default">Отмена</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                title: '',
                slug: '',
            }
        },
        created() {
        },
        methods: {
            saveCategory() {
                axios
                .post('/api/categories', { title: this.title, slug: this.slug })
                .then(response => (
                    this.$router.push({path: '/elements'}) 
                ));
            },
        },
        watch: {
        },
        components: {
        }
    }
</script>

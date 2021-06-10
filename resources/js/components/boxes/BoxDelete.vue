<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 mb-4">Удалить <strong>{{ box.title }}</strong>?</h1>
                <button @click="deleteBox(box.id)" class="btn btn-danger">Удалить</button>
                <router-link :to="{name: 'Elements'}" class="btn btn-default">Отмена</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                box: {},
            }
        },
        created() {
            axios
                .get(`/api/box/${this.$route.params.id}`)
                .then(response => (
                    this.box = response.data
                ));
        },
        methods: {
            deleteBox(id) {
                axios
                .get(`/api/box/${id}/delete`)
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
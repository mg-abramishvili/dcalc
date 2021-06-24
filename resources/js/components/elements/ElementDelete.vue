<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 mb-4">Удалить <strong>{{ element.title }}</strong>?</h1>
                <button @click="deleteElement(element.id)" class="btn btn-danger">Удалить</button>
                <router-link :to="{name: 'Elements'}" class="btn btn-default">Отмена</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                element: {},
            }
        },
        created() {
            axios
                .get(`/api/element/${this.$route.params.id}`)
                .then(response => (
                    this.element = response.data
                ));
        },
        methods: {
            deleteElement(id) {
                axios
                .get(`/api/element/${id}/delete`)
                .then(response => (
                    this.$parent.counterElementsBoxes(),
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
<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новая новость</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                Новость:
                <textarea class="form-control mb-2" v-model="text"></textarea>
                <button @click="saveAnnouncement()" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                text: '',
            }
        },
        created() {
        },
        methods: {
            onChange(index, event) {
                
            },
            saveAnnouncement() {
                axios
                .post('/api/announcements', { text: this.text })
                .then(response => (
                    this.$router.push({path: '/announcements'}) 
                ));
            }
        },
        watch: {
        },
        components: {
        }
    }
</script>
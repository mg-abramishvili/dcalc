<template>
    <div>

        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новости</h1>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <router-link to="/announcements/create" class="btn btn-primary">Добавить новость</router-link>
            </div>
        </div>




                <div v-for="announcement in announcements" :key="announcement.id" class="card mb-3 border">
                    <div class="card-body p-3">
                        <h6 class="card-subtitle text-muted mb-3">21.05.2021</h6>
                        <p>{{announcement.text}}</p>
                    </div>
                </div>



    </div>
</template>

<script>
    export default {
        data() {
            return {
                announcements: [],
                moment: moment,
            }
        },
        created() {
            axios
                .get('/api/announcements')
                .then(response => (
                    this.announcements = response.data
                ));
        },
        methods: {
        },
        components: {
        }
    }
</script>
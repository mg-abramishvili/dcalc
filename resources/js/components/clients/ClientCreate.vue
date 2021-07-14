<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новый конечник</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label id="name_label">Имя / Название</label>
                    <input v-model="name" id="name_input" type="text" class="form-control mb-3">
                </div>

                <div class="form-group">
                    <label id="inn_label">ИНН</label>
                    <input v-model="inn" id="inn_input" type="text" class="form-control mb-3">
                </div>

                <div class="form-group">
                    <label id="phone_label">Телефон</label>
                    <input v-model="phone" id="phone_input" type="text" class="form-control mb-3">
                </div>

                <div class="form-group">
                    <label id="email_label">E-mail</label>
                    <input v-model="email" id="email_input" type="text" class="form-control mb-3">
                </div>

                <div>
                    <button @click="saveProject()" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                inn: '',
                phone: '',
                email: '',
            }
        },
        created() {
        },
        methods: {
            saveProject() {
                axios
                .post('/api/clients', { name: this.name, inn: this.inn, phone: this.phone, email: this.email })
                .then(response => (
                    this.$parent.counterClients(),
                    this.$router.push({path: '/clients'}) 
                ));
            },
        },
        watch: {
        },
        components: {
        }
    }
</script>

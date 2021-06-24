<template>
    <div>
        <h1 class="h3 mb-4">{{ user.name }}</h1>
        <div class="card">
            <div class="card-body">

                <div v-if="error_alert" class="alert alert-danger alert-dismissible" role="alert">
                    <div class="alert-message">
                        {{ error_message }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Имя</label>
                    <input v-model="name" type="text" class="form-control" placeholder="Имя">
                </div>
                <div class="mb-3">
                    <label class="form-label">E-mail (логин)</label>
                    <input v-model="email" type="text" class="form-control" placeholder="E-mail">
                </div>
                <!--<div class="mb-3">
                    <label class="form-label">Изменить пароль:</label>
                    <input v-model="password" type="password" class="form-control" placeholder="Новый пароль">
                </div>-->

                <button @click="updateProfile()" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
				user: {},

                name: '',
                email: '',
                password: '',

                error_alert: false,
                error_message: '',
            }
        },
        created() {
			/*axios.post('/api/me').then(response => {
                this.user = response.data,
                this.email = response.data.email,
                this.name = response.data.name
            });*/
            axios.get(`/api/user/${this.$route.params.id}`).then(response => {
                this.user = response.data,
                this.email = response.data.email,
                this.name = response.data.name
            });
        },
		methods: {
            updateProfile() {
                this.error_alert = false
                
                axios
                .post(`/api/user/${this.$route.params.id}/edit`, {
                    id: this.user.id,
                    name: this.name,
                    email: this.email,
                })
                .then((response => {
                    this.$router.push({name: 'Users'})
                }))
                .catch((error) => {
                    if(error.response) {
                        var errors = []
                        for(var key in error.response.data.errors){
                            if(key === 'name') {
                                errors.push('Имя')
                            }
                            if(key === 'email') {
                                errors.push('E-mail')
                            }
                        }
                        this.error_message = 'Не заполнено: ' + errors
                        this.error_alert = true
                    }
                });
            }
		},
        components: {
        }
    }
</script>
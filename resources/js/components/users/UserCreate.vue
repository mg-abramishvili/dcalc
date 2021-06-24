<template>
    <div>
        <h1 class="h3 mb-4">Новый пользователь</h1>
        <div class="card">
            <div class="card-body">

                <template v-if="error_alert">
                <div v-for="msg in error_message" class="alert alert-danger alert-dismissible mb-2" role="alert">
                    <div class="alert-message">
                        {{ msg }}
                    </div>
                </div>
                </template>

                <div class="mb-3">
                    <label class="form-label">Имя</label>
                    <input v-model="name" type="text" class="form-control" placeholder="Имя">
                </div>
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input v-model="email" type="text" class="form-control" placeholder="E-mail">
                </div>
                <div class="mb-3">
                    <label class="form-label">Пароль</label>
                    <input v-model="password" type="text" class="form-control" placeholder="Пароль">
                </div>

                <!--
                <div class="mb-3 row">
					<label class="col-form-label col-sm-6 text-sm-right pt-sm-0">Может создавать расчеты</label>
                    <div class="col-sm-6">
                        <label class="form-check m-0">
                            <input type="checkbox" class="form-check-input">
                            <span class="form-check-label"></span>
                        </label>
                    </div>
				</div>

                <div class="mb-3 row">
					<label class="col-form-label col-sm-6 text-sm-right pt-sm-0">Может создавать КП</label>
                    <div class="col-sm-6">
                        <label class="form-check m-0">
                            <input type="checkbox" class="form-check-input">
                            <span class="form-check-label"></span>
                        </label>
                    </div>
				</div>

                <div class="mb-3 row">
					<label class="col-form-label col-sm-6 text-sm-right pt-sm-0">Может редактировать каталог</label>
                    <div class="col-sm-6">
                        <label class="form-check m-0">
                            <input type="checkbox" class="form-check-input">
                            <span class="form-check-label"></span>
                        </label>
                    </div>
				</div>

                <div class="mb-3 row">
					<label class="col-form-label col-sm-6 text-sm-right pt-sm-0">Может назначать задачи другим пользователям</label>
                    <div class="col-sm-6">
                        <label class="form-check m-0">
                            <input type="checkbox" class="form-check-input">
                            <span class="form-check-label"></span>
                        </label>
                    </div>
				</div>
                -->

                <button @click="storeUser()" class="btn btn-primary">Добавить</button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',

                error_alert: false,
                error_message: '',
            }
        },
        created() {
        },
		methods: {
            storeUser() {
                this.error_alert = false
                
                axios
                .post('/api/users', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                })
                .then((response => {
                    this.$parent.counterUsers()
                    this.$router.push({name: 'Users'})
                }))
                .catch((error) => {
                    if(error.response) {
                        var errors = []
                        for(var key in error.response.data.errors){
                            if(key === 'name') {
                                errors.push('Не указано имя')
                            }
                            if(key === 'email') {
                                errors.push('Не указан E-mail или такой адрес уже занят другим пользователем')
                            }
                            if(key === 'password') {
                                errors.push('Не указан пароль')
                            }
                        }
                        this.error_message = errors
                        this.error_alert = true
                    }
                });
            }
		},
        components: {
        }
    }
</script>
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
                    <label class="form-label">E-mail (логин)</label>
                    <input v-model="email" type="text" class="form-control" placeholder="E-mail">
                </div>
                <div class="mb-3">
                    <label class="form-label">Пароль</label>
                    <input v-model="password" type="text" class="form-control" placeholder="Пароль">
                </div>

                <div class="user_permissions mt-4">
                    <div class="d-block mb-3">
                        <input type="checkbox" v-model="elements_prices" true-value="true" false-value="false" id="elements_prices" class="checkbox_custom_input" />
                        <label for="elements_prices" class="checkbox_custom_label"></label>
                        <span class="checkbox_custom_span">Может видеть цены компонентов и корпусов</span>
                    </div>
                    <div>
                        <input type="checkbox" v-model="elements_edit" true-value="true" false-value="false" id="elements_edit" class="checkbox_custom_input" />
                        <label for="elements_edit" class="checkbox_custom_label"></label>
                        <span class="checkbox_custom_span">Может редактировать компоненты и корпуса</span>
                    </div>
                </div>

                <button @click="storeUser()" class="btn btn-primary mt-4">Добавить</button>
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

                elements_edit: 'false',
                elements_prices: 'false',

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
                    elements_prices: this.elements_prices,
                    elements_edit: this.elements_edit
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
<style scoped>
    .checkbox_custom_label {
        cursor: pointer;
        text-indent: -9999px;
        width: 34px;
        height: 18px;
        background: grey;
        display: inline-block;
        vertical-align: middle;
        border-radius: 100px;
        position: relative;
    }
    .checkbox_custom_label:after {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        width: 14px;
        height: 14px;
        background: #fff;
        border-radius: 90px;
        transition: 0.3s;
    }
    .checkbox_custom_label:active:after {
        width: 15px;
    }
    .checkbox_custom_input {
        height: 0;
        width: 0;
        visibility: hidden;
    }
    .checkbox_custom_input:checked + .checkbox_custom_label {
        background: #3f80ea;
    }
    .checkbox_custom_input:checked + .checkbox_custom_label:after {
        left: calc(100% - 2px);
        transform: translateX(-100%);
    }
    .checkbox_custom_span {
        display: inline-block;
        vertical-align: middle;
        margin-left: 5px;
    }
    .user_permissions {
        background-color: #f5f5f5;
        padding: 25px;
        border-radius: 4px;
    }
</style>
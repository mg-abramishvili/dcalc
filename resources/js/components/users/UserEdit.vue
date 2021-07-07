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

                <div class="user_permissions mt-4">
                    <div class="d-block mb-3">
                        <input type="checkbox" v-model="elements_prices" true-value="1" false-value="0" id="elements_prices" class="checkbox_custom_input" />
                        <label for="elements_prices" class="checkbox_custom_label"></label>
                        <span class="checkbox_custom_span">Может видеть цены компонентов и корпусов</span>
                    </div>
                    <div>
                        <input type="checkbox" v-model="elements_edit" true-value="1" false-value="0" id="elements_edit" class="checkbox_custom_input" />
                        <label for="elements_edit" class="checkbox_custom_label"></label>
                        <span class="checkbox_custom_span">Может редактировать компоненты и корпуса</span>
                    </div>
                </div>

                <button @click="updateProfile()" class="btn btn-primary mt-4">Сохранить</button>
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

                elements_edit: '',
                elements_prices: '',

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
                this.elements_prices = response.data.elements_prices,
                this.elements_edit = response.data.elements_edit
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
                    elements_prices: this.elements_prices,
                    elements_edit: this.elements_edit,
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
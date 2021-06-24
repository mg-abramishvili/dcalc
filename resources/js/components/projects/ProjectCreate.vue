<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новый проект</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label id="name_label">Название</label>
                    <input v-model="name" id="name_input" type="text" class="form-control mb-3">
                </div>

                <div class="form-group">
                    <label id="status_label">Статус</label>
                    <select v-model="status" id="status_input" class="form-control mb-3">
                        <option value="in_works">В работе</option>
                        <option value="waiting_for_review">Ждет отзыва клиента</option>
                        <option value="warehouse">Склад</option>
                        <option value="new">Новый</option>
                    </select>
                </div>

                <div class="form-group">
                    <label id="priority_label">Приоритет</label>
                    <select v-model="priority" id="priority_input" class="form-control mb-3">
                        <option value="normal">Нормальный</option>
                        <option value="high">Срочный</option>
                    </select>
                </div>

                <div class="form-group">
                    <label id="deadline_label">Срок сдачи</label>
                    <input v-model="deadline" id="deadline_input" type="date" class="form-control mb-3">
                </div>

                <div class="form-group">
                    <label id="payment_label">Оплата</label>
                    <select v-model="payment" id="payment_input" class="form-control mb-3">
                        <option value="pre100">Предоплата 100%</option>
                        <option value="pre50">Предоплата 50%</option>
                        <option value="after">Оплата после поставки</option>
                    </select>
                </div>

                <div class="form-group">
                    <label id="description_label">Описание</label>
                    <textarea v-model="description" id="description_input" class="form-control mb-3"></textarea>
                </div>

                <div class="form-group">
                    <label id="users_label">Ответственный</label>
                    <select v-model="users" id="users_input" class="form-control mb-3">
                        <option v-for="user in users_data" :value="user.id">{{ user.name }}</option>
                    </select>
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
                status: '',
                priority: '',
                deadline: '',
                payment: '',
                description: '',
                users: '',

                users_data: {},

                calculation_id: '',
            }
        },
        created() {
            this.calculation_id = this.$route.params.calculation_id

            axios
                .get('/api/users')
                .then(response => (
                    this.users_data = response.data
                ));
        },
        methods: {
            saveProject() {
                axios
                .post('/api/projects', { name: this.name, status: this.status, priority: this.priority, deadline: this.deadline, payment: this.payment, description: this.description, calculation_id: this.calculation_id, users: this.users })
                .then(response => (
                    this.$parent.counterProjects(),
                    this.$router.push({path: '/projects'}) 
                ));
            },
        },
        watch: {
        },
        components: {
        }
    }
</script>

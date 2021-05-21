<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новая задача</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <label>Кому</label>
                <select v-model="user_selected" class="form-control mb-3">
                    <template v-for="user in users">
                        <option :value="user.id">{{ user.name }}</option>
                    </template>
                </select>
                Задача:
                <textarea class="form-control mb-2" v-model="task"></textarea>
                <button @click="saveTask()" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: {},
                user_selected: '',
                task: '',
            }
        },
        created() {
            axios
                .get('/api/users')
                .then(response => (
                    this.users = response.data
                ));
        },
        methods: {
            onChange(index, event) {
                
            },
            saveTask() {
                axios
                .post('/api/tasks', { task: this.task, users: this.user_selected })
                .then(response => (
                    this.$router.push({path: '/tasks'}) 
                ));
            }
        },
        watch: {
        },
        components: {
        }
    }
</script>
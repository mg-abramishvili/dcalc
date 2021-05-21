<template>
    <div>

        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Задачи</h1>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <router-link to="/tasks/create" class="btn btn-primary">Новая задача</router-link>
            </div>
        </div>




                <div v-for="task in tasks" :key="task.id" class="card mb-3 border">
                    <div class="card-body p-3">
                        <div class="float-end mr-n2">
                            <button class="btn btn-success">Готово!</button>
                        </div>
                        <h6 class="card-subtitle text-muted mb-3">от: Петр Иванов</h6>
                        <p>{{task.task}}</p>
                    </div>
                </div>



    </div>
</template>

<script>
    export default {
        data() {
            return {
                tasks: [],
                moment: moment,
            }
        },
        created() {
            axios
                .get('/api/tasks')
                .then(response => (
                    this.tasks = response.data
                ));
        },
        methods: {
        },
        components: {
        }
    }
</script>
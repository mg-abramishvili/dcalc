<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новое КП</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <label>Клиент</label>
                <input v-model="client" type="text" class="form-control mb-3">
                
                <label>Расчет</label>
                <select v-model="calculation_selected" class="form-control mb-3" disabled>
                    <template v-for="calculation in calculations">
                        <option :value="calculation.id">Расчет №{{ calculation.id }}</option>
                    </template>
                </select>

                Текст КП:
                <textarea class="form-control mb-2" v-model="comment"></textarea>
                <button @click="saveCalculation()" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                calculations: {},
                calculation_selected: this.$route.params.calculation_id,
                comment: '',
                client: '',
            }
        },
        created() {
            axios
                .get('/api/calculations')
                .then(response => (
                    this.calculations = response.data
                ));
        },
        methods: {
            onChange(index, event) {
                
            },
            saveCalculation() {
                axios
                .post('/api/offers', { client: this.client, comment: this.comment, calculations: this.calculation_selected, user: this.$parent.user.id })
                .then(response => (
                    this.$router.push({path: '/offers'}) 
                ));
            }
        },
        watch: {
        },
        components: {
        }
    }
</script>
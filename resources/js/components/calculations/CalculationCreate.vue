<template>
    <div>
        <h1 class="mb-4">Новый расчет</h1>

            <table class="table table-bordered table-hover mb-4">
                <tbody>
                    <tr>
                        <td>
                            <select v-model="formElement" class="custom-select">
                                <option v-for="element in elements" :key="element.id" :value="element.id">{{ element.title }}</option>
                            </select>
                        </td>
                        <td>
                            <input v-model="formAmount" type="text" class="form-control" value="1"/>
                        </td>
                        <td>
                            <input v-model="formPrice" type="text" class="form-control" value="1"/>
                        </td>
                    </tr>
                </tbody>
            </table>

            <textarea v-model="formComment" class="form-control mt-4"></textarea>

            <button @click="CalculationSubmit" type="submit" class="btn btn-success">Сохранить</button>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                elements: [],
                formElement: '',
                formComment: '',
                formAmount: '',
                formPrice: '',
            }
        },
        created() {
            axios
                .get('/api/elements')
                .then(response => (
                    this.elements = response.data
                ));
        },
        methods: {
            CalculationSubmit() {
                axios.post('/api/calculations', {
                    formComment: this.formComment,
                    formElement: this.formElement,
                    formAmount: this.formAmount,
                    formPrice: this.formPrice,
                })
                .then((response) => {
                    //console.log(response);
                    this.$router.push({name: 'Calculations'})
                }, (error) => {
                    console.log(error);
                });
            },
        },
        components: {
        }
    }
</script>
<template>
    <div>
        <h1 class="mb-4">Новый расчет</h1>

        <table class="table table-bordered table-hover mb-4">
            <tbody>
                <tr v-for="(row, index) in rows" :key="index">
                    <td>
                        <select v-model="formElements[index]" @change="onChange(index, $event)" class="custom-select">
                            <option v-for="element in elements" :key="element.id" :value="element.id">{{ element.title }}</option>
                        </select>
                    </td>
                    <td>
                        <input v-model="formAmounts[index]" type="text" class="form-control" />
                    </td>
                    <td>
                        <input v-model="formPrices[index]" type="text" class="form-control" />
                    </td>
                    <td>
                        <span @click="deleteRow(index)" class="btn btn-outline-danger">&times;</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <span @click="addRow()" class="btn btn-secondary">+</span>
        <textarea v-model="formComment" class="form-control mt-4"></textarea>

        <button @click="CalculationSubmit" type="submit" class="btn btn-success mt-4">Сохранить</button>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                elements: [],
                rows: [],
                formElements: [],
                formAmounts: [],
                formPrices: [],
                formComment: '',
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
            addRow() {
                this.rows.push('')
            },
            deleteRow(index) {
                this.rows.splice(index, 1)
            },
            onChange(index, event) {
                //console.log(index, event.target.value);
            },
            CalculationSubmit() {
                axios.post('/api/calculations', {
                    formComment: this.formComment,
                    formElements: this.formElements,
                    formAmounts: this.formAmounts,
                    formPrices: this.formPrices,
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
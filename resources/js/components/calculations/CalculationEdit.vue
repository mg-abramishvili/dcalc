<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Расчет №{{ calculation.id }} от {{moment(calculation.created_at).format('D MMMM YYYY')}}</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <label>Тип</label>
                <select v-model="selected_types" @change="onTypeChange()" class="form-control mb-3">
                    <option v-for="type in types" v-bind:value="{ id: type.id, title: type.title }">{{ type.title }}</option>
                </select>

                <label>Корпус</label>
                <select v-model="selected_boxes" id="selected_boxes" @change="onBoxChange()" class="form-control mb-3">
                    <template v-for="box in boxes">
                        <option :value="box.id">{{ box.title }} - {{ box.price }}₽</option>
                    </template>
                </select>

                <hr>

                <div v-for="(category, index) in categories" :key="'category_' + category.id" class="mb-3">
                    <label>{{ category.title }}</label>
                    <select :name="category.slug" class="form-control mb-3">
                        <option value="none">&nbsp;</option>
                        <template v-for="element in elements">
                            <template v-for="ect in element.categories">
                                <template v-if="calculation.elements && calculation.elements.find(e => e.id === element.id)">
                                    <option v-if="ect.id === category.id" :value="element.id" selected>{{ element.title }} - {{ element.price }}₽</option>
                                </template>
                                <template v-else>
                                    <option v-if="ect.id === category.id" :value="element.id">{{ element.title }} - {{ element.price }}₽</option>
                                </template>
                            </template>
                        </template>
                    </select>
                </div>

                <hr>

                Комментарий:
                <textarea class="form-control mb-2" v-model="comment"></textarea>
                <div v-if="price_total > 0" class="row align-items-center my-4">
                    <div class="col-10 text-right" style="color: #888;">
                        Итого:
                    </div>
                    <div class="col-2 text-end">
                        <h4 class="text-primary m-0">{{ price_total }} ₽</h4>
                    </div>
                </div>
                <button @click="saveCalculation()" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                calculation: {},
                categories: [],
                elements: [],
                price_total: {},
                comment: '',
                selected_elements: [],
                selected_elements_dop: [],
                boxes: {},
                types: {},
                selected_types: '',
                selected_boxes: {},
                selected_boxes_price: '',
                moment: moment,
            }
        },
        created() {
            axios
                .get(`/api/calculation/${this.$route.params.id}`)
                .then(response => (
                    this.calculation = response.data,
                    this.selected_boxes = response.data.boxes[0].id,
                    this.comment = response.data.comment,
                    this.price_total = response.data.price_total
                ));
            axios
                .get('/api/categories')
                .then(response => (
                    this.categories = response.data
                ));
            axios
                .get('/api/elements')
                .then(response => (
                    this.elements = response.data
                ));
            axios
                .get('/api/types')
                .then(response => (
                    this.types = response.data
                ));
            axios
                .get('/api/boxes')
                .then(response => (
                    this.boxes = response.data
                ));
        },
        methods: {
            onChange(index, event) {
                this.price_total =  parseInt(this.selected_boxes_price);
            },
            onTypeChange() {
                axios
                .get(`/api/boxes/filter/${this.selected_types.id}`)
                .then(response => (
                    this.boxes = response.data
                ));
            },
            onBoxChange() {
                // Берем цену корпуса
                axios
                .get(`/api/box/${this.selected_boxes}`)
                .then(response => (
                    this.selected_boxes_price =  response.data.price,
                    this.price_total =  response.data.price
                ));
                // Фильтруем остальные детали относительно корпуса
                axios
                .get(`/api/elements/filter/box/${this.selected_boxes}`)
                .then(response => (
                    this.elements = response.data
                ));
            },
            saveCalculation() {
                var megred_select_form_values = [];
                this.categories.forEach(function(category) {
                        if(document.getElementsByName(category.slug)[0].value !== 'none') {
                            megred_select_form_values.push(document.getElementsByName(category.slug)[0].value)
                        } else {
                            console.log(category.slug + '- none')
                        }
                    }
                );
                console.log(megred_select_form_values)
                /*axios
                .post('/api/calculations', { comment: this.comment, price_total: this.price_total, boxes: this.selected_boxes.id, elements: this.selected_elements.map(element=>({id:element.id})).concat(this.selected_elements_dop.map(element=>({id:element.id}))) })
                .then(response => (
                    this.$router.push({path: '/calculations'}) 
                ));*/
            }
        },
        watch: {
        },
        components: {
        }
    }
</script>

<style scoped>
    .w-45 {
        width: 45%;
    }
    .w-40 {
        width: 40%;
    }
    .w-35 {
        width: 35%;
    }
    .w-30 {
        width: 30%;
    }
    .w-25 {
        width: 25%;
    }
</style>
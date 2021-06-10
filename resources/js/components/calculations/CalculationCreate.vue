<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новый расчет</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <label>Тип</label>
                <select v-model="selected_types" @change="onTypeChange()" class="form-control mb-3">
                    <option v-for="type in types" v-bind:value="{ id: type.id, title: type.title }">{{ type.title }}</option>
                </select>

                <label v-if="boxes.length">Корпус</label>
                <select v-if="boxes.length" v-model="selected_boxes" @change="onBoxChange()" class="form-control mb-3">
                    <option v-for="box in boxes" v-bind:value="{ id: box.id, title: box.title, price: box.price }">{{ box.title }}  — {{ box.price }} ₽</option>
                </select>

                <div v-for="(category, index) in categories" :key="index" class="mb-3">
                    <div :id="'index' + index" style="display:none">
                        <div class="col-12 col-lg-4">
                            {{ category.title }}
                        </div>
                        <div class="col-12 col-lg-4">
                            <select v-model="selected_elements[index]" @change="onChange(index, $event)" class="form-control">
                                <template v-for="element in elements">
                                    <template v-for="ect in element.categories">
                                        <option v-if="ect.id === category.id" v-bind:value="{ id: element.id, price: element.price }">{{ element.title }} — {{ element.price }} ₽</option>
                                    </template>
                                </template>
                            </select>
                        </div>
                    </div>
                </div>

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
                categories: [],
                elements: [],
                price_total: {},
                comment: '',
                selected_elements: [],
                selected_elements_amounts: [],
                boxes: {},
                types: {},
                selected_types: '',
                selected_boxes: '',
            }
        },
        created() {
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
        },
        methods: {
            onChange(index, event) {
                this.price_total =  parseInt(this.selected_boxes.price) + this.selected_elements.reduce((acc, curr) => acc + parseInt(curr.price), 0);
                if(document.getElementById('index' + (index + 1))) {
                    document.getElementById('index' + (index + 1)).style.display = "block";
                }
            },
            onTypeChange() {
                axios
                .get(`/api/boxes/filter/${this.selected_types.id}`)
                .then(response => (
                    this.boxes = response.data
                ));
            },
            onBoxChange() {
                axios
                .get(`/api/elements/filter/box/${this.selected_boxes.id}`)
                .then(response => (
                    this.elements = response.data
                ));
                var indexes = document.querySelectorAll('[id^="index"]');
                [].forEach.call(indexes, function(index) {
                index.style.display = "none";
                });
                document.getElementById('index0').style.display = "block";
                this.selected_elements = [],
                this.price_total =  parseInt(this.selected_boxes.price)
            },
            saveCalculation() {
                axios
                .post('/api/calculations', { comment: this.comment, price_total: this.price_total, boxes: this.selected_boxes.id, elements: this.selected_elements.map(element=>({id:element.id})) })
                .then(response => (
                    this.$router.push({path: '/calculations'}) 
                ));
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
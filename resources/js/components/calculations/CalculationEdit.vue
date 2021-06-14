<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Расчет №{{ calculation.id }} от {{moment(calculation.created_at).format('D MMMM YYYY')}}</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div id="selected_types">
                    <label>Тип</label>
                    <select v-model="selected_types" @change="onTypeChange()" class="form-control mb-3">
                        <option value selected>&nbsp;</option>
                        <template v-for="type in types">
                            <option :value="type.id">{{ type.title }}</option>
                        </template>
                    </select>
                </div>

                <div id="selected_boxes">
                    <label>Корпус</label>
                    <select v-model="selected_boxes" id="selected_boxes" @change="onBoxChange()" class="form-control mb-3">
                        <template v-for="box in boxes">
                            <option :value="box.id">{{ box.title }} - {{ box.price }}₽</option>
                        </template>
                    </select>
                </div>

                <div v-for="(category, index) in categories" :key="'category_' + category.id" :id="'section_' + category.slug" :class="'index' + index + ' mb-3'">
                    
                    <template v-if="reset_form === false && ele_cat && ele_cat.find(c => c === category.id)">
                        <label>{{ category.title }}</label>
                        
                        <button @click="dopElementsClone(category)" class="btn btn-sm btn-outline-secondary" style="padding: 0; height: auto; line-height: 10px; width: 15px; height: 15px;">+</button>
                        <button @click="dopElementsRemove(category)" class="btn btn-sm btn-outline-secondary" style="padding: 0; height: auto; line-height: 10px; width: 15px; height: 15px;">-</button>
                        

                        <select :name="category.slug + '[]'" @change="onChange(category, index)" class="form-control mb-3">
                            <option value selected>&nbsp;</option>
                            <template v-for="element in elements">
                                <template v-for="ect in element.categories">
                                    <template v-if="calculation.elements && calculation.elements.find(e => e.id === element.id)">
                                        <option v-if="ect.id === category.id" :value="element.id" :data-price="element.price" selected>{{ element.title }} - {{ element.price }}₽</option>
                                    </template>
                                    <template v-else>
                                        <option v-if="ect.id === category.id" :value="element.id" :data-price="element.price">{{ element.title }} - {{ element.price }}₽</option>
                                    </template>
                                </template>
                            </template>
                        </select>
                    </template>

                    <template v-if="reset_form">
                        <label>{{ category.title }}</label>
                        
                        <button @click="dopElementsClone(category)" class="btn btn-sm btn-outline-secondary" style="padding: 0; height: auto; line-height: 10px; width: 15px; height: 15px;">+</button>
                        <button @click="dopElementsRemove(category)" class="btn btn-sm btn-outline-secondary" style="padding: 0; height: auto; line-height: 10px; width: 15px; height: 15px;">-</button>

                        <select :name="category.slug + '[]'" @change="onChange(category, index)" class="form-control mb-3">
                            <option value selected>&nbsp;</option>
                            <template v-for="element in elements">
                                <template v-for="ect in element.categories">
                                    <option v-if="ect.id === category.id" :value="element.id" :data-price="element.price">{{ element.title }} - {{ element.price }}₽</option>
                                </template>
                            </template>
                        </select>
                    </template>

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
                <button @click="calc()">Пересчитать</button>
                <button @click="clear()">Сбросить</button>
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
                ele_cat: [],
                reset_form: false,
            }
        },
        created() {
            axios
                .get('/api/categories')
                .then(response => (
                    this.categories = response.data
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
            axios
                .get(`/api/calculation/${this.$route.params.id}`)
                .then((response) => {
                    this.calculation = response.data,
                    this.elements = response.data.elements,
                    this.selected_types = response.data.types[0].id,
                    this.selected_boxes = response.data.boxes[0].id,
                    this.comment = response.data.comment,
                    this.price_total = response.data.price_total

                    var ele_cat =  [];
                    this.ele_cat = ele_cat
                    this.elements.forEach((element) => {
                        ele_cat.push(element.categories[0].id)
                    })
                    console.log(ele_cat)
                })
                .then(() => {
                    axios
                        .get(`/api/elements/filter/box/${this.selected_boxes}`)
                        .then((response => {
                            this.elements = response.data
                        }))
                    axios
                        .get(`/api/box/${this.selected_boxes}`)
                        .then(response => (
                            this.selected_boxes_price = response.data.price
                        ));
                });
        },
        methods: {
            clear() {
                this.categories.forEach(function(category) {
                        while(document.getElementById('section_' + category.slug).childElementCount > 4) {
                            document.getElementById('section_' + category.slug).lastElementChild.remove()
                        }
                    }
                );

                var indexes = document.querySelectorAll('[class^="index"]');
                [].forEach.call(indexes, function(index) {
                index.style.display = "none";
                });

                document.getElementById('selected_boxes').style.display = "none";

                this.selected_types = ''

                this.reset_form = true
            },
            calc() {
                this.price_total = 0
                var pr_to =  [];
                this.price_total = pr_to

                this.categories.forEach(function(category) {
                        document.getElementsByName(category.slug + '[]').forEach((child) => {
                            if(child.options[child.selectedIndex].getAttribute('data-price')) {
                                pr_to.push(parseInt(child.options[child.selectedIndex].getAttribute('data-price')))
                            }
                        });
                    }
                );

                pr_to = pr_to.reduce((a, b) => a + b, 0)
                this.price_total = parseInt(this.selected_boxes_price) + pr_to
            },
            onChange(category, index) {
                console.log('change')
                if(document.getElementsByName(category.slug + '[]')[0].value && document.getElementsByClassName('index' + (index + 1))[0]) {
                    document.getElementsByClassName('index' + (index + 1))[0].style.display = "block";
                }

                var all_numbers = [
                    index + 1, index + 2, index + 3, index + 4, index + 5, index + 6, index + 7, index + 8, index + 9, index + 10
                ]
                if(!document.getElementsByName(category.slug + '[]')[0].value.length) {
                    all_numbers.forEach(function(number) {
                        if(document.getElementsByClassName('index' + (number))[0]) {
                            document.getElementsByClassName('index' + (number))[0].style.display = "none";
                        }
                    });
                }
            },
            onTypeChange() {
                axios
                .get(`/api/boxes/filter/${this.selected_types}`)
                .then(response => (
                    this.boxes = response.data,
                    this.price_total = 0
                ));

                this.categories.forEach(function(category) {
                        while(document.getElementById('section_' + category.slug).childElementCount > 4) {
                            document.getElementById('section_' + category.slug).lastElementChild.remove()
                        }
                    }
                );

                document.getElementById('selected_boxes').style.display = "block";
            },
            onBoxChange() {
                // Берем цену корпуса
                axios
                .get(`/api/box/${this.selected_boxes}`)
                .then(response => (
                    this.selected_boxes_price = response.data.price
                ));

                // Фильтруем остальные детали относительно корпуса
                axios
                .get(`/api/elements/filter/box/${this.selected_boxes}`)
                .then(response => (
                    this.elements = response.data
                ));

                this.categories.forEach(function(category) {
                        while(document.getElementById('section_' + category.slug).childElementCount > 4) {
                            document.getElementById('section_' + category.slug).lastElementChild.remove()
                        }
                    }
                );

                var all_numbers = [
                    0,1,2,3,4,5,6,7,8,9,10
                ]
                all_numbers.forEach(function(number) {
                    if(document.getElementsByClassName('index' + (number))[0]) {
                        document.getElementsByClassName('index' + (number))[0].style.display = "none";
                    }
                });
                document.getElementsByClassName('index0')[0].style.display = "block";
            },
            dopElementsClone(category) {
                var cln = document.getElementsByName(category.slug + '[]')[0].cloneNode(true)
                document.getElementById('section_' + category.slug).appendChild(cln)
            },
            dopElementsRemove(category) {
                if(document.getElementById('section_' + category.slug).childElementCount > 4) {
                    document.getElementById('section_' + category.slug).lastElementChild.remove()
                }
            },
            saveCalculation() {
                var megred_select_form_values = [];
                this.categories.forEach(function(category) {
                        document.getElementsByName(category.slug + '[]').forEach((child) => {
                            if(document.getElementsByName(category.slug + '[]')[0].value) {
                                megred_select_form_values.push(child.value)
                            } else {
                                console.log(category.slug + ' - none')
                            }
                        });
                    }
                );

                console.log(megred_select_form_values)
                
                axios
                .post(`/api/calculation/${this.$route.params.id}/edit`, { id: this.$route.params.id, comment: this.comment, price_total: this.price_total, types: this.selected_types, boxes: this.selected_boxes, elements: megred_select_form_values })
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
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
                    <select v-model="selected_boxes" @change="onBoxChange()" class="form-control mb-3">
                        <option value selected>&nbsp;</option>
                        <template v-for="box in boxes">
                            <option :value="box.id">{{ box.title }} - {{ box.price }}₽</option>
                        </template>
                    </select>
                </div>

                <div v-for="(category, index) in categories" :key="'category_' + category.id" :id="'section_' + category.slug" :class="'index' + index + ' mb-3'">

                    <label>{{ category.title }}</label>
                    
                    <button @click="dopElementsClone(category)" class="btn btn-sm btn-outline-secondary" style="padding: 0; height: auto; line-height: 10px; width: 15px; height: 15px;">+</button>
                    <!--<button @click="dopElementsRemove(category)" class="btn btn-sm btn-outline-secondary" style="padding: 0; height: auto; line-height: 10px; width: 15px; height: 15px;">-</button>-->

                    <select :name="category.slug + '[]'" @change="onChange(category, index)" class="form-control mb-3">
                        <option value selected>&nbsp;</option>
                        <template v-for="element in elements">
                            <template v-for="ect in element.categories">
                                <option v-if="ect.id === category.id" :value="element.id" :data-price="element.price">{{ element.title }} - {{ element.price }}₽</option>
                            </template>
                        </template>
                    </select>

                </div>

                <div class="delivery mt-4" id="delivery">
                    <div class="alert alert-primary alert-outline">
                        <div></div>
                        <div class="alert-message">
                            <h6 class="alert-heading">Город доставки (ПЭК):</h6>
                            
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <select class="form-control" v-model="pek_city_selected" @change="onCityChange()">
                                        <option v-for="pek_city in pek_cities" :value="pek_city">{{ pek_city }}</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select class="form-control" v-model="pek_city_sub_selected" @change="calcDelivery()">
                                        <option v-for="pek_city_sub in pek_cities_sub" :value="pek_city_sub.id">{{ pek_city_sub.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div v-if="pek_loading" class="spinner-border text-primary mt-4">
                                <span class="sr-only">Загрузка...</span>
                            </div>

                        </div>
                    </div>
                </div>

                <div v-if="price_subtotal > 0" class="row align-items-center mt-4">
                    <div class="col-10 text-end" style="color: #888;">
                        Стоимость:
                    </div>
                    <div class="col-2 text-end">
                        <h4 class="text-primary m-0">{{ price_subtotal }} ₽</h4>
                    </div>
                </div>

                <div v-if="parseInt(pek_price) > 0" class="row align-items-center my-0 mb-1">
                    <div class="col-10 text-end" style="color: #888;">
                        <p v-if="pek_response" class="m-0">
                            Доставка
                            <template v-if="pek_response.auto[1]">
                                <small style="display:block; line-height: 1; font-size: 11px;">{{ pek_response.auto[1] }} ({{ pek_response.periods_days }} дней)</small>
                                <small style="display:block; line-height: 1; font-size: 11px;">{{ selected_boxes_length }}м &times; {{ selected_boxes_width }}м &times; {{ selected_boxes_height }}м, {{ (selected_boxes_width * selected_boxes_height * selected_boxes_length).toFixed(2) }}м³, {{ selected_boxes_weight }}кг</small>
                            </template>
                        </p>
                    </div>
                    <div class="col-2 text-end">
                        <h4 class="text-primary m-0">{{ parseInt(pek_price) }} ₽</h4>
                    </div>
                </div>

                <div v-if="price_subtotal > 0 && parseInt(pek_price) > 0" class="row align-items-center mb-0">
                    <div class="col-10 text-end" style="color: #888;">
                        Итого:
                    </div>
                    <div class="col-2 text-end">
                        <h4 class="text-primary m-0">{{ (price_subtotal + pek_price).toFixed(0) }} ₽</h4>
                    </div>
                </div>

                <div class="mt-4">Комментарий:</div>
                <textarea class="form-control mb-2" v-model="comment"></textarea>

                <!--<button @click="calc()">Пересчитать</button>-->
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
                price_subtotal: {},
                price_total: {},
                comment: '',
                boxes: {},
                types: {},
                selected_types: '',

                selected_boxes: {},
                selected_boxes_width: '',
                selected_boxes_length: '',
                selected_boxes_height: '',
                selected_boxes_weight: '',

                selected_boxes_price: '',
                moment: moment,
                ele_cat: [],

                pek_cities_data: {},
                pek_cities: {},
                pek_city_selected: '',
                pek_cities_sub: {},
                pek_city_sub_selected: '',
                pek_response: '',
                pek_price: '',
                pek_loading: false,

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

            setTimeout(function(){
                this.clear()
            }.bind(this), 500);

            axios
                //.get('http://www.pecom.ru/ru/calc/towns.php')
                .get('/towns.php')
                .then((response => {
                    this.pek_cities_data = response.data
                    
                    var data = this.pek_cities_data;
                    var pek_cities = [];

                    for(var i in data) {
                        pek_cities.push(i);
                    }

                    this.pek_cities = pek_cities.sort()
                }));
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
                this.selected_boxes = ''

                this.reset_form = true
            },
            calc() {
                this.price_subtotal = 0
                var pr_to =  [];
                this.price_subtotal = pr_to

                this.categories.forEach(function(category) {
                        document.getElementsByName(category.slug + '[]').forEach((child) => {
                            if(child.options[child.selectedIndex].getAttribute('data-price')) {
                                pr_to.push(parseInt(child.options[child.selectedIndex].getAttribute('data-price')))
                            }
                        });
                    }
                );

                pr_to = pr_to.reduce((a, b) => a + b, 0)
                this.price_subtotal = parseInt(this.selected_boxes_price) + pr_to
            },
            onChange(category, index) {
                if(document.getElementsByName(category.slug + '[]')[0].value && document.getElementsByClassName('index' + (index + 1))[0]) {
                    document.getElementsByClassName('index' + (index + 1))[0].style.display = "block";
                    if(document.getElementsByClassName('index' + (index + 1))[0].querySelector("select")) {
                        document.getElementsByClassName('index' + (index + 1))[0].querySelector("select").selectedIndex = "0";
                    }
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
                    this.price_subtotal = 0
                ));

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

                document.getElementById('selected_boxes').style.display = "block";

                this.selected_boxes = ''
            },
            onBoxChange() {
                // Берем цену корпуса
                axios
                .get(`/api/box/${this.selected_boxes}`)
                .then(response => (
                    this.selected_boxes_price = response.data.price,
                    this.selected_boxes_width = response.data.width,
                    this.selected_boxes_length = response.data.length,
                    this.selected_boxes_height = response.data.height,
                    this.selected_boxes_weight = response.data.weight
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
                .post(`/api/calculations`, { comment: this.comment, price_total: this.price_subtotal + this.pek_price.toFixed(0), types: this.selected_types, boxes: this.selected_boxes, elements: megred_select_form_values })
                .then(response => (
                    this.$router.push({path: '/calculations'})
                ));
            },
            onCityChange() {
                this.pek_response = ''
                var data = this.pek_cities_data;
                var pek_cities_sub = [];

                for(var i in data) {
                    if(i === this.pek_city_selected) {
                        for (const [key, value] of Object.entries(data[i])) {
                            pek_cities_sub.push({id: `${key}`, name: `${value}`});
                        }
                    }
                }

                this.pek_cities_sub = pek_cities_sub.sort((a, b) => (a.name > b.name) ? 1 : -1)
            },
            calcDelivery() {
                this.pek_loading = true
                axios
                    .get('http://calc.pecom.ru/bitrix/components/pecom/calc/ajax.php', {
                        params: {
                            'places[0]': [ `${this.selected_boxes_width}`, `${this.selected_boxes_length}`, `${this.selected_boxes_height}`, `${(this.selected_boxes_width * this.selected_boxes_height * this.selected_boxes_length).toFixed(2)}`, `${this.selected_boxes_weight}`, 0, 1 ],
                            'take[town]': '-463',
                            'deliver[town]': `${this.pek_city_sub_selected}`
                        }
                    })
                    .then(response => (
                        this.pek_response = response.data,
                        this.pek_price = response.data.auto[2] + response.data.ADD[0],
                        this.pek_loading = false,
                        console.log(response.data)
                    ));
            },
            checkDelivery() {
                if(document.getElementsByName('delivery[]')[0].value === '55') {
                    document.getElementById('delivery').style.display = 'block'
                } else {
                    document.getElementById('delivery').style.display = 'none'
                }
            },
        },
        mounted() {
            setInterval(this.calc,500);
            setInterval(this.checkDelivery,500);
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
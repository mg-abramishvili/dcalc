<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новый расчёт</h1>
            </div>
        </div>

        <div class="tab tab-vertical">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link tab-link active" @click="tabSelect('tab_type')" id="tab_type_link" role="tab">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <small style="color: #888;">Тип</small>
                                <strong id="type_title" class="d-block"></strong>
                            </div>
                            <div class="col-4 text-end"></div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-link" @click="tabSelect('tab_box')" id="tab_box_link" role="tab">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <small style="color: #888;">Корпус</small>
                                <strong id="box_title" class="d-block"></strong>
                            </div>
                            <div class="col-4 text-end">
                                <strong id="box_price" class="text-primary"></strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div id="box_description" class="description"></div>
                            </div>
                        </div>
                    </a>
                </li>
                <li v-for="(category, index) in categories" :key="'category_' + category.id" :id="'section_' + category.slug" class="nav-item">
                    <a class="nav-link tab-link" @click="tabSelect('tab_' + category.slug)" :id="'tab_' + category.slug + '_link'" role="tab">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <small style="color: #888;">{{ category.title }}</small>
                                <strong :id="category.slug + '_title'" class="d-block"></strong>
                            </div>
                            <div class="col-4 text-end">
                                <strong :id="category.slug + '_price'" class="text-primary"></strong>
                            </div>
                        </div>
                    </a>
                </li>
                <li v-if="overlay" class="overlay"></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_type" role="tabpanel">
                    <label class="mb-2"><strong>Тип</strong></label>
                    <select v-model="selected_type" class="form-select form-select-lg mb-3">
                        <template v-for="type in types">
                            <option v-bind:value="{ id: type.id, title: type.title }">{{ type.title }}</option>
                        </template>
                    </select>
                    <button class="btn btn-outline-primary" disabled>Назад</button>
                    <button @click="onTypeSelect()" class="btn btn-outline-primary">Далее</button>
                </div>
                <div class="tab-pane" id="tab_box" role="tabpanel">
                    <label class="mb-2"><strong>Корпус</strong></label>
                    <select v-model="selected_box" class="form-select form-select-lg mb-3">
                        <option value selected>&nbsp;</option>
                        <template v-for="box in boxes">
                            <option v-bind:value="{ id: box.id, title: box.title, price: box.price, width: box.width, length: box.length, height: box.height, weight: box.weight, descriptionmanager: box.descriptionmanager }">{{ box.title }} - {{ parseInt(box.price) }}₽</option>
                        </template>
                    </select>
                    <button @click="tabSelect('tab_type')" class="btn btn-outline-primary">Назад</button>
                    <button @click="onBoxSelect()" class="btn btn-outline-primary">Далее</button>
                </div>
                <div v-for="(category, index) in categories" :key="'category_pane_' + category.id" :id="'tab_' + category.slug" class="tab-pane" role="tabpanel">
                    <label class="mb-2"><strong>{{ category.title }}</strong></label>
                    <div v-if="elements_loader" class="spinner-border spinner-border-sm text-primary me-2" role="status">
                        <span class="sr-only">Загрузка...</span>
                    </div>
                    <select :name="category.slug + '[]'" class="form-select form-select-lg mb-3">
                        <option value selected>&nbsp;</option>
                        <template v-for="element in elements">
                            <template v-for="ect in element.categories">
                                <option v-if="ect.id === category.id" :value="element.id" :data-title="element.title" :data-price="element.price">{{ element.title }} - {{ parseInt(element.price) }}₽</option>
                            </template>
                        </template>
                    </select>
                    
                    <div class="row align-items-center">
                        <div class="col">
                            <button @click="tabSelectBack(index)" class="btn btn-outline-primary">Назад</button>
                            <button @click="onSelect(category, index)" class="btn btn-outline-primary btn-next">Далее</button>
                        </div>
                        <div class="col text-end">
                            <button @click="dopElementsClone(category)" class="btn btn-sm btn-outline-secondary me-auto">добавить ещё</button>
                        </div>                        
                    </div>
                </div>

                <div v-if="delivery_block" class="delivery mt-4" id="delivery">
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

                <div v-if="price_subtotal > 0" class="total">
                    <div class="row align-items-center m-0 p-0">
                        <div class="col-6">Подитог:</div>
                        <div class="col-6 text-end text-primary">{{ parseInt(price_subtotal) }} ₽</div>
                    </div>
                    <div v-if="delivery_block && pek_price > 0" class="row align-items-center m-0 p-0">
                        <div class="col-6">
                            Доставка:
                            <template v-if="pek_response.auto[1]">
                                <small style="display:block; line-height: 1; font-size: 11px;">{{ pek_response.auto[1] }} ({{ pek_response.periods_days }} дней)</small>
                                <small style="display:block; line-height: 1; font-size: 11px;">{{ selected_box_length }}м &times; {{ selected_box_width }}м &times; {{ selected_box_height }}м, {{ (selected_box_width * selected_box_height * selected_box_length).toFixed(2) }}м³, {{ selected_box_weight }}кг</small>
                            </template>
                        </div>
                        <div class="col-6 text-end text-primary">{{ parseInt(pek_price) }} ₽</div>
                    </div>
                    <div class="row align-items-center m-0 p-0">
                        <div class="col-6">Итого:</div>
                        <div class="col-6 text-end text-primary">{{ parseInt(price_subtotal) + parseInt(pek_price) }} ₽</div>
                    </div>
                    <button @click="checkBeforeSave()" v-if="save_button" class="btn btn-lg btn-primary mt-4">Создать проект</button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                types: {},
                selected_type: {},

                boxes: {},
                selected_box: {},
                selected_box_width: '',
                selected_box_length: '',
                selected_box_height: '',
                selected_box_weight: '',

                categories: {},
                elements: {},
                elements_loader: false,

                price_subtotal: '',

                save_button: false,
                overlay: true,

                delivery_block: false,
                pek_cities_data: {},
                pek_cities: {},
                pek_city_selected: '',
                pek_cities_sub: {},
                pek_city_sub_selected: '',
                pek_response: '',
                pek_price: 0,
                pek_loading: false,
            }
        },
        created() {
            axios
                .get('/api/types')
                .then(response => (
                    this.types = response.data
                ));
            axios
                .get(`/api/boxes/type/all`)
                .then(response => (
                    this.boxes = response.data
                ));
            axios
                .get('/api/categories')
                .then(response => (
                    this.categories = response.data
                ));
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
            onTypeSelect() {
                if(!isNaN(this.selected_type.id)) {
                    axios
                    .get(`/api/boxes/filter/${this.selected_type.id}`)
                    .then(response => (
                        this.boxes = response.data
                    ));

                    if(document.getElementById('type_title')) {
                        document.getElementById('type_title').innerHTML = this.selected_type.title
                    }

                    this.tabSelect('tab_box')
                } else {
                    alert('Выберите тип')
                }
            },
            onBoxSelect() {
                if(!isNaN(this.selected_box.id)) {
                    this.elements_loader = true
                    axios
                    .get(`/api/elements/filter/box/${this.selected_box.id}`)
                    .then(response => (
                        this.elements = response.data,
                        this.elements_loader = false
                    ));

                    if(document.getElementById('box_title')) {
                        document.getElementById('box_title').innerHTML = this.selected_box.title
                    }
                    if(document.getElementById('box_price')) {
                        document.getElementById('box_price').innerHTML = parseInt(this.selected_box.price) + ' ₽'
                    }
                    if(document.getElementById('box_description')) {
                        document.getElementById('box_description').innerHTML = this.selected_box.descriptionmanager
                    }

                    this.tabSelect('tab_' + this.categories[0].slug)

                    this.overlay = true
                    this.delivery_block = false

                    this.price_subtotal = this.selected_box.price
                    this.pek_price = 0

                    this.selected_box_width = parseInt(this.selected_box.width) / 1000
                    this.selected_box_length = parseInt(this.selected_box.length) / 1000
                    this.selected_box_height = parseInt(this.selected_box.height) / 1000
                    this.selected_box_weight = parseInt(this.selected_box.weight)

                    this.categories.forEach(function(category) {
                        if(document.getElementById(category.slug + '_title')) {
                            document.getElementById(category.slug + '_title').innerHTML = ''
                        }
                        if(document.getElementById(category.slug + '_price')) {
                            document.getElementById(category.slug + '_price').innerHTML = ''
                        }
                    });

                } else {
                    alert('Выберите корпус')
                }
            },
            onSelect(category, index) {
                var category_titles = []
                var category_prices = []
                
                document.getElementsByName(category.slug + '[]').forEach((child) => {
                    if(child.options[child.selectedIndex].getAttribute('data-title')) {
                        category_titles.push(child.options[child.selectedIndex].getAttribute('data-title'))
                    }
                    if(document.getElementById(category.slug + '_title')) {
                        document.getElementById(category.slug + '_title').innerHTML = category_titles
                    }

                    if(child.options[child.selectedIndex].getAttribute('data-price')) {
                        category_prices.push(child.options[child.selectedIndex].getAttribute('data-price'))
                    }
                    if(document.getElementById(category.slug + '_price')) {
                        document.getElementById(category.slug + '_price').innerHTML = category_prices.reduce((a, b) => parseInt(a) + parseInt(b), 0) + ' ₽'
                    }
                });

                if(document.getElementsByName(category.slug + '[]')[0].options[document.getElementsByName(category.slug + '[]')[0].selectedIndex].getAttribute('data-title')) {
                    this.calc()

                    if(this.categories[0+index+1]) {
                        this.tabSelect('tab_' + this.categories[0+index+1].slug)
                    } else {
                        this.overlay = false
                        this.delivery_block = true
                        this.save_button = true
                        /*document.querySelectorAll('.btn-next').forEach.call(document.querySelectorAll('.btn-next'), function (el) {
                        el.style.visibility = 'hidden';
                        });*/
                    }
                } else {
                    alert('Выберите ' + category.title)
                }

                document.getElementsByName(category.slug + '[]').forEach((child, index) => {
                    if ( index != 0 ) {
                        if(!child.options[child.selectedIndex].getAttribute('data-title')) {
                            child.remove()
                        }
                    }
                });

            },
            tabSelect(tab_id) {
                // Убираем активность со всех табов и их кнопок
                var tab_link
                var tab_links = document.querySelectorAll(".tab-link");
                for (tab_link = 0; tab_link < tab_links.length; tab_link++) {
                    tab_links[tab_link].classList.remove('active')
                }
                var tab_pane
                var tab_panes = document.querySelectorAll(".tab-pane");
                for (tab_pane = 0; tab_pane < tab_panes.length; tab_pane++) {
                    tab_panes[tab_pane].classList.remove('active')
                }

                // Делаем активным нужный таб
                document.getElementById(tab_id).classList.add('active')
                document.getElementById(tab_id + '_link').classList.add('active')
            },
            tabSelectBack(index) {
                if(index === 0) {
                    this.tabSelect('tab_box')
                } else if (this.categories[0+index-1]) {
                    this.tabSelect('tab_' + this.categories[0+index-1].slug)
                }
            },
            dopElementsClone(category) {
                var cln = document.getElementsByName(category.slug + '[]')[0].cloneNode(true)
                document.getElementById('tab_' + category.slug).insertBefore(cln, document.getElementById('tab_' + category.slug).lastChild)
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
                            'places[0]': [ `${this.selected_box_width}`, `${this.selected_box_length}`, `${this.selected_box_height}`, `${(this.selected_box_width * this.selected_box_height * this.selected_box_length).toFixed(2)}`, `${this.selected_box_weight}`, 0, 1 ],
                            'take[town]': '-463',
                            'deliver[town]': `${this.pek_city_sub_selected}`
                        }
                    })
                    .then(response => (
                        this.pek_response = response.data,
                        this.pek_price = parseInt(response.data.auto[2]) + parseInt(response.data.ADD[1]),
                        this.pek_loading = false,
                        console.log(response.data)
                    ));
            },
            checkDelivery() {
                if(document.getElementsByName('delivery[]')[0] && document.getElementsByName('delivery[]')[0].value === '55') {
                    document.getElementById('delivery').style.display = 'block'
                } else if(document.getElementById('delivery')) {
                    document.getElementById('delivery').style.display = 'none'
                }
            },
            calc() {
                this.price_subtotal = 0
                var price_subtotal =  [];

                this.categories.forEach(function(category) {
                        document.getElementsByName(category.slug + '[]').forEach((child) => {
                            if(child.options[child.selectedIndex].getAttribute('data-price')) {
                                price_subtotal.push(parseInt(child.options[child.selectedIndex].getAttribute('data-price')))
                            }
                        });
                    }
                );

                price_subtotal = price_subtotal.reduce((a, b) => a + b, 0)
                this.price_subtotal = parseInt(this.selected_box.price) + price_subtotal
            },
            checkBeforeSave() {
                var categories_filled = []
                var categories_not_filled = []

                this.categories.forEach(function(category) {
                    if(document.getElementsByName(category.slug + '[]')[0].options[document.getElementsByName(category.slug + '[]')[0].selectedIndex].getAttribute('data-title')) {
                        categories_filled.push(category.id)
                    } else {
                        categories_not_filled.push(category.title)
                    }
                })

                if(!isNaN(this.selected_type.id) && !isNaN(this.selected_box.id) && categories_filled.length === this.categories.length) {
                    this.saveCalculation()
                } else {
                    alert('Не заполнено: ' + categories_not_filled)
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
                .post(`/api/calculations`, { comment: 'no comment', price_total: this.price_subtotal, type: this.selected_type.id, box: this.selected_box.id, elements: megred_select_form_values })
                .then(response => (
                    this.$router.push({name: 'ProjectCreate', params: {calculation_id: response.data}})
                ));
            },
        },
        mounted() {
        },
        watch: {
        },
        components: {
        }
    }
</script>
<style scoped>
    .tab {
        min-height: 1500px;
    }
    .tab-vertical .nav-tabs {
        width: 60%;
        float: right;
        padding-left: 30px;
        display: block;
        position: relative;
    }
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
        /*background-color: rgba(0,0,0,0.4);*/
        z-index: 100;
    }
    .tab .nav-tabs .nav-link.active {
        background: none;
    }
    .tab .nav-tabs .nav-link {
        border-radius: 0;
        padding-left: 0;
        padding-right: 0;
        border-bottom: 1px solid #ddd;
    }
    .tab .nav-tabs .nav-item:first-child .nav-link {
        padding-top: 0;
    }
    .tab .tab-content {
        position: sticky;
        top: 20px;
        background: none;
        box-shadow: none;
        padding: 0;
    }

    .tab-content>.tab-pane {
        background: #fff;
        padding: 1.25rem;
        box-shadow: 0 0.1rem 0.2rem rgb(0 0 0 / 5%);
        margin-bottom: 40px;
    }

    .total .col-6 {
        padding: 0;
    }

    .total .text-primary {
        font-size: 26px;
        font-weight: bold;
    }

    .description {
        font-size: 12px;
    }
</style>
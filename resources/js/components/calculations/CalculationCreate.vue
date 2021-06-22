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
                                <strong class="d-block">{{ selected_type.title }}</strong>
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
                                <strong class="d-block">{{ selected_box.title }}</strong>
                            </div>
                            <div class="col-4 text-end">
                                <strong v-if="selected_box.price" class="text-primary">{{ selected_box.price }} ₽</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="description">{{ selected_box.description }}</div>
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
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_type" role="tabpanel">
                    <label class="mb-2"><strong>Тип</strong></label>
                    <select v-model="selected_type" class="form-select form-select-lg mb-3">
                        <template v-for="type in types">
                            <option v-bind:value="{ id: type.id, title: type.title }">{{ type.title }}</option>
                        </template>
                    </select>
                    <button @click="onTypeSelect()" class="btn btn-primary">Далее</button>
                </div>
                <div class="tab-pane" id="tab_box" role="tabpanel">
                    <label class="mb-2"><strong>Корпус</strong></label>
                    <select v-model="selected_box" class="form-select form-select-lg mb-3">
                        <option value selected>&nbsp;</option>
                        <template v-for="box in boxes">
                            <option v-bind:value="{ id: box.id, title: box.title, price: box.price, description: box.description }">{{ box.title }} - {{ box.price }}₽</option>
                        </template>
                    </select>
                    <button @click="tabSelect('tab_type')" class="btn btn-primary">Назад</button>
                    <button @click="onBoxSelect()" class="btn btn-primary">Далее</button>
                </div>
                <div v-for="(category, index) in categories" :key="'category_pane_' + category.id" :id="'tab_' + category.slug" class="tab-pane" role="tabpanel">
                    <label class="mb-2"><strong>{{ category.title }}</strong></label>
                    <select :name="category.slug + '[]'" class="form-select form-select-lg mb-3">
                        <option value selected>&nbsp;</option>
                        <template v-for="element in elements">
                            <template v-for="ect in element.categories">
                                <option v-if="ect.id === category.id" :value="element.id" :data-title="element.title" :data-price="element.price">{{ element.title }} - {{ element.price }}₽</option>
                            </template>
                        </template>
                    </select>
                    <button @click="tabSelectBack(index)" class="btn btn-primary">Назад</button>
                    <button @click="onSelect(category, index)" class="btn btn-primary btn-next">Далее</button>
                </div>
                <div v-if="price_subtotal > 0" class="total">
                    <div class="row align-items-center m-0 p-0">
                        <div class="col-6">Итого:</div>
                        <div class="col-6 text-end text-primary">{{ price_subtotal }} ₽</div>
                    </div>
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

                categories: {},
                elements: {},

                price_subtotal: ''
            }
        },
        created() {
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
                .get('/api/categories')
                .then(response => (
                    this.categories = response.data
                ));
        },
        methods: {
            onTypeSelect() {
                if(!isNaN(this.selected_type.id)) {
                    axios
                    .get(`/api/boxes/filter/${this.selected_type.id}`)
                    .then(response => (
                        this.boxes = response.data
                    ));
                    this.tabSelect('tab_box')
                } else {
                    alert('Выберите тип')
                }
            },
            onBoxSelect() {
                if(!isNaN(this.selected_box.id)) {
                    axios
                    .get(`/api/elements/filter/box/${this.selected_box.id}`)
                    .then(response => (
                        this.elements = response.data
                    ));
                    this.tabSelect('tab_type')

                    this.tabSelect('tab_' + this.categories[0].slug)

                    this.categories.forEach(function(category) {
                        if(document.getElementById(category.slug + '_title')) {
                            document.getElementById(category.slug + '_title').innerHTML = ''
                        }
                        if(document.getElementById(category.slug + '_price')) {
                            document.getElementById(category.slug + '_price').innerHTML = ''
                        }
                    });

                } else {
                    alert('Выберите тип')
                }
            },
            onSelect(category, index) {
                document.getElementsByName(category.slug + '[]').forEach((child) => {
                    if(child.options[child.selectedIndex].getAttribute('data-title')) {
                        if(document.getElementById(category.slug + '_title')) {
                            document.getElementById(category.slug + '_title').innerHTML = child.options[child.selectedIndex].getAttribute('data-title')
                        }
                    }
                    if(child.options[child.selectedIndex].getAttribute('data-price')) {
                        if(document.getElementById(category.slug + '_price')) {
                            document.getElementById(category.slug + '_price').innerHTML = parseInt(child.options[child.selectedIndex].getAttribute('data-price')) + ' ₽'
                        }
                    }
                });
                this.calc()

                if(this.categories[0+index+1]) {
                    this.tabSelect('tab_' + this.categories[0+index+1].slug)
                } else {
                    document.querySelectorAll('.btn-next').forEach.call(document.querySelectorAll('.btn-next'), function (el) {
                    el.style.visibility = 'hidden';
                    });
                }

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
                    document.querySelectorAll('.btn-next').forEach.call(document.querySelectorAll('.btn-next'), function (el) {
                    el.style.visibility = 'visible';
                    });
                } else if (this.categories[0+index-1]) {
                    this.tabSelect('tab_' + this.categories[0+index-1].slug)
                    document.querySelectorAll('.btn-next').forEach.call(document.querySelectorAll('.btn-next'), function (el) {
                    el.style.visibility = 'visible';
                    });
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
        min-height: 500px;
    }
    .tab-vertical .nav-tabs {
        width: 60%;
        float: right;
        padding-left: 30px;
        display: block;
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
<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новый компонент</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <label id="title_label">Название</label>
                <input v-model="title" id="title_input" type="text" class="form-control mb-3">

                <label>Курс USD <small>(на {{moment(currencies_date).format('DD.MM.YYYY')}})</small></label>
                <input type="text" class="form-control mb-3" :value="currencies.Value" disabled>

                <div class="row" style="position: relative">
                    <div class="col-6">
                        <label>Цена RUB</label>
                        <input type="text" class="form-control mb-3" v-model="price_rub">
                    </div>
                    <div class="col-6">
                        <label>Цена USD</label>
                        <input type="text" class="form-control mb-3" v-model="price_usd">
                    </div>
                    <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: block; width: 10px; padding: 0; margin: 0; margin-top: 2px;">+</span>
                </div>

                <div class="form-group" style="position: relative;">
                    <label id="price_label">Цена (финальная)</label>
                    <input v-model="price" id="price_input" type="text" class="form-control mb-3">
                    <button @click="TotalPrice()" style="position: absolute; top: 50%; transform: translateY(-50%); right: 1rem; border: none; box-shadow: none; font-size: 0.7rem; background: none; margin-top: 0.75rem">пересчитать</button>
                </div>

                <label id="categories_label">Категория</label>
                <select v-model="categories_selected" id="categories_input" class="form-control mb-3">
                    <template v-for="category in categories">
                        <option :value="category.id">{{ category.title }}</option>
                    </template>
                </select>

                <label id="boxes_label">Совместимость</label>
                <select v-model="selected_boxes" id="boxes_input" class="form-control mb-3" multiple>
                    <template v-for="box in boxes">
                        <option :value="box.id">{{ box.title }}</option>
                    </template>
                </select>
                <button @click="saveCalculation()" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: {},
                boxes: {},
                categories_selected: '',
                connected_elements: '',
                title: '',
                price_rub: '',
                price_usd: '',
                price: '',
                currencies: {},
                currencies_date: {},
                moment: moment,
                elements: {},
                selected_boxes: [],
            }
        },
        created() {
            axios
                .get('/api/element-categories')
                .then(response => (
                    this.categories = response.data
                ));
            axios
                .get('/api/boxes')
                .then(response => (
                    this.boxes = response.data
                ));
            axios
                .get('https://www.cbr-xml-daily.ru/daily_json.js')
                .then(response => (
                    this.currencies = response.data.Valute.USD,
                    this.currencies_date = response.data.Date
                ));
            axios
                .get('/api/elements')
                .then(response => (
                    this.elements = response.data
                ));
        },
        methods: {
            onChange(index, event) {
                
            },
            saveCalculation() {
                for (var i = 0; i < document.querySelectorAll('label').length; i++) {
                    if(document.querySelectorAll('label')[i].classList.contains('text-danger') === true) {
                        document.querySelectorAll('label')[i].classList.remove('text-danger')
                    }
                }
                for (var i = 0; i < document.querySelectorAll('input').length; i++) {
                    if(document.querySelectorAll('input')[i].classList.contains('border-danger') === true) {
                        document.querySelectorAll('input')[i].classList.remove('border-danger')
                    }
                }
                for (var i = 0; i < document.querySelectorAll('select').length; i++) {
                    if(document.querySelectorAll('select')[i].classList.contains('border-danger') === true) {
                        document.querySelectorAll('select')[i].classList.remove('border-danger')
                    }
                }

                axios
                .post('/api/elements', {
                    title: this.title,
                    price: this.price,
                    categories: this.categories_selected,
                    boxes: this.selected_boxes,
                })
                .then(response => (
                    this.$router.push({path: '/elements'}) 
                ))
                .catch((error) => {
                    if(error.response) {
                        for(var key in error.response.data.errors){
                            document.getElementById(key + '_label').classList.add('text-danger')
                            document.getElementById(key + '_input').classList.add('border-danger')
                        }
                    }
                });
            },
            TotalPrice() {
                if(this.price_rub > 0 && this.price_usd > 0) {
                    this.price = Math.ceil((this.price_rub + (parseFloat(this.currencies.Value) * this.price_usd)) / 50)*50
                } else if (!this.price_rub) {
                    this.price = Math.ceil((0 + (parseFloat(this.currencies.Value) * this.price_usd)) / 50)*50
                } else if (!this.price_usd) {
                    this.price = Math.ceil((this.price_rub + 0) / 50)*50
                }
            }
        },
        watch: {
            price_rub: function (val) {
                if(!isNaN(parseFloat(val))) {
                    this.price_rub = parseFloat(val)
                    this.TotalPrice()
                } else {
                    this.price_rub = 0
                }
            },
            price_usd: function (val) {
                if(!isNaN(parseFloat(val))) {
                    this.price_usd = parseFloat(val)
                    this.TotalPrice()
                } else {
                    this.price_usd = 0
                }
            },
        },
        components: {
        }
    }
</script>
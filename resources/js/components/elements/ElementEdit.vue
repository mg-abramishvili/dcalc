<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">{{ element.title }}</h1>
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
                        <label id="pre_rub_label">Цена RUB</label>
                        <input type="text" id="pre_rub_input" class="form-control mb-3" v-model="pre_rub">
                    </div>
                    <div class="col-6">
                        <label id="pre_usd_label">Цена USD</label>
                        <input type="text" id="pre_usd_input" class="form-control mb-3" v-model="pre_usd">
                    </div>
                    <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: block; width: 10px; padding: 0; margin: 0; margin-top: 2px;">+</span>
                </div>

                <div class="form-group" style="position: relative;">
                    <label id="price_label">Цена (финальная)</label>
                    <input v-model="price" id="price_input" type="text" class="form-control mb-3">
                    <button @click="TotalPrice()" style="position: absolute; top: 50%; transform: translateY(-50%); right: 1rem; border: none; box-shadow: none; font-size: 0.7rem; background: none; margin-top: 0.75rem">пересчитать</button>
                </div>

                <label id="categories_label">Категория</label>
                <select v-model="selected_category" id="categories_input" class="form-control mb-3">
                    <template v-for="category in categories">
                        <option :value="category.id">{{ category.title }}</option>
                    </template>
                </select>

                <div class="d-flex justify-content-between">
                    <label id="boxes_label">Совместимость</label>
                    <button @click="selectAllCat()" class="btn btn-sm">выбрать все</button>
                </div>
                <select v-model="selected_boxes" id="boxes_input" class="form-control mb-3" style="height: 300px;" multiple>
                    <template v-for="box in boxes">
                        <option :value="box.id">{{ box.title }}</option>
                    </template>
                </select>
                <div class="row">
                    <div class="col-6">
                        <button @click="saveCalculation()" class="btn btn-primary">Сохранить</button>
                    </div>
                    <div class="col-6 text-end">
                        <router-link v-if="$parent.user.elements_edit === '1'" :to="{name: 'ElementDelete', params: {id: element.id}}" class="btn btn-outline-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </router-link>
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
                element: {},
                categories: {},
                boxes: {},
                title: '',
                pre_rub: '',
                pre_usd: '',
                price: '',
                currencies: {},
                currencies_date: {},
                moment: moment,
                selected_category: {},
                selected_boxes: [],
            }
        },
        created() {
            axios
                .get(`/api/element/${this.$route.params.id}`)
                .then(response => (
                    this.element = response.data,
                    this.title = response.data.title,
                    this.selected_category = response.data.categories[0].id,
                    this.selected_boxes = response.data.boxes.map(box => box.id),
                    this.pre_rub = response.data.pre_rub,
                    this.pre_usd = response.data.pre_usd,
                    this.price = response.data.price
                ));
            axios
                .get('/api/categories')
                .then(response => (
                    this.categories = response.data
                ));
            axios
                .get(`/api/boxes/type/all`)
                .then(response => (
                    this.boxes = response.data
                ));
            axios
                .get(`https://www.cbr-xml-daily.ru/daily_json.js`, { withCredentials: false })
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
            selectAllCat() {
                axios
                .get('/api/boxes/type/all')
                .then(response => (
                    this.selected_boxes = response.data.map(box => box.id)
                ));
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
                .post(`/api/element/${this.$route.params.id}/edit`, {
                    id: this.element.id,
                    title: this.title,
                    pre_rub: this.pre_rub,
                    pre_usd: this.pre_usd,
                    price: this.price,
                    categories: this.selected_category,
                    boxes: this.selected_boxes,
                })
                .then(response => (
                    this.$router.push({name: 'ElementsByCategory', params: {id: this.selected_category}}) 
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
                if(this.pre_rub > 0 && this.pre_usd > 0) {
                    this.price = Math.ceil((this.pre_rub + (parseFloat(this.currencies.Value) * this.pre_usd)) / 50)*50
                } else if (!this.pre_rub) {
                    this.price = Math.ceil((0 + (parseFloat(this.currencies.Value) * this.pre_usd)) / 50)*50
                } else if (!this.pre_usd) {
                    this.price = Math.ceil((this.pre_rub + 0) / 50)*50
                }
            }
        },
        watch: {
            pre_rub: function (val) {
                if(!isNaN(parseFloat(val))) {
                    this.pre_rub = parseFloat(val)
                    this.TotalPrice()
                } else {
                    this.pre_rub = 0
                }
            },
            pre_usd: function (val) {
                if(!isNaN(parseFloat(val))) {
                    this.pre_usd = parseFloat(val)
                    this.TotalPrice()
                } else {
                    this.pre_usd = 0
                }
            },
        },
        components: {
        }
    }
</script>
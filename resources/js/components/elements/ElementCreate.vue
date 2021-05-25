<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новый компонент</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <label>Название</label>
                <input v-model="title" type="text" class="form-control mb-3">

                <label>Курс USD <small>(на {{moment(currencies_date).format('DD.MM.YYYY')}})</small></label>
                <input type="text" class="form-control mb-3" :value="currencies.Value" disabled>

                <div class="row">
                    <div class="col-6">
                        <label>Цена RUB</label>
                        <input type="text" class="form-control mb-3" v-model="price_rub">
                    </div>
                    <div class="col-6">
                        <label>Цена USD</label>
                        <input type="text" class="form-control mb-3" v-model="price_usd">
                    </div>
                    <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: block; width: 10px; padding: 0; margin: 0; margin-top: -12px;">+</span>
                </div>

                <div class="form-group" style="position: relative;">
                    <label>Цена (финальная)</label>
                    <input v-model="price" type="text" class="form-control mb-3">
                    <button @click="TotalPrice()" style="position: absolute; top: 50%; transform: translateY(-50%); right: 1rem; border: none; box-shadow: none; font-size: 0.7rem; background: none; margin-top: 0.75rem">пересчитать</button>
                </div>

                <label>Категория</label>
                <select v-model="categories_selected" class="form-control mb-3">
                    <template v-for="category in categories">
                        <option :value="category.id">{{ category.title }}</option>
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
                categories_selected: '',
                title: '',
                price_rub: '',
                price_usd: '',
                price: '',
                currencies: {},
                currencies_date: {},
                moment: moment,
            }
        },
        created() {
            axios
                .get('/api/element-categories')
                .then(response => (
                    this.categories = response.data
                ));
            axios
                .get('https://www.cbr-xml-daily.ru/daily_json.js')
                .then(response => (
                    this.currencies = response.data.Valute.USD,
                    this.currencies_date = response.data.Date
                ));
        },
        methods: {
            onChange(index, event) {
                
            },
            saveCalculation() {
                axios
                .post('/api/elements', { title: this.title, price: this.price, categories: this.categories_selected })
                .then(response => (
                    this.$router.push({path: '/elements'}) 
                ));
            },
            TotalPrice() {
                if(this.price_rub > 0 && this.price_usd > 0) {
                    this.price = (this.price_rub + (parseFloat(this.currencies.Value) * this.price_usd)).toFixed(2)
                } else if (!this.price_rub) {
                    this.price = (0 + (parseFloat(this.currencies.Value) * this.price_usd)).toFixed(2)
                } else if (!this.price_usd) {
                    this.price = (this.price_rub + 0).toFixed(2)
                }
            }
        },
        watch: {
            price_rub: function (val) {
                this.price_rub = parseFloat(val)
                this.TotalPrice()
            },
            price_usd: function (val) {
                this.price_usd = parseFloat(val)
                this.TotalPrice()
            },
        },
        components: {
        }
    }
</script>
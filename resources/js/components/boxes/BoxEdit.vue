<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">{{ box.title }}</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <label id="title_label">Название</label>
                <input v-model="title" id="title_input" type="text" class="form-control mb-3">

                <div class="row">
                    <div class="col-12 col-md-3">
                        <label id="length_label">Длина, мм</label>
                        <input v-model="length" id="length_input" type="text" class="form-control mb-3">
                    </div>
                    <div class="col-12 col-md-3">
                        <label id="width_label">Ширина, мм</label>
                        <input v-model="width" id="width_input" type="text" class="form-control mb-3">
                    </div>
                    <div class="col-12 col-md-3">
                        <label id="height_label">Высота, мм</label>
                        <input v-model="height" id="height_input" type="text" class="form-control mb-3">
                    </div>
                    <div class="col-12 col-md-3">
                        <label id="weight_label">Вес, кг</label>
                        <input v-model="weight" id="weight_input" type="text" class="form-control mb-3">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3">
                        <label>Цена RUB</label>
                        <input type="text" class="form-control" v-model="pre_rub">
                    </div>
                    <div class="col-3">
                        <label>Цена USD</label>
                        <input type="text" class="form-control" v-model="pre_usd">
                        <small style="color: #999;">курс {{currencies.Value}} на {{moment(currencies_date).format('DD.MM.YYYY')}}</small>
                    </div>
                    <div class="col-3">
                        <label>Маржа, руб.</label>
                        <input type="text" class="form-control" v-model="marzha">
                    </div>
                    <div class="col-3">
                        <label>Сборка, руб.</label>
                        <input type="text" class="form-control" v-model="sborka">
                    </div>
                </div>

                <div class="form-group" style="position: relative;">
                    <label id="price_label">Цена (финальная)</label>
                    <input v-model="price" id="price_input" type="text" class="form-control mb-3">
                    <button @click="TotalPrice()" style="position: absolute; top: 50%; transform: translateY(-50%); right: 1rem; border: none; box-shadow: none; font-size: 0.7rem; background: none; margin-top: 0.75rem">пересчитать</button>
                </div>

                <label id="types_label">Совместимость c типами</label>
                <select v-model="selected_types" id="types_input" class="form-control mb-3" multiple>
                    <template v-for="type in types">
                        <option :value="type.id">{{ type.title }}</option>
                    </template>
                </select>

                <label id="description_label">Описание (для КП)</label>
                <textarea v-model="description" id="description_input" class="form-control mb-3"></textarea>

                <label id="descriptionmanager_label">Описание (для менеджеров)</label>
                <textarea v-model="descriptionmanager" id="descriptionmanager_input" class="form-control mb-3"></textarea>

                <button @click="saveBox()" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                box: {},
                title: '',
                pre_rub: '',
                pre_usd: '',
                marzha: '',
                sborka: '',
                price: '',
                description: '',
                descriptionmanager: '',
                currencies: {},
                currencies_date: {},
                moment: moment,
                types: {},
                selected_types: [],

                width: '',
                height: '',
                length: '',
                weight: '',
            }
        },
        created() {
            axios
                .get(`/api/box/${this.$route.params.id}`)
                .then(response => (
                    this.box = response.data,
                    this.title = response.data.title,
                    this.pre_rub = response.data.pre_rub,
                    this.pre_usd = response.data.pre_usd,
                    this.marzha = response.data.marzha,
                    this.sborka = response.data.sborka,
                    this.price = response.data.price,
                    this.selected_types = response.data.types.map(type => type.id),
                    this.width = response.data.width,
                    this.height = response.data.height,
                    this.length = response.data.length,
                    this.weight = response.data.weight,
                    this.description = response.data.description,
                    this.descriptionmanager = response.data.descriptionmanager
                ));
            axios
                .get('https://www.cbr-xml-daily.ru/daily_json.js', { withCredentials: false })
                .then(response => (
                    this.currencies = response.data.Valute.USD,
                    this.currencies_date = response.data.Date
                ));
            axios
                .get('/api/types')
                .then(response => (
                    this.types = response.data
                ));
        },
        methods: {
            onChange(index, event) {
                
            },
            saveBox() {
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
                .post(`/api/box/${this.$route.params.id}/edit`, {
                    id: this.box.id,
                    title: this.title,
                    pre_rub: this.pre_rub,
                    pre_usd: this.pre_usd,
                    marzha: this.marzha,
                    sborka: this.sborka,
                    price: this.price,
                    types: this.selected_types,
                    length: this.length,
                    width: this.width,
                    height: this.height,
                    weight: this.weight,
                    description: this.description,
                    descriptionmanager: this.descriptionmanager,
                })
                .then(response => (
                    this.$router.push({path: '/boxes'}) 
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
                this.price = Math.ceil((this.pre_rub + (parseFloat(this.currencies.Value) * this.pre_usd) + this.marzha + this.sborka) / 50)*50
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
            marzha: function (val) {
                if(!isNaN(parseFloat(val))) {
                    this.marzha = parseFloat(val)
                    this.TotalPrice()
                } else {
                    this.marzha = 0
                }
            },
            sborka: function (val) {
                if(!isNaN(parseFloat(val))) {
                    this.sborka = parseFloat(val)
                    this.TotalPrice()
                } else {
                    this.sborka = 0
                }
            },
        },
        components: {
        }
    }
</script>
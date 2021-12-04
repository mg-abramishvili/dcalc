<template>
    <div v-if="categories && categories.length > 0 && boxes && boxes.length > 0 && usdKurs && usdKurs > 0">
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новый компонент</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <label id="title_label">Название</label>
                <input v-model="title" id="title_input" type="text" class="form-control mb-3">

                <label>Курс USD <small>(на {{moment(usdKursDate).format('DD.MM.YYYY')}})</small></label>
                <input v-model="usdKurs" type="text" class="form-control mb-3" disabled>

                <div class="row" style="position: relative">
                    <div class="col-6">
                        <label id="pre_rub_label">Цена RUB</label>
                        <input v-model="pre_rub" id="pre_rub_input" type="text" class="form-control mb-3">
                    </div>
                    <div class="col-6">
                        <label id="pre_usd_label">Цена USD</label>
                        <input v-model="pre_usd" id="pre_usd_input" type="text" class="form-control mb-3">
                    </div>
                    <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: block; width: 10px; padding: 0; margin: 0; margin-top: 2px;">+</span>
                </div>

                <div class="form-group" style="position: relative;">
                    <label id="price_label">Цена (финальная)</label>
                    <input v-model="price" id="price_input" type="text" class="form-control mb-3">
                    <button @click="TotalPrice()" style="position: absolute; top: 50%; transform: translateY(-50%); right: 1rem; border: none; box-shadow: none; font-size: 0.7rem; background: none; margin-top: 0.75rem">пересчитать</button>
                </div>

                <label id="selectedCategory_label">Категория</label>
                <select v-model="selectedCategory" id="selectedCategory_input" class="form-select mb-3">
                    <option v-for="category in categories" :key="'key_' + category.id" :value="category.id">{{ category.title }}</option>
                </select>

                <div class="d-flex justify-content-between">
                    <label id="selectedBox_label">Совместимость</label>
                    <button @click="selectAllBoxes()" class="btn btn-sm">выбрать все</button>
                </div>
                <select v-model="selectedBox" id="selectedBox_input" class="form-control mb-3" style="height: 300px;" multiple>
                    <option v-for="box in boxes" :key="'box_' + box.id" :value="box.id">{{ box.title }}</option>
                </select>
                <button @click="saveElement()" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="spinner-border text-primary me-2" role="status">
            <span class="sr-only">Загрузка...</span>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: [],
                boxes: [],

                title: '',
                pre_rub: '',
                pre_usd: '',

                selectedCategory: '',
                selectedBox: [],
                
                usdKurs: '',
                usdKursDate: '',

                moment: moment,
            }
        },
        computed: {
            price: function () {
                if(this.pre_rub && this.pre_rub.length > 0 || this.pre_usd && this.pre_usd.length > 0) {
                    if(this.pre_rub && this.pre_rub.length > 0 && this.pre_usd && this.pre_usd.length > 0) {
                        return Math.ceil((parseFloat(this.pre_rub) + (parseFloat(this.usdKurs) * parseFloat(this.pre_usd))) / 50) * 50
                    } else if (!this.pre_rub) {
                        return Math.ceil(parseFloat(parseFloat(this.usdKurs) * parseFloat(this.pre_usd) / 50)) * 50
                    } else if (!this.pre_usd) {
                        return Math.ceil(parseFloat(this.pre_rub) / 50) * 50
                    }
                } else {
                    return 0
                }
            }
        },
        created() {
            axios
                .get('/api/categories')
                .then((response => {
                    this.categories = response.data
                    if(this.$route.params.category) {
                        this.selectedCategory = this.$route.params.category
                    }
                }));
            axios
                .get(`/api/boxes/type/all`)
                .then(response => (
                    this.boxes = response.data
                ));
            axios
                .get('https://www.cbr-xml-daily.ru/daily_json.js', { withCredentials: false })
                .then(response => (
                    this.usdKurs = response.data.Valute.USD.Value,
                    this.usdKursDate = response.data.Date
                ));
        },
        methods: {
            selectAllBoxes() {
                axios
                .get('/api/boxes/type/all')
                .then(response => (
                    this.selectedBox = response.data.map(box => box.id)
                ));
            },
            saveElement() {
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
                    pre_rub: this.pre_rub,
                    pre_usd: this.pre_usd,
                    price: this.price,
                    categories: this.selectedCategory,
                    boxes: this.selectedBox,
                })
                .then(response => (
                    this.$parent.counterElementsBoxes(),
                    this.$router.push({path: `/category/${this.selectedCategory}/elements/`}) 
                ))
                .catch((error) => {
                    if(error.response) {
                        for(var key in error.response.data.errors){
                            console.log(key)
                            document.getElementById(key + '_label').classList.add('text-danger')
                            document.getElementById(key + '_input').classList.add('border-danger')
                        }
                    }
                });
            },
        },
        components: {
        }
    }
</script>
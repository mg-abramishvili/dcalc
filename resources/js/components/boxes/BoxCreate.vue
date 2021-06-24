<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новый корпус</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
<!--
                {{ box_images }}

                <file-pond
                    name="box_images"
                    ref="pond"
                    label-idle="<span class='filepond--label-action'>Загрузить фотки корпуса</span>"
                    allow-multiple="true"
                    allow-reorder="true"
                    instant-upload="false"
                    accepted-file-types="image/jpeg, image/png"
                    :server="{ process }"
                    v-on:addfile="addFilepondFile"
                    v-on:removefile="removeFilepondFile"
                />
                -->

                <label id="title_label">Название</label>
                <input v-model="title" id="title_input" type="text" class="form-control mb-3">

                <div class="row">
                    <div class="col-12 col-md-3">
                        <label id="length_label">Длина</label>
                        <input v-model="length" id="length_input" type="text" class="form-control mb-3">
                    </div>
                    <div class="col-12 col-md-3">
                        <label id="width_label">Ширина</label>
                        <input v-model="width" id="width_input" type="text" class="form-control mb-3">
                    </div>
                    <div class="col-12 col-md-3">
                        <label id="height_label">Высота</label>
                        <input v-model="height" id="height_input" type="text" class="form-control mb-3">
                    </div>
                    <div class="col-12 col-md-3">
                        <label id="weight_label">Вес</label>
                        <input v-model="weight" id="weight_input" type="text" class="form-control mb-3">
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <label>Цена RUB</label>
                        <input type="text" class="form-control mb-3" v-model="pre_rub">
                    </div>
                    <div class="col-3">
                        <label>Цена USD</label>
                        <input type="text" class="form-control mb-3" v-model="pre_usd">
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
    import vueFilePond from 'vue-filepond'
    import 'filepond/dist/filepond.min.css'
    import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'
    import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
    import FilePondPluginImagePreview from 'filepond-plugin-image-preview'

    const FilePond = vueFilePond(
        FilePondPluginFileValidateType,
        FilePondPluginImagePreview
    )

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
                box_images: [],
                currencies: {},
                currencies_date: {},
                moment: moment,
                types: {},
                selected_types: [],

                width: '',
                height: '',
                length: '',
                weight: '',

                myFiles: ["cat.jpeg"]
            }
        },
        created() {
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
                .post(`/api/boxes`, {
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
                    box_images: this.box_images,
                })
                .then(response => (
                    this.$parent.counterElementsBoxes(),
                    this.$router.push({path: '/boxes'}) 
                ))
                .catch((error) => {
                    if(error.response) {
                        for(var key in error.response.data.errors){
                            if(document.getElementById(key + '_label')) {
                                document.getElementById(key + '_label').classList.add('text-danger')
                                document.getElementById(key + '_input').classList.add('border-danger')
                            }
                        }
                    }
                });
            },
            TotalPrice() {
                this.price = Math.ceil((this.pre_rub + (parseFloat(this.currencies.Value) * this.pre_usd) + this.marzha + this.sborka) / 50)*50
            },
            handleFilePondInit: function() {
                console.log('FilePond has initialized');

                // example of instance method call on pond reference
                this.$refs.pond.getFiles();
            },
            removeFilepondFile: function(file) {
                console.log('файл удален')
                console.log(this.$refs.pond.getFiles())
            },
            addFilepondFile: function(file) {
                console.log('файл добавлен')
                console.log(this.$refs.pond.getFiles())
            },
            storeFilepond: function(file, progress) {
                const box_images = this.$refs.pond.getFiles(0) 
                const formData = new FormData();
                formData.append('box_images', box_images)
                
                axios({
                    method: 'post',
                    url: '/api/box/file_upload',
                    data: formData,
                }).then(response => {
                    console.log(response)
                })
            },
            process: function(fieldName, file, metadata, load, error, progress, abort) {
                // set data
                const formData = new FormData();
                formData.append('box_images', file, file.id);

                // related to aborting the request
                const CancelToken = axios.CancelToken;
                const source = CancelToken.source();
                        
                // the request itself
                axios({
                    method: 'post',
                    url: '/api/box/file_upload',
                    data: formData,
                    //cancelToken: source.token,
                    onUploadProgress: (e) => {
                        // updating progress indicator
                        progress(e.lengthComputable, e.loaded, e.total);
                    }
                }).then(response => {
                    // passing the file id to FilePond
                    load(response)
                    this.box_images.push(response.data)
                }).catch((thrown) => {
                    if (axios.isCancel(thrown)) {
                        console.log('Request canceled', thrown.message);
                    } else {
                        // handle error
                    }
                });

                // Setup abort interface
                return {
                    abort: () => {
                        source.cancel('Operation canceled by the user.');
                    }
                };
            },
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
            FilePond,
        }
    }
</script>
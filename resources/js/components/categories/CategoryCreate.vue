<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">Новая категория</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <label id="title_label">Название</label>
                <input v-model="title" id="title_input" type="text" class="form-control mb-3">

                <label id="slug_label">Код</label>
                <input v-model="slug" id="slug_input" type="text" class="form-control mb-3" disabled>

                <div>
                    <button @click="saveCategory()" class="btn btn-primary">Сохранить</button>
                    <router-link :to="{name: 'Elements'}" class="btn btn-default">Отмена</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                title: '',
            }
        },
        created() {
        },
        computed: {
            slug: function () {
            return this.slugify(this.title)
            }
        },
        methods: {
            saveCategory() {
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
                .post('/api/categories', { title: this.title, slug: this.slug })
                .then(response => (
                    this.$router.push({path: '/elements'}) 
                ))
                .catch((error) => {
                    if(error.response) {
                        for(var key in error.response.data.errors){
                            console.log(key)
                            document.getElementById(key + '_label').classList.add('text-danger')
                            document.getElementById(key + '_input').classList.add('border-danger')
                        }
                    }
                })
            },
            slugify (text, ampersand = 'and') {
                const a = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя'
                const b = 'abvgdeezziiklmnoprstufxcchhyyyeya'
                const p = new RegExp(a.split('').join('|'), 'g')

                return text.toString().toLowerCase()
                    .replace(/[\s_]+/g, '-')
                    .replace(p, c =>
                    b.charAt(a.indexOf(c)))
                    .replace(/&/g, `-${ampersand}-`)
                    .replace(/[^\w-]+/g, '')
                    .replace(/--+/g, '-')
                    .replace(/^-+|-+$/g, '')
            }
        },
        watch: {
        },
        components: {
        }
    }
</script>

<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0" style="position:relative;">Компоненты</h1>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <router-link :to="{name: 'ElementCreate'}" class="btn btn-primary">Новый компонент</router-link>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 col-lg-3">
                <CatSidebar />
            </div>
            <div class="col-12 col-lg-9">

                <div class="card mb-4">
                    <div class="card-body">
                        <input v-model="searchInput" type="text" placeholder="Поиск" class="form-control form-control-lg">
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Наименование</th>
                                <th v-if="$parent.user.elements_prices === '1'" scope="col" class="text-end">Цена</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="box in filteredBoxes" :key="'box_' + box.id">
                                <td class="align-middle">{{ box.title }}</td>
                                <td v-if="$parent.user.elements_prices === '1'" class="align-middle text-end">{{ parseInt(box.price).toFixed(0) }} ₽</td>
                                <td class="align-middle text-end">
                                    <router-link v-if="$parent.user.elements_edit === '1'" :to="{name: 'BoxEdit', params: {id: box.id}}" class="btn btn-outline-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 align-middle"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                    </router-link>
                                </td>
                            </tr>
                            <tr v-for="element in filteredElements" :key="'element_' + element.id">
                                <td class="align-middle">{{ element.title }}</td>
                                <td v-if="$parent.user.elements_prices === '1'" class="align-middle text-end">{{ parseInt(element.price).toFixed(0) }} ₽</td>
                                <td class="align-middle text-end">
                                    <router-link v-if="$parent.user.elements_edit === '1'" :to="{name: 'ElementEdit', params: {id: element.id}}" class="btn btn-outline-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 align-middle"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CatSidebar from './CatSidebar.vue'

    export default {
        data() {
            return {
                elements: [],
                boxes: [],

                searchInput: '',
            }
        },
        created() {
            axios
                .get(`/api/boxes/type/all`)
                .then(response => (
                    this.boxes = response.data
                ));
            axios
                .get('/api/elements')
                .then(response => (
                    this.elements = response.data
                ));
        },
        methods: {
        },
        computed: {
            filteredBoxes() {
                return this.boxes.filter(box => {
                    return box.title.toLowerCase().includes(this.searchInput.toLowerCase())
                })
            },
            filteredElements() {
                return this.elements.filter(element => {
                    return element.title.toLowerCase().includes(this.searchInput.toLowerCase())
                })
            }
        },
        components: {
            CatSidebar
        }
    }
</script>

<style scoped>
    .list-group-item:hover {
        cursor: pointer;
    }
</style>
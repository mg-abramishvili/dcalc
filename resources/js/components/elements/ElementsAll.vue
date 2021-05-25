<template>
    <div>

        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0" style="position:relative;">Компоненты 
                    <span v-if="current_category" class="text-primary">
                        {{ current_category.title }}
                        <button @click="ecategory_edit_modal_toggle()" class="btn btn-outline p-0 ms-1 text-secondary" style="opacity: 0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 align-middle"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                        </button>
                    </span>
                </h1>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <router-link to="/elements/create" class="btn btn-primary">Новый компонент</router-link>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="card mb-2">
                    <div class="list-group list-group-flush">
                        <div v-for="element_category in element_categories" @click="filter_category(element_category)">
                            <a v-if="current_category.id === element_category.id" class="list-group-item list-group-item-action active">
                                {{ element_category.title }}
                            </a>
                            <a v-else class="list-group-item list-group-item-action">
                                {{ element_category.title }}
                            </a>
                        </div>
                    </div>
                </div>
                <button @click="ecategory_create_modal_toggle()" class="btn btn-outline-secondary btn-sm">добавить категорию</button>

                <EcategoryCreate :class="{ show: ecategory_create_modal === true, 'd-block': ecategory_create_modal === true }" />
                <div v-if="ecategory_create_modal" class="modal-backdrop fade show"></div>

                <EcategoryEdit v-bind:id="current_category.id" v-if="ecategory_edit_modal" :class="{ show: ecategory_edit_modal === true, 'd-block': ecategory_edit_modal === true }" />
                <div v-if="ecategory_edit_modal" class="modal-backdrop fade show"></div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Наименование</th>
                                <th scope="col" class="text-end">Цена</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="element in elements" :key="element.id">
                                <td class="align-middle">{{ element.id }}</td>
                                <td class="align-middle">{{ element.title }}</td>
                                <td class="align-middle text-end">{{ element.price }} ₽</td>
                                <td class="align-middle text-end">
                                    <button class="btn btn-warning">Правка</button>
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
    import EcategoryCreate from './EcategoryCreate'
    import EcategoryEdit from './EcategoryEdit'

    export default {
        data() {
            return {
                element_categories: [],
                elements: [],
                current_category: '',
                ecategory_create_modal: false,
                ecategory_edit_modal: false,
            }
        },
        created() {
            axios
                .get('/api/element-categories')
                .then(response => (
                    this.element_categories = response.data
                ));
            axios
                .get('/api/elements')
                .then(response => (
                    this.elements = response.data
                ));
        },
        methods: {
            filter_category(element_category) {
                axios
                .get(`/api/elements/category/${element_category.id}`)
                .then(response => (
                    this.elements = response.data
                ));
                axios
                .get(`/api/element-category/${element_category.id}`)
                .then(response => (
                    this.current_category = response.data
                ));
            },
            ecategory_create_modal_toggle() {
				if (this.ecategory_create_modal === false) {
					this.ecategory_create_modal = true
				} else {
					this.ecategory_create_modal = false
				}
			},
            ecategory_edit_modal_toggle() {
				if (this.ecategory_edit_modal === false) {
					this.ecategory_edit_modal = true
				} else {
					this.ecategory_edit_modal = false
				}
			},
            refresh() {
                axios
                .get('/api/element-categories')
                .then(response => (
                    this.element_categories = response.data
                ));
            }
        },
        components: {
            EcategoryCreate,
            EcategoryEdit
        }
    }
</script>

<style scoped>
    .list-group-item:hover {
        cursor: pointer;
    }
</style>
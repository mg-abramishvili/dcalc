<template>
    <div class="modal fade" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Правка раздела каталога</h5>
                    <button @click="ecategory_edit_modal_toggle()" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="mb-3">
                        <label class="form-label">Название</label>
                        <input v-model="title" class="form-control" placeholder="Название">
                    </div>			
                </div>
                <div class="modal-footer">
                    <button @click="delete_ecategory()" class="btn btn-outline-danger me-auto">Удалить категорию</button>
                    <button @click="ecategory_edit_modal_toggle()" class="btn btn-secondary">Отмена</button>
                    <button @click="store_ecategory()" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                ecategory: {},
                title: '',
            }
        },
        created() {
            axios
            .get(`/api/element-category/${this.$props.id}`)
            .then(response => (
                this.ecategory = response.data,
                this.title = response.data.title
            ));
        },
        methods: {
            ecategory_edit_modal_toggle() {
				this.$parent.ecategory_edit_modal = false
			},
            store_ecategory() {
                axios
                .post(`/api/ecategory_edit/${this.$props.id}`, { id: this.$props.id, title: this.title })
                .then(response => (
                    this.title = '',
                    this.$parent.ecategory_edit_modal = false,
                    this.$parent.refresh()
                ));
            },
        },
        components: {
        }
    }
</script>

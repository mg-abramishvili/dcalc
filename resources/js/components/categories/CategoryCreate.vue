<template>
    <div class="modal fade" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Новый раздел каталога</h5>
                    <button @click="category_create_modal_toggle()" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="mb-3">
                        <label class="form-label">Название</label>
                        <input v-model="title" class="form-control" placeholder="Название">
                    </div>			
                </div>
                <div class="modal-footer">
                    <button @click="category_create_modal_toggle()" class="btn btn-secondary">Отмена</button>
                    <button @click="store_category()" class="btn btn-primary">Сохранить</button>
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
        methods: {
            store_category() {
                axios
                .post('/api/categories', { title: this.title })
                .then(response => (
                    this.title = '',
                    this.$parent.category_create_modal = false,
                    this.$parent.refresh()
                ));
            }
        },
        components: {
        }
    }
</script>

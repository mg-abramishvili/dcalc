<template>
    <div>
        <h1 class="mt-0 mb-4">Компоненты</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Цена</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="element in elements" :key="element.id">
                    <td>{{ element.id }}</td>
                    <td>{{ element.title }}</td>
                    <td>{{ element.price }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                elements: []
            }
        },
        created() {
            axios
                .get('/api/elements')
                .then(response => (
                    this.elements = response.data
                ));
        },
        components: {
        }
    }
</script>
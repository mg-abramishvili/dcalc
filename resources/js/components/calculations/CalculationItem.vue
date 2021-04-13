<template>
    <div>
        <h2>Расчет №{{ calculation.id }}</h2>
        <h3>{{ calculation.comment }}</h3>
        <h4>{{ calculation.created_at }}</h4>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                calculation: {},
                moment: moment,
            }
        },
        created() {
            axios
                .get(`/api/calculation/${this.$route.params.id}`)
                .then(response => (
                    this.calculation = response.data
                ));
        },
        components: {
        }
    }
</script>
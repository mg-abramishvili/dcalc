<template>
    <div class="wrapper">
        <Header />
        <div class="container">
            <router-view :key="$route.path" />
        </div>
    </div>
</template>

<script>
    import Header from './components/Header'

    export default {
        data() {
            return {
            }
        },
        created() {
        },
        components: {
            Header
        }
    }
</script>
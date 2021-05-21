<template>
    <div>
        <h1 class="h3 mb-4">КП №{{offer.id}} для {{ offer.client }}</h1>
        <div class="card">
            <div class="card-body m-sm-3 m-md-5">
                <div class="mb-4">
                    {{offer.comment}}
                </div>

                <table class="table table-sm mb-3">
                    <thead>
                        <tr>
                            <th>Наименование</th>
                            <th class="text-end">Стоимость</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="element in offer.calculations[0].elements">
                            <td>{{ element.title }}</td>
                            <td class="text-end">{{ element.price }} ₽</td>
                        </tr>
                        <tr>
                            <th class="text-end">Итого </th>
                            <th class="text-end">{{ offer.calculations[0].price_total }} ₽</th>
                        </tr>
                    </tbody>
                </table>

                <div class="text-center">
                    <!--<p class="text-sm">
                        <strong>Extra note:</strong> Please send all items at the same time to the shipping address. Thanks in advance.
                    </p>-->

                    <a href="#" class="btn btn-primary">
                        Скачать PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                offer: {},
                moment: moment,
            }
        },
        created() {
            axios
                .get(`/api/offer/${this.$route.params.id}`)
                .then(response => (
                    this.offer = response.data
                ));
        },
        components: {
        }
    }
</script>
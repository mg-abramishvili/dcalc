<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">
                    Расчет №{{ calculation.id }} от {{moment(calculation.created_at).format('D MMMM YYYY')}}
                </h1>    
                <template v-for="user in calculation.users">
                    <span class="text-sm">автор: {{ user.name }}</span>
                </template>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <!--<router-link :to="{name: 'CalculationEdit', params: {id: calculation.id}}" class="btn btn-warning">Изменить</router-link>-->
                <template v-if="calculation.offers && calculation.offers.length">
                    <div class="text-sm">У расчета есть КП: </div>
                    <template v-for="offer in calculation.offers">
                        <router-link :to="{name: 'OfferItem', params: {id: offer.id}}" class="btn btn-outline-primary">КП №{{offer.id}} от {{moment(offer.created_at).format('D MMMM YYYY')}}</router-link>
                    </template>
                </template>
                <template v-else>
                    <router-link :to="{name: 'OfferCreate', params: {calculation_id: calculation.id}}" class="btn btn-primary">Создать КП из расчета</router-link>
                </template>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                
                
                <table class="table table-striped table-hover dataTable no-footer dtr-inline">
                    <!--<thead>
                        <th>
                            
                        </th>
                        <th>
                            Наименование
                        </th>
                        <th class="text-end">
                            Цена
                        </th>
                    </thead>-->
                    <tbody>
                        <tr v-for="box in calculation.boxes">
                            <td>Корпус</td>
                            <td>{{ box.title }}</td>
                            <td class="text-end">{{ box.price }} ₽</td>
                        </tr>
                        <template v-for="element in calculation.elements">
                        <tr v-if="element.price > 0">
                            <td>{{ element.categories[0].title }}</td>
                            <td>{{ element.title }}</td>
                            <td class="text-end">{{ element.price }} ₽</td>
                        </tr>
                        </template>
                    </tbody>
                </table>
                <div class="text-end">
                    <p class="m-0">
                        Итого: 
                        <strong class="text-primary font-weight-bolder">{{ calculation.price_total }} ₽</strong>
                    </p>
                </div>
                <!--<div class="mt-4">
                    <div class="alert alert-primary alert-outline">
                        <div></div>
                        <div class="alert-message">
                            <h6 class="alert-heading">Комментарий:</h6>
                            <p class="mb-0">{{ calculation.comment }}</p>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
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
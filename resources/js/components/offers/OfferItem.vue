<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 mb-0">КП №{{offer.id}} для {{ offer.client }}</h1>
            </div>
            <div class="col-12 col-lg-6 text-end">
                <a @click="generatePdf" class="btn btn-primary">
                    Скачать PDF
                </a>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body m-sm-3 m-md-5" id="offer">
                <h2 class="h2 mt-4 mb-4 text-center">
                    Коммерческое предложение
                    <br>для {{offer.client}}
                </h2>
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
                        <template v-for="offer_calc in offer.calculations">
                            <tr v-for="element in offer_calc.elements">
                                <td>{{ element.title }}</td>
                                <td class="text-end">{{ element.price }} ₽</td>
                            </tr>
                        </template>
                        <tr>
                            <th class="text-end">Итого </th>
                            <th class="text-end">
                                <template v-for="of_c in offer.calculations">
                                    {{ of_c.price_total }} ₽
                                </template>
                            </th>
                        </tr>
                    </tbody>
                </table>

                <div class="text-center">
                    <!--<p class="text-sm">
                        <strong>Extra note:</strong> Please send all items at the same time to the shipping address. Thanks in advance.
                    </p>-->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import jsPDF from 'jspdf'
    import html2canvas from 'html2canvas'

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
        methods: {
            generatePdf() {
                html2canvas(document.getElementById('offer'), {imageTimeout: 5000, useCORS: true}).then(canvas => {
                    let img = canvas.toDataURL('image/png')
                    let pdf = new jsPDF('p', 'pt', 'a4')
                    pdf.addImage(img, 'JPEG', 5, 5, 595.28, 841.89)
                    pdf.save(`KP_${this.offer.id}.pdf`)
                })
            }
        },
        components: {
            jsPDF,
            html2canvas
        }
    }
</script>
<style scoped>
    #offer {
        width: 595.28pt;
        height: 841.89pt;
    }
</style>
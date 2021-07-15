<template>
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-12 col-lg-6">
                <h1 class="h3 m-0">{{ project.name }}</h1>
            </div>
        </div>

        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a @click="tabSelect('tab_general')" id="tab_general_link" class="nav-link active" data-bs-toggle="tab" role="tab">Общая информация</a></li>
                <li class="nav-item"><a @click="tabSelect('tab_calculations')" id="tab_calculations_link" class="nav-link" data-bs-toggle="tab" role="tab">Расчеты</a></li>
                <li class="nav-item"><a @click="tabSelect('tab_kps')" id="tab_kps_link" class="nav-link" data-bs-toggle="tab" role="tab">КП</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_general" role="tabpanel">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="progress mb-3">
                                <div v-if="project.status === 'new'" class="progress-bar bg-primary" role="progressbar" style="width: 25%">
                                    Статус: Новый
                                </div>
                                <div v-if="project.status === 'in_works'" class="progress-bar bg-primary" role="progressbar" style="width: 50%">
                                    Статус: В работе
                                </div>
                                <div v-if="project.status === 'warehouse'" class="progress-bar bg-primary" role="progressbar" style="width: 75%">
                                    Статус: Склад
                                </div>
                                <div v-if="project.status === 'waiting_for_review'" class="progress-bar bg-primary" role="progressbar" style="width: 90%">
                                    Статус: Ожидает отзыва клиента
                                </div>
                            </div>

                            <div class="row align-items-center mb-4">
                                <div class="col-6">Срок сдачи</div>
                                <div class="col-6 text-end">{{moment(project.deadline).format('D MMMM YYYY')}}</div>
                            </div>
                            <div class="row align-items-center mb-4">
                                <div class="col-6">Ответственный</div>
                                <div class="col-6 text-end">
                                    <template v-for="user in project.users">
                                        <img src="/img/profile.png" width="32" height="32" class="rounded-circle me-2">
                                        {{ user.name }}
                                    </template>
                                </div>
                            </div>
                            <div class="row align-items-center mb-4">
                                <div class="col-6">Конечник</div>
                                <div class="col-6 text-end">
                                    <template v-for="endclient in project.endclients">
                                        {{ endclient.name }}
                                    </template>
                                </div>
                            </div>
                            <div class="row align-items-center mb-4">
                                <div class="col-6">Партнер</div>
                                <div class="col-6 text-end">
                                    <template v-for="partner in project.partners">
                                        {{ partner.name }}
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="project_chat">
                                <template v-if="chat_messages && chat_messages.length">
                                    <div v-for="cm in chat_messages" class="chat-message-left pb-4">
                                        <div>
                                            <img src="/img/profile.png" class="rounded-circle me-1" width="40" height="40">
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ms-3" style="width: 100%;">
                                            <div class="fw-bold small mb-1">{{ cm.user.name }}</div>
                                            {{ cm.message }}
                                            <div class="text-muted small text-nowrap mt-2" style="font-size: 10px; color: rgb(169 169 169) !important">{{ moment(cm.created_at).format('DD.MM.YYYY H:mm') }}</div>
                                        </div>
                                    </div>
                                </template>
                                <template v-else>
                                    <p class="m-0 text-center" style="color: #ccc;">Сообщений нет</p>
                                </template>
                            </div>
                            <div class="project_chat_input">
                                <div class="row align-items-center mt-3">
                                    <div class="col-8">
                                        <textarea v-model="chat_message" class="form-control" rows="2" placeholder="Сообщение..."></textarea>
                                    </div>
                                    <div class="col-4">
                                        <button @click="saveMessage()" class="btn btn-lg btn-primary" style="width: 100%; height: 100%;">Написать</button>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>                    
                    
                </div>
                <div class="tab-pane" id="tab_calculations" role="tabpanel">
                    <table class="table table-striped table-hover dataTable no-footer dtr-inline">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Корпус</th>
                                <th>Компоненты</th>
                                <th>Кол-во</th>
                                <th class="text-end">Стоимость</th>
                                <th class="text-end">Дата расчета</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="calculation in project.calculations" :key="calculation.id" @click="goToCalculation(calculation.id)">
                                <td class="align-middle">
                                    Расчет №{{ calculation.id }}
                                </td>
                                <td class="align-middle">
                                    <template v-for="calculation_box in calculation.boxes">
                                        {{ calculation_box.title }}
                                    </template>
                                </td>
                                <td class="align-middle">
                                    <template v-for="calculation_element in calculation.elements">
                                        <template v-for="calculation_element_category in calculation_element.categories">
                                            {{ calculation_element_category.title }}
                                        </template>
                                        {{ calculation_element.title }}
                                        <br>
                                    </template>
                                </td>
                                <td class="align-middle text-end">
                                    
                                </td>
                                <td class="align-middle text-end">
                                    <strong>{{ calculation.price_total }} ₽</strong>
                                </td>
                                <td class="align-middle text-end">
                                    {{moment(calculation.created_at).format('D MMMM YYYY')}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="tab_kps" role="tabpanel">
                    <div v-for="offer in project.offers" :key="'offer' + offer.id" class="card-body m-sm-3 m-md-5" id="offer">
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
        </div>


    </div>
</template>

<script>
    export default {
        data() {
            return {
                project: {},
                offer: {},
                moment: moment,

                chat_messages: {},
                chat_message: '',
            }
        },
        created() {
            axios
                .get(`/api/project/${this.$route.params.id}`)
                .then(response => (
                    this.project = response.data
                ));
            axios
                .get(`/api/messages/${this.$route.params.id}`)
                .then(response => (
                    this.chat_messages = response.data
                ));
        },
        methods: {
            tabSelect(tab_id) {
                document.getElementById('tab_general').classList.remove('active')
                document.getElementById('tab_calculations').classList.remove('active')
                document.getElementById('tab_kps').classList.remove('active')
                document.getElementById('tab_general_link').classList.remove('active')
                document.getElementById('tab_calculations_link').classList.remove('active')
                document.getElementById('tab_kps_link').classList.remove('active')

                document.getElementById(tab_id).classList.add('active')
                document.getElementById(tab_id + '_link').classList.add('active')
            },
            goToCalculation(id) {
                this.$router.push({ name: 'CalculationItem', params: { id: id } });
            },
            saveMessage() {
                if(this.chat_message && this.chat_message.length > 0) {
                    axios
                        .post('/api/messages', { user_id: this.$parent.user.id, project_id: this.project.id, message: this.chat_message })
                        .then((response => {
                            axios
                                .get(`/api/messages/${this.$route.params.id}`)
                                .then(response => (
                                    this.chat_messages = response.data,
                                    this.chat_message = ''
                                ));
                        }));
                } else {
                    alert('Введите сообщение')
                }
            },
        },
        watch: {
        },
        components: {
        }
    }
</script>
<style scoped>
    .table tr:hover {
        cursor: pointer;
    }
    table.dataTable>thead>tr>td:not(.sorting_disabled),
    table.dataTable>thead>tr>th:not(.sorting_disabled) {
        padding-right: .75rem;
    }
    #offer {
        width: 595.28pt;
        height: 841.89pt;
    }
</style>
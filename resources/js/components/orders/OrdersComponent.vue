<template>
    <div v-if="status">
        <div class="container mb-5">
            <div class="row">
                <div class="col-12">
                    <div class="p-3 mt-3 mb-2 bg-success text-white text-center">Ваш заказ успешно принят в обработку, с вами скоро свяжутся!<br>номер вашего заказа <a :href="'/home/'+orderId"><span class="text-dark font-weight-bold">№{{order}}</span></a></div>
                </div>
                <div class="col text-center mt-3">
                    <button type="button" class="btn btn-primary px-5" @click="refreshOrder()">Добавить новый заказ</button>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="container mb-5">
            <h5>Добавить заказ</h5>
            <h5 class="text-success">Отправитель</h5>
            <form method="POST" action="/profile" onsubmit="return false;">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>Шаблон</label>
                            <input list="templates" class="form-control bg-light" id="template" :data-value="sender.iin+'_0_'+current" :placeholder="sender.iin+'_0_'+current" v-model="template" @change="changeTemplate">
                            <datalist id="templates">
                                <option v-for="template in templateList" :value="template['name']">{{template['name']}}</option>

                            </datalist>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" v-model="save" id="customCheck">
                            <label class="custom-control-label" for="customCheck">Сохранить шаблон</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Наименование</label>
                            <input type="text" autocomplete="none" class="form-control" v-model="sender.name" readonly="true" id="sender_name">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>БИН</label>
                            <input type="text" autocomplete="none" class="form-control" v-model="sender.iin" readonly="true" id="sender_iin">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Страна</label>
                            <select class="form-control text-capitalize bg-light" id="sender_country" @change="changeCity" v-model="sender.country">
                                <option v-for="country_item in countries" :value="country_item['id']">{{country_item['russian_name']}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Область</label>
                            <input type="text" class="form-control bg-light" v-model="sender.region" id="sender_region">
                            <small class="form-text text-success">Обязательное поле.</small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Город</label>
                            <select class="form-control text-capitalize bg-light" id="sender_city" v-model="sender.city">
                                <option v-for="city_item in cities" :value="city_item['id']">{{city_item['russian_name']}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Индекс</label>
                            <input type="text" class="form-control bg-light" v-model="sender.index">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Улица</label>
                            <input type="text" class="form-control bg-light" v-model="sender.street" id="sender_street">
                            <small class="form-text text-success">Обязательное поле.</small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Дом</label>
                            <input type="text" class="form-control bg-light" v-model="sender.house" id="sender_house">
                            <small class="form-text text-success">Обязательное поле.</small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Офис\Квартира</label>
                            <input type="text" class="form-control bg-light" v-model="sender.office">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Контактное лицо</label>
                            <input type="text" class="form-control bg-light" v-model="sender.person.name" id="sender_person_name">
                            <small class="form-text text-success">Обязательное поле.</small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Телефон</label>
                            <input type="tel" class="form-control bg-light" v-model="sender.person.phone" id="sender_person_phone" v-mask="'+7(###) ###-##-##'" placeholder="+7(___) ___-__-__">
                            <small class="form-text text-success">Обязательное поле.</small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Дата забора</label>
                            <input type="date" class="form-control bg-light" v-model="sender.person.take_date" id="sender_person_take_date">
                            <small class="form-text text-success">Обязательное поле.</small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Время забора</label>
                            <select class="form-control bg-light" v-model="sender.person.take_time" id="sender_person_take_time">
                                <option v-for="(take_time_template, index) in senderTemplate.person.take_time_list" :value="index">{{take_time_template}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="receiver-list">

                    <div v-bind:class="[receiver ? 'form-receiver mb-3 w-100' : 'd-none', '']" class="" v-for="(item,index) in receiver" :id="'form-receiver-'+index">
                        <button class="btn btn-danger float-right btn-sm receiver-delete" @click="removeReceiver(index)"><i class="fas fa-trash" aria-hidden="true"></i></button>
                        <button class="btn btn-success float-right btn-sm mr-3 receiver-hide" @click="viewReceiver(index)"><i class="fas fa-chevron-down" aria-hidden="true"></i></button>
                        <h5 class="text-success mt-1">Получатель {{index+1}}</h5>
                        <div class="view-block">
                            <div class="row" id="receiver-0-body">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label >Шаблон</label>
                                        <input list="select_1" class="form-control" value="" :id="'template-'+index" v-model="receiver[index].template" @change="changeReceiverTemplate(index)" :placeholder="receiver[index].placeholder" :data-value="receiver[index].data">
                                        <datalist id="select_1">
                                            <option v-for="temp in templateList" :value="temp.name">{{temp.name}}</option>
                                        </datalist>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" :id="'customCheck-'+index" checked="" v-model="receiver[index].saveTemplate">
                                            <label class="custom-control-label" :for="'customCheck-'+index">Сохранить шаблон</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group mt-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" :id="'receiver-type-0-'+index" value="0" v-model="receiver[index].type" v-on:change="receiverTypeChange(index)">
                                            <label class="form-check-label" :for="'receiver-type-0-'+index">
                                                Физическое лицо
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" :id="'receiver-type-1-'+index" value="1" checked v-model="receiver[index].type" v-on:change="receiverTypeChange(index)">
                                            <label class="form-check-label" :for="'receiver-type-1-'+index">
                                                Юридическое лицо
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Наименование</label>
                                        <input type="text" class="form-control" :id="'name-'+index" v-model="receiver[index].name" :readonly="!receiver[index].status">
                                        <small class="form-text text-success" v-if="receiver[index].status">Обязательное поле.</small>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">БИН</label>
                                        <input type="text" class="form-control" :id="'iin-'+index" v-model="receiver[index].iin" :readonly="!receiver[index].status">
                                        <small class="form-text text-success" v-if="receiver[index].status">Обязательное поле.</small>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Код заказчика</label>
                                        <input type="text" class="form-control" v-model="receiver[index].code">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Страна</label>
                                        <select class="form-control text-capitalize" @change="changeCityReceiver(index)" v-model="receiver[index].country">
                                            <option v-for="(country,index) in receiver[index].countries" :value="country.id">{{country.russian_name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Область</label>
                                        <input type="text" class="form-control" :id="'region-'+index" v-model="receiver[index].region">
                                        <small class="form-text text-success">Обязательное поле.</small>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Город</label>
                                        <select class="form-control text-capitalize" v-model="receiver[index].city">
                                            <option v-for="receiverCity in receiver[index].cities" :value="receiverCity.id">{{receiverCity.russian_name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Индекс</label>
                                        <input type="text" class="form-control" v-model="receiver[index].index">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Улица</label>
                                        <input type="text" class="form-control" :id="'street-'+index" v-model="receiver[index].street">
                                        <small class="form-text text-success">Обязательное поле.</small>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Дом</label>
                                        <input type="text" class="form-control" :id="'house-'+index" v-model="receiver[index].house">
                                        <small class="form-text text-success">Обязательное поле.</small>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Офис\Квартира</label>
                                        <input type="text" class="form-control" v-model="receiver[index].office">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Контактное лицо</label>
                                        <input type="text" class="form-control" :id="'contact-person-name-'+index" v-model="receiver[index].contactPerson.name">
                                        <small class="form-text text-success">Обязательное поле.</small>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Телефон</label>
                                        <input type="text" class="form-control" :id="'contact-person-phone-'+index" v-model="receiver[index].contactPerson.phone" v-mask="'+7(###) ###-##-##'" placeholder="+7(___) ___-__-__">
                                        <small class="form-text text-success">Обязательное поле.</small>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5 class="text-success mt-2 mb-3">Общая информация</h5>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">К отправлению, мест</label>
                                        <input type="text" class="form-control" :id="'contact-info-place-'+index" v-model="receiver[index].info.place">
                                        <small class="form-text text-success">Обязательное поле.</small>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Вес, кг</label>
                                        <input type="text" class="form-control" :id="'contact-info-weight-'+index" v-model="receiver[index].info.weight" v-money="weight" placeholder="0,0" autocomplete="none">
                                        <small class="form-text text-success">Обязательное поле.</small>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Объем, м3</label>
                                        <input type="text" class="form-control" :id="'contact-info-volume-'+index" v-model="receiver[index].info.volume" v-money="volume" placeholder="0,0" autocomplete="none">
                                        <small class="form-text text-success">Обязательное поле.</small>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="text-secondary">Примечание</label>
                                        <input type="text" class="form-control" v-model="receiver[index].info.annotation">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5 class="text-success mt-2 mb-3">Тип оплаты</h5>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group mt-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" :id="'radio-payment-person-'+index" value="0" checked v-model="receiver[index].payment.personType">
                                            <label class="form-check-label" :for="'radio-payment-person-'+index">
                                                Отправителем
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" :id="'radio-payment-person-1-'+index" value="1" v-model="receiver[index].payment.personType">
                                            <label class="form-check-label" :for="'radio-payment-person-1-'+index">
                                                Получателем
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="payment_type_1">Способ оплаты</label>
                                        <select class="form-control text-capitalize" name="payment_type_1" id="payment_type_1" v-model="receiver[index].payment.type">
                                            <option v-for="(payment,paymentIndex) in receiver[index].payment.typeList" :value="paymentIndex">{{payment}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5 class="text-success mt-2 mb-3">Тип доставки</h5>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group mt-3">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" :id="'radio-payment-deliver-type-'+index" value="0" checked v-model="receiver[index].deliver.type">
                                            <label class="form-check-label" :for="'radio-payment-deliver-type-'+index">
                                                Стандарт
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" :id="'radio-payment-deliver-type-1-'+index" value="1" v-model="receiver[index].deliver.type">
                                            <label class="form-check-label" :for="'radio-payment-deliver-type-1-'+index">
                                                Экспресс
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" :id="'radio-payment-deliver-type-2-'+index" value="2" v-model="receiver[index].deliver.type">
                                            <label class="form-check-label" :for="'radio-payment-deliver-type-2-'+index">
                                                Ускоренная ЖД
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="text-secondary">Наложенный платеж</label>
                                        <input type="text" class="form-control" v-model="receiver[index].deliver.payment">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="text-secondary">Объявленная стоимость</label>
                                        <input type="text" class="form-control" v-model="receiver[index].deliver.price" v-money="money">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-sm-center mb-3">
                    <div class="col-12 col-sm-5">
                        <button type="button" class="btn btn-primary btn-block mt-3 new-receiver" @click="newReceiver">Добавить получателя</button>
                    </div>
                </div>
                <div class="row justify-content-sm-center">
                    <div class="col-12 col-sm-5">
                        <button type="button" class="btn btn-success btn-block" @click="readyOrder">Добавить заказ</button>
                    </div>
                </div>
            </form>
        </div>
        <!--


        -->
    </div>
</template>
<script>

    export default {
        data() {
            return {
                money: {
                    decimal: ',',
                    thousands: '',
                    suffix: ' ₸',
                    precision: 1,
                    masked: true /* doesn't work with directive */
                },
                weight: {
                    decimal: ',',
                    thousands: '',
                    precision: 1,
                    masked: true /* doesn't work with directive */
                },
                volume: {
                    decimal: ',',
                    thousands: '.',
                    precision: 1,
                    masked: true /* doesn't work with directive */
                },
                current: this.currentDate(),
                status: false,
                orderId: 0,
                order: 0,
                cities: [],
                countries: [],
                template: '',
                save: false,
                senderTemplate: {
                    name: '',
                    iin: '',
                    country: 1,
                    region: '',
                    city: '',
                    index: '',
                    street: '',
                    house: '',
                    office: '',
                    person: {
                        name: '',
                        phone: '',
                        take_date: '',
                        take_time: 0,
                        take_time_list: ['До обеда','После обеда'],
                    },
                },
                sender: {
                    name: '',
                    iin: '',
                    country: 1,
                    region: '',
                    city: '',
                    index: '',
                    street: '',
                    house: '',
                    office: '',
                    person: {
                        name: '',
                        phone: '',
                        take_date: '',
                        take_time: '',
                    },
                },
                templateList: [],
                receiverTemplate: {
                    template: '',
                    placeholder: '',
                    data: '',
                    name: '',
                    saveTemplate: false,
                    type: 1,
                    status: true,
                    iin: '',
                    code: '',
                    countries: [],
                    country: 1,
                    region: '',
                    cities: [],
                    city: '',
                    index: '',
                    house: '',
                    street: '',
                    office: '',
                    contactPerson: {
                        name: '',
                        phone: '',
                    },
                    info: {
                        place: '',
                        weight: '',
                        volume: '',
                        annotation: '',
                    },
                    payment: {
                        personType: 0,
                        typeList: ['Перечислением на счет','Наличными'],
                        type: 0,
                    },
                    deliver: {
                        type: 0,
                        payment: '',
                        price: '',
                    }

                },
                receiver: [],
                model: ''
            }
        },
        mounted() {

        },
        created() {
            this.setValues();
            this.getCountries();
            this.getTemplateList();
            this.receiverCity(this.receiverTemplate.country);
        },
        methods: {
            getCountries() {
                axios.get('order/countries').then(response => (this.countries = response.data, this.receiverTemplate.countries = response.data));
            },
            receiverCity(id) {
                axios.get('order/city_list/'+id).then(response => (this.receiverTemplate.cities = response.data, this.receiverTemplate.city = this.receiverTemplate.cities[0].id, this.changeCity() ));
            },
            getTemplateList() {
                axios.get('order/template_list').then(response => (this.templateList = response.data));
            },
            setSender() {
                this.receiver = [];
                this.changeCity();
                this.current = this.currentDate();
                /*let dateTemp = this.getDateTemplate(0);
                $("#template").attr('placeholder',dateTemp).data('data-value',dateTemp);*/

            },
            changeCity() {
                axios.get('order/city_list/'+this.sender.country).then(response => (this.cities = response.data, this.sender.city = response.data[0].id));
            },
            setValues() {
                axios.get('user').then(response => (
                    this.senderTemplate.name = response.data[2],
                        this.senderTemplate.iin = response.data[1],
                        this.sender = Object.assign({}, this.senderTemplate)
                ));
            },
            receiverTypeChange(id) {
                if (this.receiver[id].type == 0) {
                    this.receiver[id].status = false;
                } else {
                    this.receiver[id].status = true;
                }
            },
            readyOrder() {
                if (this.sender.region.trim() === '') {
                    return $("#sender_region").focus();
                } else if (this.sender.street.trim() === '') {
                    return $("#sender_street").focus();
                } else if (this.sender.house.trim() === '') {
                    return $("#sender_house").focus();
                } else if (this.sender.person.name.trim() === '') {
                    return $("#sender_person_name").focus();
                } else if (this.sender.person.phone.trim() === '') {
                    return $("#sender_person_phone").focus();
                } else if (this.sender.person.take_date.trim() === '') {
                    return $("#sender_person_take_date").focus();
                }
                if (this.receiver.length === 0) {
                    return Vue.$toast.open({
                        message: 'Пожалуйста укажите получателя!',
                        type: 'warning',
                        position: 'top-left',
                        duration: 5000,
                    });
                } else {
                    for (let index = 0, length = this.receiver.length; index < length ; index++) {
                        let value = this.receiver[ index ];
                        if (value.type == 0 && value.name.trim() === '') {
                            value.name = '-';
                        }
                        if (value.type == 1 && value.name.trim() === '') {
                            return $("#name-"+index).focus();
                        } else if (value.type == 1 && value.iin.trim() === '') {
                            return $("#iin-"+index).focus();
                        } else if (value.region.trim() === '') {
                            return $("#region-"+index).focus();
                        } else if (value.street.trim() === '') {
                            return $("#street-"+index).focus();
                        } else if (value.house.trim() === '') {
                            return $("#house-"+index).focus();
                        } else if (value.contactPerson.name.trim() === '') {
                            return $("#contact-person-name-"+index).focus();
                        } else if (value.contactPerson.phone.trim() === '') {
                            return $("#contact-person-phone-"+index).focus();
                        } else if (value.info.place.trim() === '') {
                            return $("#contact-info-place-"+index).focus();
                        } else if (value.info.weight.trim() === '0,0') {
                            return $("#contact-info-weight-"+index).focus();
                        } else if (value.info.volume.trim() === '0,0') {
                            return $("#contact-info-volume-"+index).focus();
                        }
                        if (value.template.trim() === '') {
                            value.template = $("#template-"+index).data('value');
                        }
                    }
                }


                if (!this.template.trim()) {
                    this.template = this.sender.iin+'_0_'+this.current;
                }

                let self = this;
                axios.post('/order/save', {
                    template: {
                        name: this.template,
                        save: this.save,
                    },
                    sender: this.sender,
                    receiver: this.receiver

                }).then(function (response) {

                    self.order = response.data[0];
                    self.orderId = response.data[1];
                    self.status = true;

                }).catch(function (error) {

                    return Vue.$toast.open({
                        message: error.response.data.error,
                        type: 'error',
                        position: 'top-left',
                        duration: 5000,
                    });

                });


            },

            currentDate() {
                let date = new Date();
                let day = date.getDate();
                day = day<10 ? '0'+day : day;
                let month = date.getMonth()+1;
                month = month< 10 ? '0'+month: month;
                let hours = date.getHours();
                hours = hours< 10 ? '0'+hours: hours;
                let minutes = date.getMinutes();
                minutes = minutes< 10 ? '0'+minutes: minutes;
                let seconds = date.getSeconds();
                seconds = seconds<10 ? '0'+seconds: seconds;
                return day+'-'+month+'-'+date.getFullYear()+'_'+hours+':'+minutes+':'+seconds;
            },
            getDateTemplate(id) {

                let currentDate = this.currentDate();
                const date = new Date();
                return this.senderTemplate.iin+'_'+id+'_'+currentDate;

            },
            refreshOrder() {

                this.template = '';
                this.save = true;
                this.status = false;
                this.getTemplateList();
                this.setSender();

            },

            changeCityReceiver(id) {

                axios.get('order/city_list/'+this.receiver[id].country).then(response => (this.receiver[id].cities = response.data,  this.receiver[id].city = this.receiver[id].cities[0].id));
            },
            show(a) {
                console.log(a);
            },
            newReceiver() {
                this.receiver.push(Object.assign({}, this.receiverTemplate));
                let id = this.receiver.length - 1;
                let dateTemp = this.getDateTemplate(this.receiver.length);
                this.receiver[id].cities = this.receiverTemplate.cities;
                this.receiver[id].placeholder = dateTemp;
                this.receiver[id].data = dateTemp;
            },
            changeTemplate() {
                let self = this;
                axios.get('order/template/'+this.template).then(function(response) {
                    if (response.data.length === 0) return;
                    self.sender = JSON.parse(response.data[0].data)
                });
            },
            changeReceiverTemplate(id) {
                if (this.receiver[id].template.trim() === '') return;
                let receiver = this.receiver[id];

                axios.get('order/template_receiver/'+this.receiver[id].template).then(function(response) {
                    if (response.data.length === 0) return;
                    let data = JSON.parse(response.data[0].data);
                    receiver.name = data.name;
                    receiver.placeholder = data.placeholder;
                    receiver.data = data.data;
                    receiver.saveTemplate = data.saveTemplate;
                    receiver.type = data.type;
                    receiver.status = data.status;
                    receiver.iin = data.iin;
                    receiver.code = data.code;
                    receiver.countries = data.countries;
                    receiver.country = data.country;
                    receiver.region = data.region;
                    receiver.cities = data.cities;
                    receiver.city = data.city;
                    receiver.index = data.index;
                    receiver.house = data.house;
                    receiver.street = data.street;
                    receiver.office = data.office;
                    receiver.contactPerson.name = data.contactPerson.name;
                    receiver.contactPerson.phone = data.contactPerson.phone;
                    receiver.info.place = data.info.place;
                    receiver.info.weight = data.info.weight;
                    receiver.info.volume = data.info.volume;
                    receiver.info.annotation = data.info.annotation;
                    receiver.payment.personType = data.payment.personType;
                    receiver.payment.typeList = data.payment.typeList;
                    receiver.payment.type = data.payment.type;
                    receiver.deliver.type = data.deliver.type;
                    receiver.deliver.payment = data.deliver.payment;
                    receiver.deliver.price = data.deliver.price;
                });
            },

            removeReceiver(id) {
                this.receiver.splice(id,1);
            },
            viewReceiver(id) {
                $("#form-receiver-"+id).find('.receiver-hide').toggleClass('reverse').end().find('.view-block').fadeToggle(0);
            },

        }
    }
</script>

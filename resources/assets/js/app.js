require('./bootstrap');

window.Vue = require('vue');

Vue.component('user', require('./components/user.vue').default);
Vue.component('promocion', require('./components/promocion.vue').default);
Vue.component('tipo_pago', require('./components/tipo_pago.vue').default);
Vue.component('servicio', require('./components/servicio.vue').default);
Vue.component('tipo_habitacion', require('./components/tipo_habitacion.vue').default);
Vue.component('habitacion', require('./components/habitacion.vue').default);
Vue.component('reserva', require('./components/reserva.vue').default);
Vue.component('reserva_guest', require('./components/reserva_guest.vue').default);

const app = new Vue({
    el: '#app',
    data :{
        menu: 0   
    }
});
